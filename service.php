<?php
session_start();
include 'database.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" href="styles/headlogo.png" type="image/x-icon">

    <link rel="stylesheet" href="styles/service.css" type="text/css" />

    <!-- icon link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



<body>

    <!-- Navbar  -->
    <div class="navigation">
        <nav class="navbar navbar-expand-lg  navbar-light bg-white p-fixed">
            <div class="container-fluid">

                <img class="m-0" style="width: 60px; height: 50px; border-radius: 20px;"
                    src="styles/home-service-logo.png">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link active" aria-current="page" href="allorder.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="logout.php">Log out</a>
                        </li>

                    </ul>
                    <form class="d-flex" role="search" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search"
                            aria-label="Search">
                        <button id="search" class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- <div id="testModel" class="modal">
  <div class="modal-content">
      <div class="modal-header">
         
      </div>
  </div>
</div> -->
    <div class="modal fad" id="exampleModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <!-- <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button> 
            </div> -->
                <div class="modal-body">

                </div>
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
            </div>

        </div>
    </div>



    <div class="main-container">

        <!-- heading -->
        <div class="title d-flex align-items-center justify-content-between mb-2">
            <div class="ti">
                <h3>Electrician</h3>
            </div>
            <div class="tle">
                <?php
        $cus_id = $_SESSION['cus_id'];
        $sql = "select * from `order cart` where cus_id = $cus_id";
        $result = mysqli_query($conn, $sql);
          if ($result)
          {
              // it return number of rows in the table.
              $row = mysqli_num_rows($result);
                
                  if ($row)
                    {
                        printf("
                        <a href='cart.php'>
                        <button type='button' class='btn btn-outline-primary text-white position-relative'>
                        More Service
                        <span class='position-absolute top-0 mt-1 start-100 fs-6 translate-middle badge rounded-pill bg-danger'>
                          $row
                          <span class='visually-hidden'>unread messages</span>
                        </span>
                      </button>
                      </a>
                      ");
                    }
              // close the result.
              mysqli_free_result($result);
          }
        ?>
            </div>
        </div>

        <div class="line"></div>

        <div class="content">
            <div class="box">
                <img src="styles/socket.jfif" alt="switch and socket">
                <p class="light">&nbsp;Switch & Socket&nbsp;</p>
            </div>
            <div class="box">
                <img src="styles/bulb.jfif" alt="bulb">
                <p class="light">Light</p>
            </div>
            <div class="box">
                <img src="styles/fan.jfif" alt="fan">
                <p class="light">Fan</p>
            </div>
            <div class="box">
                <img src="styles/wire.jpg" alt="wire">
                <p class="light">Wiring</p>
            </div>
        </div>

        <div class="line"></div>
    </div>

    <div class="flex">
        <div class="services">

            <?php

      include 'database.php';
      if(isset($_POST['search'])){
        $search_name = $_POST['search'];
        // SELECT * FROM `service master` WHERE `ser_name` LIKE '%switch%'
        $sql = "SELECT * FROM `service master` WHERE ser_available = '1' AND `ser_name` LIKE '%$search_name%'";
        // echo $sql;
        
      }else{

      $sql = "SELECT * FROM `service master` WHERE ser_available = '1' ";
      }
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc()) {
        echo "
        <div class='light-bulb'>
                <div class='left-side'>
                  <h4 id='sername' name='ser_name' value='service_name'> 
                  ".$row['ser_name']."
                  </h4>
                  <i class='fa-solid fa-star'></i><span>4.81</span>
                  <br>
                  <h6 class='my-2'>₹".$row['ser_price']."</h6>
                  <i class='fa-solid fa-tag'></i><span>₹20 off 2nd order onward</span>
                  <br>
                  <button class='modal-button openPopup' data-b s-toggle='modal' data-bs-target='#exampleModal' data-href='getcontent.php?id=".$row['ser_id']."'>View Details</button>
                  </div>
                  <div class='right-side'>
                      <img class='img' src='http://localhost/project/styles/$row[ser_img]' alt='image'>
                      <a class='order' href='ord.php?id=".$row['ser_id']."'><button class='ord' >Order</button></a>
                      <hr>
                      <div class='cart-action'>
                      <input type='text' class='bags product-quantity' id='qty_".$row['ser_id']."' min='3' max='10'  value='1' size='2' />
                      <input type='button' value='More service' class='bag btnAddAction' data-id=".$row['ser_id']." data-qty=''/>
                      </div>
                      </div>
                      </div>
                      ";
                    }
                    // <input type='hidden' name='userLog' id='userLog' value=".$_SESSION['cus_id'].">
      
      ?>

        </div>


        <div class="different-section">
            <div class="v-line"></div>
        </div>

        <div class="discount mt-3 w-25">

            <div class="offer bg-light p-3 mb-2 rounded ">
                <i class="fa-solid fa-star plus"></i>
                <span class="fw-bold m-1  text-black">HS Plus added</span>
                <br>
                <span class="text-black-50 m-4">15% saving on every order</span>
            </div>

            <div class="offer bg-light p-3 mb-2 rounded">
                <i class="fa-solid fa-tag off"></i>
                <span class="fw-bold m-1 text-black">Get 10% off</span>
                <br>
                <span class="text-black-50 m-4">On order above ₹150</span>
            </div>

            <div class="offer bg-light p-3 mb-2 rounded">
                <i class="fa-solid fa-tag off"></i>
                <span class="fw-bold m-1 text-black">5% Simple cashback up to ₹750</span>
                <br>
                <span class="text-black-50 m-4">Get up to Rs.750 cashback</span>
            </div>

            <div class="offer bg-light p-3 mb-2 rounded">
                <i class="fa-solid fa-tag off"></i>
                <span class="fw-bold m-1 text-black">Assured cashback on Paytm</span>
                <br>
                <span class="text-black-50 m-4">Upto ₹500 off</span>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.openPopup').on('click', function() {
            var dataURL = $(this).attr('data-href');
            $('.modal-body').load(dataURL, function() {
                $('#exampleModal').modal('show');
            });
        });
        $(".btnAddAction").click(function() {
            var id = $(this).attr('data-id');
            var qty = $("#qty_" + id).val();
            $.ajax('/project/addcart.php', {
                type: 'POST', // http method
                data: {
                    id: id,
                    qty: qty
                }, // data to submit
                datatype: 'html',
                success: function(data, status, xhr) {
                    location.reload('/project/cart.php')
                },
                error: function(jqXhr, textStatus, errorMessage) {
                    // $('p').append('Error' + errorMessage);
                }
            });
        });
    });
    </script>

    <script>

    </script>
</body>

</html>