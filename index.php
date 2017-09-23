<?php

    include('./php/data-validation.php');

    $error = '';

    if(isset($_POST['login'])){
        
        $error =  RegisterValidation::validate($_POST['nick'], $_POST['login'], 
            $_POST['password'], $_POST['confirm']); 

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style/tags.css" rel="stylesheet">
        <link href="style/classes.css" rel="stylesheet">
        <link href="style/buttons/UI-Button/button.css" rel="stylesheet">
        <link href="style/ids.css" rel="stylesheet">
        <link href="style/icons/UI-Icon/icon.css" rel="stylesheet">
        <script src="scripts/jquery-3.2.1.js"></script>
        <script src='scripts/validation.js'></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title>Enter - simple chat</title>
    </head>
    <body>
        <nav>
           <div class="logo"></div>
            <div class="login">
                <span>Do you have account? So, </span>
                <button id='login' class='ui basic green button'>Log In</button>
            </div>
        </nav>
        <main>
            <section id='about'>
             <article>
                <header>
                    <h1>About site</h1>
                </header>
                <div id="desc">
                    <p>"Enter" - simple internet chat similar to Discord (but very simpler)
                         <br/>
                        This is <strong> open source </strong> project, which I create because I want to learn server administration and writing client-server web apps with databases. This page isn't responsive and nice as front-end, I'm focused on back-end, layout is very basic.
                        <br/>
                        In this project I use these technologies: <br/>
                    </p>
                        <ul>
                            <li>Apache</li>
                            <li>PHP7</li>
                            <li>MySQL</li>
                            <li>Web: html5, css3, js (ES6)</li>
                        </ul>
                        <p>
                        Click here to see my GitHub:
                          <a target='_blank' href="https://github.com/wojtek2kdev/-Enter---simple-chat">
                          <img src="assets/github.png" alt="GitHub" class='github'>
                          </a>
                        </p>
                </div>
             </article>
            </section>
            <section id='register'>
             <article>
                <header>
                    <h1>Register</h1>
                </header>
                <div id="regform">
                   <form method="post"> 
                    <input type="text" placeholder='Login..'  name="login">
                    <input type="text" placeholder='Nickname.. (without spaces)' name="nick" maxlength='20'>
                    <input type="password" placeholder='Password.. (min 8 letters)'  name="password">
                    <div>
                    <input type="password" placeholder='Confirm password..'  name="confirm">
                    <i id='pass_err' class="error warning circle icon" title="Passwords aren't same."></i>
                    <script>$('#pass_err').hide();</script>
                    </div>
                   <div class="g-recaptcha" data-sitekey="6LeRzTEUAAAAABAZRLh3DdjeX8aol7Lvm9mJEcRl"></div> 
                   <div id="errorlog">
                        <span>
                            <?php 
                                echo($error);
                            ?> 
                        </span>
                    </div>
                         <input id='submit' type="submit" style='margin-top: 7%;' class="ui inverted green button" value="Create account" name="">
                   </form>
                </div>
             </article>
            </section>
        </main>
    </body>
</html>
