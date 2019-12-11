<?php
include "config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['searchRec']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$rec = mysqli_real_escape_string($conn, $_POST['searchRec']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT * FROM research
          WHERE
            code_apdu = '$rec'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nr = mysqli_num_rows($query);
  if($nr > 0){

    $strSQL = "SELECT * FROM rec WHERE id_apdu = '$rec'";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      $nr2 = mysqli_num_rows($query);
      if($nr > 0){
        echo "Y";
        mysqli_close($conn);
        die();
      }else{
        echo "No in rec";
        mysqli_close($conn);
        die();
      }
    }else{
      echo "No in rec";
      mysqli_close($conn);
      die();
    }

  }else{
    echo "No apdu";
    mysqli_close($conn);
    die();
  }
}else{
  echo "No apdu";
  mysqli_close($conn);
  die();
}


mysqli_close($conn);
die();

?>
