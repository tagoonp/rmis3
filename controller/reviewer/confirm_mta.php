<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$cm_id = '';

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);

$strSQL = "UPDATE eform_mta SET efm_status = 'saved' WHERE efm_reviewer_id = '$id_reviewer' AND efm_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
