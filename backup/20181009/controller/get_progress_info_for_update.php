<?php
include "config.class.php";

$return = [];

if(!isset($_POST['rp_id'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$rp_id = mysqli_real_escape_string($conn, $_POST['rp_id']);

$strSQL = "SELECT * FROM rec_progress WHERE rp_id = '$rp_id'";
if($query = mysqli_query($conn, $strSQL)){
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
