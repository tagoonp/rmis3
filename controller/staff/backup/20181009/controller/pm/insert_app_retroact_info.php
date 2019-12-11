<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$app_date = mysqli_real_escape_string($conn, $_POST['app_date']);
$app_reound = mysqli_real_escape_string($conn, $_POST['app_reound']);
$app_meeting = mysqli_real_escape_string($conn, $_POST['app_meeting']);
$app_report_period = mysqli_real_escape_string($conn, $_POST['app_report_period']);
$cont_app_date = mysqli_real_escape_string($conn, $_POST['cont_app_date']);
$cont_app_meeting = mysqli_real_escape_string($conn, $_POST['cont_date_meeting']);
$rri_cont_acknowledge_closing = mysqli_real_escape_string($conn, $_POST['rri_cont_acknowledge_closing']);

$cuurent_session_id = mysqli_real_escape_string($conn, $_POST['cuurent_session_id']);

if($app_date == ''){
  $app_date = '0000-00-00';
}else{
  $b = explode('-', $app_date);
  $app_date = intval($b[0] - 543) . "-" . $b[1] . "-" . $b[2];
}

if($app_reound == ''){
  $app_reound = null;
}

if($app_meeting == ''){
  $app_meeting = '0000-00-00';
}else{
  $b = explode('-', $app_meeting);
  $app_meeting = intval($b[0] - 543) . "-" . $b[1] . "-" . $b[2];
}

if($app_report_period == ''){
  $app_report_period = 'na';
}

if($cont_app_date == ''){
  $cont_app_date = '0000-00-00';
}else{
  $c = explode('-', $cont_app_date);
  $cont_app_date = intval($c[0] - 543) . "-" . $c[1] . "-" . $c[2];
}



if($cont_app_meeting == ''){
  $cont_app_meeting = '0000-00-00';
  // echo "string";
}else{
  $d = explode('-', $cont_app_meeting);
  $cont_app_meeting = intval($d[0] - 543) . "-" . $d[1] . "-" . $d[2];
}


if($rri_cont_acknowledge_closing == ''){
  $rri_cont_acknowledge_closing = '0000-00-00';
}else{
  $d = explode('-', $rri_cont_acknowledge_closing);
  $rri_cont_acknowledge_closing = intval($d[0] - 543) . "-" . $d[1] . "-" . $d[2];
}

$id_rs = '';

$strSQL = "SELECT id_rs FROM research WHERE session_id = '$cuurent_session_id' AND research_status = 'retroact'";
if($query = mysqli_query($conn, $strSQL)){
  $data = mysqli_fetch_assoc($query);
  $id_rs = $data['id_rs'];
}else{
  echo "N";
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id WHERE a.id = '$id'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';
$id_dept = '';
$id_personnel = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
    $id_dept = $row['id_dept'];
    $id_personnel = $row['id_personnel'];
  }else{
    echo "N1";
    mysqli_close($conn);
    die();
  }
}else{
  echo $strSQL;
  mysqli_close($conn);
  die();
}



if($id_pm == ''){
  echo "N3";
  mysqli_close($conn);
  die();
}

if($id_rs == ''){
  echo "N4";
  mysqli_close($conn);
  die();
}



$strSQL = "SELECT * FROM research_retroact_info WHERE rri_id_rs = '$id_rs' AND rri_delete_status = '0'";
$query = mysqli_query($conn, $strSQL);

if($query){
  if(mysqli_num_rows($query) > 0){
    $strSQL = "UPDATE research_retroact_info
               SET
                rri_date_approve = '$app_date',
                rri_tmeeting = '$app_reound',
                rri_dmeeting = '$app_meeting',
                rri_reportrange = '$app_report_period',
                rri_cont_report_app_date = '$cont_app_date',
                rri_cont_repor_dmeeting = '$cont_app_meeting',
                rri_cont_acknowledge_closing = '$rri_cont_acknowledge_closing'
              WHERE
                rri_id_rs = '$id_rs'
              ";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }else{
    $strSQL = "INSERT INTO research_retroact_info (rri_id_rs, rri_date_approve, rri_tmeeting, rri_dmeeting, rri_reportrange, rri_cont_report_app_date, rri_cont_repor_dmeeting, rri_cont_acknowledge_closing)
              VALUES ('$id_rs','$app_date','$app_reound','$app_meeting','$app_report_period','$cont_app_date','$cont_app_meeting', '$rri_cont_acknowledge_closing')
              ";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO research_retroact_info (rri_id_rs, rri_date_approve, rri_tmeeting, rri_dmeeting, rri_reportrange, rri_cont_report_app_date, rri_cont_repor_dmeeting, rri_cont_acknowledge_closing)
            VALUES ('$id_rs','$app_date','$app_reound','$app_meeting','$app_report_period','$cont_app_date','$cont_app_meeting', '$rri_cont_acknowledge_closing')
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
  }else{
    echo "N5-2";
  }
}



mysqli_close($conn);
die();

?>
