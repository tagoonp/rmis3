<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['rir_id'])){
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
$ririd = mysqli_real_escape_string($conn, $_POST['rir_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);


$strSQL = "UPDATE research_init_reviewer SET rw_reply_status = '3', rw_reply_datetime = '$date' WHERE rir_id = '$ririd' AND rir_id_rs = '$id_rs' ";
if($query = mysqli_query($conn, $strSQL)){
  echo "Y";

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Staff update reviewer response', 'เจ้าหน้าที่ทำการปรับสถานะการพิจารณาของผู้ทรง', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'Staff : $id')";
  mysqli_query($conn, $strSQL);

}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
