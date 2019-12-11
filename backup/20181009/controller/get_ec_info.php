<?php
include "config.class.php";

if(!isset($_POST['id_ec'])){
  mysqli_close($conn);
  die();
}

$id_ec = mysqli_real_escape_string($conn, $_POST['id_ec']);

$return = [];

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
           INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
           WHERE a.id = '$id_ec'";
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
