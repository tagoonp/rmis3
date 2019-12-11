<?php
include "config.class.php";

if(!isset($_POST['copi_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ratio'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['pm_ratio'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}




$log_ip = $_SERVER['REMOTE_ADDR'];
$return = [];
$copi_id = mysqli_real_escape_string($conn, $_POST['copi_id']);
$id_session = mysqli_real_escape_string($conn, $_POST['sess_id']);
$ratio = mysqli_real_escape_string($conn, $_POST['ratio']);
$pm_ratio = mysqli_real_escape_string($conn, $_POST['pm_ratio']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "DELETE FROM  pm_team WHERE copi_id = '$copi_id'";
$query = mysqli_query($conn, $strSQL);

$remain = $ratio + $pm_ratio;

$strSQL = "UPDATE research SET rate_pm = '$remain' WHERE id_rs = '$id_rs'";
mysqli_query($conn, $strSQL);


mysqli_close($conn);
die();


?>
