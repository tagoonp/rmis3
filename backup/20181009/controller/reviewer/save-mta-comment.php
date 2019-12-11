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
$cm_id = mysqli_real_escape_string($conn, $_POST['cm_id']);
$com_msg = mysqli_real_escape_string($conn, $_POST['com_msg']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);

if($cm_id == ''){
  $strSQL = "INSERT INTO comment_mta (cmta_id_rs, cmta_msg, cmta_udate, cmta_uby) VALUES ('$id_rs', '$com_msg', '$date', '$id_reviewer')";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
  }else{
    echo "N";
  }
}else{
  $strSQL = "UPDATE comment_mta
            SET
            cmta_msg = '$com_msg',
            cmta_udate = '$date'
            WHERE
            cmta_id_rs = '$id_rs'
            AND cmta_id = '$cm_id'
            AND cmta_uby = '$id_reviewer'
          ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    echo "Y";
  }else{
    echo "N";
  }
}

mysqli_close($conn);
die();

?>
