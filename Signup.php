<?php  
$message= false;
$messageError= false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $mobileno = $_POST["mobileno"];
    $user_role = $_POST["user_role"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $date = date('Y-m-d H:i:s');
    // $exists=false;

    // check username exitst 
    $exitstSql = "SELECT * FROM `customer` WHERE email = '$email'";
    $result = mysqli_query($conn, $exitstSql);
    $numExistRows = mysqli_num_rows ($result);
    if($numExistRows > 0){
        // $exists = true;
         $messageError = " Username is Already Exists";
    }
    else
    {
    if(($password === $cpassword)){ //if password equl to confirm password
            $sql = "INSERT INTO `customer` (`first_name`, `last_name`, `email`, `password`, `mobileno`, `state`, `city`, `dt`,`user_role`) 
            VALUES ('$firstname', '$lastname', '$email', '$password', '$mobileno', '$state', '$city', '$date', '$user_role')"; //sql query
            $result = mysqli_query($conn, $sql); //connection result
            if ($result){
                $sql = "Select * from customer where email = '$email' AND password= '$password' AND city = '$city'";

                $result = mysqli_query($conn, $sql); //connection result
                $row =  mysqli_fetch_assoc($result);
                
                if (isset($row) && $row['user_role'] == 'customer'){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['cus_id'] = $row["cus_id"];
                    $_SESSION['user_role'] = $row["user_role"];

                    header("location: welcome.php");
                    exit;
                }else if(isset($row) && $row['user_role'] == 'electrician'){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['cus_id'] = $row["cus_id"];
                    $_SESSION['city'] = $city;
                    $_SESSION['user_role'] = $row["user_role"];

                    header("location: electrician.php");
                    exit;
                    }
            } else {
                echo 'Please enter a valid Details';
            }
        }
        else
        {
            $messageError = "Password Do Not Match";
        }
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
   <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/formstyle.css"> 

    <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">
  </head>
  <body class="sbgcolor">
<?php require "navbar.php" ?>
        <?php
if($message){
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are login Successfully Now you can Login
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    
   if($messageError){
    echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!Your Password is incorrect</strong>'. $messageError.' 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    }
?>
<section class="Form my-4 mx-5">
  <div class="container mt-5">
  <!-- <div id="spinner"
                class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only"></span>
                </div>
             </div> -->
    <div class="row gx-0">
        <div class="col-lg-5">
            <img src="styles/bg3.avif" class="img-fluid h-100" alt="hello">
        </div>
        
        <div class="col-lg-7 justify-content-center">
            <!-- <h3 class="text-center mt-1">Sign Up to our web site</h3> -->
            <form id="form"  action="signup.php"  name="myForm" method="POST" class="content">
                <div class="form-row mb-1">
                    <div class="col-lg-7 ">
                        <label for="username"  class="form-label  m-0 question">First Name </label>
                        <div class=" msgError">
                     <input type="text" id="fname" autocomplete="off"  name="fname" class="form-control" placeholder="Enter Your FirstName">
                     </div>
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class=" col-lg-7">
                     <label for="username" class="form-label  m-0">Last Name </label>
                     <input type="text" name="lname" id="lname" autocomplete="off" class="form-control" placeholder="Enter Your LastName">
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                        <label for="username" class="form-label  m-0" >Email </label>
                        <input type="text" name="email" id="email" autocomplete="off" class="form-control" placeholder="Enter Your Email">
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                      <label for="password" class="form-label  m-0" id="password">Password</label>
                      <input type="password" id="password"  name="password" autocomplete="off" class="form-control" placeholder="Enter Your password">
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                      <label for="cpassword" class="form-label  m-0" id="cpassword">Confirm Password</label>
                     <input type="password" id="cpassword"  name="cpassword" autocomplete="off" class="form-control" placeholder="Confirm password">
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                      <label for="mobileno" class="form-label  m-0" id="mobileno">Mobile Number</label>
                      <input type="number" id="mobileno"  name="mobileno" autocomplete="off" class="form-control" placeholder="Enter Your mobile number">
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                    <label for="disabledSelect" class="form-label m-0">State</label>
                        <select id="disabledSelect" class="form-select" name="state">
                            <option value="Gujarat">Gujarat</option>
                        </select>
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                    <label for="disabledSelect" class="form-label m-0">City</label>
                        <select id="disabledSelect" class="form-select" name="city">
                            <option value="Gandhinagar">Gandhinagar</option>
                            <option value="Kalol">Kalol</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                        </select>
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7">
                        <label for="disabledSelect" class="form-label m-0">User-Type</label>
                        <select id="disabledSelect" class="form-select" name="user_role">
                            <option value="customer">Customer</option>
                            <option value="electrician">Electrician</option>
                        </select>
                    </div>
                </div>

                <div class="form-row mb-1">
                    <div class="col-lg-7 mt-2">
                       <button type="submit" name="register_btn" class="btn1">Sign Up</button>
                    </div>
                </div>

                <p class="link">Already have an account? <a class="text-decoration-none" href="login.php">Login Now!</a></p>
            </form>
        </div>
    </div>
  </div>
</section>


    <script src="message.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
 
<script>
    // / Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 500);
    };
    spinner();
    
    
    if ( window.history.replaceState ) { 
    window.history.replaceState( null, null, window.location.href );
    }

    $(document).ready(function() {
        $("form[name='myForm']").validate({

    rules: {
    fname: "required",
    lname: "required",
    city: "required",
    state: "required",
    mobileno: {
        required: true,
        minlength: 10,
      },
    email: {
        required: true,
        email: true
      },
        password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        minlength: 5
      }
      
    },
    messages: {
    fname: "*Please enter your Firstname",
    lname: "*Please enter your Lastname",
    state: "*Please Enter Your state",
    city: "*Please Enter your city name",
    mobileno: {
        required: "*Please Enter a mobile Number",
        minlength: "*Your password must be 10 char long"
    },
    password: {
        required: "*Please Enter a Password",
        minlength: "*Your password must be at least 5 characters long"
    },
    cpassword: {
        required: "*Please Enter a Password",
        minlength: "*Your password must be at least 5 characters long"
    },
    email: "*Please enter a valid Email address"
    },

    submitHandler: function(form) {
      form.submit();
    }
  });
});


</script>

 </body>
</html>



