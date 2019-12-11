<?php
include "config.class.php";

if(!isset($_POST['txtCodeBCIDRS'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['txtCodeBCIDRS']);

if (!empty($_FILES)) {

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/';  //4
  $filename = 'file-review-summary-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6

  $strSQL = "INSERT INTO research_init_reviewer_summary_file (rirsf_filename, rirsf_id_rs_buffer)
              VALUES ('$filename', '$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  // else{
  //   echo $strSQL;
  // }
}

mysqli_close($conn);
die();



?>
