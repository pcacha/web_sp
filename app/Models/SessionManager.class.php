<?php

namespace kivweb\Models;

class SessionManager {

    public function __construct(){
        session_start();
    }
    

    public function addSession(string $key, $value){
        $_SESSION[$key] = $value;
    }


    public function isSessionSet(string $key){
        return isset($_SESSION[$key]);
    }


    public function readSession(string $key){

        if($this->isSessionSet($key)){
            return $_SESSION[$key];
        } else {
            return null;
        }
    }
    

    public function removeSession(string $key){
        unset($_SESSION[$key]);
    }

    public function destroy(){
        session_destroy();
    }

    public function addCredentialsToTmpData($tmpData){
        if(isset($_SESSION["name"])){
            $tmpData["name"] = $_SESSION["name"];
            $tmpData["id"] = $_SESSION["id"];
            $tmpData["roles"] = $_SESSION["roles"];
        }
        return $tmpData;
    }
}
?>
