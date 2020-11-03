<?php

namespace kivweb\Views;

class TemplateBasics implements IView {

    const PAGE_INTRODUCTION = "IntroductionTemplate.tpl.php";

    public function printOutput(array $templateData, string $pageType = self::PAGE_INTRODUCTION)
    {
        $this->getHTMLHeader($this->protectTemplates($templateData['title']));

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

    public function getHTMLHeader(string $pageTitle) {
        ?>

        <!doctype html>
        <html>
            <head>
                <meta charset='utf-8'>
                <title><?= $pageTitle ?></title>
            </head>
            <body>

        <?php
    }
    

    public function getHTMLFooter(){
        ?>
                <br>
                <footer>Semestrální práce z KIV/WEB; Pavel Čácha</footer>
            <body>
        </html>

        <?php
    }
}
?>
