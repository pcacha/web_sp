<?php

namespace kivweb\Controllers;

use kivweb\Models\AccountHandler;
use kivweb\Models\DatabaseModel;
use kivweb\Models\SessionManager;

class LoginController implements IController {

    private $db;
    private $session;

    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        $this->session = new SessionManager();
    }


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);

        $handler = new AccountHandler();

        if($_POST){
            if(isset($_POST["name"]) && $_POST["name"]
                && isset($_POST["pass"]) && $_POST["pass"])
            {
                $name = $_POST["name"];
                $pass = $_POST["pass"];


                $user = $handler->checkCredentials($name, $pass);

                if($user !== null){

                    $handler->loginUser($this->session, $user);
                    header("Location: index.php");
                }
                else{
                    $tplData["message"] = "Špatné přihlašovací údaje!";
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