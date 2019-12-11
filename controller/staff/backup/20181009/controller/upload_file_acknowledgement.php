<?php
include "config.class.php";

if(!isset($_POST['docSessID'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['docSessID']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['docSessCodeAPDU']);
$id_session = mysqli_real_escape_string($conn, $_POST['docSess']);


$strSQL = "DELETE FROM research_file_approve_document WHERE rfad_id_rs = '$id_rs' AND rfad_session != '$id_session' AND rfad_doctype = 'Acknowledge' AND rfad_status = 'buffer' ";
mysqli_query($conn, $strSQL);

if (!empty($_FILES)) {

  mkdir("../tmp_file/".$id_apdu);

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-Acknowledge-'.date('H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;
  $strSQL = "INSERT INTO research_file_approve_document (rfad_id_rs, rfad_session, rfad_filename, rfad_filefullpart, rfad_doctype, rfad_status)
              VALUES ('$id_rs', '$id_session', '$filename', '$fullpart', 'Acknowledge', 'buffer')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }


}

mysqli_close($conn);
die();



?>
