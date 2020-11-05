<?php

define("DB_SERVER","localhost");
define("DB_NAME","cacha_konference");
define("DB_USER","root");
define("DB_PASS","");

const DEFAULT_WEB_PAGE_KEY = "uvod";

define("ADMIN","admin");
define("REVIEWER","reviewer");
define("AUTHOR","author");
define("ALL", "all");

const WEB_PAGES = array(
    "uvod" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\IntroductionController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
        "access" => [ALL],
    ),

    "prihlaseni" => array(
        "title" => "Přihlášení",
        "controller_class_name" => \kivweb\Controllers\LoginController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_LOGIN,
        "access" => [ALL],
    ),

    "registrace" => array(
        "title" => "Registrace",
        "controller_class_name" => \kivweb\Controllers\RegistrationController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_REGISTRATION,
        "access" => [ALL],
    ),
    "clanky" => array(
        "title" => "Články",
        "controller_class_name" => \kivweb\Controllers\ArticlesController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_ARTICLES,
        "access" => [ALL],
    ),
    "odhlasit" => array(
        "title" => "Úvodní stránka",
        "controller_class_name" => \kivweb\Controllers\LogoutController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
        "access" => [ALL],
    ),
    "publikovat" => array(
        "title" => "Publikace článků",
        "controller_class_name" => \kivweb\Controllers\CreateArticelController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_CREATE_ARTICEL,
        "access" => [AUTHOR],
    ),
);
?>
