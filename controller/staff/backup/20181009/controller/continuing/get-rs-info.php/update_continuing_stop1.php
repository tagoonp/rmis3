<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['rp_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$user = mysqli_real_escape_string($conn, $_POST['user']);
$rp_id = mysqli_real_escape_string($conn, $_POST['rp_id']);
$info = mysqli_real_escape_string($conn, $_POST['info']);



$strSQL = "SELECT * FROM rec_progress a INNER JOIN useraccount b ON a.rp_id_pm = b.id_pm WHERE a.rp_id = '$rp_id' AND a.rp_sending_status = '1' AND a.rp_delete_status = '0'";
if($query = mysqli_query($conn, $strSQL)){

  $row = mysqli_fetch_assoc($query);

  $strSQL = "UPDATE rec_progress SET rp_progress_status = '2', rp_sending_status = '0' WHERE rp_id = '$rp_id' AND rp_delete_status = '0'";
  $query2 = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('change_continuing_status', 'เจ้าหน้าที่ได้เพิ่มผลการตรวจสอบเอกสารการรายงาน (เอกสารไม่ถูกต้อง)', '$date', '".$row['id']."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_continuing_not_correct', '$info', '$date', '".$row['rp_id_rs']."', 'Staff : ".$user."')";
  mysqli_query($conn, $strSQL);



  echo "Y";


}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
