<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['content'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$strSQL = "INSERT INTO
            messaging (msg_content, msg_by, msg_role, msg_datetime, msg_systemstatus, msg_id_rs)
            VALUES
            ('$content', '$id', '$role', '$date', '0', '$id_rs')
          ";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo $strSQL;
}
mysqli_close($conn);
die();
?>
