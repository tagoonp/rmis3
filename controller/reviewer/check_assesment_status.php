<?php
include "../config.class.php";

if((!isset($_POST['id']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['fid']))){
  mysqli_close($conn);
  die();
}



$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$fid = mysqli_real_escape_string($conn, $_POST['fid']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$strSQL = '';

if($fid == '2'){
  $strSQL = "SELECT * FROM eform_bio WHERE efb_reviewer_id = '$id' AND efb_id_rs = '$id_rs' AND efb_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='4'){
  $strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id' AND efi_id_rs = '$id_rs' AND efi_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='3'){
  $strSQL = "SELECT * FROM eform_social WHERE efs_reviewer_id = '$id' AND efs_id_rs = '$id_rs' AND efs_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='8'){
  $strSQL = "SELECT * FROM eform_mta WHERE efm_reviewer_id = '$id' AND efm_id_rs = '$id_rs' AND efm_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='11'){
  $strSQL = "SELECT * FROM eform_bio_fund WHERE efb_reviewer_id = '$id' AND efb_id_rs = '$id_rs' AND efb_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='12'){
  $strSQL = "SELECT * FROM eform_social_fund WHERE efm_reviewer_id = '$id' AND efm_id_rs = '$id_rs' AND efm_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }
}else if($fid=='13'){
  $strSQL = "SELECT * FROM eform_funding WHERE eff_reviewer_id = '$id' AND eff_id_rs = '$id_rs' AND eff_draft_status = 'saved'";
  $query = mysqli_query($conn, $strSQL);

  if($query){
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      echo "Y";
    }else{
      echo "N";
    }
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
