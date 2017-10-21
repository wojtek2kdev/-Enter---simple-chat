<?php

  require_once(__DIR__.'/user/account.php');

    session_start();

    if(isset($_POST['user']) && isset($_SESSION['active'])){
        if(strlen($_POST['user'])){
          $arr = iterator_to_array(Account::searchUser($_POST['user']));
          $i = array_search([$_SESSION['nick']], $arr);
          if($i !== false) array_splice($arr, $i, 1);
          foreach(iterator_to_array(Account::getFriends()) as $friend){
            $f = array_search($friend, $arr);
            if($f !== false) array_splice($arr, $f, 1);
          }
          foreach (iterator_to_array(Account::getMyRequests()) as $user) {
            $u = array_search($user, $arr);
            if($u !== false) array_splice($arr, $u, 1);
          }
          if(count($arr) > 50){
            $arr = array_slice($arr, 0, 50);
          }
        echo(json_encode($arr));
        }
    }else{
      header('Location: /');
    }

?>
