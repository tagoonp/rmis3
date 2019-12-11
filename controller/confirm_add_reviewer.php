<?php
include "config.class.php";



if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}



$ip_add = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$return = [];
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id = mysqli_real_escape_string($conn, $_POST['id']);

$strSQL = "UPDATE research SET id_status_research = '4' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = 1 WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_init_reviewer SET rir_conf = 1 WHERE rir_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('เลขาส่งต่อเจ้าหน้าที่เพื่อดำเนินการ', 'เลขาส่งเพื่อดำนเนิการส่งผู้เชี่ยวชาญอิสระ', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);
  if(!$query){
    echo $strSQL;
    die();
  }

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('EC Secretory choose reviewer', 'เลขาส่งรายชื่อผู้เชี่ยวชาญอิสระเพิ่มเติม', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เลขาส่งเจ้าหน้าที่เพื่อดำเนินการส่งผู้เชียวชาญอิสระ</p>', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);


}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
