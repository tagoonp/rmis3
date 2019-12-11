<?php
include "config.class.php";

$return = [];

if(!isset($_POST['id'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['th'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['en'])) {
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$en = mysqli_real_escape_string($conn, $_POST['en']);
$th = mysqli_real_escape_string($conn, $_POST['th']);
$datetime = date('Y-m-d H:i:s');

$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);

if($result){

  $row = mysqli_fetch_assoc($result);


  $p_th = $row['title_th'];
  $p_en = $row['title_en'];

  $strSQL = "UPDATE research SET title_th = '$th', title_en = '$en' WHERE id_rs = '$id_rs'";
  $result = mysqli_query($conn, $strSQL);



  if($result){
    echo "Y";

    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by )
              VALUES ('ปรับปรุงชื่อโครงการวิจัย (TH)', $p_th.' -> '.$th, '$datetime', '$id_rs', 'Staff : ".$id."')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by )
              VALUES ('ปรับปรุงชื่อโครงการวิจัย (Eng)', $p_en.' -> '.$en, '$datetime', '$id_rs', 'Staff : ".$id."')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_countrange, log_by_id )
    VALUES ('Add note', '<p>[System] เจ้าหน้าที่แก้ไขชื่อโครงการวิจัย</p><p>$p_th -> $th </p><p>$p_en -> $en</p>', '$log_ip', '$datetime', '$id_rs', 'staff', '0', '$id')";
    mysqli_query($conn, $strSQL);

    // echo $strSQL;
  }



}else{
  echo "N";
}

mysqli_close($conn);
die();

// if($_POST['role'] == 'pm'){
//   $id = mysqli_real_escape_string($conn, $_POST['id']);
//   $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
//   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
//   $lname = mysqli_real_escape_string($conn, $_POST['lname']);
//   $position = mysqli_real_escape_string($conn, $_POST['position']);
//   $address = mysqli_real_escape_string($conn, $_POST['address']);
//   $exp = mysqli_real_escape_string($conn, $_POST['exp']);
//   $ri = mysqli_real_escape_string($conn, $_POST['ri']);
//   $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
//   $office = mysqli_real_escape_string($conn, $_POST['office']);
//   $fax = mysqli_real_escape_string($conn, $_POST['fax']);
//
//   $strSQL = "UPDATE pm
//             SET
//             id_prefix = '$prefix',
//             fname = '$fname',
//             lname = '$lname',
//             id_personnel = '$position',
//             expertise = '$exp',
//             rs_interest = '$ri',
//             address = '$address',
//             tel_mobile = '$mobile',
//             tel_office = '$office',
//             tel_fax = '$fax'
//             WHERE user_id = '$id'";
//   if(mysqli_query($conn, $strSQL)){
//     echo "Y";
//
//     $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('update profile', 'คุณได้ทำการปรับปรุงข้อมูลส่วนบุคคล', '".date('Y-m-d H:i:s')."', '$id')";
//     mysqli_query($conn, $strSQL);
//
//     $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('update profile', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
//     mysqli_query($conn, $strSQL);
//
//   }else{
//     echo "N";
//   }
//
// }

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $prefix = mysqli_real_escape_string($conn, $_POST['prefix']);
  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);
  $position = mysqli_real_escape_string($conn, $_POST['position']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $exp = mysqli_real_escape_string($conn, $_POST['exp']);
  $ri = mysqli_real_escape_string($conn, $_POST['ri']);
  $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
  $office = mysqli_real_escape_string($conn, $_POST['office']);
  $fax = mysqli_real_escape_string($conn, $_POST['fax']);

  $strSQL = "UPDATE userinfo
            SET
            id_prefix = '$prefix',
            fname = '$fname',
            lname = '$lname',
            id_personnel = '$position',
            expertise = '$exp',
            rs_interest = '$ri',
            address = '$address',
            tel_mobile = '$mobile',
            tel_office = '$office',
            tel_fax = '$fax'
            WHERE user_id = '$id'";
  if(mysqli_query($conn, $strSQL)){
    echo "Y";

    $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('update profile', 'คุณได้ทำการปรับปรุงข้อมูลส่วนบุคคล', '".date('Y-m-d H:i:s')."', '$id')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('update profile', '$log_ip', '".date('Y-m-d H:i:s')."', '$id')";
    mysqli_query($conn, $strSQL);

  }else{
    echo "N";
  }









die();
