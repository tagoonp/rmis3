<?php
include "config.class.php";

if(!isset($_POST['docSess'])){
  mysqli_close($conn);
  die();
}

$session_id = mysqli_real_escape_string($conn, $_POST['docSess']);
$doctype = mysqli_real_escape_string($conn, $_POST['docType']);
$id = mysqli_real_escape_string($conn, $_POST['docSessuser']);

$log_ip = $_SERVER['REMOTE_ADDR'];
$log_date = date('Y-m-d');
$log_datetime = date('Y-m-d H:i:s');

if (!empty($_FILES)) {

  $tempFile = $_FILES['file']['tmp_name'];
  $targetPath = '../tmp_file/';  //4
  $filename = 'file-rs-'.date('Y-m-d-H-i-s').'-'.$_FILES['file']['name'];
  $targetFile =  $targetPath. $filename;  //5
  // move_uploaded_file($tempFile,$targetFile); //6
  if(move_uploaded_file($tempFile,$targetFile)){
    $strSQL = "INSERT INTO file_research_attached (f_name, f_group, f_session_id, f_date, f_user_id )
                VALUES ('$filename', '$doctype', '$session_id','$log_date', '$id')";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      echo "Y";

      //Enter into system error log
      $strSQL = "SELECT id_rs FROM research WHERE session_id = '$session_id'";
      $result = mysqli_query($conn, $strSQL);
      if($result){
        $row = mysqli_fetch_assoc($result);
        $id_rs = $row['id_rs'];
        $strSQL = "INSERT INTO log_system (log_err_ip, log_err_id_rs, log_err_msg, log_err_datetime, log_err_by, log_err_status)
                   VALUES ('$log_ip', '$id_rs', 'Upload research file ($doctype) by user success.', '$log_datetime', '$id', 'success')";
        $query = mysqli_query($conn, $strSQL);
      }else{
        $strSQL = "INSERT INTO log_system (log_err_ip, log_err_msg, log_err_datetime, log_err_by, log_err_status)
                   VALUES ('$log_ip', 'Upload research file ($doctype) by user success.', '$log_datetime', '$id', 'success')";
        $query = mysqli_query($conn, $strSQL);
      }

    }else{
      echo "N1";

      //Enter into system error log
      $strSQL = "SELECT id_rs FROM research WHERE session_id = '$session_id'";
      $result = mysqli_query($conn, $strSQL);
      if($result){

        $row = mysqli_fetch_assoc($result);
        $id_rs = $row['id_rs'];

        $strSQL = "INSERT INTO log_system (log_err_ip, log_err_id_rs, log_err_msg, log_err_datetime, log_err_by)
                   VALUES ('$log_ip', '$id_rs', 'Fail on upload research file ($doctype) by user.', '$log_datetime', '$id')";
        $query = mysqli_query($conn, $strSQL);
      }else{
        $strSQL = "INSERT INTO log_system (log_err_ip, log_err_msg, log_err_datetime, log_err_by)
                   VALUES ('$log_ip', 'Fail on upload research file ($doctype) by user.', '$log_datetime', '$id')";
        $query = mysqli_query($conn, $strSQL);
      }

    }
  }else{
    echo "N2";
    //Enter into system error log
    $strSQL = "SELECT id_rs FROM research WHERE session_id = '$session_id'";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $row = mysqli_fetch_assoc($result);
      $id_rs = $row['id_rs'];
      $strSQL = "INSERT INTO log_system (log_err_ip, log_err_id_rs, log_err_msg, log_err_datetime, log_err_by)
                 VALUES ('$log_ip', '$id_rs', 'Fail on upload research file ($doctype) by user.', '$log_datetime', '$id')";
      $query = mysqli_query($conn, $strSQL);
    }else{
      $strSQL = "INSERT INTO log_system (log_err_ip, log_err_msg, log_err_datetime, log_err_by)
                 VALUES ('$log_ip', 'Fail on upload research file ($doctype) by user.', '$log_datetime', '$id')";
      $query = mysqli_query($conn, $strSQL);
    }
  }
}

mysqli_close($conn);
die();



?>
