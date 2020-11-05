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
        $query = "select * from cacha_articles";
        return $this->queryAll($query);
    }

    public function getUserName($name){
        $query = "select name from cacha_users where name = ?";
        return $this->queryOne($query, [$name]);
    }

    public function registrateUser($name, $pass){
        $query = "insert into cacha_users (name, password, reg_date) values (?, ?, ?)";
        $params = [$name, password_hash($pass, PASSWORD_DEFAULT), date("Y-m-d")];
        return $this->query($query, $params);
    }

    public function getUserRolesTitles($id){
        $query = "select a.title from cacha_users as s 
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
