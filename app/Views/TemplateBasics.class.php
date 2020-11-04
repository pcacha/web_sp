<?php

namespace kivweb\Views;

class TemplateBasics implements IView {

    const PAGE_INTRODUCTION = "IntroductionTemplate.tpl.php";

    public function printOutput(array $templateData, string $pageType = self::PAGE_INTRODUCTION)
    {
        $this->getHTMLHead($this->protectTemplates($templateData['title']));
        $this->getHeader();

        global $tplData;
        $tplData = $this->protectTemplates($templateData);
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
                $output[$key] = $this->protectTemplates($value);
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
                <link type="text/css" rel="stylesheet" href="../../css/style.css" />
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            </head>
            <body>

        <?php
    }
    
    public function getHeader(){
        ?>

        <header>
            <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="../../index.php?clanek=uvod">Vědecká konference</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php?clanek=uvod">Úvod</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php?clanek=clanky">Články</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../index.php?clanek=prihlaseni">Přihlášení</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </header>



        <?php
    }

    public function getHTMLFooter(){
        ?>
                <footer class="position-fixed d-flex justify-content-center align-items-center w-100">Semestrální práce z KIV/WEB; Pavel Čácha</footer>
            <body>
        </html>

        <?php
    }
}
?>
