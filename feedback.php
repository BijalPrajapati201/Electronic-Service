<?php 

include 'database.php';

  $sql = "SELECT * FROM `customer`";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $sql = "SELECT * FROM `service master`";
  $result = $conn->query($sql);
  $data = $result->fetch_assoc();

  
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $feed = $_POST['reason'];

  $cus_id = $row['cus_id'];
  $ser_id = $data['ser_id'];
  $query = "INSERT INTO `feedback table` ( `cus_id`, `ord_id`, `feed_des` ) VALUES ( '$cus_id', '$ser_id', '$feed' )";
  $res = $conn->query($query);
  echo "<script> alert('Thank you for select your service'); </script>";
  header("location: service.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback page</title>

  <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    
    	<!-- Navbar  -->
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
 
<form action="feedback.php" method="post">
<div class="container shadow p-3 mb-5 mt-3 bg-body rounded ">
    <div class="feedback-info border border-dark rounded p-3">    
        <h2 class="text-center">Feedback Form</h2>
        <h6 class="text-muted text-center">We would love to hear your thoughts, suggestions, concerns or problems with anything so we can improve!</h6>

        <hr class="my-4">   

        <h6 class="fw-bold">Description Your Feedback</h6>
        <textarea class="form-control" name="reason" id="reason" cols="170" rows="5"></textarea>

    <div class="row g-3 mt-4 mb-5">
    <div class="col-sm-6 mb-2">
        <label for="firstName" class="form-label fw-bold">First name</label>
        <input type="text" class="form-control" name="firstname" id="firstName"  value="<?php echo $row['first_name'];?>" readonly>
    </div>

    <div class="col-sm-6">
        <label for="lastName" class="form-label fw-bold">Last name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['last_name'];?>"  readonly>
    </div>

    <div class="col-12">
        <label for="email" class="form-label fw-bold">Email</label>
        <input type="email" class="form-control" name="email" id="email"  value="<?php echo $row['email'];?>" readonly placeholder="Enter your email">
    </div>
    </div>

    <hr class="my-4">

    <div class="text-center mb-2">
        <button class="mb-2 mt-2 btn btn-success btn-lg btn-block"  type="submit">Submit Feedback</button>        
    </div>
    </div>               
</div>
</form>

</body>
</html>