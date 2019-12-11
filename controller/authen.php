<?php
include "config.class.php";

if((!isset($_POST['username'])) || (!isset($_POST['password']))){
  // echo "string";
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
  $numrow = mysqli_num_rows($query);
  if($numrow > 0){
    $raw['authen_status'] = 'Already register';
    $return[] = $raw;
  }else{
    // 1. Check email ก่อน
    $strSQL = "SELECT * FROM useraccount
              WHERE ((email = '$email' AND password = '$password') OR (username = '$email' AND password = '$password')) AND delete_status = '0' AND active_status = '1' AND allow_status = '1' AND ".$role."_role = '1'";
    if ($query = mysqli_query($conn, $strSQL)) {

      $numrow = mysqli_num_rows($query);

      if($numrow > 0){
        while ($row = mysqli_fetch_array($query)) {
          $buf = [];
          $row_id = '';
          foreach ($row as $key => $value) {
              if(!is_int($key)){
                $buf[$key] = $value;

                if($key == 'id'){
                  $row_id = $value;
                }

                if($key == 'pm_role'){
                  if($value == '1'){

                    $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('signin', 'คุณได้ทำการเข้าสู่ระบบเมื่อ ".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', '$row_id')";
                    mysqli_query($conn, $strSQL);

                    $strSQL = "INSERT INTO log_pm (log_activity, log_ip, log_datetime, user_id ) VALUES ('signin', '$log_ip', '".date('Y-m-d H:i:s')."', '$row_id')";
                    mysqli_query($conn, $strSQL);
                  }
                }
              }
          }

          $raw['data'] = $buf;
          // $raw['authen_status'] = 'Found by useraccount'.$strSQL;
          $raw['authen_status'] = 'Found by useraccount';
          $return[] = $raw;
        }
      }else{
        $password = mysqli_real_escape_string($conn, base64_decode($password));
        $strSQL = "SELECT * FROM personnel WHERE id_per = '$email' AND birthdate = '$password'";
        if ($query = mysqli_query($conn, $strSQL)) {

          $numrow = mysqli_num_rows($query);

          if($numrow > 0){
            while ($row = mysqli_fetch_array($query)) {
              $buf = [];
              foreach ($row as $key => $value) {
                  if(!is_int($key)){
                    $buf[$key] = $value;
                  }
              }
              // $return[] = $buf;
              // $return[] = array('authen_status' => 'Found by personnel');
              $raw['data'] = $buf;
              $raw['authen_status'] = 'Found by personnel';
              $return[] = $raw;
            }
          }else{
            // $return[] = array('authen_status' => 'Not found 1');
            $raw['authen_status'] = 'Not found';
            $return[] = $raw;
          }
        }
      }


    }
    //2. ถ้าไม่เจอใน useraccount ให้หาใน personnel
    else{
      $password = mysqli_real_escape_string($conn, base64_decode($password));
      $strSQL = "SELECT * FROM personnel WHERE id_per = '$email' AND birthdate = '$password'";
      if ($query = mysqli_query($conn, $strSQL)) {

        $numrow = mysqli_num_rows($query);

        if($numrow > 0){
          while ($row = mysqli_fetch_array($query)) {
            $buf = [];
            foreach ($row as $key => $value) {
                if(!is_int($key)){
                  $buf[$key] = $value;
                }
            }
            $return[] = $buf;
            $return[] = array('authen_status' => 'Found by personnel');
          }
        }else{
          // $return[] = array('authen_status' => 'Not found 2');
          $raw['authen_status'] = 'Not found';
          $return[] = $raw;
        }
      }else{
          // $return[] = array('authen_status' => 'Not found 3');
          $raw['authen_status'] = 'Not found';
          $return[] = $raw;
      }
    }
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
      // $return[] = $buf;
      // $return[] = array('authen_status' => 'By useraccount');
      $raw['data'] = $buf;
      $raw['authen_status'] = 'Found by useraccount';
      $return[] = $raw;
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
        // $return[] = $buf;
        // $return[] = array('authen_status' => 'By personnel');
        $raw['data'] = $buf;
        $raw['authen_status'] = 'Found by personnel';
        $return[] = $raw;
      }
    }
  }
}

echo json_encode($return);
// echo json_encode($strSQL);

mysqli_close($conn);
die();

?>
