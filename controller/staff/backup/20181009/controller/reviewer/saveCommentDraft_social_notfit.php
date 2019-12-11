<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['q'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['com_msg'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$cm_id = '';

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);
$comment = mysqli_real_escape_string($conn, $_POST['com_msg']);
$element = mysqli_real_escape_string($conn, $_POST['q']);

$strSQL = "SELECT * FROM eform_social WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    $strSQL = "UPDATE eform_social_comment SET cfsc_status = '0' WHERE cfsc_efb_id = '".$data['efs_id']."' AND cfsc_element = '$element'" ;
              mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO eform_social_comment (cfsc_comment, cfsc_element, cfsc_efb_id, cfsc_udate)
              VALUES ('$comment', '$element', '".$data['efs_id']."', '$date')
              ";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $strSQL = "UPDATE eform_social SET efs_".$element." = '0' WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs'";
      mysqli_query($conn, $strSQL);
    }
  }

}

mysqli_close($conn);
die();

?>
