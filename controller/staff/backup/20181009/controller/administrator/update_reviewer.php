<?php
include "../config.class.php";

if(!isset($_POST['email'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fname'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}


$id_pm = mysqli_real_escape_string($conn, $_POST['id_pm']);
$id = mysqli_real_escape_string($conn, $_POST['id']);

$nr2 = '1';
$strSQL = "SELECT *
          FROM useraccount
          WHERE id = '$id'";

$query = mysqli_query($conn, $strSQL);
if(!$query){
  die();
}

$prev_data = mysqli_fetch_assoc($query);

$email = mysqli_real_escape_string($conn, $_POST['email']);

$strSQL = "SELECT *
          FROM useraccount a
          WHERE a.delete_status = '0' AND a.email = '$email' AND a.id != '$id'";
$query = mysqli_query($conn, $strSQL);

if($query){
  $nr = mysqli_num_rows($query);
  if($nr > 0){
    echo "D";
    mysqli_close($conn);
    die();
  }
}

$id_prefix = mysqli_real_escape_string($conn, $_POST['id_prefix']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$pos_reviewer = mysqli_real_escape_string($conn, $_POST['pos_status']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
$position = mysqli_real_escape_string($conn, $_POST['position']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$exp = mysqli_real_escape_string($conn, $_POST['exp']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$strSQL = "UPDATE useraccount
          SET id_pm = '$id_pm', username = '$email', password = '$password', email = '$email', reviewer_status = '$pos_reviewer'
          WHERE id = '$id'
          ";
$query = mysqli_query($conn, $strSQL);

if($query){

  $strSQL = "UPDATE userinfo
            SET id_prefix = '$id_prefix', fname = '$fname', lname = '$lname', id_dept = '$dept', id_personnel = '$position', expertise = '$exp', tel_mobile = '$phone'
            WHERE user_id = '$id'
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
    mysqli_close($conn);
    die();
  }else{

  }

}else{
  // echo $strSQL;
  echo "N";
}

mysqli_close($conn);
die();


?>
