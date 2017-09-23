<?php

    include(__DIR__.'/user/register.php');

    class Validation{

        private function __construct(){}

        private function __clone(){}

        public static function normalize($data){

            return htmlentities($data, ENT_QUOTES, 'utf-8');

        }

    }

    class RegisterValidation extends Validation{

        private static $_nick, $_login, $_password, $_confirm;

        public static function validate($n, $l, $p, $c){

            self::$_nick = parent::normalize($n);
            self::$_login = parent::normalize($l);
            self::$_password = parent::normalize($p);
            self::$_confirm = parent::normalize($c);

            try{
                self::_isLoginSet($l);
                self::_isNickSet($n);
                self::_isPasswordSet($p);
                self::_arePasswordsSame($p, $c);
                self::_isPasswordStrong($p);
                self::_isLoginTooLong($l);
                self::_isNickTooLong($n);
                self::_areInputsCorrect([$l,$n,$p,$c]);

                $register = new Register(self::$_login, self::$_nick, self::$_password);
                $register->isExistUserWithNick();
            }catch(Exception $e){
                return $e->getMessage();
            }

        }

        private static function _isNickSet($n){
            if(!strlen($n)){
                throw new Exception("Nickname isn't set!");
            }
        }

        private static function _isNickTooLong($n){
            if(strlen($n) > 20){
                throw new Exception("Nickname is too long! (max 20 letters)");
            }
        }

        private static function _isLoginTooLong($l){
            if(strlen($l) > 20){
                throw new Exception("Login is too long! (max 20 letters)");
            }
        }

        private static function _isLoginSet($l){
            if(!strlen($l)){
                throw new Exception("Login isn't set!");
            }
        }

        private static function _isPasswordSet($p){
             if(!strlen($p)){
                throw new Exception("Password isn't set!");
             }
        }

        private static function _arePasswordsSame($p, $c){
            if($p != $c){
                throw new Exception("Passwords aren't same!");
            } 
        }

        private static function _isPasswordStrong($p){
            if(strlen($p) < 8){
                throw new Exception('Password must have min. 8 letters!');
            }
        }

        private static function _areInputsCorrect($inputs){
            foreach($inputs as $input){
                $correct = false;
                for($i=0; $i<strlen($input); $i++){
                   if($input[$i] != ' ') $correct = true;
                }
                if(!$correct){
                    throw new Exception("Input must includes letter!");
                }
            }
        }

    }

?>
