<?php

    require('./php/database/dbutils.php');

    class Register{
        
        private $_login;
        private $_nick;
        private $_password;
    
        public function __construct($l, $n, $p){
            $this->_login = $l;
            $this->_nick = $n;
            $this->_password = $p;
            $this->_hashPassword();
        }

        private function _hashPassword(){
            $this->_password = password_hash($this->_password, PASSWORD_DEFAULT);
        }

        public function isExistUserWithNick(){
            $result = DbUtils::executeQuery('select id from Users where nick="%s"', [$this->_nick]);
            if(!!$result->num_rows) throw new Exception("User with this nickname already exist!");
        }

        public function addUserToDatabase(){
            $result = DbUtils::executeQuery('insert into Users(id,login,password,nick) values(NULL, "%s", "%s", "%s")', [$this->_login, $this->_password, $this->_nick]);
            if($result){
                //here will be header location to welcome.php
                throw new Exception('Your account has been created!');
            }else{
                throw new Exception('Database error, please register when we resolve problem.');
            }
        }

    }

?>