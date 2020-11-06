<?php
namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel;
use kivweb\Models\SessionManager;

class MyArticlesController implements IController {

    private $db;
    private $session;

    public function __construct(){
        $this->db = DatabaseModel::getDatabaseModel();
        $this->session = SessionManager::getSession();
    }


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);

        $tplData['articles'] = $this->db->getUserArticles($this->session->readSession("id"));

        return $tplData;
    }
}