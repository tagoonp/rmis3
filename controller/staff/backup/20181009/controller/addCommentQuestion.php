<?php
include "config.class.php";

if(!isset($_POST['part_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$id_part = mysqli_real_escape_string($conn, $_POST['part_id']);
$id_user = mysqli_real_escape_string($conn, $_POST['user']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$data = mysqli_real_escape_string($conn, $_POST['data']);

if(isset($_POST['rid'])){
  $rid = mysqli_real_escape_string($conn, $_POST['rid']);
  $strSQL = "UPDATE research_init_rw_comment
            SET
              riwc_part = '$id_part',
              riwc_q = '$data'
            WHERE
              riwc_id_rs = '$id_rs' AND riwc_part = '$id_part' AND riwc_id = '$rid'";
  mysqli_query($conn, $strSQL);
  echo "Y";
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT MAX(riwc_seq) mr FROM research_init_rw_comment WHERE riwc_part = '$id_part' AND riwc_id_rs = '$id_rs' AND riwc_ustatus = '1' AND riwc_part != '5'";
$query = mysqli_query($conn, $strSQL);

$new_seq = 1;
if($query){
  $row = mysqli_fetch_assoc($query);
  $new_seq = $row['mr'] + 1;
}

if($id_part == 1){
  $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$new_seq', '$id_part', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    // echo $strSQL;
    echo "N";
  }
}else if(($id_part == 2) || ($id_part == 3) || ($id_part == 4)){

  $strSQL = "SELECT MAX(riwc_seq) mr FROM research_init_rw_comment WHERE riwc_part = '$id_part' AND riwc_id_rs = '$id_rs' AND riwc_ustatus = '1' AND riwc_part != '5'";
  $query = mysqli_query($conn, $strSQL);

  $new_seq = 1;
  if($query){
    $row = mysqli_fetch_assoc($query);
    $new_seq = $row['mr'] + 1;
  }

  $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$new_seq', '$id_part', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    // echo $strSQL;
    echo "N";
  }
}else if($id_part == 5){
  $topic = mysqli_real_escape_string($conn, $_POST['tt']);

  $strSQL = "INSERT INTO research_init_rw_comment (riwc_part, rirc_key, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs )
            VALUES ('$id_part', '$topic', '$data', '$date', '$id_user','$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เจ้าหน้าเพิ่ม Note ในการสรุปข้อเสนอแนะจากผู้เชี่ยวชาญ</p>$data', '$log_ip', '$date', '$id_rs', 'staff', '$id_user')";
  mysqli_query($conn, $strSQL);

  if($query){
    echo "Y";
  }
  else{
    echo $strSQL;
    echo "N";
  }
}



// echo json_encode($return);
mysqli_close($conn);
die();


?>
