<?php
include "config.class.php";

$return = [];

$strSQL = "SELECT * FROM type_prefix WHERE prefix_status = '1' AND prefix_name != '' ORDER BY prefix_name";
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
