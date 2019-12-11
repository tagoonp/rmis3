<?php
include "../config.class.php";

if(!isset($_POST['key'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['progress_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$key = mysqli_real_escape_string($conn, $_POST['key']);
$user = mysqli_real_escape_string($conn, $_POST['user']);
$progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);


if($progress_id == 1){

}else if($progress_id == 2){
  $strSQL = "UPDATE rec_progress_2 SET rp2_conf = '0', rp2_status = 'withdraw' WHERE rp2_key = '$key' AND rp_2_user = '$user'";
  if($query = mysqli_query($conn, $strSQL)){
    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('PM delete amendment record key : $key ', 'ผู้วิจัยถอนรายงานแบบขอปรับปรุงโครการฉบับร่าง', '$date', '0', '$key', 'PM : ".$user."')";
    mysqli_query($conn, $strSQL);
    echo "Y";
  }else{
    echo "N";
  }
  // echo $strSQL;
}

mysqli_close($conn);
die();

?>
