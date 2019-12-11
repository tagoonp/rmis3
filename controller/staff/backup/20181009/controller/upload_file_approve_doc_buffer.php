<?php
include "config.class.php";

if(!isset($_POST['COAIDRS'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['COAIDRS']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['COAAPDU']);
$id_session = mysqli_real_escape_string($conn, $_POST['COASess']);


$strSQL = "DELETE FROM research_file_approve_document WHERE rfad_id_rs = '$id_rs' AND rfad_upload_by IS NULL AND rfad_session != '$id_session'";
mysqli_query($conn, $strSQL);

if (!empty($_FILES)) {

  mkdir("../tmp_file/".$id_apdu);

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-coabuffer-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;
  $strSQL = "INSERT INTO research_file_approve_document (rfad_id_rs, rfad_session, rfad_filefullpart, rfad_filename, rfad_status )
              VALUES ('$id_rs', '$id_session', '$fullpart', '$filename', 'buffer')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }else{
    echo $strSQL;
  }


}

mysqli_close($conn);
die();



?>
