<?php
        
    include 'dbinfo.php'; //require_once

    class DbUtils{

        private function __construct(){}

        private function __clone(){}
 
        public static function executeQuery($sql){
            try{
                $conn = new mysqli(DbInfo::IP, DbInfo::USER, DbInfo::PASSWORD, 'Enter');
                if($conn->connect_errno!=0){ 
                    throw new Exception(mysqli_connect_errno());
                }else{
                $conn->query($sql);
                $conn->close();
                }
            }catch(Exception $e){
                //obsulga bledu
            }

        }
        
    }

?>

