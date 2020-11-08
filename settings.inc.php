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

define("ACCEPTED","accepted");
define("REJECTED","rejected");
define("REVIEWED","reviewed");

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
    "mojeClanky" => array(
        "title" => "Moje Články",
        "controller_class_name" => \kivweb\Controllers\MyArticlesController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_MY_ARTICLES,
        "access" => [AUTHOR],
    ),
    "recenzeClanky" => array(
        "title" => "Články k Recenzování",
        "controller_class_name" => \kivweb\Controllers\ArticlesToReviewController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_ARTICELS_TO_REVIEW,
        "access" => [REVIEWER],
    ),
    "recenzovat" => array(
        "title" => "Recenzovat Článek",
        "controller_class_name" => \kivweb\Controllers\ReviewArticelController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_REVIEW_ARTICEL,
        "access" => [REVIEWER],
    ),
    "mojeRecenze" => array(
        "title" => "Moje Recenze",
        "controller_class_name" => \kivweb\Controllers\MyReviewsController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_MY_REVIEWS,
        "access" => [REVIEWER],
    ),
    "spravceUzivatelu" => array(
        "title" => "Správa uživatelů",
        "controller_class_name" => \kivweb\Controllers\ManageUsersController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_USER_MANAGER,
        "access" => [ADMIN],
    ),
    "zpracujPozadavek" => array(
        "title" => "Zpracování požadavku",
        "controller_class_name" => \kivweb\Controllers\HandleAjaxController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
        "access" => [ADMIN],
    ),
    "spravceClanku" => array(
        "title" => "Správa článků",
        "controller_class_name" => \kivweb\Controllers\ArticlesManagerController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_ARTICLES_MANAGER,
        "access" => [ADMIN],
    ),
    "zpracujPrirazeni" => array(
        "title" => "Přiřazení k recenzi",
        "controller_class_name" => \kivweb\Controllers\HandleReviewerToArticelController::class,
        "view_class_name" => \kivweb\Views\TemplateBasics::class,
        "template_type" => \kivweb\Views\TemplateBasics::PAGE_INTRODUCTION,
        "access" => [ADMIN],
    ),
);
?>
