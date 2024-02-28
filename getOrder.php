<?php

include 'database.php';
$sql = "SELECT * FROM `order master` ";

  $result = $conn->query($sql);

    if($row = $result->fetch_assoc()){ 
        print_r($row["date"]);
        exit;
    }else{ 
        echo 'Content not found....'; 
    } 
?>