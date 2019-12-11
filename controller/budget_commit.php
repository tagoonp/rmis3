<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['budget'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['user'])) {
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$sysdate = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id = mysqli_real_escape_string($conn, $_POST['user']);
$budget = mysqli_real_escape_string($conn, $_POST['budget']);

$strSQL = "SELECT a.budget bg, b.id uid FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
           WHERE a.id_rs = '$id_rs' AND b.active_status = '1' AND b.delete_status = '0' AND b.allow_status = '1' LIMIT 1";
$query = mysqli_query($conn, $strSQL);
if($query){ //Found
  $data1 = mysqli_fetch_assoc($query);

  // Check old record
  $strSQL = "SELECT * FROM log_budget WHERE lb_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow == 0){
      $strSQL = "INSERT INTO log_budget (lb_budget, lb_by, lb_updateon, lb_status, lb_id_rs)
                 VALUES ('".$data1['bg']."', '".$data1['uid']."', '$sysdate', '1', '$id_rs')
                ";
      mysqli_query($conn, $strSQL);
    }
  }
  $strSQL = "UPDATE research SET budget = '$budget' WHERE id_rs = '$id_rs'";
            mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE log_budget SET lb_status = '0' WHERE lb_id_rs = '$id_rs'";
            mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_budget (lb_budget, lb_by, lb_updateon, lb_status, lb_id_rs)
             VALUES ('$budget','$id','$sysdate','1','$id_rs')
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
  }else{
    echo "N1";
  }
}else{
  echo "N2";
}

mysqli_close($conn);
die();




?>
