<?php

  require_once(__DIR__.'/../database/dbutils.php');
  require_once(__DIR__.'/account.php');

  session_start();

  if(isset($_SESSION['active'])){

    if(isset($_POST['action']) && isset($_POST['user'])){
        switch($_POST['action']){
          case 'accept': Account::acceptRequest($_POST['user']); break;
          case 'discard': Account::discardRequest($_POST['user']); break;
          case 'add': Account::addRequest($_POST['user']);
        }
    }else if(isset($_POST['action'])){
        switch($_POST['action']){
          case 'getRequests': Account::getOtherRequests(); break;
        }
    }

  }else{
    header('Location: /');
  }

?>
