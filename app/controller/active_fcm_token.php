<?php
include "config.class.php";

if(!isset($_POST['token_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if($token_id == ''){
  mysqli_close($conn);
  die();
}

$token_id = mysqli_real_escape_string($conn, $_POST['token_id']);
$id = mysqli_real_escape_string($conn, $_POST['id']);

$strSQL = "SELECT * FROM fcm_token WHERE fcm_token = '$token_id'";
$query = mysqli_query($conn, $strSQL);

if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow == 0){
    $strSQL = "INSERT INTO fcm_token (fcm_token, fcm_uid, fcm_regdate, fcm_regip, active) VALUES ('$token_id', '$id', '$sys_datetime', '$ip', '1')";
    mysqli_query($conn, $strSQL);
  }else{
    $strSQL = "UPDATE fcm_token SET fcm_status = '0', active = '0' WHERE fcm_token = '$token_id'";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO fcm_token (fcm_token, fcm_uid, fcm_regdate, fcm_regip, active) VALUES ('$token_id', '$id', '$sys_datetime', '$ip', '1')";
    mysqli_query($conn, $strSQL);
  }
}

mysqli_close($conn);
die();
