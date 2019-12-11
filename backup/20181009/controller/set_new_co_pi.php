<?php
include "config.class.php";

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['last_rate_pm'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);
$prefix_th = mysqli_real_escape_string($conn, $_POST['prefix_th']);
$prefix_en = mysqli_real_escape_string($conn, $_POST['prefix_en']);
$fname_th = mysqli_real_escape_string($conn, $_POST['fname_th']);
$fname_en = mysqli_real_escape_string($conn, $_POST['fname_en']);
$lname_th = mysqli_real_escape_string($conn, $_POST['lname_th']);
$lname_en = mysqli_real_escape_string($conn, $_POST['lname_en']);
$dept_th = mysqli_real_escape_string($conn, $_POST['dept_th']);
$dept_en = mysqli_real_escape_string($conn, $_POST['dept_en']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$ratio = mysqli_real_escape_string($conn, $_POST['ratio']);
$job = mysqli_real_escape_string($conn, $_POST['job']);
$last_rate_pm = mysqli_real_escape_string($conn, $_POST['last_rate_pm']);

if(($ratio + (100 - $last_rate_pm)) > 100){
  echo "Over";
  mysqli_close($conn);
  die();
}

$remain = $last_rate_pm - $ratio;

$strSQL = "UPDATE research SET rate_pm = '$remain' WHERE id_rs = '$id_rs'";
mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO pm_team (co_prefix_approval, co_prefix_approval_en, co_fname, co_lname, co_dept, co_fname_en, co_lname_en, co_dept_en, co_email, co_ratio, co_job, co_sess_id, co_rs_id, co_user_id)
          VALUES
          (
            '$prefix_th', '$prefix_en', '$fname_th', '$lname_th', '$dept_th',
            '$fname_en', '$lname_en', '$dept_en', '$email', '$ratio', '$job', '$sess_id', '$id_rs', '$id'
          )
          ";
$result = mysqli_query($conn, $strSQL);
if($result){
  echo "Y";
}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
