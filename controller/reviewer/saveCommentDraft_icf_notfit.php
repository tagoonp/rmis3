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

if(!isset($_POST['com_title'])){
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
$comment_title = mysqli_real_escape_string($conn, $_POST['com_title']);
$element = mysqli_real_escape_string($conn, $_POST['q']);

$strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    $strSQL = "UPDATE eform_icf_comment SET cfic_status = '0' WHERE cfic_efb_id = '".$data['efi_id']."' AND cfic_element = '$element'" ;
              mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO eform_icf_comment (cfic_comment, cfic_title, cfic_element, cfic_efb_id, cfic_udate)
              VALUES ('$comment', '$comment_title', '$element', '".$data['efi_id']."', '$date')
              ";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $strSQL = "UPDATE eform_icf SET efi_".$element." = '0' WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs= '$id_rs'";
      mysqli_query($conn, $strSQL);
      echo "Y";
    }
  }

}

mysqli_close($conn);
die();

?>
