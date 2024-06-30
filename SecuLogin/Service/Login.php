<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"] . "/SecuLogin/Connexion.php");

class Login {
    private $connexion;

    public function __construct()
    {
        $this->connexion = new Connexion("login_secu_bdd");
    }

    public function authenticate($username, $password)
    {
        $dbh = $this->connexion->dbh;

        // Check for brute force attempts
        if ($this->isBruteForce($username)) {
            echo "Too many login attempts. Please try again later.";
            return;
        }

        // Prepare and execute the query to fetch user data
        $stmt = $dbh->prepare("SELECT user, pwd FROM user WHERE user = :user");
        $stmt->bindParam(':user', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Hash the input password with sha512
            $password_hash = hash('sha512', $password);

            // Verify the password
            if ($password_hash === $user['pwd']) {
                // Clear previous failed attempts
                $this->clearFailedAttempts($username);

                // Set session variables
                $_SESSION['username'] = $user['user'];
                echo "Login successful! Welcome, " . $_SESSION['username'] . ". <a href='../Connexion/logout.php'>Go to home</a>";
            } else {
                // Record the failed attempt
                $this->recordFailedAttempt($username);
                echo "Invalid password. <a href='../Connexion/logout.php'>Retry</a>";
            }
        } else {
            // Record the failed attempt
            $this->recordFailedAttempt($username);
            echo "User not found. <a href='../Connexion/logout.php'>Retry</a>";
        }
    }

    private function isBruteForce($user_id)
    {
        $dbh = $this->connexion->dbh;

        // Get the timestamp of the current time minus the limit duration (e.g., 15 minutes)
        $time_limit = date('Y-m-d H:i:s', strtotime('-15 minutes'));

        // Count the number of failed attempts in the last 15 minutes
        $stmt = $dbh->prepare("SELECT COUNT(*) FROM login_attempts WHERE user_id = :user_id AND attempt_time > :time_limit");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':time_limit', $time_limit);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        // Allow a maximum of 5 attempts in 15 minutes
        return $count >= 5;
    }

    private function recordFailedAttempt($user_id)
    {
        $dbh = $this->connexion->dbh;

        // Record the failed login attempt
        $stmt = $dbh->prepare("INSERT INTO login_attempts (user_id) VALUES (:user_id)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    private function clearFailedAttempts($user_id)
    {
        $dbh = $this->connexion->dbh;

        // Clear all failed attempts for the user
        $stmt = $dbh->prepare("DELETE FROM login_attempts WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a new Login instance and authenticate
    $login = new Login();
    $login->authenticate($username, $password);
}
