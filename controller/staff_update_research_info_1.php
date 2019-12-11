<?php
include "./config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$th_title = mysqli_real_escape_string($conn, $_POST['th_title']);
$en_title = mysqli_real_escape_string($conn, $_POST['en_title']);
$th_keyword = mysqli_real_escape_string($conn, $_POST['th_keyword']);
$en_keyword = mysqli_real_escape_string($conn, $_POST['th_keyword']);
$rtype = mysqli_real_escape_string($conn, $_POST['rtype']);
$b1 = mysqli_real_escape_string($conn, $_POST['b1']);
$b2 = mysqli_real_escape_string($conn, $_POST['b2']);

$id_status = '';
$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";

$query = mysqli_query($conn, $strSQL);
if($query){
  $strSQL = "UPDATE research SET
            title_th = '$th_title',
            title_en = '$en_title',
            keywords_th = '$th_keyword',
            keywords_en = '$en_keyword',
            id_type = '$rtype',
            budget = '$b1',
            final_budget = '$b2'
            WHERE id_rs = '$id_rs'
            ";

  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', 'เจ้าหน้าที่แก้ไขข้อมูลโครงการวิจัย รหัสลงทะเบียนที่ $id_rs', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
  $result = mysqli_query($conn, $strSQL);

  if($b2 != ''){
    $strSQL = "UPDATE log_budget SET use_status = '0' WHERE id_rs = '$id_rs'";
              mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_budget (lb_budget, lb_by, lb_updateon, lb_id_rs) VALUES ('$b2', '$id', '$date', '$id_rs')";
    mysqli_query($conn, $strSQL);

  }

  echo "Y";




}else{
  echo "N";
}


// echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
// // echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
