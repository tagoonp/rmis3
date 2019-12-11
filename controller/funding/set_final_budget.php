<?php
include "../config.class.php";

if(!isset($_POST['new_final'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['uid'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$new_final = mysqli_real_escape_string($conn, $_POST['new_final']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$uid = mysqli_real_escape_string($conn, $_POST['uid']);

$strSQL = "UPDATE research SET final_budget = '$new_final' WHERE id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){

  $strSQL = "UPDATE log_budget SET lb_status = '0' WHERE lb_id_rs = '$id_rs'";
            mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_budget (lb_budget, lb_by, lb_updateon, lb_id_rs)
            VALUES ('$new_final', '$uid', '$date', '$id_rs')";
            mysqli_query($conn, $strSQL)
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
