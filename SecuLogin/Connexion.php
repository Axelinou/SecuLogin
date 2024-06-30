<?php
require_once ($_SERVER["DOCUMENT_ROOT"]."/SecuLogin/Service/Credentials.php");
class Connexion {

    public PDO $dbh;

    public function __construct($name){
        $credential = new Credentials("phpadmin.json");
        $this->dbh = new  \PDO("mysql:host=localhost;dbname=".$name.";port=3306",$credential->username ,$credential->password);
    }

}
