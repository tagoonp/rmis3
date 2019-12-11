<?php
include "config.class.php";

if(!isset($_POST['id_team'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id_team']);
$sess = mysqli_real_escape_string($conn, $_POST['sess']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM pm_team WHERE copi_id = '$id'";
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
