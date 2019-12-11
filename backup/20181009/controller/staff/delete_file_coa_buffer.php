<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}




$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$file_id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "DELETE FROM research_file_approve_document WHERE rfad_id = '$file_id' AND rfad_id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
