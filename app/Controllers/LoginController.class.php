<?php

namespace kivweb\Controllers;

class LoginController implements IController {


    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;

        return $tplData;
    }

}
?>