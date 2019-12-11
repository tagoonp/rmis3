<?php
include "config.class.php";

if(!isset($_POST['docIdrs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['docIdrs']);
$progress_id = mysqli_real_escape_string($conn, $_POST['docType']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['docCodeapdu']);
$session_id = mysqli_real_escape_string($conn, $_POST['docSession']);

if (!empty($_FILES)) {


  // mkdir("../tmp_file/".$id_apdu);
  
  $path = "../tmp_file/".$id_apdu;
  if(!is_dir($path)){
    mkdir($path);
  }

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-pg-'.$progress_id.'-'.date('H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;

  $strSQL = "INSERT INTO file_research_progress_attached (f_name, f_fullpart, f_group, f_confirm, f_date, f_rs_id, f_session_id)
              VALUES ('$filename', '$fullpart', '$progress_id', '0','".date('Y-m-d')."', '$id_rs', '$session_id')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
