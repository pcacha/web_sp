<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class HandleReviewerToArticelController implements IController {
    private $db;
    private $session;

    public function __construct() {
        $this->db = db::getDatabaseModel();
        $this->session = SessionManager::getSession();
    }

    public function show(string $pageTitle):array {
        if(!(isset($_GET["user_id"])) || !(isset($_GET["articel_id"]))){
            header("Location: index.php");
            exit;
        }

        $user_id = $_GET["user_id"];
        $articel_id = $_GET["articel_id"];


        $res = $this->db->setArticelToReviewer($user_id, $articel_id);


        if($res){
            echo json_encode(true);
            exit;
        }

        echo json_encode(false);
        exit;
    }

}
?>