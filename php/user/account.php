<?php

    require_once(__DIR__.'/../database/dbutils.php');

    class Account{

        private $_login;
        private $_password;

        private $_error;

        public function __construct($login, $password){

            $this->_error = 'Login or password is incorrect.';

            $this->_login = $login;
            $this->_password = $password;
        }

        public function login(){
            $result = DbUtils::executeQuery('select * from Users where login="%s"', [$this->_login]);
            if(!$result->num_rows) throw new Exception($this->_error);
            else{
                $row = mysqli_fetch_assoc($result);
                if(!password_verify($this->_password, $row['password'])){
                    throw new Exception($this->_error);
                }else{
                    session_start();
                    $_SESSION['active'] = true;
                    $_SESSION['nick'] = $row['nick'];
                    header('Location: /main.php');
                }
            }
        }

        public static function getFriends(){
            $result = DbUtils::executeQuery('select user2 from Friends where user1="%s";', [$_SESSION['nick']]);
            $result2 = DbUtils::executeQuery('select user1 from Friends where user2="%s";', [$_SESSION['nick']]);
            $arr = mysqli_fetch_all($result);
            $arr2 = mysqli_fetch_all($result2);
            foreach($arr as $i){
                yield $i;
            }
            foreach($arr2 as $i){
                yield $i;
            }
        }

        public static function searchUser($user){
          $result = DbUtils::executeQuery('select nick from Users where nick like "%s%%"', [$user]);
          $arr = mysqli_fetch_all($result);
          foreach($arr as $i){
            yield $i;
          }
        }

        public static function removeFriend($friend){
            DbUtils::executeQuery('delete from Friends where (user1="%s" and user2="%s") or (user1="%s" and user2="%s")', [$_SESSION['nick'], $friend, $friend, $_SESSION['nick']]);
        }

        public static function addRequest($user){
            if($user == $_SESSION['nick']){
              echo(json_encode('You are trying to send request to yourself'));
              return;
            }
            $is_friend = DbUtils::executeQuery('select id from Friends where (user1="%s" and user2="%s") or (user1="%s" and user2="%s");',
            [$_SESSION['nick'], $user, $user, $_SESSION['nick']]);
            if($is_friend->num_rows){
              echo(json_encode('You are trying send request to your actually friend'));
              return;
            }
            $was_sended = DbUtils::executeQuery('select id from Requests where user1="%s" and user2="%s"', [$_SESSION['nick'], $user]);
            if($was_sended->num_rows){
              echo(json_encode('You has been sended request to this user'));
              return;
            }
            $exist = DbUtils::executeQuery('select id from Users where nick="%s"', [$user]);
            if(!$exist->num_rows){
              echo(json_encode("User '".$user."' does not exist."));
              return;
            }
            DbUtils::executeQuery('insert into Requests(id, user1, user2) values(null, "%s", "%s");', [$_SESSION['nick'], $user]);
        }

        public static function acceptRequest($user){
          try{
            self::_removeOtherRequest($user);
          }catch(Exception $e){
            echo(json_encode($e->getMessage()));
            return;
          }
            DbUtils::executeQuery('insert into Friends(id, user1, user2) values(null, "%s", "%s");',[$_SESSION['nick'], $user]);
        }

        public static function discardRequest($user){
          try{
            self::_removeOtherRequest($user);
          }catch(Exception $e){
            echo(json_encode($e->getMessage()));
            return;
          }
        }

        public static function getMyRequests(){
          $result = DbUtils::executeQuery('select user2 from Requests where user1="%s";', [$_SESSION['nick']]);
          $arr = mysqli_fetch_all($result);
          foreach($arr as $i){
              yield $i;
          }
        }

        public static function getOtherRequests(){
          $result = DbUtils::executeQuery('select user1 from Requests where user2="%s";', [$_SESSION['nick']]);
          $arr = mysqli_fetch_all($result);
          foreach($arr as $i){
              yield $i;
          }
        }

        private static function _removeOtherRequest($user){
             $result = DbUtils::executeQuery('select id from Requests where user1="%s" and user2="%s"', [$user, $_SESSION['nick']]);
             if(!$result->num_rows) throw new Exception("Request does not exist.");
             else DbUtils::executeQuery('delete from Requests where user1="%s" and user2="%s"', [$user,$_SESSION['nick']]);
        }

    }

?>
