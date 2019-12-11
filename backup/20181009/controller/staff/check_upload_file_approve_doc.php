<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_session = mysqli_real_escape_string($conn, $_POST['id_session']);
$id_doctype = mysqli_real_escape_string($conn, $_POST['doctype']);
$id_docstatus = mysqli_real_escape_string($conn, $_POST['docstatus']);

$return = [];
$buffer = [];

$strSQL = "DELETE FROM research_file_approve_document WHERE rfad_id_rs = '$id_rs' AND rfad_upload_by IS NULL AND rfad_session != '$id_session'";
mysqli_query($conn, $strSQL);

$strSQL = "SELECT * FROM research_file_approve_document
          WHERE
            rfad_id_rs = '$id_rs' AND rfad_status = '$id_docstatus'";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
