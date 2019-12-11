<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['rirsf_id'])){
  mysqli_close($conn);
  die();
}


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$rirsf_id = mysqli_real_escape_string($conn, $_POST['rirsf_id']);

$strSQL = "DELETE FROM research_init_reviewer_summary_file WHERE rirsf_id_rs_buffer = '$id_rs' AND rirsf_id = '$rirsf_id'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
