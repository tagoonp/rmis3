<?php
include "config.class.php";

$rwid = mysqli_real_escape_string($conn, $_POST['c_id']);
$current_seq = mysqli_real_escape_string($conn, $_POST['c_seq']);
$new_seq = mysqli_real_escape_string($conn, $_POST['n_seq']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$fnc = mysqli_real_escape_string($conn, $_POST['f']);
$part = mysqli_real_escape_string($conn, $_POST['ipart']);

$return = [];

if($fnc == 'up'){
  // $strSQL = "SELECT riwc_id FROM research_init_rw_comment
  //           WHERE
  //             riwc_id_rs = '$id_rs'
  //             AND riwc_part = '$part'
  //             AND riwc_seq = '$new_seq'";

  $strSQL = "UPDATE research_init_rw_comment
            SET riwc_seq = '$current_seq'
            WHERE
              riwc_id_rs = '$id_rs'
              AND riwc_part = '$part'
              AND riwc_seq = '$new_seq'
              AND riwc_ustatus = '1'
            ";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_init_rw_comment
            SET riwc_seq = '$new_seq'
            WHERE
              riwc_id_rs = '$id_rs'
              AND riwc_part = '$part'
              AND riwc_seq = '$current_seq'
              AND riwc_ustatus = '1'
              AND riwc_id = '$rwid'
            ";
  mysqli_query($conn, $strSQL);

  // echo $strSQL;
  echo "Y";

}else{
  $strSQL = "UPDATE research_init_rw_comment
            SET riwc_seq = '$current_seq'
            WHERE
              riwc_id_rs = '$id_rs'
              AND riwc_part = '$part'
              AND riwc_seq = '$new_seq'
              AND riwc_ustatus = '1'
            ";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_init_rw_comment
            SET riwc_seq = '$new_seq'
            WHERE
              riwc_id_rs = '$id_rs'
              AND riwc_part = '$part'
              AND riwc_seq = '$current_seq'
              AND riwc_ustatus = '1'
              AND riwc_id = '$rwid'
            ";
  mysqli_query($conn, $strSQL);

  // echo $strSQL;
  echo "Y";
}

mysqli_close($conn);
die();
?>
