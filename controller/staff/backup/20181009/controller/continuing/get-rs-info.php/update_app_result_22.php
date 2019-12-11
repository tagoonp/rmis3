<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "UPDATE research SET id_status_research = '22' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  echo "Y";

  $r = 1;
  $strSQL = "SELECT COUNT(*) cn FROM research_approve_result_log WHERE rarl_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    $row = mysqli_fetch_array($query);
    $r = $row['cn'];
  }else{
    $strSQL = "INSERT INTO research_approve_result_log (rarl_id_rs, rarl_rould, rarl_by, rarl_status)
              VALUES ('$id_rs', '$r', '$id', 'in progress')";
    mysqli_query($conn, $strSQL);
  }

  $strSQL = "UPDATE research_file_comment SET rfc_id_rs = '22', rfc_by = '$id',  rfc_revise_round = '$r' WHERE rfc_id_rs_buff = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('ส่งเจ้าหน้าที่เพื่อออกใบรับรองต่อไปเข้าสู่กระบวนการออก COA' , '', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);
  if(!$query){
    echo $strSQL;
    die();
  }

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait for COA', '', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);
}

mysqli_close($conn);
die();

?>
