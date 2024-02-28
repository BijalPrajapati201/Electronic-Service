<?php

session_start();

session_unset(); //fizzz 
session_destroy();

header("location: login.php");



?>