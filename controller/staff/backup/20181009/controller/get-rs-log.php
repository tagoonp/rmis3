<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM log_research WHERE id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }

        if($key == 'log_by'){
          $lb = explode(' ', $value);
          if(sizeof($lb) == 3){
            $strSQL = "SELECT * FROM userinfo WHERE user_id = '".$lb[2]."'";
            if($query2 = mysqli_query($conn, $strSQL)){
              $data = mysqli_fetch_assoc($query2);
              $buf['log_by_fullname'] = $data['fname']." ".$data['lname'];
            }
          }else{
            $buf['log_by_fullname'] = 'NA';
          }
        }
    }
    $return[] = $buf;
  }
}


echo json_encode($return);
mysqli_close($conn);
die();
