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

  $buffer = [];
  $buffer['fullname'] = $row['prefix_name'].$row['fname']." ".$row['lname'];
  $buffer['email'] = $row['email'];

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

  $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('required_more_information', 'EC ขอให้แก้ไขโครงการตามข้อเสนอแนะ', '".date('Y-m-d H:i:s')."', '".$row['id']."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('required_more_information', '$msg', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
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
