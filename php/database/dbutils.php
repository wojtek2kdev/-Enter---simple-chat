<?php
        
    include 'dbinfo.php';

    class DbUtils{

         public static function getConnection(){
            
              return new mysqli(DbInfo::IP, DbInfo::USER, DbInfo::PASSWORD, 'Enter');

         }
        
    }

?>

