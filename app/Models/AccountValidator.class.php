<?php
namespace kivweb\Models;


class AccountValidator{
    private $db;

    public function __construct(){
        $this->db = DatabaseModel::getDatabaseModel();
    }

    public function nameLength($name):bool{
        if(strlen($name) < 101){
            return true;
        }
        return false;
    }

    public function nameUnique($name):bool{
        $res = $this->db->getUserName($name);
        if($res == null){
            return true;
        }
        return false;
    }
}