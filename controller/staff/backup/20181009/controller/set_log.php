<?php
include "config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['role'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];

$id = mysqli_real_escape_string($conn, $_POST['id']);

if($_POST['role'] == 'pm'){
  $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('signout', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('signout', 'คุณได้ทำออกจากระบบเมื่อ ".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', '$id')";
  mysqli_query($conn, $strSQL);
}




?>
