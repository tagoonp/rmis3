<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$tmeeting = mysqli_real_escape_string($conn, $_POST['tmeeting']);
$mset = mysqli_real_escape_string($conn, $_POST['mset']);
$argendar = mysqli_real_escape_string($conn, $_POST['argendar']);
$mdate = mysqli_real_escape_string($conn, $_POST['mdate']);

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) > 0){

    $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_status = '0' WHERE rafa_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO research_assign_fullboard_agendar (rafa_id_rs, rafa_date, rafa_agn, rafa_panal, rafa_set, rafa_add_datetime, rafa_add_by)
              VALUES ('$id_rs', '$mdate', '$tmeeting', '$argendar', '$mset', '$date', '$id')
              ";
    $q = mysqli_query($conn, $strSQL);
    if($q){
      echo "Y";
    }else{
      echo "N3";
    }

  }else{
    $strSQL = "INSERT INTO research_assign_fullboard_agendar (rafa_id_rs, rafa_date, rafa_agn, rafa_panal, rafa_set, rafa_add_datetime, rafa_add_by)
              VALUES ('$id_rs', '$mdate', '$tmeeting', '$argendar', '$mset', '$date', '$id')
              ";
    $q = mysqli_query($conn, $strSQL);
    if($q){
      echo "Y";
    }else{
      echo "N1";
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO research_assign_fullboard_agendar (rafa_id_rs, rafa_agn, rafa_panal, rafa_set, rafa_add_datetime, rafa_add_by)
            VALUES ('$id_rs', '$tmeeting', '$argendar', '$mset', '$date', '$id')
            ";
  $q = mysqli_query($conn, $strSQL);
  if($q){
    echo "Y";
  }else{
    echo "N2";
  }

}

$strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เจ้าหน้าที่เพิ่มข้อมูลกำหนดวาระการประชุม</p>', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
mysqli_query($conn, $strSQL);

mysqli_close($conn);
die();
?>
