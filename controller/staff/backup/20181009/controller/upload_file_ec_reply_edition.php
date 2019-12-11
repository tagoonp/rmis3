<?php
include "config.class.php";

if(!isset($_POST['txtIdRSRp'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['txtIdECRp'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['txtIdRSRp']);
$id_ec = mysqli_real_escape_string($conn, $_POST['txtIdECRp']);
$id_apdu = mysqli_real_escape_string($conn, $_POST['txtIdCodeAPDURp']);


if (!empty($_FILES)) {

  mkdir("../tmp_file/".$id_apdu);

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/'.$id_apdu."/";  //4
  $filename = $id_apdu.'-rep-comment-'.date('H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  move_uploaded_file($tempFile,$targetFile); //6
  $fullpart = $targetPath.$filename;

  $strSQL = "INSERT INTO research_file_reply_to_pi_edit (rfa_filename, rfa_filefullpart, rfa_id_rs, rfa_id_ec, rfa_datetime)
              VALUES ('$filename', '$fullpart', '$id_rs', '$id_ec','".date('Y-m-d')."')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }

}

mysqli_close($conn);
die();



?>
