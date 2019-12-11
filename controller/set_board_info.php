<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['tmeeting'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$mdate = mysqli_real_escape_string($conn, $_POST['datemeeting']);
$tmeeting = mysqli_real_escape_string($conn, $_POST['tmeeting']);
$argendar = mysqli_real_escape_string($conn, $_POST['panal']);
$mset = mysqli_real_escape_string($conn, $_POST['mset']);
$date = date('Y-m-d H:i:s');

$return = [];
$buffer = [];

$strSQL = "SELECT * FROM research_assign_fullboard_agendar
          WHERE
          rafa_id_rs = '$id_rs' AND rafa_status = '1'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $strSQL = "UPDATE
                research_assign_fullboard_agendar
              SET
                rafa_date = '$mdate',
                rafa_agn = '$tmeeting',
                rafa_panal = '$argendar',
                rafa_set = '$mset',
                rafa_add_by = '$id'
              WHERE
                rafa_id_rs = '$id_rs'
              ";
    mysqli_query($conn, $strSQL);
    echo "Y";
  }else{
    $strSQL = "INSERT INTO research_assign_fullboard_agendar
              (rafa_id_rs, rafa_date, rafa_agn, rafa_panal, rafa_set, rafa_add_datetime, rafa_add_by)
              VALUES ('$id_rs', '$mdate', '$tmeeting', '$argendar', '$mset', '$date', '$id')
              ";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo "N".$strSQL;
    }
  }
}

// echo json_encode($return);
mysqli_close($conn);
die();

?>
