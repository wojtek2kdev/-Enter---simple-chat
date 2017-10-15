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

        public static function searUser($user){
          $result = DbUtils::executeQuery('select nick from Users where nick="%s"', [$user]);
          $arr = mysqli_fetch_all($result);
          foreach($arr as $i){
            yield $i;
          }
        }

        public static function removeFriend($friend){
            DbUtils::executeQuery('delete from Friends where (user1="%s" and user2="%s") or (user1="%s" and user2="%s")', [$_SESSION['nick'], $friend, $friend, $_SESSION['nick']]);
        }

    }

?>
