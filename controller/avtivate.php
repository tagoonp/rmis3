<?php
include "config.class.php";

if((!isset($_GET['email'])) || (!isset($_GET['sid']))){

  echo "ไม่สามารถยืนยันตัวตนได้ กรุณาติดต่อเจ้าหน้าที่";
  mysqli_close($conn);
  die();

}

$email = mysqli_real_escape_string($conn, $_GET['email']);
$sid = mysqli_real_escape_string($conn, $_GET['sid']);

$strSQL = "SELECT * FROM useraccount WHERE SID =  '$sid' AND email = '$email'";
if($query = mysqli_query($conn, $strSQL)){

  $nr = mysqli_num_rows($query);
  if($nr > 0){

    $strSQL = "UPDATE useraccount SET active_status = '1', allow_status = '1' WHERE SID =  '$sid' AND email = '$email'";
    $query = mysqli_query($conn, $strSQL);

    header('Location: ../activate_success.html');
    mysqli_close($conn);
    die();

  }else{
    header('Location: ../activate_fail.html');
    mysqli_close($conn);
    die();
  }

}else{

  header('Location: ../activate_fail.html');
  mysqli_close($conn);
  die();

}

mysqli_close($conn);
die();

?>
