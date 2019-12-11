<?php
include "config.class.php";

if(!isset($_POST['fid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_reviewer'])){
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
$cm_id = '';

$fid = mysqli_real_escape_string($conn, $_POST['fid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['id_reviewer']);
if($fid == 2){
  $strSQL = "SELECT * FROM eform_bio WHERE efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs' AND efb_status = 'sended' ORDER By efb_id DESC LIMIT 1";
}
else if($fid == 3){
  $strSQL = "SELECT * FROM eform_social WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs' AND efs_status = 'sended' ORDER By efs_id DESC LIMIT 1";
}
else if($fid == 4){
  $strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs= '$id_rs' AND efi_status = 'sended' ORDER By efi_id DESC LIMIT 1";
}
else if($fid == 8){
  $strSQL = "SELECT * FROM eform_mta WHERE efm_id_rs = '$id_rs' AND efm_reviewer_id = '$id_reviewer' AND efm_status = 'sended' ORDER By efm_id DESC LIMIT 1";
}
else if($fid == 13){
  $strSQL = "SELECT * FROM eform_funding WHERE eff_id_rs = '$id_rs' AND eff_reviewer_id = '$id_reviewer' AND eff_draft_status = 'sended' ORDER By eff_id DESC LIMIT 1";
}

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}
echo json_encode($return);
mysqli_close($conn);
die();

?>
