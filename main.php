<?php
    
    require_once('./style/theme/login-elements.php');
    
    session_start();

    if(!isset($_SESSION['active'])){
        header('Location: /');
    }

    if(isset($_POST['logout'])){
       session_destroy(); 
       header('Location: /login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php
        echo(Element::getElement('nav-style'));
    ?>
    <link href="style/main-page/classes.css" rel="stylesheet">
    <title>Enter - simple chat</title>
</head>
<body>
   <?php
    echo(Element::getElement('nav'));
   ?>
    <script type="text/javascript">
        const loginBlock = document.getElementsByClassName('login')[0];
        const loginBlockMessage = loginBlock.children[0];
        const loginBlockButton = loginBlock.children[1].children[0];

        (function rebuild(){
            loginBlockMessage.innerText = "Hello " + <?php echo(json_encode($_SESSION['nick'])) ?>;
            loginBlockButton.className = 'ui basic red button';
            loginBlockButton.innerText = 'Log out';
            loginBlockButton.setAttribute('name', 'logout');

            loginBlock.children[1].remove();
            loginBlock.appendChild(loginBlockButton);

            let form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.appendChild(loginBlock);
            document.getElementsByTagName('nav')[0].appendChild(form);
         })();
    </script>
    <main>
        <aside>
            <div class="friends">
            
            </div>
        </aside>
    </main>
</body>
</html>
