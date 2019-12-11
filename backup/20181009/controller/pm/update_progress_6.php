<?php
include "../config.class.php";

if(!isset($_POST['session_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['progress_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id_pm = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_session = mysqli_real_escape_string($conn, $_POST['session_id']);
$code_apdu = mysqli_real_escape_string($conn, $_POST['code_apdu']);
$id_year = mysqli_real_escape_string($conn, $_POST['id_year']);

$rp6_qs1 = mysqli_real_escape_string($conn, $_POST['qs1']);
$rp6_qs2 = mysqli_real_escape_string($conn, $_POST['qs2']);
$rp6_qs2_info = mysqli_real_escape_string($conn, $_POST['qs2_info']);
$rp6_qs2_1 = mysqli_real_escape_string($conn, $_POST['qs2_1']);
$rp6_qs2_2 = mysqli_real_escape_string($conn, $_POST['qs2_2']);
$rp6_qs2_3 = mysqli_real_escape_string($conn, $_POST['qs2_3']);
$rp6_qs2_4 = mysqli_real_escape_string($conn, $_POST['qs2_4']);
$rp6_qs2_5 = mysqli_real_escape_string($conn, $_POST['qs2_5']);
$rp6_qs2_6 = mysqli_real_escape_string($conn, $_POST['qs2_6']);
$rp6_qs3_1 = mysqli_real_escape_string($conn, $_POST['qs3_1']);
$rp6_qs3_2 = mysqli_real_escape_string($conn, $_POST['qs3_2']);
$rp6_qs3_3 = mysqli_real_escape_string($conn, $_POST['qs3_3']);
$rp6_qs4 = mysqli_real_escape_string($conn, $_POST['qs4']);
$rp6_qs4_info_1 = mysqli_real_escape_string($conn, $_POST['qs4_info_1']);
$rp6_qs4_info_2 = mysqli_real_escape_string($conn, $_POST['qs4_info_2']);
$rp5_qs5 = mysqli_real_escape_string($conn, $_POST['qs5']);
$rp6_qs5_info_1 = mysqli_real_escape_string($conn, $_POST['qs5_info_1']);
$rp6_qs5_info_2 = mysqli_real_escape_string($conn, $_POST['qs5_info_2']);
$rp6_qs6 = mysqli_real_escape_string($conn, $_POST['qs6']);
$rp6_qs7 = mysqli_real_escape_string($conn, $_POST['qs7']);
$rp6_qs8 = mysqli_real_escape_string($conn, $_POST['qs8']);
$rp6_qs8_info = mysqli_real_escape_string($conn, $_POST['qs8_info']);
$rp6_qs9 = mysqli_real_escape_string($conn, $_POST['qs9']);


$strSQL = "UPDATE rec_progress
          SET
            rp_submit_date = '$date'
          WHERE
            rp_id_rs = '$id_rs' AND rp_progress_id = '6' AND rp_session = '$id_session'
          ";
if($query = mysqli_query($conn, $strSQL)){
  // $last_id = mysqli_insert_id($conn);

  $strSQL = "SELECT rp_id FROM rec_progress WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '6' AND rp_session = '$id_session' AND rp_delete_status = '0'";
  $query2 = mysqli_query($conn, $strSQL);
  $data = mysqli_fetch_assoc($query2);

  $last_id = $data['rp_id'];

  $strSQL = "UPDATE rec_progress_6
            SET
              rp6_qs1 = '$rp6_qs1',
              rp6_qs2 = '$rp6_qs2',
              rp6_qs2_info = '$rp6_qs2_info',
              rp6_qs2_1 = '$rp6_qs2_1',
              rp6_qs2_2 = '$rp6_qs2_2',
              rp6_qs2_3 = '$rp6_qs2_3',
              rp6_qs2_4 = '$rp6_qs2_4',
              rp6_qs2_5 = '$rp6_qs2_5',
              rp6_qs2_6 = '$rp6_qs2_6',
              rp6_qs3_1 = '$rp6_qs3_1',
              rp6_qs3_2 = '$rp6_qs3_2',
              rp6_qs3_3 = '$rp6_qs3_3',
              rp6_qs4 = '$rp6_qs4',
              rp6_qs4_info_1 = '$rp6_qs4_info_1',
              rp6_qs4_info_2 = '$rp6_qs4_info_2',
              rp6_qs5 = '$rp5_qs5',
              rp6_qs5_info_1 = '$rp6_qs5_info_1',
              rp6_qs5_info_2 = '$rp6_qs5_info_2',
              rp6_qs6 = '$rp6_qs6',
              rp6_qs7 = '$rp6_qs7',
              rp6_qs8 = '$rp6_qs8',
              rp6_qs8_info = '$rp6_qs8_info',
              rp6_qs9 = '$rp6_qs9'
            WHERE
              rpx_id = '$last_id'
            ";

  if($query2 = mysqli_query($conn, $strSQL)){

    // echo $strSQL;

    $strSQL = "UPDATE file_research_progress_attached SET f_confirm = '1' WHERE f_session_id = '$id_session' AND f_rs_id = '$id_rs' AND f_group = '6'";
    mysqli_query($conn, $strSQL);
    echo $last_id;

  }else{
    // $strSQL = "DELETE FROM rec_progress WHERE rp_id = '$last_id'";
    // mysqli_query($conn, $strSQL);
    echo "N";
  }
}else{
  echo $strSQL;
}


mysqli_close($conn);
die();

?>
