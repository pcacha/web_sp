<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;

class ArticlesController implements IController {
    private $db;

    public function __construct() {
        $this->db = db::getDatabaseModel();
    }

    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData['articles'] = $this->db->getAllArticles();

        return $tplData;
    }
    
}
?>
