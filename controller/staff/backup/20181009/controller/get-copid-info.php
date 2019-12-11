<?php
include "config.class.php";

if(!isset($_POST['copid'])){
  mysqli_close($conn);
  die();
}

$copid = mysqli_real_escape_string($conn, $_POST['copid']);

$return = [];

$strSQL = "SELECT * FROM pm_team
           WHERE copi_id = '$copid'";
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
