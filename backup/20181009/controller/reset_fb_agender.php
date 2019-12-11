<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) > 0){

    $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_status = '0' WHERE rafa_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    $strSQL = "UPDATE research_init_rw_comment SET riwc_ustatus = '0' WHERE riwc_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    echo "Y";

  }else{
    echo "N";
  }
}else{
  echo "N";
}

$strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เจ้าหน้าที่ยกเลิกวาระการประชุมเดิม</p>', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
mysqli_query($conn, $strSQL);

mysqli_close($conn);
die();
?>
