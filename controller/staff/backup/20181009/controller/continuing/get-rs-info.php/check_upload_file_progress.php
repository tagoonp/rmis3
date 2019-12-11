<?php
include "../config.class.php";

if(!isset($_POST['progress_id'])){
  mysqli_close($conn);
  die();
}

$progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
$id_session = mysqli_real_escape_string($conn, $_POST['session_id']);

$return = [];
$buffer = [];

$strSQL = "SELECT * FROM file_research_progress_attached
          WHERE
            f_session_id = '$id_session' AND f_group = '$progress_id'";
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
