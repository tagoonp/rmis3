<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$sess = mysqli_real_escape_string($conn, $_POST['sess']);
$content = mysqli_real_escape_string($conn, $_POST['msg']);
$rtype = mysqli_real_escape_string($conn, $_POST['rtype']);
$id_ec = mysqli_real_escape_string($conn, $_POST['id_ec']);

$strSQL = "UPDATE research SET id_status_research = '4' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";


  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('เจ้าหน้าที่ดำเนินการส่งผู้เชี่ยวชาญอิสระ', '$content', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  // $strSQL = "UPDATE "
  if(!$query){
    echo $strSQL;
    die();
  }

  $strSQL = "INSERT INTO research_consider_type (rct_type, rct_fb_ec, rct_datetime, rct_conf, rct_id_rs, rct_by)
            VALUES ('$rtype', '$id_ec', '$date', '1', '$id_rs', '$id')";

  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait for reviewer', '$content', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] ส่งต่อเจ้าหน้าที่เพื่อดำเนินการเชิญผู้เชี่ยวชาญอิสระ</p>".$content."', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);

  if(($rtype == 'Fullboard (Social)') || ($rtype == 'Fullboard (Bio)')){
    $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
               VALUES ('".date('Y-m-d H:i:s')."', '$id_rs', 'ec', 'staff', '$id', '1027', 'เลขาส่งเจ้าหน้าที่เพื่อดำเนินการส่งผู้เชี่ยงชาญอิสระ')";
    mysqli_query($conn, $strSQL);
  }else{
    $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
               VALUES ('".date('Y-m-d H:i:s')."', '$id_rs', 'ec', 'staff', '$id', '1037', 'เลขาส่งเจ้าหน้าที่เพื่อดำเนินการส่งผู้เชี่ยงชาญอิสระ')";
    mysqli_query($conn, $strSQL);
  }
  // $strSQL = "UPDATE research_init_reviewer SET rir_conf = '1' WHERE rir_id_rs = '$id_rs' AND rir_session = '$sess'";
  $strSQL = "UPDATE research_init_reviewer SET rir_conf = '1' WHERE rir_id_rs = '$id_rs' ";
  $Q = mysqli_query($conn, $strSQL);


}else{
  // echo $strSQL;
  echo "N";
}

mysqli_close($conn);
die();

?>
