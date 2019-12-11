<?php
include "config.class.php";

if(!isset($_POST['progresssession'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['docidrs'])){
  mysqli_close($conn);
  die();
}

$filegroup = mysqli_real_escape_string($conn, $_POST['filegroup']);
$progresssession = mysqli_real_escape_string($conn, $_POST['progresssession']);
$docidrs = mysqli_real_escape_string($conn, $_POST['docidrs']);

$docadmgroup = '';
if(isset($_POST['docadmgroup'])){
  $docadmgroup = mysqli_real_escape_string($conn, $_POST['docadmgroup']);
}



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
