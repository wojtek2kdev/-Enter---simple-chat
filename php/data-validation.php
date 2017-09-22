<?php

    class Validation{

        private function __construct(){}

        private function __clone(){}

        public static function normalize($data){

            return htmlentities($data, ENT_QUOTES, 'utf-8');

        }

    }

    class RegisterValidation extends Validation{

        private static $nick, $login, $password, $confirm;

        public static function validate($n, $l, $p, $c){

            self::$nick = parent::normalize($n);
            self::$login = parent::normalize($l);
            self::$password = parent::normalize($p);
            self::$confirm = parent::normalize($c);

            try{
                self::isLoginSet($l);
                self::isNickSet($n);
                self::isPasswordSet($p);
                self::arePasswordsSame($p, $c);
                self::isPasswordStrong($p);
            }catch(Exception $e){
                return $e->getMessage();
            }

        }

        private static function isNickSet($n){
            if(!strlen($n)){
                throw new Exception("Nickname isn't set!");
            }
        }

        private static function isNickTooLong($n){
            if(strlen($n) > 20){
                throw new Exception("Nickname is too long! (max 20 letters)");
            }
        }

        private static function isLoginSet($l){
            if(!strlen($l)){
                throw new Exception("Login isn't set!");
            }
        }

        private static function isPasswordSet($p){
             if(!strlen($p)){
                throw new Exception("Password isn't set!");
             }
        }

        private static function arePasswordsSame($p, $c){
            if($p != $c){
                throw new Exception("Passwords aren't same!");
            } 
        }

        private static function isPasswordStrong($p){
            if(strlen($p) < 8){
                throw new Exception('Password must have min. 8 letters!');
            }
        }

    }

?>
