<?php

include 'database.php';
$sql = "SELECT * FROM `service master` WHERE ser_id = {$_GET['id']} ";

  $result = $conn->query($sql);

    if($row = $result->fetch_assoc()){ 
        echo "
        <button type='button' class='btn-close close' data-bs-dismiss='modal' aria-label='Close'></button>
        <div class='top'>
          <img class='img'  src='http://localhost/project/styles/$row[ser_img]' alt='socket-repair'>
      </div>
        <div class='buttom p-3 text-black'>
            <h4>
            ".$row['ser_name']."
            </h4>
            <i class='fa-solid fa-star'></i><span>4.50</span>
            <br>
            <h6 class='my-2'>₹".$row['ser_price']."</h6>
            <i class='fa-solid fa-tag'></i><span>₹30 off 2nd item onward</span>
            <hr class='my-4'>
            <h5 class='fw-bold mt-2 mb-1'>Service Detail</h5>
            <ul>
              <li>".$row['ser_des']."</li>
            </ul>
            <hr class='my-4'>";
    }else{ 
        echo 'Content not found....'; 
    } 
?>