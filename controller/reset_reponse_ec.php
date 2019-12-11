<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$sysdate = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
$id_ec = mysqli_real_escape_string($conn, $_POST['id_ec']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$role = mysqli_real_escape_string($conn, $_POST['role']);
$next_stage = mysqli_real_escape_string($conn, $_POST['next_stage']);

$strSQL = "UPDATE research SET id_ec = '$id_ec' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  if($next_stage == '3'){
    $strSQL = "UPDATE research SET id_status_research = '1' WHERE id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);
  }

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>แก้ไขเลขาผู้รหับผิดชอบโครงการ</p>$message', '$log_ip', '$sysdate', '$id_rs', '$role', '$id')";
  $result = mysqli_query($conn, $strSQL);

  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();
?>
