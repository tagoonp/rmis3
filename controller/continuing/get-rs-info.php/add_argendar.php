<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$atime = mysqli_real_escape_string($conn, $_POST['argend']);
$panal = mysqli_real_escape_string($conn, $_POST['panal']);
$adate = mysqli_real_escape_string($conn, $_POST['argend_date']);
$adate2 = $adate;
$b = explode('-', $adate);
if(sizeof($b) > 1){
  $adate2 = (intval($b[0]) - 543) . '-' . $b[1] . '-' . $b[2];
}

$strSQL = "INSERT INTO research_assign_fullboard_agendar (rafa_id_rs, rafa_date, rafa_agn, rafa_panal, rafa_add_datetime, rafa_add_by)
          VALUES ('$id_rs', '$adate2', '$atime', '$panal', '".date('Y-m-d H:i:s')."', '$id')";
          
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "UPDATE research SET id_status_research = '23' WHERE id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('รอผลมติจากที่ประชุม' , '', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('Wait fullboard review', '', '".date('Y0m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
  mysqli_query($conn, $strSQL);

  echo "Y";
}else{

  echo "N";
}

mysqli_close($conn);
die();

?>
