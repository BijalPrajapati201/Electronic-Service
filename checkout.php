<?php
session_start();

require 'config.php';
require 'vendor/autoload.php';
use Razorpay\Api\Api;

if(!empty($_POST['amount'])){
    $cus_id = $_POST['cus_id'];
    $email = $_POST['email'];
    $amount = $_POST['amount']*'100';

    $_SESSION['cus_id'] = $cus_id;
    $_SESSION['email'] = $email;
    $_SESSION['ord_id'] = $amount;  

    if($_POST['colorRadio'] != 'red') {
        $api = new Api(API_KEY, API_SECRET);
        $res = $api->order->create(
            array(
                'receipt' => '123',
                'amount' => $amount,
                'currency' => 'INR',
                'notes' => array('key' => 'value3', 'key2' => 'value2')
            )
        );
   
   
        if(!empty($res['id'])) {
            $_SESSION['ord_id'] = $res['id'];
        ?>

            <form action="<?php echo BASE_URL?>success.php" method="post"> 
                <script
                    src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="<?php echo API_KEY; ?>";
                    data-amount="<?php echo $amount; ?>"
                    data-currency="INR"
                    data-ord_id ="<?php echo $res['id']; ?>"
                    data-buttontext = "Pay <?php echo $amount; ?> with Razorpay" 
                    data-name = "<?php echo COMPANY_NAME; ?>"
                    data-description= "Company Description"
                    data-image="<?php echo COMPANY_LOGO_URL;?>"
                    data-prefill.name="<?php echo $name; ?>"
                    data-prefill.email="<?php echo $email; ?>"
                    data-theme.color="#3fb0a7">
                    
                </script>
                <input type="hidden" custom="Hidden Element" name="hidden" />
            </form>
            
    <?php
            }
        } else {
        header("location: success.php");
    }
} 
?>