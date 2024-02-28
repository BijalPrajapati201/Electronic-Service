<?php
session_start();
include('database.php');
$status="";
$id = $_POST['id'];
if (isset($_POST['id']) && $_POST['id']!=""){
    $code = $_POST['id'];
    $result=mysqli_query($conn,"SELECT * FROM `service master` WHERE ser_id='$id'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['ser_name'];   
    $code = $row['ser_id'];
    $price = $row['ser_price'];
    $image = $row['ser_img'];

    $_SESSION['ser_id'] = $code;
    // $cartArray = array(
    // 	$code=>array(
    // 	'name'=>$name,
    // 	'code'=>$code,
    // 	'price'=>$price,
    // 	'quantity'=>$_POST['qty'],
    // 	'image'=>$image)
    // );

$cid = $_SESSION['cus_id'];
$qty = $_POST['qty'];
$insert = $conn->query("INSERT IGNORE INTO `order cart` ( `cus_id`, `name`, `ser_id`, `price`, `qty`, `image`) VALUES ( '$cid', '$name', '$code',  '$price', '$qty', '$image')");
print_r($insert);
exit;
if($insert){
    $status = "<div class='box'>Product is added to your cart!</div>";

}else{
    $status = "<div class='box' style='color:red;'>
	failed to add to your cart!</div>";	
}
echo $status;
exit(0);
if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}
        echo json_encode($status);
	}
}
?>