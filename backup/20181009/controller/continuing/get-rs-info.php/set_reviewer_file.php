<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ririd'])){
  mysqli_close($conn);
  die();
}




$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$ririd = mysqli_real_escape_string($conn, $_POST['ririd']);

$strSQL = "DELETE FROM research_init_reviewer_file_attached WHERE rif_rir_id = '$ririd'";
mysqli_query($conn, $strSQL);

if(isset($_POST['file1'])){
  if($_POST['file1'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file1']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file2'])){
  if($_POST['file2'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file2']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file3'])){
  if($_POST['file3'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file3']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file4'])){
  if($_POST['file4'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file4']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file5'])){
  if($_POST['file5'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file5']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file6'])){
  if($_POST['file6'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file6']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file7'])){
  if($_POST['file7'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file7']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

if(isset($_POST['file8'])){
  if($_POST['file8'] != '0'){
    $strSQL = "INSERT INTO research_init_reviewer_file_attached (rif_fileid, rif_rir_id, rif_adddatetime, rif_addby)
              VALUES ('".$_POST['file8']."', '$ririd', '".date('Y-m-d H:i:s')."', '$id')
              ";
    mysqli_query($conn, $strSQL);
  }
}

echo 'Y';
mysqli_close($conn);
die();

?>
