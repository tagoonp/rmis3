<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_session = mysqli_real_escape_string($conn, $_POST['sess_id']);
$content = mysqli_real_escape_string($conn, $_POST['content']);

$strSQL = "UPDATE research SET id_status_research = '24' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  // $return['status'] = 'Y';
  echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_file_approve_document (rfad_id_rs, rfad_session, rfad_doc_content, rfad_doctype, rfad_status, rfad_upload_by)
            VALUES ('$id_rs', '$id_session', '$content', 'COA', 'buffer', '$id')";
  if($query = mysqli_query($conn, $strSQL)){

  }else{
    // echo $strSQL;
  }

  // $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  // mysqli_query($conn, $strSQL);
  //
  // $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
  //           VALUES ('Wait for COA approve', '', '".date('Y-m-d H:i:s')."', '0', '$id_rs',  'Staff : $id')";
  // mysqli_query($conn, $strSQL);
  //
  // $strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_ec = b.id
  //            INNER JOIN ec d ON b.id = d.account_id
  //            INNER JOIN type_prefix e ON d.id_prefix = e.prefix_name
  //            WHERE a.id_rs = '$id_rs'
  //           ";
  // $data = '';
  // if($query = mysqli_query($conn, $strSQL)){
  //   while ($row = mysqli_fetch_array($query)) {
  //     $buf = [];
  //     foreach ($row as $key => $value) {
  //         if(!is_int($key)){
  //           $buf[$key] = $value;
  //         }
  //     }
  //     $data[] = $buf;
  //   }
  // }
  //
  // $return['data'] = $data;

}else{
  // $return['status'] = 'N';
  echo "N";
}

mysqli_close($conn);
die();

?>
