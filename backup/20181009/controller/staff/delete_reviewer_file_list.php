<?php
include "../config.class.php";

if(!isset($_POST['rif_id'])){
  mysqli_close($conn);
  die();
}




$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$ririd = mysqli_real_escape_string($conn, $_POST['rif_id']);

$strSQL = "DELETE FROM research_init_reviewer_file_attached WHERE rif_id = '$ririd'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
