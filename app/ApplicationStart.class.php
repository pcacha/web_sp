<?php

namespace kivweb;

class ApplicationStart {

    public function appStart(){

        if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
            $pageKey = $_GET["page"];
        } else {
            $pageKey = DEFAULT_WEB_PAGE_KEY;
        }

        $pageInfo = WEB_PAGES[$pageKey];

        $controller = new $pageInfo["controller_class_name"];
        $tplData = $controller->show($pageInfo["title"]);


        $view = new $pageInfo["view_class_name"];
        $view->printOutput($tplData, $pageInfo["template_type"]);

    }
}
?>
