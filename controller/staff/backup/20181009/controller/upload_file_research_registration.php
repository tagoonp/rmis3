<?php
include "config.class.php";

if(!isset($_POST['docSess'])){
  mysqli_close($conn);
  die();
}

$session_id = mysqli_real_escape_string($conn, $_POST['docSess']);
$doctype = mysqli_real_escape_string($conn, $_POST['docType']);
$id = mysqli_real_escape_string($conn, $_POST['docSessuser']);

if (!empty($_FILES)) {

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/';  //4
  $filename = 'file-rs-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6

  $strSQL = "INSERT INTO file_research_attached (f_name, f_group, f_session_id, f_date, f_user_id )
              VALUES ('$filename', '$doctype', '$session_id','".date('Y-m-d')."', '$id')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
