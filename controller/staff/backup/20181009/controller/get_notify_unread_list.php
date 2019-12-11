<?php
include "config.class.php";

$return = [];

if(!isset($_POST['user'])) {
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['user']);

$return = [];

$strSQL = "SELECT
  *
FROM
  log_notification a
  LEFT JOIN useraccount b ON a.user_id = b.id
WHERE
  a.user_id = '$id'
  AND a.log_view = '0'
ORDER BY
  a.log_datetime DESC";

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
