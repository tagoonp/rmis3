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
          WHERE a.id_rs = '$id_rs' ";


if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "UPDATE research SET id_status_research = '27' WHERE id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);



  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_correct', 'เจ้าหน้าที่ส่งกลับเลขา EC เพื่อดำเนินการเลือกผู้เชี่ยวชาญอิสระใหม่/เพิ่มเติม', '$date', '$id_rs', 'Staff : ".$id."')";


  if($msg != ''){
    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_correct', '$msg', '$date', '$id_rs', 'Staff : ".$id."')";
  }

  mysqli_query($conn, $strSQL);

  echo "Y";
  mysqli_close($conn);
  die();

}else{
  echo "N";
  mysqli_close($conn);
  die();
}




?>
