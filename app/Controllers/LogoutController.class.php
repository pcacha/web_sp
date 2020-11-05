<?php

namespace kivweb\Controllers;

use kivweb\Models\SessionManager;

class LogoutController implements IController {

    private $session;


    public function __construct()
    {
        $this->session = SessionManager::getSession();
    }


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $this->session->destroy();

        return $tplData;
    }

}
?>
