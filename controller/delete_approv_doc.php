<?php
include "config.class.php";

if(!isset($_POST['doc_id'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$doc_lv = '1';

$return = [];
$doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);

$strSQL = "DELETE FROM initial_approval_document WHERE init_doc_id = '$doc_id'";
$result = mysqli_query($conn, $strSQL);

if($result){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();


?>
