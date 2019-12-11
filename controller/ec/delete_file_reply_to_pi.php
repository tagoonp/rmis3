<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fid'])){
  mysqli_close($conn);
  die();
}




$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$fid = mysqli_real_escape_string($conn, $_POST['fid']);

$strSQL = "DELETE FROM research_file_reply_to_pi_edit WHERE rfa_id = '$fid' AND rfa_id_rs = '$id_rs' AND rfa_id_ec = '$id'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
