<?php

namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;

class IntroductionController implements IController {


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;

        return $tplData;
    }
    
}
?>
