<?php
include "../config.class.php";

if(!isset($_POST['id'])){
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

$strSQL = "SELECT * FROM research WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
$query = mysqli_query($conn, $strSQL);
$ep = '';
$newep = '';
$lastStatus = '1';

if($query){

  $row = mysqli_fetch_assoc($query);
  $ep = $row['ep'];
  $newep = intval($ep) + 1;
  $lastStatus = $row['id_status_research'];

}else{
  mysqli_close($conn);
  die();
}

$strSQL = "UPDATE research SET draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
if($lastStatus != 1){
  if($lastStatus == 2){

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

      $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', 'นักวิจัยปรับปรุงข้อมูลโครงการวิจัยในขั้นตอนตรวจสอบความถูกต้องของเอกสาร', '$log_ip', '$sysdate', '$id_rs', 'pi', '$user_id')";
      $result = mysqli_query($conn, $strSQL);

      $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
                 VALUES ('$sysdate', '$id_rs', 'pi', 'staff', '$user_id', '1037', 'นักวิจัยปรับปรุงข้อมูลโครงการวิจัยในขั้นตอนตรวจสอบความถูกต้องของเอกสาร')";
      mysqli_query($conn, $strSQL);

    }

    $strSQL = "UPDATE research SET ep = '$newep', id_status_research = '1', draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
    mysqli_query($conn, $strSQL);

    $strSQL = "UPDATE file_research_attached SET f_allow_delete   = '0', f_rs_id = '$id_rs' WHERE f_session_id = '$sess_id'";
    mysqli_query($conn, $strSQL);
  }
}else{


}

$query = mysqli_query($conn, $strSQL);
if($query){

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('PM confirm research record', 'ผู้วิจัยบันทึกเป็นโครงการวิจัยฉบับจริง', '$date', '0', '$sess_id', 'PM : ".$id_pm."')";
  mysqli_query($conn, $strSQL);

  echo "Y";
}else{
  echo "N";
  // echo $strSQL;
}


mysqli_close($conn);
die();

?>
