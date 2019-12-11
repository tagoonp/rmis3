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
$c1 = mysqli_real_escape_string($conn, $_POST['eff_c1']);
$c2 = mysqli_real_escape_string($conn, $_POST['eff_c2']);
$c3 = mysqli_real_escape_string($conn, $_POST['eff_c3']);
$c4 = mysqli_real_escape_string($conn, $_POST['eff_c4']);
$c5 = mysqli_real_escape_string($conn, $_POST['eff_c5']);
$c6 = mysqli_real_escape_string($conn, $_POST['eff_c6']);
$eff_totalscore = mysqli_real_escape_string($conn, $_POST['eff_totalscore']);
$eff_summary = mysqli_real_escape_string($conn, $_POST['eff_summary']);
$eff_summary_comment = mysqli_real_escape_string($conn, $_POST['eff_summary_comment']);

$strSQL = "SELECT * FROM eform_funding WHERE eff_reviewer_id = '$id_reviewer' AND eff_id_rs = '$id_rs' AND eff_draft_status = 'draft'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $data = mysqli_fetch_assoc($query);
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){

    $strSQL = "UPDATE eform_funding
              SET
              eff_c1 = '$c1',
              eff_c2 = '$c2',
              eff_c3 = '$c3',
              eff_c4 = '$c4',
              eff_c5 = '$c5',
              eff_c6 = '$c6',
              eff_totalscore = '$eff_totalscore',
              eff_summary = '$eff_summary',
              eff_summary_message = '$eff_summary_comment',
              eff_udate = '$date'
              WHERE eff_reviewer_id = '$id_reviewer' AND eff_id_rs= '$id_rs'
              ";
              mysqli_query($conn, $strSQL);
    echo "Y";

  }else{
    $strSQL = "INSERT INTO eform_funding (eff_c1, eff_c2, eff_c3, eff_c4, eff_c5, eff_c6, eff_totalscore, eff_summary, eff_summary_message, eff_udate, eff_reviewer_id, eff_id_rs)
              VALUES ('$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$eff_totalscore', '$eff_summary', '$eff_summary_comment', '$date', '$id_reviewer', '$id_rs')";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO eform_funding (eff_c1, eff_c2, eff_c3, eff_c4, eff_c5, eff_c6, eff_totalscore, eff_summary, eff_summary_message, eff_udate, eff_reviewer_id, eff_id_rs)
            VALUES ('$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$eff_totalscore', '$eff_summary', '$eff_summary_comment', '$date', '$id_reviewer', '$id_rs')";
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
