<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_session = mysqli_real_escape_string($conn, $_POST['id_session']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "DELETE FROM research_file_comment WHERE rfc_id_rs_buff = '$id_rs' AND rfc_id_rs IS NULL AND (rfc_session != '$id_session' OR rfc_session IS NULL)";
mysqli_query($conn, $strSQL);


$strSQL = "SELECT * FROM research_file_comment
          WHERE
            rfc_id_rs_buff = '$id_rs'";
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
