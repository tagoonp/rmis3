<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM research_consider_type WHERE rct_id_rs = '$id_rs' AND rct_status = '1'";
$query = mysqli_query($conn, $strSQL);
$conside_type = '';
$return = [];
if($query){
  $row = mysqli_fetch_assoc($query);
  $conside_type = $row['rct_type'];
}

if($conside_type != ''){
  if($conside_type == 'Exempt'){
    $strSQL = "SELECT * FROM research_acknowledge_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_status = '1'";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      $row = mysqli_fetch_assoc($query);
      $return = $row['rai_sign_date'];
    }
  }else{
    $strSQL = "SELECT * FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_sign_status = '1' AND rai_status = '1'";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      $row = mysqli_fetch_assoc($query);
      $return = $row['rai_sign_date'];
    }
  }
}

echo $return;
mysqli_close($conn);
die();

?>
