<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id WHERE a.id = '$id'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
  }else{
    mysqli_close($conn);
    die();
  }
}else{
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  mysqli_close($conn);
  die();
}

$strSQL = "UPDATE research SET sendding_status = 'Y' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";

  $log_ip = $_SERVER['REMOTE_ADDR'];
  $sysdate = date('Y-m-d H:i:s');

  $strSQL = "SELECT id_rs FROM research WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
  $result = mysqli_query($conn, $strSQL);
  if($result){

    $row = mysqli_fetch_assoc($result);
    $id_rs = $row['id_rs'];

    $strSQL = "SELECT id FROM useraccount WHERE id_pm = '$id_pm' AND delete_status = '0' AND allow_status = '1'";
    $result2 = mysqli_query($conn, $strSQL);
    $row2 = mysqli_fetch_assoc($result2);
    $user_id = $row2['id'];

    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', 'นักวิจัยลงทะเบียนโครงการวิจัยใหม่', '$log_ip', '$sysdate', '$id_rs', 'pi', '$user_id')";
    $result = mysqli_query($conn, $strSQL);
  }

}else{
  echo "N";
}


mysqli_close($conn);
die();

?>
