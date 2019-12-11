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

$info = 'ไม่ระบุ';

if(isset($_POST['info'])){
  $info = $_POST['info'];
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);


$strSQL = "UPDATE research SET id_status_research = '26', delete_flag = 'Y' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";
  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Withdraw research', 'ผู้วิจัยขอถอนโครงการด้วยตนเอง', '$date', '0', '$id_rs', 'PM : ".$id."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] นักวิจัยขอถอนโครงการ</p>เหตุผล : $info', '$ip_add', '$date', '$id_rs', 'PM', '$id')";
  mysqli_query($conn, $strSQL);

}else{
  echo "N";
}



mysqli_close($conn);
die();

?>
