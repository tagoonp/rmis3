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



$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "UPDATE research_init_reviewer SET rw_reply_status = '2', rw_reply_datetime = '".date('Y-m-d H:i:s')."' WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id'";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('ผู้เชี่ยวชาญอิสระขอรับไฟล์โครงการในรูปแบบเอกสาร', 'ผู้เชี่ยวชาญอิสระขอรับไฟล์โครงการในรูปแบบเอกสาร', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
