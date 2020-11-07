<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class ManageUsersController implements IController {
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


        $tplData['users'] = $this->db->getUsers();

        return $tplData;
    }

}
?>