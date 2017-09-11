<?php

include 'php/dbutils.php';

//$conn = DbUtils::getConnection();

//echo($conn->query('select * from Users'));

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style/tags.css" rel="stylesheet">
        <link href="style/classes.css" rel="stylesheet">
        <script src="jquery-3.2.1.min.js"></script>
        <title>Enter - simple chat</title>
    </head>
    <body>
        <nav>
            <form method="post">
                <ul>
                    <li>
                        <span>Login:</span>
                        <input type="text" class="" value="" name="login" maxlength="20">
                    </li>
                    <li>
                        <span>Password:</span>
                        <input type="password" class="" value="" name="pass" maxlength="20">
                    </li>
                </ul>
                <div class="logo">
                    <input type="submit" value="" name="">
                </div>
            </form>
        </nav>
    </body>
</html>
