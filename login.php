<?php  
$login= false;
$messageError= false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    
        $sql = "SELECT * FROM `customer` WHERE email = '$email' AND password = '$password'";
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
        }else if(isset($row) && $row['user_role'] == 'electrician' ){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['cus_id'] = $row["cus_id"];
            $_SESSION['user_role'] = $row["user_role"];
            $_SESSION['city'] = $row['city'];

          header("location: electrician.php");
        }
        else
        {
            $messageError = "Invalid password";
        }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="styles/loginstyle.css" type="text/css" />

  <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">


  </head>
  <body class="lbgcolor">
    <?php require "navbar.php" ?>
    <?php
    if($login){
    echo  '<div class="alert my-2 text-white bg-dark alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your are login 
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    
   if($messageError){
    echo  '<div class="my-2 alert text-white bg-dark alert-dismissible " role="alert">
    <strong>messageError!Password is incorrect</strong> 
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
?>

<section class="Form my-4 mx-5">
  <div class="container mt-5">
  <div id="spinner"
      class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-light" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only"></span>
      </div>
  </div>
<div class="row gx-0">
        <div class="col-lg-5">
            <img src="styles/loginbg.jfif" class="img-fluid h-100" alt="hello">
        </div>
        
    <div class="col-lg-7 justify-content-center">
        <!-- <h1 class="text-center m-2">Login to our website</h1> -->
        <br>
    <form action="login.php" method="POST" name="myForm" class="content">
        <div class="form-row mb-3">
        <div class="col-lg-8 ">
        <label for="email" class="form-label m-0">Email </label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email" autocomplete="off" aria-describedby="emailHelp">
        </div>
        </div>

        <div class="form-row mb-1">
        <div class="col-lg-8 mb-4">
        <label for="password" class="form-label m-0">Password</label>
        <input type="password" class="form-control " id="password" name="password" placeholder="Enter your password">
        </div>
        </div>

        <div class="button ">
        <button type="submit" class="btn1" >Login</button>
        </div>
      <hr>
      <span class="fw-bold">Don't have an account? <a class="text-decoration-none" href="signup.php">Registration Now!</a></span>

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
      //spinner
        var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
                }
            }, 500);
        };
        spinner();
        
        //refresh the page
         if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }

    $(document).ready(function() {
           $("form[name='myForm']").validate({
    // Specify validation rules
    rules: {
    email: {
        required: true,
        email: true
      },
        password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation messageError messages
    messages: {
    password: {
        required: "Please enter a password",
        minlength: "Your password must be at least 5 characters long"
    },
    email: "Please enter a valid email address"
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});


</script>
</body>
</html>





