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

if(!isset($_POST['ptype'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['prefix_th'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['prefix_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fname_th'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['fname_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname_th'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lname_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['dept_th'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['dept_en'])) {
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ptype'])) {
  mysqli_close($conn);
  die();
}


$ptype = mysqli_real_escape_string($conn, $_POST['ptype']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$prefix_th = mysqli_real_escape_string($conn, $_POST['prefix_th']);
$prefix_en = mysqli_real_escape_string($conn, $_POST['prefix_en']);
$fname_th = mysqli_real_escape_string($conn, $_POST['fname_th']);
$fname_en = mysqli_real_escape_string($conn, $_POST['fname_en']);
$lname_th = mysqli_real_escape_string($conn, $_POST['lname_th']);
$lname_en = mysqli_real_escape_string($conn, $_POST['lname_en']);
$dept_th = mysqli_real_escape_string($conn, $_POST['dept_th']);
$dept_en = mysqli_real_escape_string($conn, $_POST['dept_en']);
$datetime = date('Y-m-d H:i:s');
$log_ip = $_SERVER['REMOTE_ADDR'];

$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);

if($result){
  $row = mysqli_fetch_assoc($result);
  $id_pm = $row['id_pm'];

  $strSQL = "SELECT * FROM useraccount WHERE id_pm = '$id_pm'";
  $result_id_pm = mysqli_query($conn, $strSQL);

  if($result_id_pm){
    $nrow = mysqli_num_rows($result_id_pm);
    if($nrow > 1){
      $data_pm = mysqli_fetch_array($result);
      foreach ($data_pm as $row_pm) {
        if($ptype == 'external'){
          $strSQL = "UPDATE userinfo
                     SET
                      prefix_th = '$prefix_th', prefix_en = '$prefix_en', fname = '$fname_th', lname = '$lname_th',
                      fname_en = '$fname_en', lname_en = '$lname_en', dept = '$dept_th', dept_en = '$dept_en'
                     WHERE
                      user_id = '".$row_pm['id']."'";
          mysqli_query($conn, $strSQL);
        }else{
          $strSQL = "UPDATE userinfo
                     SET
                      prefix_th = '$prefix_th', prefix_en = '$prefix_en', fname = '$fname_th', lname = '$lname_th',
                      fname_en = '$fname_en', lname_en = '$lname_en'
                     WHERE
                      user_id = '".$row_pm['id']."'";
          mysqli_query($conn, $strSQL);
        }
      }
    }else{
      $row_pm = mysqli_fetch_assoc($result_id_pm);

      // print_r($row_pm);
      // die();

      if($ptype == 'external'){
        $strSQL = "UPDATE userinfo
                   SET
                    prefix_th = '$prefix_th', prefix_en = '$prefix_en', fname = '$fname_th', lname = '$lname_th',
                    fname_en = '$fname_en', lname_en = '$lname_en', dept = '$dept_th', dept_en = '$dept_en'
                   WHERE
                    user_id = '".$row_pm['id']."'";

                    // echo $strSQL;
                    // die();

        mysqli_query($conn, $strSQL);


      }else{
        $strSQL = "UPDATE userinfo
                   SET
                    prefix_th = '$prefix_th', prefix_en = '$prefix_en', fname = '$fname_th', lname = '$lname_th',
                    fname_en = '$fname_en', lname_en = '$lname_en'
                   WHERE
                    user_id = '".$row_pm['id']."'";

                    // echo $strSQL;
                    // die();
        mysqli_query($conn, $strSQL);
      }
    }


    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by )
              VALUES ('เจ้าหน้าที่แก้ไขข้อมูลหัวหน้าโครงการวิจัย','', '$datetime', '$id_rs', 'Staff : ".$id."')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_countrange, log_by_id )
    VALUES ('Add note', '<p>[System] เจ้าหน้าที่แก้ไขข้อมูลหัวหน้าโครงการวิจัย</p>', '$log_ip', '$datetime', '$id_rs', 'staff', '0', '$id')";
    mysqli_query($conn, $strSQL);

    echo "Y";
  }else{
    echo "N2";
  }
}else{
  echo "N1";
}

mysqli_close($conn);
die();
