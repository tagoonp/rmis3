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

  $strSQL = "SELECT * FROM research_prototype_document_reference WHERE rpdr_id_rs = '$id_rs' AND rpdr_ref = '$refnp'";
  $query = mysqli_query($conn, $strSQL);
  if(!$query){
    echo "N";
  }else{

    $nr = mysqli_num_rows($query);

    if($nr == 0){
      echo "N";
    }
    else{
      $strSQL = "UPDATE research_prototype_document_reference SET rpdr_conf_status = 1
                WHERE rpdr_id_rs = '$id_rs' AND rpdr_ref = '$refnp'
                ";
      if($query = mysqli_query($conn, $strSQL)){
        $strSQL = "SELECT * FROM research_prototype_document_reference WHERE rpdr_id_rs = '$id_rs' AND rpdr_ref = '$refnp' AND rpdr_conf_status = 1";
        if($query = mysqli_query($conn, $strSQL)){
          echo "Y";
        }
      }
    }

  }
}

mysqli_close($conn);
die();

?>
