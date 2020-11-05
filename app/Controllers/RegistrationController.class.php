<?php

namespace kivweb\Controllers;

use kivweb\Models\AccountValidator;
use kivweb\Models\SessionManager;
use kivweb\Models\AccountHandler;
use kivweb\Models\DatabaseModel;

class RegistrationController implements IController {
    private $db;
    private $session;

    public function __construct(){
        $this->db = DatabaseModel::getDatabaseModel();
        $this->session = new SessionManager();
    }


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);

        $validator = new AccountValidator();
        $handler = new AccountHandler();

        $tplData["res"] = false;

        if($_POST){
            if(isset($_POST["name"]) && $_POST["name"]
                && isset($_POST["pass1"]) && $_POST["pass1"]
                && isset($_POST["pass2"]) && $_POST["pass2"])
            {
                $name = $_POST["name"];
                $pass1 = $_POST["pass1"];
                $pass2 = $_POST["pass2"];

                if(!$validator->nameLength($name)){
                    $tplData["message"] = "Jméno je moc dlouhé";
                    return $tplData;
                }
                if(!$validator->nameUnique($name)){
                    $tplData["message"] = "Jméno je již obsazené";
                    return $tplData;
                }
                if($pass1 !== $pass2){
                    $tplData["message"] = "Hesla se neshodují";
                    return $tplData;
                }

                $done = $this->db->registrateUser($name, $pass1);
                if($done){
                    $tplData["message"] = "Uživatel byl úspěšně zaregistrován";
                    $tplData["res"] = true;


                    $handler->loginUser($this->session, $this->db->getUserByName($name));
                }
                else{
                    $tplData["message"] = "Něco se nepovedlo";
                }
            }
            else{
                $tplData["message"] = "Vyplň všechna pole, až poté odešli formulář";
            }
        }

        return $tplData;
    }

}
?>