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
$pos_reviewer = mysqli_real_escape_string($conn, $_POST['pos_status']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
$position = mysqli_real_escape_string($conn, $_POST['position']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$exp = mysqli_real_escape_string($conn, $_POST['exp']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$strSQL = "INSERT INTO useraccount (id, id_pm, username, password, email, usertype, active_status, allow_status, reg_datetime, pm_role, reviewer_role, reviewer_status)
          VALUES ('$nr2', '$id_pm', '$email', '$password', '$email', 'reviewer', '1', '1', '$date', '1', '1', '$pos_reviewer')
          ";
$query = mysqli_query($conn, $strSQL);

if($query){

  // $strSQL = "INSERT INTO reviewer (id_prefix, fname, lname, phone, pos_status, account_id)
  //           VALUES ('$id_prefix', '$fname', '$lname', '$phone', '$pos_reviewer','$nr2')
  //           ";

  $strSQL = "INSERT INTO userinfo (id_prefix, fname, lname, id_dept, id_personnel, expertise, tel_mobile, user_id)
            VALUES ('$id_prefix', '$fname', '$lname', '$dept', '$position', '$exp', '$phone', '$nr2')
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
