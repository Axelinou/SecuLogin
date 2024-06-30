<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/SecuLogin/Connexion.php");

class DataBase {
    public $Connexion;

    function __construct() {
        $this->Connexion = new  Connexion("login_secu_bdd");
    }


}