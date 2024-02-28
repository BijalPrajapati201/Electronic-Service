<?php
include_once("database.php");

function getCusName($id){
    $sql = "SELECT first_name,last_name FROM `customer` WHERE cus_id = $id";
    global $conn;
    $result = $conn->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $full_name = $data[0]['first_name']." ".$data[0]['last_name'];
    return $full_name;
}


function getServiceDetails($id){
    $sql = "SELECT * FROM `service master` WHERE ser_id = $id";
    global $conn;
    $result = $conn->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data[0];
}


// print_r(getServiceDetails(1));

?>