<?php

require_once ($_SERVER["DOCUMENT_ROOT"]."/SecuLogin/SecurityLib.php");
class Credentials  {
    public $username;
    public $password;

    function __construct($file) {
        $this->username =SecurityLib::GetCredential($file)->username;
        $this->password =SecurityLib::GetCredential($file)->password;

    }

}