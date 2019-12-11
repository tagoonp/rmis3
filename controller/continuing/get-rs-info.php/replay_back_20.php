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

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['next_status'])){
  mysqli_close($conn);
  die();
}



$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$next_status = mysqli_real_escape_string($conn, $_POST['next_status']);
$info = mysqli_real_escape_string($conn, $_POST['info']);



$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id'";


if($query = mysqli_query($conn, $strSQL)){
  $rn = mysqli_num_rows($query);
  if($rn > 0){

    while ($row = mysqli_fetch_array($query)) {
      $buffer = [];
      $buffer['fullname'] = $row['prefix_name'].$row['fname']." ".$row['lname'];
      $buffer['email'] = $row['email'];
      //
      //
      $strSQL = "UPDATE research SET id_status_research = '$next_status' WHERE session_id = '$sess_id' AND id_rs = '$id_rs'";
      $query2 = mysqli_query($conn, $strSQL);
      if($query2){
        $buffer['status'] = 'Y';
      }else{
        $buffer['status'] = 'N';
      }

      if($next_status == '20'){
        $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
        mysqli_query($conn, $strSQL);

        $strSQL = "UPDATE research_init_rw_comment SET riwc_status = '2' WHERE riwc_id_rs = '$id_rs'";
        mysqli_query($conn, $strSQL);
      }

      if($next_status == '28'){
        $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
        mysqli_query($conn, $strSQL);

        // $strSQL = "UPDATE research_init_rw_comment SET riwc_status = '2' WHERE riwc_id_rs = '$id_rs'";
        // mysqli_query($conn, $strSQL);
      }

      $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('change_research_status', 'เจ้าหน้าที่ได้เพิ่มผลการตรวจสอบเอกสาร (เอกสารไม่ถูกต้อง)', '".date('Y-m-d H:i:s')."', '".$row['id']."')";
      mysqli_query($conn, $strSQL);

      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_incorrect', '$info', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
      mysqli_query($conn, $strSQL);

      $return[] = $buffer;

    }
  }


}else{
  mysqli_close($conn);
  die();
}


echo json_encode($return);
mysqli_close($conn);
die();

?>
