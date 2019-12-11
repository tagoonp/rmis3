<?php
include "config.class.php";

if(!isset($_POST['q_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$q_id = mysqli_real_escape_string($conn, $_POST['q_id']);

$strSQL = "SELECT * FROM eform_bio_comment WHERE cfbc_comment_id = '$q_id' ";
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
