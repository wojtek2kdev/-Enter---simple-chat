<?php

include 'php/database/dbutils.php';


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="style/tags.css" rel="stylesheet">
        <link href="style/classes.css" rel="stylesheet">
        <link href="style/buttons/UI-Button/button.css" rel="stylesheet">
        <link href="style/ids.css" rel="stylesheet">
        <script src="jquery-3.2.1.min.js"></script>
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
                        This is <strong> open source </strong> project, which I create because I want to learn writing client-server web apps with databases and server administration. This page isn't responsive and nice as front-end, I'm focused on back-end, layout is very basic.
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
             </article>
            </section>
        </main>
    </body>
</html>
