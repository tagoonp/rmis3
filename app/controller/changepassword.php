<?php
include "config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['newpassword']))){
  mysqli_close($conn);
  die();
}


$id = mysqli_real_escape_string($conn, $_POST['id']);
$newpassword = mysqli_real_escape_string($conn, base64_encode($_POST['newpassword']));

$return = [];

$strSQL = "UPDATE useraccount SET password = '$newpassword' WHERE id = '$id'";
if(mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('changepassword', 'คุณได้ทำการปรับปรุงรหัสผ่าน', '".date('Y-m-d H:i:s')."', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('changepassword', '$ip', '".date('Y-m-d H:i:s')."', '$id')";
  mysqli_query($conn, $strSQL);

}else{
  echo "N";
}





die();
