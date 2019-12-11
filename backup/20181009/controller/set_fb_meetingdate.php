<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$mdate = mysqli_real_escape_string($conn, $_POST['mdate']);
$date = date('Y-m-d H:i:s');

$strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) > 0){

    $md = explode('-', $mdate);
    $md2 = ($md[0] - 543) . "-" . $md[1] . "-" . $md[2];
    $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_date = '$md2' WHERE rafa_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    echo "Y";

  }else{
    echo "N";
  }
}else{
  echo "N";
}

mysqli_close($conn);
die();
?>
