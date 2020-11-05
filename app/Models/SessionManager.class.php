<?php

namespace kivweb\Models;

class SessionManager {
    private static $session;

    private function __construct(){
        session_start();
    }

    public static function getSession(){
        if(empty(self::$session)) {
            self::$session = new SessionManager();
        }
        return self::$session;
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

    public function hasAccess($access):bool
    {
        if(!isset($_SESSION["roles"])){
            return false;
        }

        foreach ($access as $a){
            foreach ($_SESSION["roles"] as $role){
                if($a === $role){
                    return true;
                }
            }
        }
        return false;
    }
}
?>
