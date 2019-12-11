<?php
include "../config.class.php";

$return = [];

$strSQL = "SELECT * FROM dept WHERE 1 ORDER BY dept_name";
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

echo json_encode($return, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
die();
