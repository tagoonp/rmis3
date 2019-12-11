<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$result = mysqli_real_escape_string($conn, $_POST['result']);
$result_progress = mysqli_real_escape_string($conn, $_POST['result_progress']);

$date = date('Y-m-d H:i:s');

$strSQL = "SELECT * FROM research_assign_fullboard_agendar WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) > 0){

    $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_result = '$result' WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1'";

    if($result == 1){
      $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_result = '$result', rafa_progress = '$result_progress' WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1'";
    }

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
