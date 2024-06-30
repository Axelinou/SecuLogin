<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/SecuLogin/Service/Register.php");



echo '<html>
    <head>
        <title>Registration Form</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        <h2>Registration Form</h2>

        <form action="../Service/Register.php" method="POST"> Username:

            <input type="text" name="username"> <br> Password:

            <input type="password" name="password">

            <input type="hidden" name="form_submitted" value="1" />

            <input type="submit" value="Submit">

        </form>
    </body>
</html>';




