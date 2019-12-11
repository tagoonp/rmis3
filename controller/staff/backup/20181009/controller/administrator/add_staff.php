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


$id_pm = mysqli_real_escape_string($conn, $_POST['id_pm']);

$nr2 = '1';
$strSQL = "SELECT MAX(id) a
          FROM useraccount
          WHERE 1";

$query2 = mysqli_query($conn, $strSQL);
if($query2){
  $row = mysqli_fetch_array($query2);
  $nr2 = $row['a'];
}

$nr2 = $nr2 + 1;





if($id_pm != ''){
  $strSQL = "SELECT *
            FROM personnel
            WHERE id_per = '$id_pm'";

  $query = mysqli_query($conn, $strSQL);
  if($query){
    $nr = mysqli_num_rows($query);
    if($nr == 0){
      $id_pm = "PI_00".$nr2;
    }
  }
}else{
  $id_pm = "PI_00".$nr2;
}

$email = mysqli_real_escape_string($conn, $_POST['email']);

$strSQL = "SELECT *
          FROM useraccount a
          WHERE a.delete_status = '0' AND a.email = '$email'";
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

$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$strSQL = "INSERT INTO useraccount (id, id_pm, username, password, email, usertype, active_status, allow_status, reg_datetime)
          VALUES ('$nr2', '$id_pm', '$email', '$password', '$email', 'staff', '1', '1', '$date')
          ";
$query = mysqli_query($conn, $strSQL);

if($query){

  $strSQL = "INSERT INTO staff (id_prefix, fname, lname, phone, account_id)
            VALUES ('$id_prefix', '$fname', '$lname', '$phone', '$nr2')
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
    mysqli_close($conn);
    die();
  }

}else{
  // echo $strSQL;
  echo "N";
}

mysqli_close($conn);
die();


?>
