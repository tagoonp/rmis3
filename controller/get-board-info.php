<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM research a INNER JOIN research_consider_type b ON a.id_rs = b.rct_id_rs
           INNER JOIN research_assign_fullboard_agendar c ON a.id_rs = c.rafa_id_rs
           INNER JOIN useraccount d ON b.rct_fb_ec = d.id
           INNER JOIN userinfo e ON d.id = e.user_id
           WHERE b.rct_status = '1' AND b.rct_conf = '1' AND b.rct_id_rs = '$id_rs' AND b.rct_type LIKE 'Fullboard%'
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
