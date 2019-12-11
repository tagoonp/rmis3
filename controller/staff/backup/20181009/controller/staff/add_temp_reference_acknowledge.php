<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['refNumber'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$refnp = mysqli_real_escape_string($conn, $_POST['refNumber']);


$strSQL = "SELECT * FROM research
          WHERE id_rs = '$id_rs' ";


if($query = mysqli_query($conn, $strSQL)){
  $strSQL = "INSERT INTO research_prototype_document_reference (rpdr_id_rs, rpdr_save_date, rpdr_ref, rpdr_by)
            VALUES ('$id_rs', '$date', '$refnp', '$id')";
  if($query = mysqli_query($conn, $strSQL)){
    echo "Y";
  }
}

mysqli_close($conn);
die();

?>
