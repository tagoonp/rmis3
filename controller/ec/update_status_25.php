<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$content = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "UPDATE research SET id_status_research = '25' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  echo "Y";

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('ส่งเจ้าหน้าที่เพื่อจัดพิมพ์ใบรับทราบและส่งประธานลงนาม' , '$content', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  // if(!$query){
  //   echo $strSQL;
  //   die();
  // }

  $strSQL = "INSERT INTO research_file_approve_document (rfad_id_rs, rfad_doc_content, rfad_doctype, rfad_status, rfad_upload_datetime, rfad_upload_by)
            VALUES ('$id_rs', '$content', 'COA', 'checked', '".date('Y-m-d H:i:s')."', '$id')
            ";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Wait for sign in COA', '$content', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);
}

mysqli_close($conn);
die();

?>
