<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$asses_1 = '';
$asses_2 = '';
$asses_3 = '';
$asses_4 = '';

if(isset($_POST['asses_1'])){
  $asses_1 = mysqli_real_escape_string($conn, $_POST['asses_1']);
}

if(isset($_POST['asses_2'])){
  $asses_2 = mysqli_real_escape_string($conn, $_POST['asses_2']);
}

if(isset($_POST['asses_3'])){
  $asses_3 = mysqli_real_escape_string($conn, $_POST['asses_3']);
}

if(isset($_POST['asses_4'])){
  $asses_4 = mysqli_real_escape_string($conn, $_POST['asses_4']);
}

$strSQL = "DELETE FROM assessment_survey WHERE asq_id_rs = '$id_rs' AND  asq_id_rw = '$id'";
mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO assessment_survey (asq_1, asq_2, asq_3, asq_4, asq_id_rs, asq_id_rw, asq_datetime) VALUES ('$asses_1','$asses_2','$asses_3','$asses_4','$id_rs','$id', '$date')";
mysqli_query($conn, $strSQL);

mysqli_close($conn);
die();

?>
