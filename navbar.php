 <?php

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true; 
  }
  else{
    $loggedin = false;
  }
  echo '
 <nav class="navbar navbar-expand-lg  navbar-light bg-white">
    <div class="container-fluid">
  
    <img class="m-0" style="width: 60px; height: 50px; border-radius: 20px;" src="styles/home-service-logo.png">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="mx-2 collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        </li>';

      if(!$loggedin){
      echo '<li class="nav-item">
          <a class="nav-link active" href="login.php">Login</a>
        </li>
         <li class="nav-item">
          <a class="nav-link active" href="signup.php">Sign Up</a>
        </li>';
      }

      if($loggedin){
      echo '<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">Help</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="logout.php">Log out</a>
        </li>';
      }

    echo '</ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search"  aria-label="Search">
        <button id="search" class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
';

  // <nav class="navbar navbar-expand-lg" style="background: linear-gradient(#43C6AC, #F8FFAE);>
?>