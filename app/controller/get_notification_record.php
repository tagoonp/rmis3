<?php
include "config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$type = mysqli_real_escape_string($conn, $_POST['type']);

if($type == 'count'){
  $strSQL = "SELECT COUNT(*) FROM notification_record WHERE owner_id = '$id' AND log_view = '0'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow != 0){
      echo $nrow;
    }
  }
}else if($type == 'list_some'){
  $strSQL = "SELECT * FROM notification_record WHERE owner_id = '$id' AND log_view = '0' ORDER BY nr_id DESC";
  $query = mysqli_query($conn, $strSQL);
  $return = [];
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
}else{
  $strSQL = "SELECT * FROM notification_record WHERE owner_id = '$id' ORDER BY nr_id DESC";
  $query = mysqli_query($conn, $strSQL);
  $return = [];
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
}


mysqli_close($conn);
die();
