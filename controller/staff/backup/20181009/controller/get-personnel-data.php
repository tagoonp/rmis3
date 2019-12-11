<?php
include "config.class.php";

if(!isset($_POST['per_id'])){
  mysqli_close($conn);
  die();
}

$per_id = mysqli_real_escape_string($conn, $_POST['per_id']);
$return = [];

$strSQL = "SELECT * FROM personnel WHERE id_per = '$per_id'";
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
