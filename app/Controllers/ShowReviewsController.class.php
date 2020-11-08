<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class ShowReviewsController implements IController {
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

        if(!isset($_GET["articel_id"])){
            header("Location: index.php");
            exit;
        }

        $articel_id = $_GET["articel_id"];

        $tplData["reviews"] = $this->db->getArticelRevs($articel_id);

        return $tplData;
    }

}
?>