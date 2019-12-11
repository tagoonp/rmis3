<?php
include "config.class.php";

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);

$return = [];

$strSQL = "SELECT * FROM pm_team
           WHERE co_sess_id = '$sess_id'";
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
