<?php
include "config.class.php";

if(!isset($_POST['uid'])) {
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$exp = mysqli_real_escape_string($conn, $_POST['exp']);
$ri = mysqli_real_escape_string($conn, $_POST['ri']);
$mobile = mysqli_real_escape_string($conn, $_POST['address']);
$office = mysqli_real_escape_string($conn, $_POST['office']);
$fax = mysqli_real_escape_string($conn, $_POST['fax']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$id' ";
if($query = mysqli_query($conn, $strSQL)){
  $strSQL = "UPDATE userinfo
            SET
              id_prefix = '$prefix',
              fname = '$fname',
              lname = '$lname',
              id_personnel = '$position',
              expertise = '$exp',
              rs_interest = '$ri',
              address = '$address',
              tel_mobile = '$mobile',
              tel_office = '$office',
              tel_fax = '$fax'
            WHERE
              user_id = '$id'
            ";
  mysqli_query($conn, $strSQL);
  echo "Y";
}else{
  echo 'N';
}
//
// if (!empty($_FILES)) {
//
//     $tempFile = $_FILES['file']['tmp_name'];
//     $targetPath = '../images/profile/';  //4
//     $filename = 'file-'.date('Y-m-d-H-i-s').$_FILES['file']['name'];
//     $targetFile =  $targetPath. $filename;  //5
//     move_uploaded_file($tempFile,$targetFile); //6
//
//     $strSQL = "UPDATE useraccount SET profile = '$filename' WHERE id = '$id'";
//     if(mysqli_query($conn, $strSQL)){
//
//       $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('change profile image', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
//       mysqli_query($conn, $strSQL);
//     }
//
// }

mysqli_close($conn);
die();

?>
