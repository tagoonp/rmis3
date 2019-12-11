<?php
include "config.class.php";

$return = [];

if(!isset($_POST['rp_id'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['progress_id'])) {
  mysqli_close($conn);
  die();
}


$log_ip = $_SERVER['REMOTE_ADDR'];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$rp_id = mysqli_real_escape_string($conn, $_POST['rp_id']);
$progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);

$strSQL = "UPDATE rec_progress
            SET
            rp_delete_status = '1'
            WHERE rp_id = '$rp_id'";
  if(mysqli_query($conn, $strSQL)){
    echo "Y";

    $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('Withdraw progress report ID : ' . $rp_id . ' (Progress no. : ' . $progress_id . ')', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
    mysqli_query($conn, $strSQL);

  }else{
    echo "N";
  }









die();
