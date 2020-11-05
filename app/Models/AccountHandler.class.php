<?php
namespace kivweb\Models;

class AccountHandler{
    private $db;
    public function __construct(){
        $this->db = DatabaseModel::getDatabaseModel();
    }

    public function loginUser(SessionManager  $session, array $user){
        $session->addSession("id", $user["id"]);
        $session->addSession("name", $user["name"]);
        $session->addSession("roles", $this->getUserRoles($user));
    }

    private function getUserRoles($user)
    {
        if($user["banned"] == 1)
        {
            return [];
        }
        else{
            $res = $this->db->getUserRolesTitles($user["id"]);

            $finalArray = [];

            foreach ($res as $item){
                $finalArray[] = $item["title"];
            }
            return $finalArray;
        }
    }
}