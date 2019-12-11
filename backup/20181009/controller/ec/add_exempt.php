<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$rtype = 'Exempt';
$content = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "INSERT INTO research_consider_type (rct_type, rct_datetime, rct_conf, rct_id_rs, rct_by)
          VALUES ('$rtype', '".date('Y-m-d H:i:s')."', '1', '$id_rs', '$id')";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "UPDATE research SET id_status_research = '14' WHERE id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('แจ้งดำเนินการต่อจากเลขา ec ถึงเจ้าหน้าที่ให้ออกใบรับทราบ', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait for acknowledge', 'เลขาส่งเจ้าหน้าที่เพื่อดำเนินการออกใบรับทราบ', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] ส่งต่อเจ้าหน้าที่เพื่อดำเนินการออกใบรับทราบ</p>".$content."', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);


}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
