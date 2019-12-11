<?php
include "../../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sid'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$sess_id = mysqli_real_escape_string($conn, $_POST['sid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM rec_progress_log
          WHERE rpl_pi_view = '1' AND rpl_id_rs = '$id_rs' and rpl_sess_id = '$sess_id' ";
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

?>
