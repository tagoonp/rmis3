<?php
include "config.class.php";

if((!isset($_POST['username'])) || (!isset($_POST['password']))){
  mysqli_close($conn);
  die();
}

$email = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, base64_encode($_POST['password']));
$role = mysqli_real_escape_string($conn, $_POST['role']);

$return = [];
$buffer = [];
$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM useraccount WHERE id_pm = '$email' AND active_status = '1' AND delete_status = '0' AND allow_status = '1'";
if ($query = mysqli_query($conn, $strSQL)) {
  $numrow = mysqli_fetch_num_rows($query);
  if($numrow > 0){
    //ท่านเคยได้ทำการสมัครใช้งานระบบ RMIS แล้ว กรุณาใช้ E-mail ในการเข้าสู่ระบบ
  }else{

  }
}else{

  // 1. Check email ก่อน
  $strSQL = "SELECT * FROM useraccount
            WHERE (email = '$email' AND password = '$password') OR (username = '$email' AND password = '$password') AND delete_status = '0' AND active_status = '1' AND allow_status = '1'";
  if ($query = mysqli_query($conn, $strSQL)) {
    while ($row = mysqli_fetch_array($query)) {
      $buf = [];
      $row_id = '';
      foreach ($row as $key => $value) {
          if(!is_int($key)){
            $buf[$key] = $value;

            if($key == 'id'){
              $row_id = $value;
            }

            if($key == 'usertype'){
              if($value == 'pm'){

                $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('signin', 'คุณได้ทำการเข้าสู่ระบบเมื่อ ".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', '$row_id')";
                mysqli_query($conn, $strSQL);

                $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('signin', '$log_ip', '".date('Y-m-d H:i:s')."', '$row_id')";
                mysqli_query($conn, $strSQL);
              }
            }
          }
      }
      $return[] = $buf;
    }
  }
  //2. ถ้าไม่เจอใน useraccount ให้หาใน personnel
  else{
    $password = mysqli_real_escape_string($conn, base64_decode($password));
    $strSQL = "SELECT * FROM personnel WHERE id_per = '$email' AND birthdate = '$password'";
    if ($query = mysqli_query($conn, $strSQL)) {
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
  }
}


// $strSQL = "SELECT * FROM useraccount WHERE (email = '$email' AND password = '$password') OR (username = '$email' AND password = '$password') AND delete_status = '0'";
// if ($query = mysqli_query($conn, $strSQL)) {
//
//   while ($row = mysqli_fetch_array($query)) {
//     $buf = [];
//     $row_id = '';
//     foreach ($row as $key => $value) {
//         if(!is_int($key)){
//           $buf[$key] = $value;
//
//           if($key == 'id'){
//             $row_id = $value;
//           }
//
//           if($key == 'usertype'){
//             if($value == 'pm'){
//
//               $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('signin', 'คุณได้ทำการเข้าสู่ระบบเมื่อ ".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', '$row_id')";
//               mysqli_query($conn, $strSQL);
//
//               $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('signin', '$log_ip', '".date('Y-m-d H:i:s')."', '$row_id')";
//               mysqli_query($conn, $strSQL);
//             }
//           }
//         }
//     }
//     $return[] = $buf;
//   }
//
// }

echo json_encode($return);
// echo json_encode($strSQL);

mysqli_close($conn);
die();

?>
