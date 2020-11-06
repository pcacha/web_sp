<?php
namespace kivweb\Models;

class ArticelValidator {
    private $db;

    public function __construct(){
        $this->db = DatabaseModel::getDatabaseModel();
    }

    public function nameLength($name):bool{
        if(strlen($name) < 256){
            return true;
        }
        return false;
    }

    public function nameUnique($name):bool{
        $res = $this->db->getArticelName($name);
        if($res == null){
            return true;
        }
        return false;
    }
}