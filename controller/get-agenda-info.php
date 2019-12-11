<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$copid = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM research_assign_fullboard_agendar
           WHERE rafa_id_rs = '$copid' AND rafa_status = '1'";
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
