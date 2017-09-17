<?php

    class Validation{

        private function __construct(){}

        private function __clone(){}

        public static function normalize($data){

            return htmlentities($data, ENT_QUOTES, 'utf-8');

        }

    }

    class RegisterValidation extends Validation{

        private static $nick, $login, $password;

        public static function validate($n, $l, $p){

            self::$nick = parent::normalize($n);
            self::$login = parent::normalize($l);
            self::$password = parent::normalize($p);

            try{
                self::isLoginSet();
                self::isNickSet();
                self::isPasswordSet();
            }catch(Exception $e){
                return $e->getMessage();
            }

        }

        private static function isNickSet(){
            if(!strlen(self::$nick)){
                throw new Exception("Nickname isn't set!");
            }
        }

        private static function isLoginSet(){
            if(!strlen(self::$login)){
                throw new Exception("Login isn't set!");
            }
        }

        private static function isPasswordSet(){
             if(!strlen(self::$password)){
                throw new Exception("Password isn't set!");
             }
        }

    }

?>
