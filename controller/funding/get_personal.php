<?php
include "../config.class.php";

if(!isset($_POST['sk'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$search_id = mysqli_real_escape_string($conn, $_POST['sk']);

$strSQL = "SELECT * FROM personnel
          WHERE id_per LIKE '$search_id%' OR name LIKE '$search_id%' OR surname LIKE '$search_id%'";
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
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
