<?php
include "config.class.php";

if(!isset($_POST['uid'])) {
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['uid']);

$log_ip = $_SERVER['REMOTE_ADDR'];

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = '../images/profile/';  //4
    $filename = 'file-'.date('Y-m-d-H-i-s').$_FILES['file']['name'];
    $targetFile =  $targetPath. $filename;  //5
    move_uploaded_file($tempFile,$targetFile); //6

    $strSQL = "UPDATE useraccount SET profile = '$filename' WHERE id = '$id'";
    if(mysqli_query($conn, $strSQL)){

      $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('change profile image', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
      mysqli_query($conn, $strSQL);
    }

}

mysqli_close($conn);
die();

?>
