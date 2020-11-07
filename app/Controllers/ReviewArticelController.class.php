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

        if(!isset($_GET["articel_id"])){
            header("Location: index.php");
            exit;
        }

        $articel_id = $_GET["articel_id"];

        $review_data = $this->db->canReviewArticel($articel_id, $this->session->readSession("id"));
        if($review_data === null){
            header("Location: index.php");
            exit;
        }

        if(isset($_GET["review_id"])){
            $review_id = $_GET["review_id"];
            $canModify = $this->db->canModifyReview($review_id, $this->session->readSession("id"));

            if(!$canModify){
                header("Location: index.php");
                exit;
            }

            $tplData["rev_star_count"] = $review_data["stars_count"];
            $tplData["rev_recom"] = $review_data["recommended"];
            $tplData["rev-eval"] = $review_data["evaluation"];
        }

        $tplData["res"] = false;

        if($_POST){
            if(isset($_POST["eval"]) && $_POST["eval"]
            && isset($_POST["stars"]) && $_POST["stars"]
            && isset($_POST["recommend"]) && $_POST["recommend"])
            {
                $eval = $_POST["eval"];
                $stars = $_POST["stars"];
                $rec = $_POST["recommend"];
                $rec = ($rec === "yes") ? 1 : 0;
                $rev_id = $review_data["review_id"];

                if($this->db->addReview($stars, $rec, $eval, $rev_id)){
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