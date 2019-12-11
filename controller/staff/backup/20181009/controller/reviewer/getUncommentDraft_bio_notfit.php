<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ele'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$cm_id = '';

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);
$element = mysqli_real_escape_string($conn, $_POST['ele']);

$strSQL = "SELECT * FROM eform_bio WHERE efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);

$bio_record_id = '';

if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);
    $bio_record_id = $data['efb_id'];
  }
}

if($bio_record_id != ''){
  $strSQL = "SELECT * FROM eform_bio_comment WHERE cfbc_status = '1' AND cfbc_efb_id = '$bio_record_id' AND cfbc_element = '$element'";
  if($query = mysqli_query($conn, $strSQL)){
    $data = mysqli_fetch_assoc($query);
    echo $data['cfbc_comment'];
  }
}
// echo json_encode($return);
mysqli_close($conn);
die();

?>
