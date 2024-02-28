<?php
include_once("database.php");
session_start();
if(!isset($_SESSION['cus_id'])){
	header("location: login.php");
	exit;
  }	


//code for Cart
if(!empty($_GET["action"])) {
	// print_r($_GET["code"]);
	// exit;
switch($_GET["action"]) {
	//code for adding product in cart
	
	// code for removing product from cart
	case "remove":
		// if(!empty($_SESSION["shopping_cart"])) {
		// 	foreach($_SESSION["shopping_cart"] as $k => $v) {
		// 			if($_GET["code"] == $k)
		// 				unset($_SESSION["shopping_cart"][$k]);				
		// 			if(empty($_SESSION["shopping_cart"]))
		// 				unset($_SESSION["shopping_cart"]);
		// 	}
		// }
		$cart_id = $_GET["code"] ;
		$conn->query("DELETE FROM `order cart` WHERE cart_id = $cart_id");
	break;
	// code for if cart is empty
	case "empty":
		unset($_SESSION["shopping_cart"]);
	break;	
}
}
?>
<HTML>

<HEAD>
    <TITLE> Shopping Cart</TITLE>

    <script src="show.js"></script>

    <link rel="icon" href="styles/headlogo.png" type="image/x-icon">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</HEAD>

<BODY style="background-color: #ddd;">


    <!-- Cart ---->
    <div id="shopping-cart" class="container border mt-5 rounded-4 bg-light shadow-lg ">
        <div class="txt-heading fs-4 fw-bold">Shopping Cart</div>

        <hr class="mb-3 mt-0">
        <!-- <div class="d-flex justify-content-end mb-3">
<a id="btnEmpty" class="btn btn-outline-danger" href="cart.php?action=empty">Empty Cart</a>
</div> -->
        <?php
$cus_id  = $_SESSION['cus_id'];
$data = $conn->query("SELECT * FROM `order cart` WHERE cus_id = $cus_id");	
$result = $data->fetch_all(MYSQLI_ASSOC);
$_SESSION['cartDetails'] = $result;
// print_r($_SESSION['cartDetails']);
// exit;
if(isset($result[0])){
    $total_quantity = 0;
    $total_price = 0;
?>
        <table class="tbl-cart table table-bordered " cellpadding="5" cellspacing="1">
            <tbody>
                <tr class=" bg-secondary text-white">
                    <th style="text-align:left;">Name</th>
                    <th style="text-align:right;" width="5%">Quantity</th>
                    <th style="text-align:right;" width="10%">Unit Price</th>
                    <th style="text-align:right;" width="10%">Price</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
                <?php
// echo "<pre>";	
// print_r($result);
// exit;
foreach ($result as $item){
		// print_r($_SESSION["shopping_cart"]);exit;
		$item_price = $item["qty"]*$item["price"];
		?>
                <tr class="shadow-sm  bg-body-tertiary ">
                    <td><img style="width: 5rem;" src="<?php echo "http://localhost/project/styles/$item[image]"; ?>"
                            class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["qty"]; ?></td>
                    <td style="text-align:right;"><?php echo "₹ ".$item["price"]; ?></td>
                    <td style="text-align:right;"><?php echo "₹ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["cart_id"]; ?>"
                            class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
				$total_quantity += $item["qty"];
				$total_price += ($item["price"]*$item["qty"]);
        $_SESSION['cartprice'] = $total_price;
        $_SESSION['quantity'] = $total_quantity;
        
		}

		?>

                <tr>
                    <td colspan="1" style="text-align:right">Total:</td>
                    <td style="text-align:right"><?php echo $total_quantity; ?></td>
                    <td style="text-align:right" colspan="2">
                        <strong><?php echo "₹".number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="cartend d-flex justify-content-between">
            <div class="back-to-shop"><a class="text-decoration-none" href="service.php"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg><span class="fw-bold text-muted fs-5">Back to shop</span></a></div>
            <?php
echo "
<div class='order'>
<button class='btn btn-outline-info openform' onclick='show()' >Order Now</button>
</div>
";
/* <a class='order' id='openform'><button class='btn btn-outline-info' >Order Now</button></a> */
} else {
?>
            <div class="no-records">Your Cart is Empty</div>
            <div class="back-to-shop"><a class="text-decoration-none" href="service.php"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-left text-muted" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg><span class="fw-bold text-muted fs-5">Back to shop</span></a></div>
            <?php 
}
?>
        </div>
    </div>
    <div class="container  w-100  rounded shadow p-3 mb-5 mt-3 bg-body rounded" id="formElement" style="display: none;">

        <?php
function getData($id){
	global $conn;
	$sql = "SELECT * FROM `customer` WHERE `cus_id` = $id";
	$result = $conn->query($sql);
	$data = $result->fetch_all(MYSQLI_ASSOC);
	return $data[0];
  }
  $data = getData($_SESSION['cus_id']);


?>
        <div class="order-info  border border-dark rounded p-3">

            <form method="post" action="payment.php">
                <input type='hidden' name='cus_id' id='cs_id' value="<?php echo $cus_id ?> ">
                <input type='hidden' name='total_price' id='total_price' value="<?php echo $total_price ?> ">

                <h3 class="mb-3 text-center">Billing Details</h3>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="firstName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder=""
                            value="<?php echo $data['first_name'];?>" required="">
                    </div>

                    <div class="col-12 mb-2">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="" required="">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <label for="zip" class="form-label">Mobile no</label>
                        <input type="number" class="form-control" name="mobileno" id="mobileno" placeholder=""
                            required="" value="<?php echo $data['mobileno'];?>">
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>

                    <div class="form-row mb-1">
                        <div class="col-12 mb-2">
                            <label for="disabledSelect" class="form-label m-0">City</label>
                            <select id="disabledSelect" class="form-select" name="ord_city">
                                <option value="Gandhinagar">Gandhinagar</option>
                                <option value="Kalol">Kalol</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <label for="country" class="form-label">Pin code</label>
                        <input type="number" class="form-control" name="pinno" id="pinno" placeholder="" required="">
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="country" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" id="state" placeholder="" required=""
                            value="<?php echo $data['state'];?>">
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                </div>

                <hr class="my-4">


                <label for="date">Select date for service</label>
                <br>
                <input type="date" id="date" name="date" onchange="handler(event);">

                <hr class="mb-4">
                <div class="text-center">
                    <button type="submit" name="submit_details" class="mb-3 btn btn-primary btn-lg ">Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>




</BODY>

</HTML>