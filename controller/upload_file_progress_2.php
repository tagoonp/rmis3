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

$date = date("Y-m-d H:i:s");

$filegroup = mysqli_real_escape_string($conn, $_POST['filegroup']);
$progresssession = mysqli_real_escape_string($conn, $_POST['progresssession']);
$docidrs = mysqli_real_escape_string($conn, $_POST['docidrs']);

$docadmgroup = '';
if(isset($_POST['docadmgroup'])){
  $docadmgroup = mysqli_real_escape_string($conn, $_POST['docadmgroup']);
}


if (!empty($_FILES)) {

  $orgFile = $_FILES['file']['name'];
  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/';  //4

  $array = explode('.', $_FILES['file']['name']);
  $extension = end($array);

  // $filename = 'amendment-'.$docidrs.'-'.date('Ymd-His').'-group'.$filegroup.'.'.$extension;
  $filename = 'amendment'.'-'.date('Ymd-His').'-'.$_FILES['file']['name'];;


  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6

  $strSQL = "INSERT INTO rec_progress_file_attached (rpfa_progress_id, rpfa_session_id, rpfa_group, rpfa_id_rs, rpfa_file_name, rpfa_file_original_name, rpfa_datetime )
              VALUES ('2', '$progresssession', '$filegroup', '$docidrs', '$filename', '$orgFile', '$date')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
