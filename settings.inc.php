<?php

define("DB_SERVER","localhost");
define("DB_NAME","web-konference");
define("DB_USER","root");
define("DB_PASS","");

define("TABLE_INTRODUCTION", "cacha_articles");

const DEFAULT_WEB_PAGE_KEY = "uvod";


const WEB_PAGES = array(
    "uvod" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\IntroductionController::class,
        "view_class_name" => \kivweb\Views\TemplateBased\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBased\TemplateBasics::PAGE_INTRODUCTION,
    ),

);
?>
