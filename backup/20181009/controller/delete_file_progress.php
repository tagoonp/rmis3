<?php
include "config.class.php";

if(!isset($_POST['file_id'])){
  mysqli_close($conn);
  die();
}

$fid = mysqli_real_escape_string($conn, $_POST['file_id']);
$pid = mysqli_real_escape_string($conn, $_POST['progress_id']);

$strSQL = "DELETE FROM file_research_progress_attached WHERE fid = '$fid' AND f_group = '$pid'";
$query = mysqli_query($conn, $strSQL);

if($query){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();



?>
