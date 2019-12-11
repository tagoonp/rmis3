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
$id_rs = '';

if($query){

  $row = mysqli_fetch_assoc($query);
  $ep = $row['ep'];
  $newep = intval($ep) + 1;
  $lastStatus = $row['id_status_research'];
  $id_rs = $row['id_rs'];

}else{
  mysqli_close($conn);
  die();
}

$strSQL = "UPDATE research SET draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";

if($lastStatus != 1){

  if($lastStatus == 2){
    $strSQL = "UPDATE research SET ep = '$newep', id_status_research = '1', draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
    $query = mysqli_query($conn, $strSQL);
  }

  if($lastStatus == 20){

    $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    $strSQL3 = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
              VALUES ('ผู้วิจัยส่งโครงการวิจัยฉบับแก้ไขหลังได้รับข้อเสนอแนะ' , '', '$id_rs', '".date('Y-m-d H:i:s')."',  '0')";
    mysqli_query($conn, $strSQL3);
    // echo $strSQL3;

    $strSQL = "UPDATE research SET id_status_research = '21', draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
    mysqli_query($conn, $strSQL);

    // Set note
    $strSQLNote = "SELECT id FROM useraccount WHERE id_pm = '$id_pm' AND delete_status = '0' AND allow_status = '1'";
    $resultNote = mysqli_query($conn, $strSQLNote);
    $rowNote = mysqli_fetch_assoc($resultNote);
    $user_id = $rowNote['id'];

    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', 'นักวิจัยปรับปรุงข้อมูลข้อมูลโครงการตามข้อเสนอแนะ/อัพโหลดเอกสารเพิ่มเติม', '$ip_add', '$date', '$id_rs', 'pi', '$user_id')";
    $result = mysqli_query($conn, $strSQL);
    // End set note



    $strSQL = "SELECT * FROM research_init_rw_comment WHERE  riwc_id_rs = '$id_rs' ";
    $qr = mysqli_query($conn, $strSQL);
    if($qr){
      $nr = mysqli_num_rows($qr);
      if($nr > 0){
        $strSQL = "UPDATE research_init_rw_comment SET riwc_status = '3' WHERE riwc_id_rs = '$id_rs' ";
        mysqli_query($conn, $strSQL);

        // $strSQL = "UPDATE research SET id_status_research = '28', draft_status = '0' WHERE session_id = '$sess_id' AND id_pm = '$id_pm'";
        // mysqli_query($conn, $strSQL);

        $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
        mysqli_query($conn, $strSQL);

        $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
                  VALUES ('ผู้วิจัยส่งเอกสารหลังแก้ไขตามข้อคำถาม/ข้อเสนอแนะ' , '(ระบบ) ผู้วิจัยส่งเอกสารหลังแก้ไขตามข้อคำถาม/ข้อเสนอแนะ', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
        $q = mysqli_query($conn, $strSQL);
        if(!$q){
          // echo $strSQL;
        }else{
          // echo "string";
        }

      }
    }

    $strSQL = "SELECT MAX(rav_version_id) mra FROM research_approve_version WHERE rav_id_rs = '$id_rs'";
    if($q2 = mysqli_query($conn, $strSQL)){
      $rf = mysqli_fetch_assoc($q2);
      $nver = intval($rf['mra']) + 1;

      $strSQL = "INSERT INTO research_approve_version (rav_id_rs, rav_version_id, rav_update_date )
                 VALUES ('$id_rs', '$nver', '".date('Y-m-d H:i:s')."')";
      mysqli_query($conn, $strSQL);
    }else{
      $strSQL = "INSERT INTO research_approve_version (rav_id_rs, rav_version_id, rav_update_date )
                 VALUES ('$id_rs', '2', '".date('Y-m-d H:i:s')."')";
      mysqli_query($conn, $strSQL);
    }

  }else{
    // Set note
    $strSQLNote = "SELECT id FROM useraccount WHERE id_pm = '$id_pm' AND delete_status = '0' AND allow_status = '1'";
    $resultNote = mysqli_query($conn, $strSQLNote);
    $rowNote = mysqli_fetch_assoc($resultNote);
    $user_id = $rowNote['id'];

    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', 'นักวิจัยปรับปรุงข้อมูลข้อมูลโครงการตามข้อเสนอแนะ/อัพโหลดเอกสารเพิ่มเติม', '$ip_add', '$date', '$id_rs', 'pi', '$user_id')";
    $result = mysqli_query($conn, $strSQL);
    // End set note
  }

}else{
  $query = mysqli_query($conn, $strSQL);
}


if($query){
  echo "Y";
}else{
  echo "N";
  // echo $strSQL;
}


mysqli_close($conn);
die();

?>
