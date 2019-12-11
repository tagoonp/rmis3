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

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$cm_id = '';

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);
$efb_gc = mysqli_real_escape_string($conn, $_POST['efb_gc']);
$efb_42 = mysqli_real_escape_string($conn, $_POST['efb_42']);
$efb_42_comment = mysqli_real_escape_string($conn, $_POST['efb_42_comment']);

$strSQL = "SELECT * FROM eform_mta WHERE efm_reviewer_id = '$id_reviewer' AND efm_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $data = mysqli_fetch_assoc($query);
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    if($data['efm_status'] != 'draft'){
      $strSQL = "UPDATE eform_mta
                SET
                efm_gc = '$efb_gc',
                efm_conclustion = '$efb_42',
                efm_conclusion_comment = '$efb_42_comment',
                efm_udate = '$date'
                WHERE efm_reviewer_id = '$id_reviewer' AND efm_id_rs= '$id_rs'
                ";
                mysqli_query($conn, $strSQL);
    }else{
      $strSQL = "UPDATE eform_mta
                SET
                efm_gc = '$efb_gc',
                efm_conclustion = '$efb_42',
                efm_conclusion_comment = '$efb_42_comment',
                efm_status = 'draft',
                efm_udate = '$date'
                WHERE efm_reviewer_id = '$id_reviewer' AND efm_id_rs= '$id_rs'
                ";
                mysqli_query($conn, $strSQL);
    }

    echo "Y";
    // echo $strSQL;
  }else{
    $strSQL = "INSERT INTO eform_mta (efm_gc, efm_conclustion, efm_conclusion_comment, efm_status, efm_udate, efm_reviewer_id, efm_id_rs)
              VALUES ('$efb_gc', '$efb_42', '$efb_42_comment', 'draft', '$date', '$id_reviewer', '$id_rs')";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO eform_mta (efm_gc, efm_conclustion, efm_conclusion_comment, efm_status, efm_udate, efm_reviewer_id, efm_id_rs)
            VALUES ('$efb_gc', '$efb_42', '$efb_42_comment', 'draft', '$date', '$id_reviewer', '$id_rs')";
  $result = mysqli_query($conn, $strSQL);
  if($result){
    echo "Y";
  }else{
    echo $strSQL;
  }
}

mysqli_close($conn);
die();

?>
