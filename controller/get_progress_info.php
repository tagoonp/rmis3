<?php
include "config.class.php";

if(!isset($_POST['pid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['progress'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$progress_record_id = mysqli_real_escape_string($conn, $_POST['pid']);
$progress_id = mysqli_real_escape_string($conn, $_POST['progress']);


$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
          INNER JOIN userinfo c ON b.id = c.user_id
          INNER JOIN rec x ON a.id_rs = x.id_rs
          INNER JOIN rec_progress d ON a.id_rs = d.rp_id_rs
          INNER JOIN rec_progress_".$progress_id." e ON d.rp_id = e.rpx_id
          INNER JOIN type_status_research f ON d.rp_progress_status = f.id_status_research
          WHERE d.rp_id = '$progress_record_id' ";


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
