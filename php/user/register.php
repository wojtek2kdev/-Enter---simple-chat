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
        }

        private function _hashPassword(){
            $this->_password = password_hash($this->_password, PASSWORD_DEFAULT);
        }

        public function isExistUserWithNick(){
            $result = DbUtils::executeQuery('select id from Users where nick="%s"', [$this->_nick]);
            if(!!$result->num_rows) throw new Exception("User with this nickname already exist!");
        }

        private function _addUserToDatabase(){

        }

    }

?>
