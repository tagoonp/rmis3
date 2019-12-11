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


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          WHERE a.id_rs = '$id_rs' ";


if($query = mysqli_query($conn, $strSQL)){

  $row = mysqli_fetch_assoc($query);
  $pi_od = '';

  $buffer = [];
  $buffer['fullname'] = $row['prefix_name'].$row['fname']." ".$row['lname'];
  $buffer['email'] = $row['email'];
  $pi_od = $row['id'];

  $strSQL = "UPDATE research SET id_status_research = '20' WHERE id_rs = '$id_rs'";
  $query2 = mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = 1 WHERE rwp_id_rs =  '$id_rs'";
  $query2 = mysqli_query($conn, $strSQL);

  if($query2){
    $buffer['status'] = 'Y';
  }else{
    $buffer['status'] = 'N';
  }

  $buffer['rec_id'] = $row['code_apdu'];

  $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('required_more_documents', 'EC ขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณา', '".date('Y-m-d H:i:s')."', '".$row['id']."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_incorrect', '$msg', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '$msg', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
             VALUES ('".date('Y-m-d H:i:s')."', '$id_rs', 'staff', 'pi', '$id', '$pi_od', 'เจ้าหน้าที่ผู้วิจัยเพื่อขอเอกสารเพิ่มเติม')";
  mysqli_query($conn, $strSQL);


  $return[] = $buffer;


}else{
  mysqli_close($conn);
  die();
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
