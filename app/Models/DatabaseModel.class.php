<?php

namespace kivweb\Models;

class DatabaseModel {
    private static $database;
    private $pdo;

    private function __construct() {
        $this->pdo = new \PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        $this->pdo->exec("set names utf8");
    }


    public static function getDatabaseModel() {
        if(empty(self::$database)) {
            self::$database = new DatabaseModel();
        }
        return self::$database;
    }

    public function getAllArticles() : array {
        $query = "select a.name, a.abstract, a.document_name, u.name as author, a.publish_date from 
            (select * from cacha_articles where publish_date is not null and state = 2) as a join cacha_users as u on a.author = u.id";
        return $this->queryAll($query);
    }

    public function getUserArticles($id)
    {
        $query = "select a.id, a.name, a.abstract, a.document_name, u.name as author, a.creation_date, a.publish_date, s.title as state, a.evaluation from 
            (select * from cacha_articles where author = ?) as a join cacha_users as u on a.author = u.id
                                                             join cacha_states as s on a.state = s.id
                                                             order by a.state";
        return $this->queryAll($query, [$id]);
    }

    public function getUserName($name){
        $query = "select name from cacha_users where name = ?";
        return $this->queryOne($query, [$name]);
    }


    public function getArticelName($name)
    {
        $query = "select name from cacha_articles where name = ?";
        return $this->queryOne($query, [$name]);
    }

    public function registrateUser($name, $pass){
        $query = "insert into cacha_users (name, password, reg_date) values (?, ?, ?)";
        $params = [$name, password_hash($pass, PASSWORD_DEFAULT), date("Y-m-d")];
        return $this->query($query, $params);
    }


    public function addArticel($name, $abstract, $document_name)
    {
        $query = "insert into cacha_articles (name, abstract, document_name, author, creation_date) values (?, ?, ?, ?, ?)";
        $params = [$name, $abstract, $document_name, $_SESSION["id"], date("Y-m-d")];
        return $this->query($query, $params);
    }

    public function modifyArticel($name, $abstract, string $document_name, $id)
    {
        $query = "update cacha_articles set name = ?, abstract = ?, document_name = ? where id = ?";
        $params = [$name, $abstract, $document_name, $id];
        return $this->query($query, $params);
    }

    public function addAuthorRole($name){
        $query = "insert into cacha_user_role (user_id, role_id) values ((select id from cacha_users where name = ?), 1)";
        $params = [$name];
        return $this->query($query, $params);
    }

    public function getUserRolesTitles($id){
        $query = "select r.title from cacha_users as s 
                       join cacha_user_role as ur on s.id = ur.user_id
                       join cacha_roles as r on r.id = ur.role_id
                       where s.id = ?";
        $params = [$id];
        return $this->queryAll($query, $params);
    }

    public function getUserByName($name)
    {
        $query = "select * from cacha_users where name = ?";
        $params = [$name];
        return $this->queryOne($query, $params);
    }

    public function canModifyArticel($idArticel, $idAutor)
    {
        $query = "select * from cacha_articles where id=? and author = ? and state = 1";
        $params = [$idArticel, $idAutor];
        $res = $this->queryOne($query, $params);

        if($res === false || $res === null){
            return null;
        }
        return $res;
    }


    public function getMyArticlesToRev($id)
    {
        $query = "select a.*, u.name as author  from cacha_articles as a 
                    join cacha_reviews as r on a.id = r.article_id
                    join cacha_users as u on u.id = a.author
                    where r.user_id = ? and a.state = 1 and r.evaluation is null";
        return $this->queryAll($query, [$id]);
    }

    public function canReviewArticel($articel_id, $user_id)
    {
        $query = "select r.id as review_id, r.evaluation, r.stars_count, r.recommended, r.article_id, r.user_id from cacha_articles as a 
                    join cacha_reviews as r on a.id = r.article_id
                    join cacha_users as u on u.id = r.user_id
                    where a.id = ? and u.id = ? and a.state = 1";
        $params = [$articel_id, $user_id];
        $res = $this->queryOne($query, $params);

        if($res === false || $res === null){
            return null;
        }
        return $res;
    }

    public function addReview($stars, int $rec, $eval, $id)
    {
        $query = "update cacha_reviews set stars_count = ?, recommended = ?, evaluation = ? where id = ?";
        $params = [$stars, $rec, $eval, $id];
        return $this->query($query, $params);
    }

    public function getMyReviews($userId)
    {
        $query = "select r.stars_count, r.recommended, r.evaluation, r.id as review_id, a.name as articel_name, u.name as articel_author, a.id as articel_id, a.state as articel_state 
						from cacha_reviews as r
	                     join cacha_articles as a on r.article_id = a.id
                         join cacha_users as u on a.author = u.id
                         where r.user_id = ? and r.evaluation is not null";
        return $this->queryAll($query, [$userId]);
    }

    public function canModifyReview($review_id, $user_id)
    {
        $query = "select * from (select * from cacha_reviews where id=? and user_id = ?) as r
                    join cacha_articles as a on a.id = r.article_id
                    where a.state = 1";
        $params = [$review_id, $user_id];
        $res = $this->queryOne($query, $params);

        if($res === false || $res === null){
            return false;
        }
        return true;
    }

    public function getUsers()
    {
        $query = "select u.id, u.name, u.reg_date, u.banned, 
CASE
    WHEN u.id in (select cacha_users.id from cacha_users join cacha_user_role on cacha_users.id = cacha_user_role.user_id join cacha_roles on cacha_roles.id = cacha_user_role.role_id where cacha_roles.title = 'author') THEN '1'   
    ELSE '0'
END AS isAuthor,
CASE
    WHEN u.id in (select cacha_users.id from cacha_users join cacha_user_role on cacha_users.id = cacha_user_role.user_id join cacha_roles on cacha_roles.id = cacha_user_role.role_id where cacha_roles.title = 'reviewer') THEN '1'  
    ELSE '0'
END AS isReviewer
from cacha_users as u where 'admin' not in 
	(select title from cacha_user_role as ur 
     	join cacha_roles as r on ur.role_id = r.id
    	where ur.user_id = u.id)";
        return $this->queryAll($query);
    }

    public function setAuthorRole($id, $value)
    {
        if($value == "0"){

            $query = "delete from cacha_user_role where user_id = ? and role_id = 1";
            $params = [$id];
            return $this->query($query, $params);
        }
        else{
            $query = "select * from cacha_user_role where user_id = ? and role_id = 1";
            $params = [$id];
            $res = $this->query($query, $params);
            if($res !== null && $res !== false){
                $query = "insert into cacha_user_role (user_id, role_id) values (?, 1)";
                $params = [$id];
                return $this->query($query, $params);
            }
            else{
                return true;
            }
        }
    }

    public function setRevRole($id, string $value)
    {
        if($value == "0"){

            $query = "delete from cacha_user_role where user_id = ? and role_id = 2";
            $params = [$id];
            return $this->query($query, $params);
        }
        else{
            $query = "select * from cacha_user_role where user_id = ? and role_id = 2";
            $params = [$id];
            $res = $this->query($query, $params);
            if($res !== null && $res !== false){
                $query = "insert into cacha_user_role (user_id, role_id) values (?, 2)";
                $params = [$id];
                return $this->query($query, $params);
            }
            else{
                return true;
            }
        }
    }

    public function setBan($id, string $value)
    {
        $query = "update cacha_users set banned = ? where id = ?";
        $params = [$value, $id];
        return $this->query($query, $params);
    }

    public function deleteById($id)
    {
        $query = "delete from cacha_users where id = ?";
        $params = [$id];
        $res1 =  $this->query($query, $params);

        $query = "delete from cacha_user_role where user_id = ?";
        $params = [$id];
        $res2 =  $this->query($query, $params);
        return ($res1 && $res2);
    }

    private function query($query, $params = array()){
        $statement = $this->pdo->prepare($query);
        return $statement->execute($params);
    }

    private function queryOne($query, $params = array())
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetch();
    }

    private function queryAll($query, $params = array())
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement->fetchAll();
    }
}
?>
