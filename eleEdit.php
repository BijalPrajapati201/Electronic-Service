
<?php
session_start();
include 'database.php';
include('function.php');

//variables
// $ord_id="";
$cus_id ="";
$ser_id = "";
$ord_address = "";
$cus_mobile_no = "";
$ord_status = "";
$pinno = "";
$serviceData = "";
$serviceCus="";
$ser_name ="";


$errorMessage = "";
$successMessage = "";

// $ord_id = $_SESSION["insert_ord_Id"];

if ($_SERVER ['REQUEST_METHOD'] == 'GET'){
  // GET METHOD : show the data of the client
  $ord_id = $_SESSION['insert_ord_id'];

    if(!isset($_GET["ord_id"])){
        header("location: order.php");
        exit;
    }


    // read the row of the selected client from database table
    $sql = "select * from `order_details` o1 INNER join `service master` s1 on o1.ser_id=s1.ser_id inner join `order master` o2 on o1.ord_id=o2.ord_id inner join `payment master` p1 on o1.ord_id=p1.ord_id WHERE p1.ord_id = $ord_id";
    // echo $sql;
    
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // print_r($row);
    // exit;
    // $serviceData = getServiceDetails($row['ser_id']);
    $serviceCus = getCusName($row['cus_id']);
    
    

    // echo $serviceData['ser_name'];
    // exit;

    if(!$row){
        header("location: order.php");
        exit;
    }

    //get data from database
    $cus_id = $row['cus_id'];
    $ser_id = $row['ser_id'];
    $ord_address = $row['ord_address'];   
    $cus_mobile_no = $row['cus_mobile_no'];
    $ord_status = $row['ord_status'];
    $pinno = $row['pinno'];
    $row['ser_price'];
    $row['ser_name'];
    
}else{
    //POST METHOD: Update the data of the client

    $ord_id = $_SESSION['insert_ord_id'];
    $pinno = $_POST['pinno'];
    // $cus_mobile_no = $_POST['cus_mobile_no'];
    // $ord_address = $_POST['ord_address'];
    $ord_status = $_POST['ord_status'];
    $date = $_POST['date'];

    do {
        
        //or Update a fileds
        $sql = "UPDATE `order master`".
               "SET   ord_status = '$ord_status',  date = '$date' " . " WHERE ord_id = $ord_id";
        
               $result = $conn->query($sql);
      
        if(!$result) {
            $errorMessage = "Inavlid query " . $conn->error;
            break;
        }

        $successMessage = "<script> alert('client update correctly'); </script>";

        header("location: electrician.php");
        exit;

    } while(true);
}



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

 <link rel="stylesheet" href="../styles/ord.css" class="src">

 <link rel = "icon" href = "../styles/headlogo.png" type = "image/x-icon">

</head>
<body>

<div class="navigation">
    <nav class="navbar navbar-expand-lg  navbar-light bg-white p-fixed">
      <div class="container-fluid">
    
      <img class="m-0" style="width: 60px; height: 50px; border-radius: 20px;" src="../styles/home-service-logo.png">

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
      </div>
    </div>
    </nav>
</div>


<!-- oder information -->

<div class="container h-100 w-100 rounded shadow p-3 mb-5 mt-3 bg-body rounded ">
<div class="order-info  border border-dark rounded p-3">

  <form method="post" >
        <h3 class="mb-3 text-center">Order Details</h3>
      <div class="row g-2">
            <div class="col-12">
              <label for="firstName" class="form-label">Name</label>
              <input type="text" class="form-control" name="ser_name" id="name" placeholder="" value="<?php    echo $row['ser_name'];?>" required="">
            </div>

            <div class="form-row mb-1">
                    <div class="col-lg-7">
                    <label for="disabledSelect" class="form-label m-0">Service Status</label>
                        <select id="disabledSelect" class="form-select" name="ord_status">
                            <option>Select Option</option>
                            <option value="Pendding">Pendding</option>
                            <option value="Successfull">Successfull</option>
                            <option value="Cancel Service">Cancel Service</option>
                        </select>
                    </div>
            </div>

           
          </div>
          
            <label for="date">Select date for service</label>
            <br>
            <input type="date" id="date" name="date" required>
          
            <hr class="mb-4">
            <div class="text-center">
            <button type="submit" class="mb-3 btn btn-primary btn-lg ">Confirm</button>
            </div>

  </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

</body>
</html>