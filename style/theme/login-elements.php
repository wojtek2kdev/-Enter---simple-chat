<?php 

    class Element{
        
        private function __construct(){}
        private function __clone(){}

        public static function getElement($name){
            switch($name){
                case 'nav': return self::_getNav(); break;
                case 'nav-style': return self::_getNavStyles(); break;
                default: return "Element doesn't exist"; break;
            }  
        }

        private static function _getNav(){
            return "
             <nav class='main'>
                <a href='/'><div class='logo'></div></a>
                     <div class='login'>
                          <span>Do you have account? So, </span>
                         <a href='/login1.php'><button id='login' class='ui basic green button'>Log In</button></a>
                      </div>
             </nav>
            ";
        }

        private static function _getNavStyles(){
            return '
                   <link href="style/tags.css" rel="stylesheet">
                   <link href="style/classes.css" rel="stylesheet">
                   <link href="style/buttons/UI-Button/button.css" rel="stylesheet">
                   <link href="style/ids.css" rel="stylesheet">
            ';
        }

    }

?>
