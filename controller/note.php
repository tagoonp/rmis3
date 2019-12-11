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

if(!isset($_POST['fnc'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$sysdate = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$mode = mysqli_real_escape_string($conn, $_POST['fnc']);

if($mode == 'set'){

  if(!isset($_POST['user'])) {
    mysqli_close($conn);
    die();
  }

  if(!isset($_POST['content'])) {
    mysqli_close($conn);
    die();
  }

  $crange = '1';

  $user_id = mysqli_real_escape_string($conn, $_POST['user']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $crange = mysqli_real_escape_string($conn, $_POST['crange']);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_countrange, log_by_id ) VALUES ('Add note', '$content', '$log_ip', '$sysdate', '$id_rs', '$role', '$crange', '$user_id')";
  $result = mysqli_query($conn, $strSQL);

  if($result){
    echo "Y";
  }else{
    echo $strSQL;
  }
}

if($mode == 'get'){
  $return = [];

  $strSQL = "SELECT * FROM log_note a INNER JOIN useraccount b ON a.log_by_id = b.id
             INNER JOIN userinfo c ON b.id = c.user_id
             WHERE a.log_id_rs = '$id_rs' ORDER BY a.log_datetime DESC";
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
}



mysqli_close($conn);
die();




?>
