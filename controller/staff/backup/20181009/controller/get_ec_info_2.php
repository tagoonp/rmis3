<?php
include "config.class.php";

if(!isset($_POST['id_ec'])){
  mysqli_close($conn);
  die();
}

$id_ec = mysqli_real_escape_string($conn, $_POST['id_ec']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
           INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
           INNER JOIN research_consider_type d ON a.id = d.rct_fb_ec
           WHERE d.rct_status = '1' AND d.rct_conf = '1' AND d.rct_id_rs = '$id_rs'";
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
// echo json_encode($strSQL);
mysqli_close($conn);
die();
