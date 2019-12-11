<?php
include "config.class.php";

if(!isset($_POST['id_rw'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ssid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$return = [];
$id_rw = mysqli_real_escape_string($conn, $_POST['id_rw']);
$id_session = mysqli_real_escape_string($conn, $_POST['ssid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
// $rtype = mysqli_real_escape_string($conn, $_POST['rtype']);


$strSQL = "DELETE FROM research_init_reviewer WHERE rir_id_reviewer = '$id_rw' AND rir_session = '$id_session'";
$query = mysqli_query($conn, $strSQL);

$strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN useraccount b on a.rir_id_reviewer = b.id
          INNER JOIN userinfo c ON b.id = c.user_id
          INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
          WHERE a.rir_id_rs = '$id_rs'  AND a.rir_conf = '0' ORDER BY a.rir_id";
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
