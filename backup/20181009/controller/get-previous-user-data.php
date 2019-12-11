<?php
include "config.class.php";

if(!isset($_POST['per_id'])){
  mysqli_close($conn);
  die();
}

$per_id = mysqli_real_escape_string($conn, $_POST['per_id']);
$return = [];

$strSQL = "SELECT * FROM useraccount WHERE id_pm = '$per_id' AND active_status = '1' AND delete_status = '0' AND allow_status = '1' LIMIT 1";
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
