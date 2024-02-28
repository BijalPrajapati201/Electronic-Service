<?php
session_start();
if(!isset($_GET['id'])){
  echo "Select service";
  exit;
}
if(!isset($_SESSION['cus_id'])){

  header("location: login.php");
  exit;
}

include_once("database.php");

function getData($id){
  global $conn;
  $sql = "SELECT * FROM `customer` WHERE `cus_id` = $id";
  $result = $conn->query($sql);
  $data = $result->fetch_all(MYSQLI_ASSOC);
  return $data[0];
}


$data = getData($_SESSION['cus_id']);

function getServiceDetails($id){
  global $conn;
  $sql = "SELECT * FROM `service master` WHERE `ser_available` = '1' AND `ser_id` = $id";
  $result = $conn->query($sql);
  $data = $result->fetch_all(MYSQLI_ASSOC);
  return $data[0];
}

$sericeData = getServiceDetails($_GET['id']);
// print_r($sericeData);
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order</title>

    <!-- Bootstrap link -->
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

 <link rel="stylesheet" href="styles/ord.css" class="src">

 <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">

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
          <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search"  aria-label="Search">
          <button id="search" class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
    </nav>
</div>


<!-- oder information -->
<div class="container h-100 w-100 rounded shadow p-3 mb-5 mt-3 bg-body rounded ">
  <div class="order-info  border border-dark rounded p-3">

<div class="flex-row justify-content-between card"  style="width: 18rem;">
<img class="card-img-top" src="http://localhost/project/styles/<?php echo $sericeData['ser_img'];?>" alt="Card image cap">
  <div class="card-body">
    <label for="name">Service Name:</label>
    <h6 class='mb-0' style="width: 130px;"><?php echo $sericeData['ser_name']; ?></h6>
    <hr>
    <label for="price">Total Price:</label>
    <h6 class='mb-2' name='ser_name'>₹<?php echo $sericeData['ser_price']; ?></h6>
  <!-- <ul>
    <li class="w-100"></li>
  </ul> -->
  <hr>
    <a href="service.php" class="btn btn-primary">Cancel</a>
  </div>
</div>

<hr>

  <form method="post" action="payment.php" >
  <input type='hidden' name='ser_id' id='sr_id' value="<?php echo $_GET['id'];?>">
  <input type='hidden' name='ser_price' id='cs_id' value="<?php echo $sericeData['ser_price'];?>">
  <input type='hidden' name='cus_id' id='cs_id' value="<?php echo $data['cus_id'];?>">
  
  
        <h3 class="mb-3 text-center">Billing Details</h3>
          <div class="row g-3">
            <div class="col-12">
              <label for="firstName" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $data['first_name'];?>" required="">
            </div>

            <div class="col-12 mb-2">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="" required="">
            </div>

            <div class="col-12 mb-2">
              <label for="zip" class="form-label">Mobile no</label>
              <input type="number" class="form-control" name="mobileno" id="mobileno" placeholder="" required="" value="<?php echo $data['mobileno'];?>">
            </div>

            <div class="form-row mb-1">
                    <div class="col-12 mb-2">
                    <label for="disabledSelect" class="form-label m-0">City</label>
                        <select id="disabledSelect" class="form-select" name="ord_city">
                            <option value="Gandhinagar">Gandhinagar</option>
                            <option value="Kalol">Kalol</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                        </select>
                    </div>
                </div>

            <div class="col-12 mb-2">
              <label for="country" class="form-label">Pin code</label>
              <input type="number" class="form-control" name="pinno" id="pinno" placeholder="" required="">
            </div>

            <div class="col-12">
              <label for="country" class="form-label">State</label>
              <input type="text" class="form-control" name="state" id="state" placeholder="" required="" value="<?php echo $data['state'];?>">
            </div>
          </div>

          <hr class="my-4">
 
            <label for="date">Select date for service</label>
            <br>
            <input type="date" id="date" name="date" onchange="handler(event);">
          
            <hr class="mb-4">
            <div class="text-center">
            <button type="submit" name="single_confirm" class="mb-3 btn btn-primary btn-lg ">Confirm</button>
            </div>
  </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <script>
      function handler(e){
        
      $.ajax({
        method: "POST",
        url: "order.php",
        data: { id: "date"}
      })
        .done(function( msg ) {
          alert( "Data Saved: " + msg );
        });
    }
    </script>
</body>
</html>