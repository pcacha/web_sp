<?php

define("DB_SERVER","localhost");
define("DB_NAME","cacha_konference");
define("DB_USER","root");
define("DB_PASS","");

const DEFAULT_WEB_PAGE_KEY = "uvod";

define("ADMIN","admin");
define("REVIEWER","reviewer");
define("AUTHOR","author");

const WEB_PAGES = array(
    "uvod" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\IntroductionController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
    ),

    "prihlaseni" => array(
        "title" => "Přihlášení",
        "controller_class_name" => \kivweb\Controllers\LoginController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_LOGIN,
    ),

    "registrace" => array(
        "title" => "Registrace",
        "controller_class_name" => \kivweb\Controllers\RegistrationController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_REGISTRATION,
    ),
    "clanky" => array(
        "title" => "Články",
        "controller_class_name" => \kivweb\Controllers\ArticlesController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_ARTICLES,
    ),
    "odhlasit" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\LogoutController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
    ),
);
?>
