<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$content = 'เลขาส่งผู้วิจัยเพื่อแก้ไขตามข้อเสนอแนะ';

if(isset($_POST['msga'])){
  if($_POST['msga'] != ''){
    $content = mysqli_real_escape_string($conn, $_POST['msga']);
  }
}




$strSQL = "UPDATE research SET id_status_research = '20' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_status, rwp_notify_by)
            VALUES ('ส่งหัวหน้าโครงการเพื่อแก้ไขตามข้อเสนอแนะ', '$content', '$id_rs', '".date('Y-m-d H:i:s')."', '1', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait update after PI edit by suggestion', '$content', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id )
            VALUES ('Add note', '<p>[System] เลขาส่ง PI เพื่อแก้ไขตามข้อเสนอแนะ</p>$content', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_init_rw_comment SET riwc_ustatus = '0', riwc_allow_edit = '0' WHERE riwc_id_rs = '$id_rs' AND riwc_status = '3'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_init_rw_comment SET riwc_status = '2' WHERE riwc_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "SELECT * FROM research_init_pi_edit_log WHERE pipe_id_rs = '$id_rs' AND pipe_status = '1'";
  if($qr2 = mysqli_query($conn, $strSQL)){

    $nr = mysqli_num_rows($qr2);

    if($nr == 0){
      $strSQL = "INSERT INTO research_init_pi_edit_log (pipe_id_rs, pipe_by, pipe_by_role, pipe_udate)
                VALUES ('$id_rs', '$id', 'EC', '$date')
                ";
      mysqli_query($conn, $strSQL);
    }else{
      $next = 1;
      $d = mysqli_fetch_assoc($qr2);
      $next = $d['pipe_round'] + 1;

      $strSQL = "UPDATE research_init_pi_edit_log SET pipe_status = '0' WHERE pipe_id_rs = '$id_rs'";
      mysqli_query($conn, $strSQL);

      $strSQL = "INSERT INTO research_init_pi_edit_log (pipe_id_rs, pipe_round, pipe_by, pipe_by_role, pipe_udate, pipe_status)
                VALUES ('$id_rs', '$next', '$id', 'EC', '$date', '1')
                ";
      mysqli_query($conn, $strSQL);
    }

  }else{
    $strSQL = "INSERT INTO research_init_pi_edit_log (pipe_id_rs, pipe_by, pipe_by_role, pipe_udate)
              VALUES ('$id_rs', '$id', 'EC', '$date')
              ";
    mysqli_query($conn, $strSQL);
  }

}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
