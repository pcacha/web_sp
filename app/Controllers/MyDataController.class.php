<?php

namespace kivweb\Controllers;

use kivweb\Models\AccountHandler;
use kivweb\Models\AccountValidator;
use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class MyDataController implements IController {
    private $db;
    private $session;

    public function __construct() {
        $this->db = db::getDatabaseModel();
        $this->session = SessionManager::getSession();
    }

    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);


        $validator = new AccountValidator();
        $handler = new AccountHandler();

        $tplData["res"] = false;
        $current_user_id = $this->session->readSession("id");

        if($_POST){
            if(isset($_POST["name"]) && $_POST["name"]
                )
            {
                $name = $_POST["name"];
                $pass1 = $_POST["pass1"];
                $pass2 = $_POST["pass2"];
                $passed = true;
                if(isset($_POST["changePass"]) && $_POST["changePass"]){
                    $checked = $_POST["changePass"];
                    if(!(isset($_POST["pass1"]) && $_POST["pass1"]
                        && isset($_POST["pass2"]) && $_POST["pass2"])){
                        $tplData["message"] = "Hesla musí být vyplněna";
                        $passed = false;
                    }
                }
                else{
                    $checked = false;
                }


                if(!$validator->nameLength($name)){
                    $tplData["message"] = "Jméno je moc dlouhé";
                    $passed = false;
                }
                if(!$validator->nameUnique($name) && $name !== $this->session->readSession("name")){
                    $tplData["message"] = "Jméno je již obsazené";
                    $passed = false;
                }
                if($pass1 !== $pass2 && $checked){
                    $tplData["message"] = "Hesla se neshodují";
                    $passed = false;
                }

                if($passed){
                    $addedInUsers = false;
                    if($checked){
                        $addedInUsers = $this->db->updateUser($name, $pass1, $current_user_id);
                    }
                    else{
                        $addedInUsers = $this->db->updateUserName($name, $current_user_id);
                    }

                    if($addedInUsers){
                        $tplData["message"] = "Údaje byly aktualizovány";
                        $tplData["res"] = true;


                        $handler->loginUser($this->session, $this->db->getUserByName($name));
                        $tplData["name"] = $name;
                    }
                    else{
                        $tplData["message"] = "Něco se nepovedlo";
                    }
                }
            }
            else{
                $tplData["message"] = "Vyplň všechna pole, až poté odešli formulář";
            }
        }

        $user = $this->db->getUserById($current_user_id);
        $tplData["reg_date"] = $user["reg_date"];

        return $tplData;
    }

}
?>