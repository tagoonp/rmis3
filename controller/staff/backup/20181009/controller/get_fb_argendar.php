<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$date = date('Y-m-d H:i:s');
$return = [];

$strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1' ORDER BY rafa_id DESC LIMIT 1";
if($query = mysqli_query($conn, $strSQL)){
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
