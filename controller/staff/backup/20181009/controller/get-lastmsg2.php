<?php
include "config.class.php";

$return = [];

$strSQL = "SELECT * FROM research_new_progress WHERE rwp_id_rs = '".$_POST['id_rs']."'ORDER BY rwp_datetime ";
$query = mysqli_query($conn, $strSQL);
if($query){
  // $row = mysqli_fetch_assoc($query);
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }

  // echo $row['rwp_info'];
}

// echo $strSQL;


echo json_encode($return);
mysqli_close($conn);
die();
