<?php

    require_once(__DIR__.'/style/theme/login-elements.php');
    require_once(__DIR__.'/php/user/account.php');

    session_start();

    if(!isset($_SESSION['active'])){
        header('Location: /');
    }

    if(isset($_POST['logout'])){
       session_destroy();
       header('Location: /login.php');
    }else if(isset($_POST['friend'])){
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
    <link href="style/main-page/ids.css" rel="stylesheet">
    <link href="style/main-page/tags.css" rel="stylesheet">
    <link href="style/menu/UI-Menu/menu.css" rel="stylesheet">
    <link href="style/inputs/UI-Input/input.css" rel="stylesheet">
    <link href="style/icons/UI-Icon/icon.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./scripts/friends-list.js" type="text/javascript"></script>
    <script src="./scripts/friend-requests.js" type="text/javascript"></script>

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
                    <div id='search_bar' class="ui transparent icon input" style='width: 100%; height: 2rem; border-bottom: 1px solid #DDDDDD'>
                      <input id='search_friend' placeholder="Find friend from list..." type="text" class='search' style='padding-left: 1rem !important;' maxlength="20">
                      <i class="search icon"></i>
                    </div>
               </nav>
                <section id='friends-list'>
                    <div class="list">
                        <ul id='items'></ul>
                    </div>
                    <div id='see_more'><span>See more...</span></div>
                    <script type="text/javascript">
                        FriendsList.init(<?php echo(json_encode(iterator_to_array(Account::getFriends())));?>);
                    </script>
                </section>
                <section id="requests">
                    <div class="list requests">
                        <div id='friend-requests' title="Friend Requests"><i class="add user icon" id='user-request'></i></div>
                        <div id="request">
                          <i class='angle left icon' id='previous_request'></i>
                          <div id="request_info">
                            <span style="padding-left: 0.5rem;position: absolute;top: 0.8rem;"></span>
                            <i id='accept' class="checkmark icon"></i>
                            <i id='discard' class="remove icon"></i>
                          </div>
                          <i class="angle right icon" id="next_request"></i>
                        </div>
                    </div>
                    <script>
                      Requests.init(<?php echo(json_encode(iterator_to_array(Account::getOtherRequests()))); ?>);
                    </script>
                </section>
            </div>
        </aside>
        <section id="messages_section">
          <div id="msg">
            <div class="start">
              <i class='users icon' style="font-size: 5rem;"></i>
              <h1>Find friends and talk with them!</h1>
            </div>
            <section id='s_chat_list'>
              <div class="chat_list">

              </div>
            </section>
            <section id="s_messages">
              <div class="messages">

              </div>
            </section>
            <section id="s_write">
              <div class="write_section">

              </div>
            </section>
          </div>
        </section>
    </main>
</body>
</html>
