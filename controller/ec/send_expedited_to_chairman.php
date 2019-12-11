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
$ref = mysqli_real_escape_string($conn, $_POST['refNumber']);
$main_content = mysqli_real_escape_string($conn, $_POST['main_content']);
$full_content = mysqli_real_escape_string($conn, $_POST['full_content']);
$atime = mysqli_real_escape_string($conn, $_POST['mround']);
$panal = mysqli_real_escape_string($conn, $_POST['panal']);
$report_round = mysqli_real_escape_string($conn, $_POST['doc_round']);
$lang = mysqli_real_escape_string($conn, $_POST['lang']);

$strSQL = "DELETE FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs'";
mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO research_assign_fullboard_agendar (rafa_id_rs, rafa_agn, rafa_panal, rafa_add_datetime, rafa_add_by)
          VALUES ('$id_rs', '$atime', '$panal', '$date', '$id')";

if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "UPDATE research_expedited_info SET rai_status = '0' WHERE rai_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_expedited_info (rai_id_rs, rai_staff_id, rai_staff_udate, rai_staff_conf, rai_full_content, rai_main_content, rai_ref, rai_report_round, rai_lang, rai_round_meeting, rai_status)
            VALUES ('$id_rs', '$id', '$date', '1', '$full_content', '$main_content', '$ref', '$report_round', '$lang', '$atime', '1')";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research SET id_status_research = '25' WHERE id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('Wait approval from chairman', 'เลขาส่งประธานลงนามโครงการ Expedited', '$date', '$id_rs', 'EC : ".$id."')";
  mysqli_query($conn, $strSQL);

  echo "Y";
}else{

  echo "N";
}

mysqli_close($conn);
die();

?>
