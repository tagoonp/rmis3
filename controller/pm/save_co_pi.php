<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);

$prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$pct = mysqli_real_escape_string($conn, $_POST['pct']);
$repot = mysqli_real_escape_string($conn, $_POST['repot']);
$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);

$strSQL = "INSERT INTO pm_team (co_prefix, co_fname, co_lname, co_dept, co_email, co_ratio, co_job, co_sess_id, co_user_id)
          VALUES ('$prefix', '$fname', '$lname', '$dept', '$email', '$pct', '$repot', '$session_id', '$id')";
$query = mysqli_query($conn, $strSQL);
if(!$query){
  echo $strSQL;
}else{
  echo "Y";
}

mysqli_close($conn);
die();
?>
