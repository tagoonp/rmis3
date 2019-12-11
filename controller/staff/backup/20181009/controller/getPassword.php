<?php
include "config.class.php";

if(!isset($_POST['email'])){
  mysqli_close($conn);
  die();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$return = [];

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
          WHERE a.email = '$email' AND a.active_status = '1' AND a.delete_status = '0' AND a.allow_status = '1'
          LIMIT 1";

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){

          if($key == 'password'){
            $buf['password'] = base64_decode($value);
          }else{
            $buf[$key] = $value;
          }
        }
    }
    $return[] = $buf;
  }
}


echo json_encode($return);
mysqli_close($conn);
die();
