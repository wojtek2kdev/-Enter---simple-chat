<?php
    
    require_once('./style/theme/login-elements.php');
    require_once('./php/user/account.php');

    session_start();

    if(!isset($_SESSION['active'])){
        header('Location: /');
    }

    if(isset($_POST['logout'])){
       session_destroy(); 
       header('Location: /login.php');
    }

    if(isset($_POST['friend'])){
        Account::removeFriend($_POST['friend']);
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
    <link href="style/menu/UI-Menu/menu.css" rel="stylesheet">
    <link href="style/inputs/UI-Input/input.css" rel="stylesheet">
    <link href="style/icons/UI-Icon/icon.css" rel="stylesheet">

    <script src="./scripts/friends-list.js" type="text/javascript"></script>

    <style type="text/css">
        section {
           float: unset; 
        }
    </style>

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
                <nav id='search-type'>
                    <div class="ui two item menu" style='border-radius: 0px; margin: 0rem; border: none; border-bottom: 1px solid #DDDDDD;'>
                        <a class="active item">Friends</a>
                        <a class="item">Search</a>
                    </div>
                    <div class="ui transparent icon input" style='width: 100%; height: 2rem; border-bottom: 1px solid #DDDDDD'>
                      <input id='search' placeholder="Find friend from list..." type="text" class='search' style='padding-left: 1rem !important;'>
                      <i class="search icon"></i>
                    </div>
               </nav>
                <section id='friends-list'>
                    <div class="list">
                        <ul id='items'>
                        </ul>
                        <script type="text/javascript">
                            FriendsList.init(<?php echo(json_encode(iterator_to_array(Account::getFriends())));?>); 
                        </script>
                    </div>
                </section>
                <section id="requests">
                    <div class="list requests">
                        <div style='width: 3rem; height: 3rem; border-right: 1px solid #DDDDDD;'><i class="add user icon" id='user-request'></i></div>
                    </div>
                </section>
            </div>
        </aside>
    </main>
</body>
</html>
