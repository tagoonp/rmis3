<?php
include "config.class.php";

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];

$strSQL = "SELECT * FROM research_init_rw_comment WHERE riwc_id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  if(mysqli_num_rows($query) > 0){
    echo "Y";
  }else{
    echo "N";
  }
}else{
  echo "N";
}
// echo json_encode($return);
mysqli_close($conn);
die();

?>
