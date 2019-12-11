<?php
include "config.class.php";

$return = [];

$strSQL = "SELECT * FROM research_new_progress WHERE rwp_id_rs = '".$_POST['id_rs']."' AND rwp_status = '0' ORDER BY rwp_datetime DESC LIMIT 1";
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
