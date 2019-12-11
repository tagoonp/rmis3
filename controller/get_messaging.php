<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['role'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$strSQL = "SELECT
            *
           FROM
            messaging
           WHERE
            msg_id_rs = '$id_rs'
          ";
$query = mysqli_query($conn, $strSQL);
if($query){

  if($role == 'นักวิจัย'){
    $strSQL = "UPDATE messaging SET msg_read_status = '1' WHERE msg_id_rs = '$id_rs' AND msg_role != 'นักวิจัย'";
    mysqli_query($conn, $strSQL);
  }else{
    $strSQL = "UPDATE messaging SET msg_read_status = '1' WHERE msg_id_rs = '$id_rs' AND msg_role == 'นักวิจัย'";
    mysqli_query($conn, $strSQL);
  }


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

$return_2 = '';

foreach ($return as $row) {
  $return_2_buff = '';
  foreach ($row as $key => $value) {
    if($key == 'msg_by'){
      $strSQL = "SELECT
                  *
                 FROM
                  useraccount a LEFT JOIN userinfo b ON a.id = b.user_id
                 WHERE
                  a.id = '$value'
                ";
      $query = mysqli_query($conn, $strSQL);
      if($query){
        $data = mysqli_fetch_assoc($query);
        $return_2_buff['owner_by'] = $data['fname']." ".$data['lname'];
      }
      $return_2_buff[$key] = $value;
    }else{
      $return_2_buff[$key] = $value;
    }
  }

  $return_2[] = $return_2_buff;
}

echo json_encode($return_2);
mysqli_close($conn);
die();
?>
