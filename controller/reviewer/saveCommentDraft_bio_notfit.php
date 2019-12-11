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

$strSQL = "SELECT * FROM eform_bio WHERE efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    $strSQL = "UPDATE eform_bio_comment
              SET cfbc_status = '0' WHERE cfbc_efb_id = '".$data['efb_id']."' AND cfbc_element = '$element'" ;
              mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO eform_bio_comment (cfbc_comment, cfbc_title, cfbc_element, cfbc_efb_id, cfbc_udate)
              VALUES ('$comment', '$comment_title', '$element', '".$data['efb_id']."', '$date')
              ";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      $strSQL = "UPDATE eform_bio
                 SET efb_".$element." = '0'
                 WHERE
                 efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs'";
      mysqli_query($conn, $strSQL);
      echo "Y";
    }else{
      echo "N3";
    }
  }else{
    echo "N2";
  }

}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
