<?php
include "config.class.php";

if(!isset($_POST['email'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['pid'])){
  mysqli_close($conn);
  die();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$per_id = mysqli_real_escape_string($conn, $_POST['pid']);
$sid = mysqli_real_escape_string($conn, $_POST['sid']);
$date = date("Y-m-d H:i:s");

$strSQL = "UPDATE useraccount SET SID = '$sid' WHERE email = '$email' AND id_pm = '$per_id'";
mysqli_query($conn, $strSQL);

mysqli_close($conn);
die();

?>
