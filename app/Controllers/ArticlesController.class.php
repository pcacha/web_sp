<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class ArticlesController implements IController {
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


        $tplData['articles'] = $this->db->getAllArticles();

        return $tplData;
    }
    
}
?>
