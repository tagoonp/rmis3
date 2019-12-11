<?php
include "config.class.php";

if(!isset($_POST['rwid'])){
  mysqli_close($conn);
  die();
}


$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$rwid = mysqli_real_escape_string($conn, $_POST['rwid']);
$strSQL = "DELETE FROM research_init_rw_comment WHERE riwc_id = '$rwid'";
$query = mysqli_query($conn, $strSQL);

if($query){
  echo "Y";
}
else{
  echo $strSQL;
  echo "N";
}


// echo json_encode($return);
mysqli_close($conn);
die();


?>
