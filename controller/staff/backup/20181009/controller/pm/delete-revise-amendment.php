<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$return = [];

$strSQL = "DELETE FROM progress2_revise_table WHERE p2r_id = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
