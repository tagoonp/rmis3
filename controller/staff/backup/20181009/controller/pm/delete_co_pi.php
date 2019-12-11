<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['record_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$rid = mysqli_real_escape_string($conn, $_POST['record_id']);


$strSQL = "DELETE FROM pm_team WHERE copi_id = '$rid' AND co_user_id = '$id'";
$query = mysqli_query($conn, $strSQL);
if(!$query){
  // echo $strSQL;
  echo "N";
}else{
  echo "Y";
}

mysqli_close($conn);
die();
?>
