<?php
include "config.class.php";

if(!isset($_POST['txtIdRS'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtIdReviewer'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtIdCodaAPCU'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['txtIdRS']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['txtIdReviewer']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['txtIdCodaAPCU']);

if (!empty($_FILES)) {

  // $tempFile = $_FILES['file']['tmp_name'];
  // $targetPath = '../tmp_file/';  //4
  // $filename = 'file-rs-assesment-back-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  // $targetFile =  $targetPath. $filename;  //5
  // move_uploaded_file($tempFile,$targetFile); //6
  //
  // $strSQL = "INSERT INTO research_file_assesment_reply (rfa_filename, rfa_id_rs, rfa_id_reviewer, rfa_datetime)
  //             VALUES ('$filename', '$id_rs', '$id_reviewer','".date('Y-m-d')."')";
  // $query = mysqli_query($conn, $strSQL);

  mkdir("../tmp_file/".$id_apdu);

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-rep-assesment-'.date('H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;
  // $strSQL = "INSERT INTO research_file_approve_document (rfad_id_rs, rfad_session, rfad_filefullpart, rfad_filename, rfad_status )
  //             VALUES ('$id_rs', '$id_session', '$fullpart', '$filename', 'buffer')";
  // $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_file_assesment_reply (rfa_filename, rfa_filefullpart, rfa_id_rs, rfa_id_reviewer, rfa_datetime)
              VALUES ('$filename', '$fullpart', '$id_rs', '$id_reviewer','".date('Y-m-d H:i:s')."')";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by) VALUES ('Reviewer upload file',  '$filename', '".date('Y-m-d H:i:s')."', '$id_rs','Reviewer : $id_reviewer')";
  mysqli_query($conn, $strSQL);


  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
