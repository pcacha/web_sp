<?php

namespace kivweb\Views;

class TemplateBasics implements IView {

    const PAGE_INTRODUCTION = "IntroductionTemplate.tpl.php";
    const PAGE_LOGIN = "LoginTemplate.tpl.php";
    const PAGE_REGISTRATION = "RegistrationTemplate.tpl.php";
    const PAGE_ARTICLES = "ArticlesTemplate.tpl.php";
    const PAGE_CREATE_ARTICEL = "CreateArticel.tpl.php";
    const PAGE_MY_ARTICLES = "MyArticles.tpl.php";
    const PAGE_ARTICELS_TO_REVIEW = "ArticlesToReview.tpl.php";
    const PAGE_REVIEW_ARTICEL = "ReviewArticel.tpl.php";
    const PAGE_MY_REVIEWS = "MyReviews.tpl.php";

    public function printOutput(array $templateData, string $pageType = self::PAGE_INTRODUCTION)
    {
        $this->getHTMLHead($this->protectTemplates($templateData['title']));

        global $tplData;
        $tplData = $this->protectTemplates($templateData);
        $this->getHeader($tplData);

        require_once($pageType);

        $this->getHTMLFooter();
    }

    private function protectTemplates($output)
    {
        if (is_string($output))
            return htmlspecialchars($output, ENT_QUOTES);
        else if (is_array($output))
        {
            foreach($output as $key => $value)
            {
                if($key !== "abstract"){
                    $output[$key] = $this->protectTemplates($value);
                }
            }
            return $output;
        }
        else{
            return $output;
        }
    }

    public function getHTMLHead(string $pageTitle) {
        ?>

        <!doctype html>
        <html lang="cs-cz">
            <head>
                <meta charset='utf-8'>
                <title><?= $pageTitle ?></title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link type="text/css" rel="stylesheet" href="../../css/style.css" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="../../ckeditor/ckeditor.js"></script>
            </head>
            <body id="body">

        <?php
    }
    
    public function getHeader($tplData){
        ?>

        <header class="position-fixed w-100 ">
            <nav id="nav" class="navbar navbar-expand-lg navbar-light">
                <div class="container ">
                    <a class="navbar-brand" href="../../index.php?clanek=uvod">Vědecká konference</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php?page=uvod">Úvod</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php?page=clanky">Články</a>
                            </li>


                            <?php if(isset($tplData["roles"]) && in_array(ADMIN, $tplData["roles"])): ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        SPRAVOVAT
                                    </a>
                                    <div class="dropdown-menu my-dropdown" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="../../index.php?page=spravceClanku">Články</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../../index.php?page=spravceUzivatelu">Uživatele</a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if(isset($tplData["roles"]) && in_array(REVIEWER, $tplData["roles"])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../../index.php?page=recenzeClanky">RECENZOVAT</a>
                                </li>
                            <?php endif; ?>

                            <?php if(isset($tplData["roles"]) && in_array(AUTHOR, $tplData["roles"])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../../index.php?page=publikovat">PUBLIKOVAT</a>
                                </li>
                            <?php endif; ?>


                            <?php if(isset($tplData["name"])): ?>
                                <li class="nav-item dropdown" style="align-self: center;">
                                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?= $tplData["name"]?> <i class="fa fa-user" aria-hidden="true"></i>
                                    </a>
                                    <div class="dropdown-menu my-dropdown" aria-labelledby="navbarDropdown">
                                        <?php if(isset($tplData["roles"]) && in_array(AUTHOR, $tplData["roles"])): ?>
                                        <a class="dropdown-item" href="../../index.php?page=mojeClanky">Moje Články</a>
                                        <?php endif; ?>
                                        <?php if(isset($tplData["roles"]) && in_array(REVIEWER, $tplData["roles"])): ?>
                                        <a class="dropdown-item" href="../../index.php?page=mojeRecenze">Moje Recenze</a>
                                        <?php endif; ?>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../../index.php?page=odhlasit">Odhlásit</a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if(!isset($tplData["name"])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../../index.php?page=prihlaseni">Přihlášení</a>
                                </li>
                            <?php endif; ?>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>
        <article>
        <?php
    }

    public function getHTMLFooter(){
        ?>
                </article>
                <footer class="position-fixed d-flex justify-content-center align-items-center w-100">Semestrální práce z KIV/WEB; Pavel Čácha</footer>
            </body>
        </html>

        <?php
    }
}
?>
