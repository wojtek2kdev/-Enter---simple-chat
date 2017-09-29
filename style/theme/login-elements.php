<?php 

    class Element{
        
        private function __construct(){}
        private function __clone(){}

        public static function getElement($name){
            switch($name){
                case 'nav': return self::_getNav(); break;
                default: return "Element doesn't exist"; break;
            }  
        }

        private static function _getNav(){
            return "
             <nav>
                 <div class='logo'></div>
                     <div class='login'>
                          <span>Do you have account? So, </span>
                          <button id='login' class='ui basic green button'>Log In</button>
                      </div>
             </nav>
            ";
        }

    }

?>
