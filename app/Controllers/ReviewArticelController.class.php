<?php
namespace kivweb\Controllers;

use kivweb\Models\DatabaseModel as db;
use kivweb\Models\SessionManager;

class ReviewArticelController implements IController {
    private $db;
    private $session;

    public function __construct() {
        $this->db = db::getDatabaseModel();
        $this->session = SessionManager::getSession();
    }

    public function show(string $pageTitle):array {
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData = $this->session->addCredentialsToTmpData($tplData);

        if(!isset($_GET["id"])){
            header("Location: index.php");
            exit;
        }

        $articel_id = $_GET["id"];

        $review_data = $this->db->canReviewArticel($articel_id, $this->session->readSession("id"));
        if($review_data === null){
            header("Location: index.php");
            exit;
        }

        $tplData["articel_id"] = $articel_id;
        $tplData["res"] = false;


        if($_POST){
            if(isset($_POST["id"]) && $_POST["id"]
                && isset($_POST["eval"]) && $_POST["eval"]
            && isset($_POST["stars"]) && $_POST["stars"]
            && isset($_POST["recommend"]) && $_POST["recommend"])
            {
                $eval = $_POST["eval"];
                $stars = $_POST["stars"];
                $rec = $_POST["recommend"];
                $rec = ($rec === "yes") ? 1 : 0;

                if($this->db->addReview($stars, $rec, $eval, $review_data["review_id"])){
                    $tplData["message"] = "Recenze byla úspěšně odeslána";
                    $tplData["res"] = true;
                }
                else{
                    $tplData["message"] = "Něco se nepovedlo";
                }

            }
            else{
                $tplData["message"] = "Vyplň všechna pole, až poté odešli formulář";
            }
        }




        return $tplData;
    }

}
?>