<?php
include "config.class.php";

if(!isset($_POST['email'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['prefix_common'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fname_th'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname_th'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['password'])){
  mysqli_close($conn);
  die();
}


$email = mysqli_real_escape_string($conn, $_POST['email']);
$prefix_th = mysqli_real_escape_string($conn, $_POST['prefix_th']);
$prefix_en = mysqli_real_escape_string($conn, $_POST['prefix_en']);
$fname_th = mysqli_real_escape_string($conn, $_POST['fname_th']);
$lname_th = mysqli_real_escape_string($conn, $_POST['lname_th']);
$fname_en = mysqli_real_escape_string($conn, $_POST['fname_en']);
$lname_en = mysqli_real_escape_string($conn, $_POST['lname_en']);
$id_prefix = mysqli_real_escape_string($conn, $_POST['prefix_common']);
$position = mysqli_real_escape_string($conn, $_POST['position']);
$instType = mysqli_real_escape_string($conn, $_POST['dept_group']);
$dept_th = mysqli_real_escape_string($conn, $_POST['dept_th']);
$dept_en = mysqli_real_escape_string($conn, $_POST['dept_en']);
$exp = mysqli_real_escape_string($conn, $_POST['exp']);
$ri = mysqli_real_escape_string($conn, $_POST['ri']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$office = mysqli_real_escape_string($conn, $_POST['office']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
$date = date("Y-m-d H:i:s");
$sid = mysqli_real_escape_string($conn, $_POST['sid']);
$return = [];

$strSQL = "SELECT * FROM useraccount WHERE email = '$email' AND delete_status = '0' AND active_status = '1'" ;
$query = mysqli_query($conn, $strSQL);
if($query){
  $numrow = mysqli_num_rows($query);
  if($numrow > 0){
    echo "D";
    mysqli_close($conn);
    die();
  }
}

$strSQL = "INSERT INTO useraccount (username, password, email, usertype, active_status, allow_status, reg_datetime, SID, pm_role)
          VALUES ('$email', '$password', '$email', 'pm', '0', '0', '$date', '$sid', '1')
          ";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "SELECT id FROM useraccount WHERE email = '$email' AND SID = '$sid'";
  $query = mysqli_query($conn, $strSQL);
  $row = mysqli_fetch_assoc($query);
  $strSQL = "INSERT INTO userinfo (id_prefix, prefix_th, prefix_en, fname, lname, fname_en, lname_en, id_dept, id_personnel, dept, dept_en, dept_group, expertise, rs_interest, address, tel_mobile, tel_office,  user_id)
            VALUES ('$id_prefix', '$prefix_th', '$prefix_en', '$fname_th', '$lname_th', '$fname_en', '$lname_en', '19', '$position', '$dept_th', '$dept_en', '$instType', '$exp', '$ri', '$address', '$mobile', '$office', '".$row['id']."')
            ";
  if($query = mysqli_query($conn, $strSQL)){

    $strSQL = "UPDATE useraccount SET id_pm = 'PI_0".$row['id']."' WHERE id = '".$row['id']."'";
    mysqli_query($conn, $strSQL);

    echo "Y";
  }else{
    echo "N";
  }
}else{
  $return['status'] = $strSQL;
}

mysqli_close($conn);
die();

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
