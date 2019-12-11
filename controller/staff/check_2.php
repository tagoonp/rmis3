<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);


$strSQL = "SELECT * FROM log_research b
          WHERE b.id_rs = '$id_rs' AND b.log_activity in ('Wait for conside project type', 'Wait for acknowledge') ORDER BY b.id DESC LIMIT 1";

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){

          if($key == 'log_datetime'){
            $b = explode(' ', $value);
            $b1 = explode('-', $b[0]);
            $buf['ld'] = ($b1[0] + 543) . '-' .$b1[1].'-'.$b1[2];

          }
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
