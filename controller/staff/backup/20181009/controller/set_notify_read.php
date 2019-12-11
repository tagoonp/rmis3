<?php
include "config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['user']);

$return = [];

$strSQL = "UPDATE log_notification SET log_view = '1' WHERE user_id = '$id'";
mysqli_query($conn, $strSQL);
mysqli_close($conn);
die();
?>
