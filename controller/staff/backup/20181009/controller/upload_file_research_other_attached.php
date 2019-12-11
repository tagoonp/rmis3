<?php
include "config.class.php";

if(!isset($_POST['docSess'])){
  mysqli_close($conn);
  die();
}


$doctype = mysqli_real_escape_string($conn, $_POST['docType']);
$id = mysqli_real_escape_string($conn, $_POST['docSessID']);
$sess = mysqli_real_escape_string($conn, $_POST['docSess']);
$user = mysqli_real_escape_string($conn, $_POST['docSessUser']);



if (!empty($_FILES)) {

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/';  //4
  $filename = 'file-acknowledge-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6

  $strSQL = "DELETE FROM research_file_attached WHERE upload_by = '$user' AND rf_session_id != '$sess' AND id_rs IS NULL";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_file_attached (rf_filename, rf_type, rf_session_id, rf_datetime, upload_by )
              VALUES ('$filename', '$doctype', '$sess','".date('Y-m-d')."', '$user')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
