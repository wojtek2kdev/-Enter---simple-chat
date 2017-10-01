<?php

    session_start();

    require('./style/theme/login-elements.php');
    
    if(!isset($_SESSION['new_user'])){
        //if will be user account session then header location to user main page
        header('Location: /');
    }else{
        unset($_SESSION['new_user']);
        session_destroy();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style/tags.css" rel="stylesheet">
    <link href="style/welcome-page/tags.css" rel="stylesheet">
    <link href="style/classes.css" rel="stylesheet">
    <link href="style/buttons/UI-Button/button.css" rel="stylesheet">
    <link href="style/ids.css" rel="stylesheet">
    <title>Welcome to 'Enter' chat!</title>
</head>
<body>
   <?php echo(Element::getElement('nav')); ?>
   <main>
       <article>
           <header>
           <h1>Hello <span style='color: green;'><?php echo($_GET['nick']);?></span>!</h1>
           </header>
           <h2>Your account has been created correct.<br /> Have fun!</h2>
           <a href='/login.php'><button class='ui inverted green button' style='width: 10rem;'>Log in</button></a>
       </article>
   </main>
</body>
</html>
