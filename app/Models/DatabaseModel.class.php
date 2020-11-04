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
