<?php
include "config.class.php";

if(!isset($_POST['id_rw'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['tag_item'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$return = [];
$id_reviewer = mysqli_real_escape_string($conn, $_POST['id_rw']);
$tag = mysqli_real_escape_string($conn, $_POST['tag_item']);


// $cstage = 'Reviewer 1';
$strSQL = "SELECT * FROM reviewer_tag WHERE rt_id_reviewer = '$id_reviewer' AND rt_tag = '$tag'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) == 0){
    $strSQL = "INSERT INTO reviewer_tag (rt_id_reviewer, rt_tag, rt_adddatetime) VALUES ('$id_reviewer', '$tag', '$date')";
    mysqli_query($conn, $strSQL);
  }
}else{
  $strSQL = "INSERT INTO reviewer_tag (rt_id_reviewer, rt_tag, rt_adddatetime) VALUES ('$id_reviewer', '$tag', '$date')";
  mysqli_query($conn, $strSQL);
}

$strSQL = "SELECT rt_tag FROM reviewer_tag WHERE rt_id_reviewer = '$id_reviewer' ";
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
