<?php
include "../../config.class.php";

// if((!isset($_POST['sess_id'])) || (!isset($_POST['fgroup'])) || (!isset($_POST['id_rs']))){
//   mysqli_close($conn);
//   die();
// }

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$type = mysqli_real_escape_string($conn, $_POST['fgroup']);
$sid = mysqli_real_escape_string($conn, $_POST['sess_id']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT * FROM rec_progress_file_attached
          WHERE
            rpfa_session_id = '$sid'
            AND rpfa_group = '$type'";
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
