<?php
 $host = "localhost";  
 $user = "root";  
 $password = '';  
 $db_name = "empire";  
   

 $db = null;
 try {
     $db = new PDO("mysql:host=$host;dbname=$db_name",$user, $password);
 } catch(PDOException $e)
 {
     echo "Database password mismatch";
 }

 $con = mysqli_connect($host, $user, $password, $db_name);  
 if(mysqli_connect_errno()) {  
     die("Failed to connect with MySQL: ". mysqli_connect_error());  
 }


 
?>