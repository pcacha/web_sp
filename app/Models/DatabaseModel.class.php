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
            (select * from cacha_articles where publish_date is not null) as a join cacha_users as u on a.author = u.id";
        return $this->queryAll($query);
    }

    public function getUserArticles($id)
    {
        $query = "select a.id, a.name, a.abstract, a.document_name, u.name as author, a.creation_date, a.publish_date, s.title as state, a.evaluation from 
            (select * from cacha_articles where author = ?) as a join cacha_users as u on a.author = u.id
                                                             join cacha_states as s on a.state = s.id";
        return $this->queryAll($query, $id);
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

    private function queryColumn($query, $params = array())
    {
        $res = $this->queryOne($query, $params);
        return $res[0];
    }
}
?>
