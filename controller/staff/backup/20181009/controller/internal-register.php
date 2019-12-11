<?php
include "config.class.php";

if(!isset($_POST['email'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['pid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['prefix'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fname'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['mobile'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['password'])){
  mysqli_close($conn);
  die();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$per_id = mysqli_real_escape_string($conn, $_POST['pid']);
$id_prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$exp = mysqli_real_escape_string($conn, $_POST['exp']);
$ri = mysqli_real_escape_string($conn, $_POST['ri']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$office = mysqli_real_escape_string($conn, $_POST['office']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
$fax = mysqli_real_escape_string($conn, $_POST['fax']);
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM useraccount WHERE email = '$email' AND delete_status = '0'" ;
$query = mysqli_query($conn, $strSQL);
if($query){
  $numrow = mysqli_num_rows($query);
  if($numrow > 0){
    echo "D";
    mysqli_close($conn);
    die();
  }
}

$strSQL = "INSERT INTO useraccount (id_pm, username, password, email, usertype, active_status, allow_status, reg_datetime, SID, pm_role)
          VALUES ('$per_id', '$email', '$password', '$email', 'pm', '1', '1', '$date', '', '1')
          ";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "SELECT id FROM useraccount WHERE id_pm = '$per_id' AND email = '$email'";
  $query = mysqli_query($conn, $strSQL);
  $row = mysqli_fetch_assoc($query);

  $strSQL = "INSERT INTO userinfo (id_prefix, fname, lname, id_dept, id_personnel, expertise, rs_interest, address, tel_mobile, tel_office, tel_fax, user_id)
            VALUES ('$id_prefix', '$fname', '$lname', '$dept', '$position', '$exp', '$ri', '$address', '$mobile', '$office', '$fax', '".$row['id']."')
            ";
  if($query = mysqli_query($conn, $strSQL)){
    echo "Y";
    mysqli_close($conn);
    die();
  }else{
    echo "N1";
    mysqli_close($conn);
    die();
  }
}

echo "N";
mysqli_close($conn);
die();
