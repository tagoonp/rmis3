<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$id'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
  }else{
    mysqli_close($conn);
    die();
  }
}else{
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  mysqli_close($conn);
  die();
}

$strSQL = "UPDATE research SET delete_flag = 'Y' WHERE id_pm = '$id_pm' AND id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";
  // echo $strSQL;
}else{
  // echo $strSQL;
  echo "N";
}


mysqli_close($conn);
die();

?>
