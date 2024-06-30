<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/SecuLogin/Connexion.php");

class Register {

    private $connexiondb;

    function __construct()
    {
        // Connect to the database
        $this->connexiondb = new Connexion("login_secu_bdd");
        $dbh = $this->connexiondb->dbh;


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
            // Get form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Hash the password
            $password_hash = hash('sha512', $password);

            // Check if the username already exists
            $stmt = $dbh->prepare("SELECT COUNT(*) FROM user WHERE user = :user");
            $stmt->bindParam(':user', $username);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo "Username already exists.";
            } else {
                // Insert data into the database
                $stmt = $dbh->prepare("INSERT INTO user (user, pwd) VALUES (:user, :pwd)");
                $stmt->bindParam(':user', $username);
                $stmt->bindParam(':pwd', $password_hash);

                if ($stmt->execute()) {
                    echo "User registered successfully.";
                } else {
                    echo "Error registering user.";
                }
            }
        } else {
            echo "Please fill out the registration form.";
        }
    }

}

new Register();

