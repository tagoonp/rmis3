<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$rir_id = mysqli_real_escape_string($conn, $_POST['rir_id']);
$msg_send = mysqli_real_escape_string($conn, $_POST['msg_send']);

$strSQL = "SELECT * FROM research_init_reviewer WHERE rir_id = '$rir_id'";
if($query = mysqli_query($conn, $strSQL)){
  $row = mysqli_fetch_assoc($query);

  $strSQL = "UPDATE research SET id_status_research = '5' WHERE id_rs = '".$row['rir_id_rs']."'";
  mysqli_query($conn, $strSQL);

  $notify_date = date('Y-m-d', strtotime($date .' +2 day'));
  $expire_date = date('Y-m-d', strtotime($date .' +14 day'));

  $strSQL = "UPDATE research_init_reviewer
            SET
            rw_sending_status = '1',
            rw_sendding_msg = '$msg_send',
            rw_sending_datetime = '".date('Y-m-d H:i:s')."',
            rw_sending_notify_date = '$notify_date',
            rw_sending_expire_date = '$expire_date',
            rw_sending_by = '$id'
            WHERE rir_id = '$rir_id'";
  mysqli_query($conn, $strSQL);

  echo "Y";

}else{
  echo $strSQL;
}

mysqli_close($conn);
die();

?>
