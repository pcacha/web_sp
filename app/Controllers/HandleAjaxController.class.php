<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class HandleAjaxController implements IController {
    private $db;
    private $session;

    public function __construct() {
        $this->db = db::getDatabaseModel();
        $this->session = SessionManager::getSession();
    }

    public function show(string $pageTitle):array {

        if(!(isset($_GET["action"])) || !(isset($_GET["value"])) || !(isset($_GET["id"]))){
            header("Location: index.php");
            exit;
        }

        $action = $_GET["action"];
        $value = $_GET["value"];
        $id = $_GET["id"];

        if($value !== "0" && $value !== "1"){
            echo json_encode(false);
            exit;
        }

        $res = false;
        switch ($action){
            case "setAuthor":
                $res = $this->db->setAuthorRole($id, $value);
                break;
            case "setRev":
                $res = $this->db->setRevRole($id, $value);
                break;
            case "setBan":
                $res = $this->db->setBan($id, $value);
                break;
            case "delete":
                $res = $this->db->deleteById($id);
                break;
        }

        if($res){
            echo json_encode(true);
            exit;
        }
        echo json_encode(false);
        exit;
    }

}
?>
