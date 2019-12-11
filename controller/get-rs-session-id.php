<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT session_id FROM research WHERE id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $row = mysqli_fetch_assoc($query);
  echo $row['session_id'];
}


// echo json_encode($return);
mysqli_close($conn);
die();
