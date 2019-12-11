<?php
include "config.class.php";

$return = [];

if(!isset($_POST['id_rs'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
if(mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}




mysqli_close($conn);
die();
