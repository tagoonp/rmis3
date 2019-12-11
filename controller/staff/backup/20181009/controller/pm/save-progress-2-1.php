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
$key = base64_encode($date.generateRandomString(20).$id_rs);

$stype = mysqli_real_escape_string($conn, $_POST['stype']);
$rp2_t1t1_1 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_1']);
$rp2_t1t1_2 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_2']);
$rp2_t1t1_3 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_3']);
$rp2_t1t1_4 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_4']);
$rp2_t1t1_4_1 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_4_1']);
$rp2_t1t1_4_2 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_4_2']);
$rp2_t1t1_4_3 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_4_3']);

$rp2_t1t1_5 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_5']);
$rp2_t1t1_5_1 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_5_1']);
$rp2_t1t1_5_2 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_5_2']);
$rp2_t1t1_5_3 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_5_3']);

$rp2_t1t1_6 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_6']);
$rp2_t1t1_6_1 = mysqli_real_escape_string($conn, $_POST['rp2_t1t1_6_1']);

$rp2_t2 = mysqli_real_escape_string($conn, $_POST['rp2_t2']);
$rp2_t2info = mysqli_real_escape_string($conn, $_POST['rp2_t2info']);
$rp2_t3 = mysqli_real_escape_string($conn, $_POST['rp2_t3']);
$rp2_t3a = mysqli_real_escape_string($conn, $_POST['rp2_t3a']);
$rp2_t3b = mysqli_real_escape_string($conn, $_POST['rp2_t3b']);
$rp2_t3c = mysqli_real_escape_string($conn, $_POST['rp2_t3c']);
$rp2_t3d = mysqli_real_escape_string($conn, $_POST['rp2_t3d']);
$rp2_t3e = mysqli_real_escape_string($conn, $_POST['rp2_t3e']);
$rp2_t3f = mysqli_real_escape_string($conn, $_POST['rp2_t3f']);
$rp2_t3g = mysqli_real_escape_string($conn, $_POST['rp2_t3g']);

$rp2_t4 = mysqli_real_escape_string($conn, $_POST['rp2_t4']);
$rp2_t5 = mysqli_real_escape_string($conn, $_POST['rp2_t5']);
$rp2_t6 = mysqli_real_escape_string($conn, $_POST['rp2_t6']);

$status = mysqli_real_escape_string($conn, $_POST['status']);

$strSQL = "SELECT rp2_key FROM rec_progress_2 WHERE rp2_id_rs = '$id_rs' AND rp2_usestatus = '1'";
if($query = mysqli_query($conn, $strSQL)){
  $nr = mysqli_num_rows($query);
  if($nr > 0){
    $row = mysqli_fetch_array($query);
    $key = $row['rp2_key'];

    $strSQL = "UPDATE rec_progress_2 SET rp2_usestatus = '0' WHERE rp2_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO rec_progress_2 (rp2_key, rp2_t1type, rp2_t1t1_1, rp2_t1t1_2, rp2_t1t1_3, rp2_t1t1_4, rp2_t1t1_4_1, rp2_t1t1_4_2, rp2_t1t1_4_3,
              rp2_t1t1_5, rp2_t1t1_5_1, rp2_t1t1_5_2, rp2_t1t1_5_3, rp2_t1t1_6, rp2_t1t1_6_1, rp2_t2, rp2_t2info, rp2_t3, rp2_t3a, rp2_t3b, rp2_t3c,
              rp2_t3d, rp2_t3e, rp2_t3f, rp2_t3g, rp2_t4, rp2_t5, rp2_t6, rp2_adddate, rp2_id_rs, rp2_status, rp_2_user)
              VALUES
              ('$key', '$stype', '$rp2_t1t1_1', '$rp2_t1t1_2', '$rp2_t1t1_3', '$rp2_t1t1_4', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1',
              '$rp2_t1t1_5', '$rp2_t1t1_5_1', '$rp2_t1t1_5_2', '$rp2_t1t1_5_3', '$rp2_t1t1_6', '$rp2_t1t1_6_1', '$rp2_t2', '$rp2_t2info', '$rp2_t3', '$rp2_t3a', '$rp2_t3b', '$rp2_t3c',
              '$rp2_t3d', '$rp2_t3e', '$rp2_t3f', '$rp2_t3g', '$rp2_t4', '$rp2_t5', '$rp2_t6', '$date', '$id_rs', '$status', '$user'
              )
              ";
    if($query = mysqli_query($conn, $strSQL)){
      echo "Y";
      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Save amendment record as $status', 'ผู้วิจัยบันทึกแบบขอปรับปรุงโครการฉบับร้าง', '$date', '0', '$key', 'PM : ".$user."')";
      mysqli_query($conn, $strSQL);
    }else{
      echo $strSQL;
    }

    mysqli_close($conn);
    die();

  }else{
    $strSQL = "INSERT INTO rec_progress_2 (rp2_key, rp2_t1type, rp2_t1t1_1, rp2_t1t1_2, rp2_t1t1_3, rp2_t1t1_4, rp2_t1t1_4_1, rp2_t1t1_4_2, rp2_t1t1_4_3,
              rp2_t1t1_5, rp2_t1t1_5_1, rp2_t1t1_5_2, rp2_t1t1_5_3, rp2_t1t1_6, rp2_t1t1_6_1, rp2_t2, rp2_t2info, rp2_t3, rp2_t3a, rp2_t3b, rp2_t3c,
              rp2_t3d, rp2_t3e, rp2_t3f, rp2_t3g, rp2_t4, rp2_t5, rp2_t6, rp2_adddate, rp2_id_rs, rp2_status, rp_2_user)
              VALUES
              ('$key', '$stype', '$rp2_t1t1_1', '$rp2_t1t1_2', '$rp2_t1t1_3', '$rp2_t1t1_4', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1',
              '$rp2_t1t1_5', '$rp2_t1t1_5_1', '$rp2_t1t1_5_2', '$rp2_t1t1_5_3', '$rp2_t1t1_6', '$rp2_t1t1_6_1', '$rp2_t2', '$rp2_t2info', '$rp2_t3', '$rp2_t3a', '$rp2_t3b', '$rp2_t3c',
              '$rp2_t3d', '$rp2_t3e', '$rp2_t3f', '$rp2_t3g', '$rp2_t4', '$rp2_t5', '$rp2_t6', '$date', '$id_rs', '$status', '$user'
              )
              ";
    if($query = mysqli_query($conn, $strSQL)){
      echo "Y";
      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Save amendment record as $status', 'ผู้วิจัยบันทึกแบบขอปรับปรุงโครการฉบับร้าง', '$date', '0', '$key', 'PM : ".$user."')";
      mysqli_query($conn, $strSQL);
    }else{
      echo $strSQL;
    }

    mysqli_close($conn);
    die();
  }
}else{
  $strSQL = "INSERT INTO rec_progress_2 (rp2_key, rp2_t1type, rp2_t1t1_1, rp2_t1t1_2, rp2_t1t1_3, rp2_t1t1_4, rp2_t1t1_4_1, rp2_t1t1_4_2, rp2_t1t1_4_3,
            rp2_t1t1_5, rp2_t1t1_5_1, rp2_t1t1_5_2, rp2_t1t1_5_3, rp2_t1t1_6, rp2_t1t1_6_1, rp2_t2, rp2_t2info, rp2_t3, rp2_t3a, rp2_t3b, rp2_t3c,
            rp2_t3d, rp2_t3e, rp2_t3f, rp2_t3g, rp2_t4, rp2_t5, rp2_t6, rp2_adddate, rp2_id_rs, rp2_status, rp_2_user)
            VALUES
            ('$key', '$stype', '$rp2_t1t1_1', '$rp2_t1t1_2', '$rp2_t1t1_3', '$rp2_t1t1_4', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1', '$rp2_t1t1_4_1',
            '$rp2_t1t1_5', '$rp2_t1t1_5_1', '$rp2_t1t1_5_2', '$rp2_t1t1_5_3', '$rp2_t1t1_6', '$rp2_t1t1_6_1', '$rp2_t2', '$rp2_t2info', '$rp2_t3', '$rp2_t3a', '$rp2_t3b', '$rp2_t3c',
            '$rp2_t3d', '$rp2_t3e', '$rp2_t3f', '$rp2_t3g', '$rp2_t4', '$rp2_t5', '$rp2_t6', '$date', '$id_rs', '$status', '$user'
            )
            ";
  if($query = mysqli_query($conn, $strSQL)){
    echo "Y";
    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Save amendment record as $status', 'ผู้วิจัยบันทึกแบบขอปรับปรุงโครการฉบับร้าง', '$date', '0', '$key', 'PM : ".$user."')";
    mysqli_query($conn, $strSQL);
  }else{
    echo $strSQL;
  }

  mysqli_close($conn);
  die();
}







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
