<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$sysdate = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
$id_status = mysqli_real_escape_string($conn, $_POST['id_status']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

if($id_status == '3'){
  $strSQL = "UPDATE research SET id_status_research = '3' WHERE id_rs = '$id_rs'";
  if($query = mysqli_query($conn, $strSQL)){
    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>แก้ไขสถานะโครงการวิจัยเป็น รอเสนอเลขา EC</p>$message', '$log_ip', '$sysdate', '$id_rs', '$role', '$id')";
    $result = mysqli_query($conn, $strSQL);

    // $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
    //           mysqli_query($conn, $strSQL);
    echo "Y";
  }else{
    echo "N";
  }
}else if($id_status == '6'){
  $strSQL = "UPDATE research SET id_status_research = '6' WHERE id_rs = '$id_rs'";
  if($query = mysqli_query($conn, $strSQL)){
    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>แก้ไขสถานะโครงการวิจัยเป็น รอผลพิจารณาจากเลขา EC</p>$message', '$log_ip', '$sysdate', '$id_rs', '$role', '$id')";
    $result = mysqli_query($conn, $strSQL);

    // $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
    //           mysqli_query($conn, $strSQL);

    echo "Y";
  }else{
    echo "N";
  }
}else if($id_status == '24'){
  $strSQL = "UPDATE research SET id_status_research = '24' WHERE id_rs = '$id_rs'";
  if($query = mysqli_query($conn, $strSQL)){
    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>แก้ไขสถานะโครงการวิจัยเป็น เลขาตรวจสอบใบรับรอง</p>$message', '$log_ip', '$sysdate', '$id_rs', '$role', '$id')";
    $result = mysqli_query($conn, $strSQL);

    // $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
    //           mysqli_query($conn, $strSQL);
    echo "Y";
  }else{
    echo "N";
  }
}


mysqli_close($conn);
die();
?>
