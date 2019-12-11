<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ririd'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_reviewer'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$ririd = mysqli_real_escape_string($conn, $_POST['ririd']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['id_reviewer']);


$strSQL = "UPDATE research_init_reviewer SET rw_reply_doc_mark = '1', rw_reply_doc_mark_by = '$id', rw_reply_doc_mark_datetime = '$date' WHERE rir_id = '$ririd' AND rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id_reviewer'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs' AND rwp_title = 'ผู้เชี่ยวชาญอิสระขอรับไฟล์โครงการในรูปแบบเอกสาร' AND rwp_notify_by = '$id_reviewer'";
  mysqli_query($conn, $strSQL);
}

mysqli_close($conn);
die();

?>
