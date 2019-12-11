<?php
include "../config.class.php";

if((!isset($_POST['doctype'])) || (!isset($_POST['session_id']))){
  mysqli_close($conn);
  die();
}


$dc = mysqli_real_escape_string($conn, $_POST['doctype']);
$sid = mysqli_real_escape_string($conn, $_POST['session_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['id_reviewer']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT * FROM file_research_attached
          WHERE
            f_group = '$dc'
            AND (f_session_id = '$sid' OR f_rs_id = '$id_rs') AND fid IN (SELECT frr_fid FROM file_reviewer_review WHERE frr_finish = 'N' AND frr_id_reviewer = '$id_reviewer' AND frr_id_rs = '$id_rs')
            ORDER BY f_name ASC";
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
