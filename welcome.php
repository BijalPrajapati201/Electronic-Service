<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)  
{
  header("location: login.php");
  exit;
}

?>


<!-- navbar  -->
<?php require "navbar.php" ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wel-Come </title>
    <!-- CSS only -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/wel.css" />
    <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">


  </head>
  <body>

  <div class="container">

    <h3 class="info">
       Electronic 
    </h3>

    <h3 class="info">
       Service
    </h3>

    <p>
    Global Electronic Services refurbishes and repairs your entire unit, and fully load tests all equipment before leaving our facility. You won't get your equipment back until we're confident it's going to work right.
    </p>

    <a href="service.php" class="select">LEARN MORE</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>