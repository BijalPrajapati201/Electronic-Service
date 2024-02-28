<?php

include_once("database.php");
session_start();
if(!isset($_SESSION['cus_id'])){
  header("location: login.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">
    <title>All Order</title>
</head>
<body class="bg-secondary">
<div class="navigation">
    <nav class="navbar navbar-expand-lg  navbar-light bg-white p-fixed ">
    <div class="back-to-shop pl-5">
        <a class="text-decoration-none m-2 d-flex " href="service.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-arrow-left text-muted " viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
                <span class="fw-bold text-muted fs-5">Back to shop
            </span>
        </a>
    </div>
    </nav>
</div>
<div class='row p-5 mx-0 '>
    <?php

include('./function.php');

$cus_id = $_SESSION['cus_id'];
// echo $cus_id;
// exit;
$sql = "select * from `order_details` o1 INNER join `service master` s1 on o1.ser_id=s1.ser_id inner join `order master` o2 on o1.ord_id=o2.ord_id inner join `payment master` p1 on o1.ord_id=p1.ord_id WHERE o2.cus_id='$cus_id'";
// echo $sql;
// exit;
$result = $conn->query($sql);


if(!$result){
    die("invalid query : " . $conn);
}

while($row = $result->fetch_assoc()){
    // $serviceData = getServiceDetails($row['ser_id']);
    $cusName = getCusName($row['cus_id']);
echo "

    <div class='card m-4 '  style='width: 25rem;'>
    <div class='card-body'>
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
    <label class='fw-bold fs-5' for='price'>Order Status</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[ord_status]</p>
    <hr>
    <label class='fw-bold fs-5' for='price'>Order Date</label>
    <p class='mb-2 fs-5' name='ord_status'>$row[date]</p>
    <hr>
    <a href='cancelservice.php' class='btn btn-outline-primary'>Cancel Service</a>
    </div>
    </div>

";
}
// unset($_SESSION);
?>
</div>

</body>
</html>