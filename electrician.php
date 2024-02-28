<?php

include_once("database.php");
session_start();
if(!isset($_SESSION['cus_id'])){
  header("location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>Service</title> 

  <!-- Bootstrap link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">

	<link rel="stylesheet" href="styles/service.css" type="text/css" />
  
  <!-- icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
  
<body>

<div class="navigation">
    <nav class="navbar navbar-expand-lg  navbar-light bg-white p-fixed">
      <div class="container-fluid">
    
      <img class="m-0" style="width: 60px; height: 50px; border-radius: 20px;" src="styles/home-service-logo.png">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <p class="navbar-toggler-icon my-0"></p>
      </button>
      <div class="mx-2 collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
          </li>
    
      <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="welcome.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="welcome.php">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="logout.php">Log out</a>
          </li>

        </ul>
          <form class="d-flex" role="search" method="POST">
          <input class="form-control me-2"  type="search" placeholder="Search" name="search" aria-label="Search">
          <button id="search" class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    </nav>
</div>

<div class='row p-5 mx-0 '>
<?php

include('./function.php');

$city = $_SESSION['city'];
// $cus_id = $_SESSION['cus_id'];

// $sql = "SELECT * FROM `order master` WHERE ord_city = '$city'";

// $sql = "select * from `order_details` o1 INNER join `service master` s1 on o1.ser_id=s1.ser_id inner join `order master` o2 on o1.ord_id=o2.ord_id inner join `payment master` p1 on o1.ord_id=p1.ord_id WHERE  ord_city = '$city'";
// echo $sql;

$result = mysqli_query($conn, "select * from `order_details` o1 INNER join `service master` s1 on o1.ser_id=s1.ser_id inner join `order master` o2 on o1.ord_id=o2.ord_id inner join `payment master` p1 on o1.ord_id=p1.ord_id WHERE  ord_city = '$city'");
// print_r($result);
// $row = $result->fetch_all();
// print_r($row);
// exit;
if(!$result){
    die("invalid query : " . $conn);
}

  while($row = $result->fetch_assoc()){
    // print_r($row);
    // exit;
    $cusName = getCusName($row['cus_id']);
    echo "
    <div class='card m-4 '  style='width: 25rem;'>
    <div class='card-body text-black'>
    <img class='card-img-top' src='http://localhost/project/styles/$row[ser_img]' alt='Card image cap'>
    <hr>
    <label class='fw-bold fs-5' for='name'>Customer Name:</label>
    <p class='mb-0 fs-5' style='width: 130px;'>$cusName</p>
    <hr>
    <label class='fw-bold fs-5' for='name'>Service Name:</label>
    <p class='mb-0 fs-5' style='width: 130px;'>$row[ser_name]</p>
    <hr>
    <label class='fw-bold fs-5' for='name'>Service Price:</label>
    <p class='mb-0 fs-5' style='width: 130px;'>₹$row[ser_price]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Customer Address:</label>
    <p class='mb-2 fs-5' name='address'>$row[ord_address]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Pincode No:</label>
    <p class='mb-2 fs-5' name='pincode'>$row[pinno]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Payment Type</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[pay_type]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Payment Status</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[pay_status]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Order Status</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[ord_status]</p>
    <hr>  
    <label class='fw-bold fs-5' for='price'>Order Date</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[date]</p>
    <hr>
    <a class='btn  btn-success btn-lm' href='./eleEdit.php?ord_id=$row[ord_id]'>Update</a>
    <a href='#' class='btn btn-primary'>Cancel</a>
    </div>
    </div>

";
}
?>
</div>

<!-- <div class='toast-container'>
  <div class='toast' role='alert' aria-live='assertive' aria-atomic='true'>
    <div class='toast-header'>
      <img src='...' class='rounded me-2' alt='...'>
      <strong class='me-auto'>Bootstrap</strong>
      <small class='text-muted'>just now</small>
      <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
    </div>
    <div class='toast-body'>
      See? Just like this.
    </div>
  </div> -->

</body>
</html>