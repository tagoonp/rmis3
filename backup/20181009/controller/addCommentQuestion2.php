<?php
include "config.class.php";

if(!isset($_POST['part_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$id_part = mysqli_real_escape_string($conn, $_POST['part_id']);
$id_user = mysqli_real_escape_string($conn, $_POST['user']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$data = mysqli_real_escape_string($conn, $_POST['data']);

// $strSQL = "UPDATE research_init_rw_comment SET riwc_ustatus = '0' WHERE riwc_id_rs = '$id_rs' AND riwc_part = '$id_part'";
// mysqli_query($conn, $strSQL);

if($id_part == 1){
  $strSQL = "INSERT INTO research_init_rw_comment (riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$id_part', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    // echo $strSQL;
    echo "N";
  }
}else if(($id_part == 2) || ($id_part == 3) || ($id_part == 4)){
  $strSQL = "INSERT INTO research_init_rw_comment (riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$id_part', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    // echo $strSQL;
    echo "N";
  }
}else if($id_part == 5){
  $topic = mysqli_real_escape_string($conn, $_POST['tt']);

  $strSQL = "INSERT INTO research_init_rw_comment (riwc_part, rirc_key, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$id_part', '$topic', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    echo $strSQL;
    echo "N";
  }
}



// echo json_encode($return);
mysqli_close($conn);
die();


?>
