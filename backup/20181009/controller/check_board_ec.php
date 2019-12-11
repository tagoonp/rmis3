<?php
include "config.class.php";

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM research_consider_type a INNER JOIN useraccount b ON a.rct_fb_ec = b.id
          INNER JOIN userinfo c ON b.id = c.user_id
          WHERE a.rct_id_rs = '$id_rs' AND a.rct_conf = '1'";
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
