<?php
namespace kivweb\Controllers;

use kivweb\Models\ArticelValidator;
use kivweb\Models\DatabaseModel;
use kivweb\Models\SessionManager;

class CreateArticelController implements IController
{
    private $session;
    private $db;

    public function __construct()
    {
        $this->session = SessionManager::getSession();
        $this->db = DatabaseModel::getDatabaseModel();
    }

    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);

        $tplData["res"] = false;
        $validator = new ArticelValidator();

        if($_POST){
            if(isset($_POST["name"]) && $_POST["name"] &&
                isset($_FILES["articel"]) && $_FILES["articel"] &&
                isset($_POST["abstract"]) && $_POST["abstract"])
            {
                $name = $_POST["name"];
                $abstract = $_POST["abstract"];

                if(!$validator->nameLength($name)){
                    $tplData["message"] = "Jméno je moc dlouhé";
                    return $tplData;
                }
                if(!$validator->nameUnique($name)){
                    $tplData["message"] = "Jméno je již obsazené";
                    return $tplData;
                }

                $document_name = time()."_".$_FILES["articel"]["name"];
                $added = $this->db->addArticel($name, $abstract, $document_name);
                move_uploaded_file($_FILES["articel"]["tmp_name"], "uploads/$document_name");
                if($added){
                    $tplData["message"] = "Článek byl úspěšně odeslán";
                    $tplData["res"] = true;
                }
                else{
                    $tplData["message"] = "Něco se nepovedlo";
                }
            }
            else {
                $tplData["message"] = "Musí být vyplněna všechna pole!";
            }
        }

        return $tplData;
    }
}