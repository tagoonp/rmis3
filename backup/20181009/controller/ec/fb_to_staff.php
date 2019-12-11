<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$content = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "UPDATE research SET id_status_research = '19' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";


  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('เลขาส่งต่อเจ้าหน้าที่เพื่อดำเนินการ', '$content', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  if(!$query){
    echo $strSQL;
    die();
  }

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait more document', '$content', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] ส่งต่อเจ้าหน้าที่เพื่อดำเนินการขอเอกสารเพิ่มเติม</p>".$content."', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
             VALUES ('".date('Y-m-d H:i:s')."', '$id_rs', 'ec', 'staff', '$id', '1037', 'ส่งต่อเจ้าหน้าที่เพื่อดำเนินการขอเอกสารเพิ่มเติม')";
  mysqli_query($conn, $strSQL);


}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
