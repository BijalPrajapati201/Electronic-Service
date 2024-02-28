
<?php
$messages = false;
$login = false;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include 'database.php';
    $name = $_POST['name'];
 	  $email = $_POST['email'];
  	$password = $_POST['password'];
 	  $mobileno = $_POST['mobileno'];
    
        $sql = "Select * from admin where email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql); //connection result
        $num = mysqli_num_rows($result);

        if ($num == 1){
            session_start();
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header("location: ./admindash/index.php");

        }
        else
        {   
            echo "<center>Invalid Password </center>";
        }
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>admin</title>

  <link rel = "icon" href = "styles/headlogo.png" type = "image/x-icon">

	<link rel="stylesheet" type="text/css" href="styles/adminstyle.css">
</head>
<body>

<form method="POST" name="admin">
<div class="container">
<h1 class="admin">Admin Login</h1>

	<div class="inputs">
		<div class="field">
			<label>Name  </label>
			<input type="text" name="name" autocomplete="off" />
		</div>
    
	
		<div class="field">
			<label>Email</label>
			<input type="text" name="email" autocomplete="off" />
		</div>
	
		<div class="field">
			<label>Password</label>
			<input type="text" name="password" autocomplete="off" />
		</div>
		
		<div class="field">
			<label>Mobileno</label>
			<input type="number" name="mobileno" autocomplete="off" />
		</div>
	
	<input type="submit" class="submit" name="Submit">

	</div>
</div>
</form>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>

	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }

        $(document).ready(function() {
           $("form[name='admin']").validate({

    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side

    name: "required",
    mobileno: {
        required: true,
        minlength: 10
      },
   		email: {
        required: true,
        email: true
      },
        password: {
        required: true,
        minlength: 5
      }

  },
    // Specify validation error messages
    messages: {
    name: "*Please Enter Your Name",
    mobileno: {
        required: "*Please Enter a mobile Number",
        minlength: "Your password must be 10 char long"
    },
    password: {
        required: "*Please Enter a Password",
        minlength: "*Your password must be at least 5 characters long"
    },
    email: "*Please enter a valid Email address"
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
