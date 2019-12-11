<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$sess = mysqli_real_escape_string($conn, $_POST['sess']);

$return = [];

$strSQL = "SELECT * FROM progress2_revise_table WHERE p2r_id_rs = '$id_rs' AND p2r_session_id	 = '$sess'";
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
