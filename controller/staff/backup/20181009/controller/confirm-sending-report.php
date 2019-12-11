<?php
include "config.class.php";

$return = [];

if(!isset($_POST['pid'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$rp_id = mysqli_real_escape_string($conn, $_POST['pid']);

$strSQL = "UPDATE rec_progress
            SET
            rp_sending_status = '1',
            rp_progress_status = '1'
            WHERE rp_id = '$rp_id'";
  if(mysqli_query($conn, $strSQL)){
    echo "Y";
    // echo $strSQL;

    $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('Confirm progress report ID : ' . $rp_id , '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
    mysqli_query($conn, $strSQL);

  }else{
    echo "N";
  }







mysqli_close($conn);
die();
