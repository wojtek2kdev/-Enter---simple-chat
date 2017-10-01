<?php

    require_once('./style/theme/login-elements.php');
    require_once('./php/data-validation.php');
    
    $error = '';

    if(isset($_POST['login'])){
        $error = LoginValidation::validate($_POST['login'], $_POST['password']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        echo(Element::getElement('nav-style'));
    ?>
    <link href="./style/login-page/classes.css" rel="stylesheet">
    <title>Enter - Log in</title>
</head>
<body>
    <?php echo(Element::getElement('nav')); ?>
    <script type="text/javascript">document.getElementsByClassName('login')[0].remove();</script>
    <div class="login-form">
        <h1>Enter - simple chat.</h1>
        <h3>Log in to your account.</h3>
        <form method="post">
            <input type="text" placeholder="Type your login.." name="login">
            <input type="password" placeholder="Type your password.." name="password">
            <span style='color: red; font-size: 1.5rem;'><?php echo($error); ?></span>
            <button class='ui inverted green button'>Log in</button>
        </form>
    </div>
</body>
</html>
