<?php
include "../config.class.php";

if((!isset($_POST['user']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['user']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM rec_progress_2 a INNER JOIN research b ON a.rp2_id_rs = b.id_rs
          INNER JOIN type_status_research c ON a.rp2_progress_status = c.id_status_research
          WHERE a.rp_2_user = '$id' AND a.rp2_usestatus = '1' AND a.rp2_status != 'deleted by PI' ORDER BY a.rp2_adddate DESC";
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
