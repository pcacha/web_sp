<?php

define("DB_SERVER","localhost");
define("DB_NAME","cacha_konference");
define("DB_USER","root");
define("DB_PASS","");

const DEFAULT_WEB_PAGE_KEY = "uvod";


const WEB_PAGES = array(
    "uvod" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\IntroductionController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
    ),

);
?>
