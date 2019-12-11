<?php
include "../config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['pm']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_pm = mysqli_real_escape_string($conn, $_POST['pm']);

$return = 0;
$buffer = [];
$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm' AND delete_flag = 'N'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $return = mysqli_num_rows($query);
  mysqli_free_result($query);
}else{
  $return = 0;
}

echo $return;
mysqli_close($conn);
die();

?>
