<?php
include "config.class.php";

$return = [];

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fid'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])) {
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$fid = mysqli_real_escape_string($conn, $_POST['fid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$datetime = date('Y-m-d H:i:s');

$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);

if($result){

  $strSQL = "DELETE FROM file_research_attached WHERE fid = '$fid' ";
  mysqli_query($conn, $strSQL);

  // echo $strSQL;

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by )
            VALUES ('เจ้าหน้าที่ลบไฟล์โครงการวิจัย รหัสลงทะเบียน $id_rs', 'เจ้าหน้าที่ลบไฟล์โครงการวิจัย รหัสลงทะเบียน $id_rs', '$datetime', '$id_rs', 'Staff : ".$id."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_countrange, log_by_id )
  VALUES ('Add note', '<p>[System] เจ้าหน้าที่ลบไฟล์โครงการวิจัย รหัสลงทะเบียน -> $id_rs </p>', '$log_ip', '$datetime', '$id_rs', 'staff', '0', '$id')";
  mysqli_query($conn, $strSQL);

  echo "Y";

}else{
  echo "N";
}

mysqli_close($conn);
die();
