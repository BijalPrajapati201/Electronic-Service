<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Service Order</title>

    <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="styles/cancelservice.css"/>
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

<div class="container shadow p-3 mb-5 mt-3 bg-body rounded">
<div class="feedback-info border border-dark rounded p-3">  
            <h3 class="text-center fw-bold mb-5">Cancel service Information</h3>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label fw-bold">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="lastName" class="form-label fw-bold">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

                <div class="col-12">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="col-12">
                    <label for="address" class="form-label fw-bold">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter your address" required="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="col-12">
                    <label for="mobileno" class="form-label fw-bold">Mobile No.</label>
                    <input type="number" class="form-control" id="mobileno" placeholder="Enter your mobile Number" required="">
                    <div class="invalid-feedback">
                        Please enter your mobile no.
                    </div>
                </div>

                <div class="select-option mt-5">
                    <h6 class="mb-2 fw-bold">Do you want to cancel your order?</h6>
                    <input type="checkbox" class="form-check-input fw-bold" id="same-address">
                    <label class="form-check-label fw-bold" for="same-address">I want to cancel my order</label>
                </div>

                <div class="select-option mt-2">
                    <input type="checkbox" class="form-check-input" id="save-info">
                    <label class="form-check-label fw-bold" for="save-info">I want to refund</label>
                </div>

                <div class="select-option mt-5">
                    <h5 class="fw-bold">Reason for Cancellation</h5>
                    <textarea class="form-control" name="reason" id="reason" cols="160" rows="5"></textarea>
                </div>
                
                <div class="select-option mt-3">
                    <input type="checkbox" class="form-check-input" id="same-address">
                    <label class="form-check-label fw-bold" for="same-address">I agree to teem & conditions.</label>
                </div>

                <hr class="my-4">

                <div class="text-center">
                     <button class=" mb-3 btn btn-secondary btn-lg btn-block" type="submit">Submit</button>
                </div>
                
        </div>
    </div>         
</div>
</body>
</html>