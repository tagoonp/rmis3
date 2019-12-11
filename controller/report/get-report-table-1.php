<?php
include "../config.class.php";
header('Content-type: application/json');

if(!isset($_POST['sd'])){
  // mysqli_close($conn);
  // die();
}

if(!isset($_POST['ed'])){
  // mysqli_close($conn);
  // die();
}

$sd = mysqli_real_escape_string($conn, $_POST['sd']);
$ed = mysqli_real_escape_string($conn, $_POST['ed']);

// $sd = '2018-01-01';
// $ed = '2018-05-01';

$sd = $sd." 00:00:00";
$ed = $ed." 23:59:59";

$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$data = '';
$return = [];
$strSQL = "SELECT rct_type, count(*) cm
           FROM research_consider_type
           WHERE rct_id_rs IN (SELECT id_rs FROM research WHERE delete_flag = 'N' AND draft_status = '0' AND sendding_status = 'Y')
           AND rct_by IS NOT NULL
           AND rct_status = '1'
           AND rct_conf = '1'
           AND rct_datetime BETWEEN '$sd' AND '$ed'
           GROUP BY rct_type";
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
