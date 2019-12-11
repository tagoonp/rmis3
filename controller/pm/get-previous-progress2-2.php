<?php
include "../config.class.php";

if((!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['session_id']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['type']))){
  mysqli_close($conn);
  die();
}

$type = mysqli_real_escape_string($conn, $_POST['type']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");



$strSQL = "SELECT * FROM rec_progress_2 a
          WHERE a.rp2_key = '$session_id' AND a.rp2_usestatus = '1' AND a.rp2_t1type = '$type' AND a.rp2_id_rs = '$id_rs' AND a.rp2_status != 'deleted by PI' ORDER BY a.rp2_adddate DESC";
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

  $strSQL = "UPDATE rec_progress_2 SET rp2rp2_usestatus = '0' WHERE rp2_key = '$session_id' AND rp2_t1type = '$type' AND rp2_id_rs = '$id_rs' AND rp2_conf = '1' AND rp2_progress_status = '2'";
            mysqli_fetch_array($query);
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
