<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "users"; 
      
    $conn = mysqli_connect($server, $username, $password, $database);  
    if(!$conn){  //when data base are not connect
    //     echo "Successful";
    // }  
    // else
    // {
    	die("Eror". mysql_connect_error());
    }
?>