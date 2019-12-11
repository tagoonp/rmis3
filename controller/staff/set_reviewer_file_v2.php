<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ririd'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['file_attached'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$ririd = mysqli_real_escape_string($conn, $_POST['ririd']);
$file_attached = $_POST['file_attached'];

$strSQL = "DELETE FROM research_init_reviewer_file_attached WHERE rif_rir_id = '$ririd'";
mysqli_query($conn, $strSQL);

foreach ($file_attached as $file_id) {
  $fid = mysqli_real_escape_string($conn, $file_id);
  $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
            VALUES ('$fid', '$ririd', '$date', '$id')
            ";
  mysqli_query($conn, $strSQL);
}

echo 'Y';
mysqli_close($conn);
die();

?>
