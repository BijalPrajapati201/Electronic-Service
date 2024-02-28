
<?php
//mail send when user register

function sendEmail($to,$subject,$body)
{
    require ('class.phpmailer.php');
    $from       = "me@kumistebal.web.id";
    $mail       = new PHPMailer();
    $mail->IsSMTP(true);            // use SMTP
    $mail->IsHTML(true);
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Host       = "ssl://smtp.gmail.com"; // SMTP host
    $mail->Port       =  465;                    // set the SMTP port
    $mail->Username   = "*********@gmail.com";  // SMTP  username
    $mail->Password   = "*********";  // SMTP password
    $mail->SetFrom($from, 'From Name');
    $mail->AddReplyTo($from,'From Name');
    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($email, $to);

    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent";
}    
?>