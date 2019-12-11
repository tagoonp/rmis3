<?php
include "config.class.php";

if((!isset($_POST['username'])) || (!isset($_POST['password']))){
  mysqli_close($conn);
  die();
}

$email = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));

$return = [];
$buffer = [];
$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM useraccount
           WHERE
            email = '$email'
            AND password = '$password'
            AND delete_status = '0'
            AND active_status = '1'
            AND allow_status = '1'
            ";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
