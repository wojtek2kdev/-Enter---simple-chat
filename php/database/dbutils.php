<?php namespace dbutils;
        
    include 'dbinfo.php';

    class DbUtils{

         public static function getConnection(){
            
            return mysqli_connect(DbInfo::IP, DbInfo::USER, DbInfo::PASSWORD, 'Enter');

         }
        
    }

?>

