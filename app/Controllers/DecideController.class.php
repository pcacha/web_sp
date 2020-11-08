<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class DecideController implements IController {
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

        $tplData["res"] = false;

        if($_POST){
            if(isset($_POST["publish"]) && $_POST["publish"]
                && isset($_POST["eval"]) && $_POST["eval"]
                && isset($_GET["articel_id"]) && $_GET["articel_id"])
            {
                $revCount = $this->db->getRevCount($_GET["articel_id"]);
                if($revCount > 2){
                    $state = ($_POST["publish"] == "yes") ? 2 : 3;
                    $eval = $_POST["eval"];
                    $id = $_GET["articel_id"];

                    $res = $this->db->updateArticel($state, $eval, $id);
                    if($res){
                        $tplData["message"] = "Hodnocení bylo úspěšně odesláno";
                        $tplData["res"] = true;
                    }
                }
                else{
                    $tplData["message"] = "Počet rezenzí je $revCount, musí být minimálně 3!";
                }
            }
            else{
                $tplData["message"] = "Vyplň všechny pole, až pak odešli formulář";
            }
        }

        return $tplData;
    }

}
?>
