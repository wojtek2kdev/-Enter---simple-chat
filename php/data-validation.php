<?php

    class Validation{

        private function __construct(){}

        private function __clone(){}

        public static function normalize($data){

            return htmlentities($data, ENT_QUOTES, 'utf-8');

        }

    }

    class RegisterValidation extends Validation{

        private  $nick, $login, $password;

        public static function validate($n, $l, $p){

            self::$nick = normalize($n);
            self::$login = normalize($l);
            self::$password = normalize($p);

            try{
                isNickSet();
                isLoginSet();
                isPasswordSet();
            }catch(Exception $e){
                return $e->getMessage();
            }

        }

        private static function isNickSet(){
            if(!strlen($nick)){
                throw new Exception("Nickname isn't set!");
            }
        }

        private static function isLoginSet(){
            if(!strlen($login)){
                throw new Exception("Login isn't set!");
            }
        }

        private static function isPasswordSet(){
             if(!strlen($password)){
                throw new Exception("Password isn't set!");
             }
        }

    }

?>
