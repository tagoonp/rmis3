<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_status = mysqli_real_escape_string($conn, $_POST['id_status']);
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "UPDATE research SET id_status_research = '$id_status' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('เลขาส่งต่อเจ้าหน้าที่เพื่อดำเนินการ', '$msg', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  if(!$query){
    echo $strSQL;
    die();
  }

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait more progress', '$msg', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เลขาส่งเจ้าหน้าที่เพื่อแจ้งผลไม่รับรอง</p>$msg', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);


}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
