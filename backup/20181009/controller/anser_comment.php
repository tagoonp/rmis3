<?php
include "config.class.php";

if(!isset($_POST['q'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$q = mysqli_real_escape_string($conn, $_POST['q']);
$ans1 = mysqli_real_escape_string($conn, $_POST['ans1']);
$ans2 = mysqli_real_escape_string($conn, $_POST['ans2']);
$ans3 = mysqli_real_escape_string($conn, $_POST['ans3']);
$ans4 = mysqli_real_escape_string($conn, $_POST['ans4']);
$ans5 = mysqli_real_escape_string($conn, $_POST['ans5']);

$strSQL = "UPDATE research_init_rw_comment
          SET riwc_a1 = '$ans1',
          riwc_a2 = '$ans2',
          riwc_a3 = '$ans3',
          riwc_a4 = '$ans4',
          riwc_a5 = '$ans5',
          riwc_replay_date = '$date'
          WHERE riwc_id = '$q' ";
if(mysqli_query($conn, $strSQL)){
  echo "Y";
}else{
  echo "N";
  echo $strSQL;
}

mysqli_close($conn);
die();


?>
