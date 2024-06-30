<?php
session_start();

if (isset($_SESSION['username'])) {
    echo "Welcome, " . $_SESSION['username'] . "! <a href='logout.php'>Logout</a>";
} else {
    echo '<html>
        <head>
            <title>Login Form</title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
        <body>

            <h2>Login Form</h2>

            <form action="../Service/Login.php" method="POST"> 
                Username: <input type="text" name="username"> <br> 
                Password: <input type="password" name="password"> <br>
                <input type="submit" value="Login">
            </form>
        </body>
    </html>';
}

