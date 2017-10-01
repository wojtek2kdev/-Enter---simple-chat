<?php

    require_once('./php/database/dbutils.php');

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
            $result = DbUtils::executeQuery('select password from Users where login="%s"', [$this->_login]);
            if(!$result->num_rows) throw new Exception($this->_error);
            else{
                $pass = mysqli_fetch_assoc($result)['password'];
                if(!password_verify($this->_password, $pass)){ 
                    throw new Exception($this->_error);
                }else{
                    session_start();
                    $_SESSION['active'] = true;
                }
            }
        }

        public function logout(){
            unset($_SESSION['active']);
        } 

    }

?>
