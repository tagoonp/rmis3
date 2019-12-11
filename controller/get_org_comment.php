<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM research_init_rw_comment_original
           WHERE riwc_id_rs = '$id_rs' AND riwc_ustatus = '1' ORDER BY riwc_seq";
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
}else{
  echo $strSQL;
}

echo json_encode($return);
mysqli_close($conn);
die();


?>
