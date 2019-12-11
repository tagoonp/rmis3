<?php
include "config.class.php";

$return = [];

if(!isset($_POST['copi_id'])){
  mysqli_close($conn);
  die();
}

$copi_id = mysqli_real_escape_string($conn, $_POST['copi_id']);

$strSQL = "SELECT * FROM pm_team WHERE copi_id = '$copi_id' ";
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
