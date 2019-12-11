<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
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

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);

$strSQL = "UPDATE comment_mta SET cmta_use_status = '0' WHERE cmta_id_rs = '$id_rs' AND cmta_uby = '$id_reviewer' AND cmta_id = '$id'";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";
}else{
  echo $strSQL;
}
mysqli_close($conn);
die();

?>
