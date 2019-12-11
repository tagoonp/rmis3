<?php
include "config.class.php";

// if(!isset($_POST['part_id'])){
//   mysqli_close($conn);
//   die();
// }

if(!isset($_POST['r_id'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

// $id_part = mysqli_real_escape_string($conn, $_POST['part_id']);
// $id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$rid = mysqli_real_escape_string($conn, $_POST['r_id']);

$strSQL = "SELECT * FROM research_init_rw_comment WHERE riwc_id = '$rid'";
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
// echo json_encode($strSQL);
mysqli_close($conn);
die();


?>
