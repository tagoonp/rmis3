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

if(!isset($_POST['uid'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);

$strSQL = "UPDATE funding_person SET fp_status = '0' WHERE fp_id_rs = '$id_rs'";
          mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO funding_person (fp_id_pm, fp_id_rs, fp_fullname, fp_udatetime)
           VALUES ('$id', '$id_rs', '$fname', '$date')
          ";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
