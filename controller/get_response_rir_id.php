<?php
include "config.class.php";

if(!isset($_POST['uid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs   WHERE a.rir_id_rs = '$id_rs' AND a.rir_id_reviewer = '$uid' AND a.rir_conf = '1'";

$query = mysqli_query($conn, $strSQL);
if($query){
  $row = mysqli_fetch_assoc($query);
  echo $row['rir_id'];
}

mysqli_close($conn);
die();
