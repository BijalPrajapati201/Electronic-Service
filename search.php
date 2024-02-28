<?php

include 'database.php';

$output = '';

if (isset($_POST['search'])){
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $sql = ("SELECT * FROM `service master` WHERE ser_name LIKE '%$searchq%' OR ser_price LIKE '%$searchq%'  ORDER BY ser_id DESC");
    
    $result = mysqli_query($conn, $sql);
    
    $count = $result->fetch_assoc();

   
    if($count == 0){
        $output = 'There was no search results!';
    }else{
        while($row = $result->fetch_assoc()){
            print_r($row);
            exit;
            $ser_name = $row['ser_name'];
            $ser_price = $row['ser_price'];
            $ser_des = $row['ser_des'];

            $output .= '<div>'.$ser_name.''.$ser_price.'</div>';
        }
    }
}
?>
