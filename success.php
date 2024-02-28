
<?php
include 'function.php';
include 'database.php';
require 'config.php';
session_start();



if(!empty($_POST)){


    $ord_id = $_SESSION['ord_id'];
   

    //response form razorpay
    $razorpay_pay_id = $_POST['razorpay_payment_id'];

    if($razorpay_pay_id != null){
        echo 'Payment Successfull';
        $sql = "SELECT * FROM `service master`";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sericeData = getServiceDetails($row['ser_id']);
        $ser_id = $sericeData['ser_id'];

        $sql = "SELECT * FROM `order master`";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        $ord_id = $data['ord_id'];

        $cus_id = $_SESSION['cus_id'];

        // $amount = $_SESSION['ord_id'];
        $razorpay_pay_id = $_POST['razorpay_payment_id'];
        $status='paid';
        $pay_type='Online';
        $pay_date = date('Y-m-d H:i:s');


        $sql = "INSERT INTO `payment master` ( `pay_id`,`cus_id`, `ser_id`, `ord_id`, `pay_type`,  `pay_status`, `pay_date`) VALUES ( '$razorpay_pay_id', '$cus_id', '$ser_id', '$ord_id', '$pay_type', '$status','$pay_date');";
        $result = mysqli_query($conn, $sql);
        // print_r($sqlUpdate);
        header("location: feedback.php");
        exit;
        } 
    
    }else {
        // print_r($ord_id);
        $sql = "SELECT * FROM `service master`";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sericeData = getServiceDetails($row['ser_id']);
        $ser_id = $sericeData['ser_id'];
        
        $sql = "SELECT * FROM `order master`";
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();
        // $ord_id = $data['ord_id'];
        $pay_date = date('Y-m-d H:i:s');
        
        $randomPayId = 'ajkdsklaklaj';
        $status='No paid';
        $pay_type='COD';
        
        $ord_id = $_SESSION['insert_ord_id'];
        $cus_id = $_SESSION['cus_id'];
        // echo $ord_id;
        // exit;

        $sql = "INSERT INTO `payment master` ( `cus_id`, `ser_id`, `ord_id`, `pay_type`,  `pay_status`, `pay_date`) VALUES (  '$cus_id', '$ser_id', '$ord_id', '$pay_type', '$status','$pay_date')";

        // print_r($sql);
        // exit;
        $result = mysqli_query($conn, $sql);
        header("location: feedback.php");
        

    }
   


?>
