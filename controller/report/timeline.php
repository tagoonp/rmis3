<?php
include "../config.class.php";

// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment; Filename=expempt-".date('Y-m-d-H-i;s').".doc");
// header("Content-Disposition: attachment; filename=expempt-".date('Y-m-d-H-i-s').".doc");

include "../config.class.php";

if(!isset($_GET['id_rs'])){
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_GET['id_rs']);

$strSQL = "SELECT * FROM log_notification H"
mysqli_close($conn);
die();


?>
