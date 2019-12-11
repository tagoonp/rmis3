<?php
include "config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$return = [];

$return = base64_encode($log_ip.date('Y-m-d-H-i-s'));

echo $return;
mysqli_close($conn);
die();


?>
