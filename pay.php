<?php
require_once './config.php';
include_once("database.php");
function getServiceDetails($id){
  global $conn;
  $sql = "SELECT * FROM `service master` WHERE `ser_available` = '1' AND `ser_id` = $id";
  $result = $conn->query($sql);
  $data = $result->fetch_all(MYSQLI_ASSOC);
  return $data[0];
}

if(isset($_POST['ser_id'])){
  $sericeData = getServiceDetails($_POST['ser_id']);
  $cus_id = $_POST['cus_id'];
  $ser_id = $_POST['ser_id'];
  $address = $_POST['address'];
  $mobileno = $_POST['mobileno'];
  $pinno = $_POST['pinno'];
  $date = $_POST['date'];
  $ser_price = $sericeData['ser_price'];

  $sql = "INSERT INTO `order master` ( `ord_price`, `cus_id`, `ser_id`, `ord_status`, `pay_id`, `ord_address`, `cus_mobile_no`, `pinno`, `date`) VALUES ('$ser_price', '$cus_id', '$ser_id', '0', '2121', '$address', '$mobileno', '$pinno', '$date')";
  $query = mysqli_query($conn,$sql);
  if(!$query){
    echo "Failed To add in DB";
    // echo mysqli_connection_error($conn);
    exit;
  }

  
}else{
  echo "<script> alert('PLease select product 1st'); </script>";
  exit; 
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment</title>
  
  <meta 
    http-equiv="Content-Security-Policy" 
    content="default-src * gap:; script-src * 'unsafe-inline' 'unsafe-eval'; connect-src *; img-src * data: blob: android-webview-video-poster:; style-src * 'unsafe-inline';" />

</head>

    <!-- Bootstrap link --> 
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<link rel="stylesheet" href="styles/payment.css" class="src">

  <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">



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
          <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search"  aria-label="Search">
          <button id="search" class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    </nav>
</div>

<div class="container shadow p-3 mb-5 mt-2 rounded bg-body">

  <div class="pay-info border border-dark p-3 rounded">

    <h2 class="mb-3 text-center ">Payment</h2>
    <hr>
    <div class="flex-row justify-content-between card"  style="width: 18rem;">
    <img class="card-img-top" src="http://localhost/project/styles/<?php echo $sericeData['ser_img'];?>" alt="Card image cap">
    <div class="card-body">
    <label for="name">Service Name:</label>
    <h6 class='mb-0' style="width: 130px;"><?php echo $sericeData['ser_name']; ?></h6>
    <hr>
    <label for="price">Total Price:</label>
    <h6 class='mb-2' name='ser_name'>₹<?php echo $sericeData['ser_price']; ?></h6>
    <hr>
    <a href="service.php" class="btn btn-primary">Cancel</a>
  </div>
</div>
<hr>
  <div id="paymentResponse" class="hidden"></div>
    <form id="paymentFrm" class="needs-validation" novalidate="">
            
          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
          
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="paypal">Cash on delivery</label>
            </div>
          </div>

          <hr>
          
          <div class="row gy-3">
            <div class="col-md-12">
              <label class="form-label">Name </label>
              <input type="text" id="name" class="form-control" placeholder="" required="">
            </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label class="form-label">email </label>
              <input type="email" id="email" class="form-control" placeholder="" required="">
            </div>

          
          <hr class="my-4">
          <div id="paymentElement">
            <!-- Stripe.js injects the payment Element   -->
          </div>

        <!-- Form submit Button. -->
		    <div class="text-center">
          <button id="submitBtn" class="mb-2 btn btn-dark btn-lg" type="submit">
          <span id="buttonText"> Payment Now </span> 
          </button>
		    </div>
        </form>
  </div>
</div>
</body>
</html>