<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$user = mysqli_real_escape_string($conn, $_POST['user']);

$amd_line = mysqli_real_escape_string($conn, $_POST['amd_line']);
$amd_before = mysqli_real_escape_string($conn, $_POST['amd_before']);
$amd_after = mysqli_real_escape_string($conn, $_POST['amd_after']);
$amd_reason = mysqli_real_escape_string($conn, $_POST['amd_reason']);
$amd_effect = mysqli_real_escape_string($conn, $_POST['amd_effect']);
$session_id = mysqli_real_escape_string($conn, $_POST['progess_session_id']);


$strSQL = "INSERT INTO progress2_revise_table (p2r_line, p2r_before, p2r_after, p2r_reason, p2r_effect, p2r_id_rs, p2r_session_id, p2r_datetime)
          VALUES ('$amd_line', '$amd_before', '$amd_after', '$amd_reason', '$amd_effect', '$id_rs', '$session_id', '$date')
          ";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
