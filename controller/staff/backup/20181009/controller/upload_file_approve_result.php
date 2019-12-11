<?php
include "config.class.php";

if(!isset($_POST['txtCodeBCIDRS'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['txtCodeBCIDRS']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['txtCodeBCAPCU']);
$id_session = mysqli_real_escape_string($conn, $_POST['txtCodeBCSESS']);


$strSQL = "DELETE FROM research_file_comment WHERE rfc_id_rs_buff = '$id_rs' AND rfc_id_rs IS NULL AND rfc_session != '$id_session'";
mysqli_query($conn, $strSQL);

if (!empty($_FILES)) {

  mkdir("../tmp_file/".$id_apdu);

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-fs7-'.date('H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;
  $strSQL = "INSERT INTO research_file_comment (rfc_filefullpart, rfc_filename, rfc_id_rs_buff, rfc_session)
              VALUES ('$fullpart', '$filename', '$id_rs', '$id_session')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }


}

mysqli_close($conn);
die();



?>
