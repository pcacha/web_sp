<?php

namespace kivweb\Controllers;

class IntroductionController implements IController {


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;

        return $tplData;
    }
    
}
?>
