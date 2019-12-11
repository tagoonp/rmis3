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



$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "UPDATE research_init_reviewer SET rw_reply_status = '1', rw_reply_datetime = '".date('Y-m-d H:i:s')."' WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
