<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$return = [];

$strSQL = "SELECT * FROM research_init_reviewer WHERE rir_id_rs = '$id_rs' AND rir_conf = '1' AND rw_sending_status = '1' AND rw_reply_status = '4'";
$query = mysqli_query($conn, $strSQL);

$start = '';
$end = '';
if($query){
  while ($row = mysqli_fetch_array($query)) {
    if($start == ''){
      $start = $row['rw_sending_datetime'];
    }else{
      if(date($start) > date($row['rw_sending_datetime'])){
        $start = $row['rw_sending_datetime'];
      }
    }


    if($end == ''){
      $end = $row['rw_reply_datetime'];
    }else{
      if(date($end) < date($row['rw_reply_datetime'])){
        $end = $row['rw_reply_datetime'];
      }
    }
  }

  if(($start != '') && ($end != '')){
    $return['start'] = $start;
    $return['end'] = $end;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
