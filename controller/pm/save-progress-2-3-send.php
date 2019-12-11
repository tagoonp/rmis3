<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$user = mysqli_real_escape_string($conn, $_POST['user']);

$rp2_key = mysqli_real_escape_string($conn, $_POST['rp2_key']);
$rp2_t1type = mysqli_real_escape_string($conn, $_POST['rp2_t1type']);

$status = mysqli_real_escape_string($conn, $_POST['status']);
$rp2_y = date('Y');

$strSQL = "UPDATE rec_progress_2 SET rp2_usestatus = '0' WHERE rp2_key = '$rp2_key' AND rp2_t1type = '$rp2_t1type' AND rp2_id_rs = '$id_rs'";
mysqli_query($conn, $strSQL);

$strSQL = "SELECT * FROM rec_progress_2 WHERE rp2_key = '$rp2_key' AND rp2_t1type = '$rp2_t1type' AND rp2_id_rs = '$id_rs' AND rp2_conf = '0' AND rp2_status = 'draft'";
if($query = mysqli_query($conn, $strSQL)){

  // $strSQL = "SELECT MAX() FROM rec_progress_2 WHERE rp2_year = '$rp2_y' ";

  $strSQL = "UPDATE rec_progress_2 SET rp2_status = '$status', rp2_conf = '1' WHERE rp2_key = '$rp2_key' AND rp2_t1type = '$rp2_t1type' AND rp2_id_rs = '$id_rs'";
  if($query2= mysqli_query($conn, $strSQL)){
    echo "Y";

    $strSQL = "UPDATE rec_progress SET rp_use_status = '0' WHERE rp_session = '$rp2_key'  AND rp_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    $strSQL = "SELECT code_apdu FROM research WHERE id_rs = '$id_rs'";
    $query3 = mysqli_query($conn, $strSQL);
    $row = mysqli_fetch_assoc($query3);

    $strSQL = "INSERT INTO rec_progress (rp_year, rp_id_rs, rp_id_pm, rp_code_apdu, rp_progress_id, rp_session, rp_submit_date)
               VALUES ('$rp2_y', '$id_rs', '$user', '".$row['code_apdu']."', '2', '$rp2_key', '$date')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Save amendment record as $status', 'ผู้วิจัยบันทึกแบบขอปรับปรุงโครการ', '$date', '0', '$rp2_key', 'PM : ".$user."')";
    mysqli_query($conn, $strSQL);

  }else{
    echo "N";
  }
}

mysqli_close($conn);
die();







function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
