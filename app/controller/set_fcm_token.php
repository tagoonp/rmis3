<?php
include "config.class.php";

if(!isset($_POST['token_id'])){
  mysqli_close($conn);
  die();
}

$token_id = mysqli_real_escape_string($conn, $_POST['token_id']);
$strSQL = "SELECT * FROM fcm_token WHERE active = '1' AND fcm_token = '$token_id'";
$query = mysqli_query($conn, $strSQL);

if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow == 0){
    $strSQL = "INSERT INTO fcm_token (fcm_token, fcm_regdate, fcm_regip) VALUES ('$token_id', '$sys_datetime', '$ip')";
    mysqli_query($conn, $strSQL);
    echo "Y1";
  }
}else{
  $strSQL = "INSERT INTO fcm_token (fcm_token, fcm_regdate, fcm_regip) VALUES ('$token_id', '$sys_datetime', '$ip')";
  mysqli_query($conn, $strSQL);
  echo "Y2";
}

mysqli_close($conn);
die();
