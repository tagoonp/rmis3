<?php

header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");

$host = 'localhost';
$user = 'root';
$password = 'mandymorenn';
$dbname = 'esman';
$conn = mysqli_connect($host, $user, $password, $dbname);


if (!$conn) {
  echo "string";
  die();
}

$conn->set_charset("utf8");


$strSQL = "SELECT * FROM tb_inddata_thesis WHERE 1";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
         // $buf = [];
         // foreach ($row as $key => $value) {
         //     if(!is_int($key)){
         //       $buf[$key] = $value;
         //     }
         // }
         // $return[] = $buf;\
      $ind_id = $row['ind_id'];

      $strSQL = "SELECT * FROM tb_indicator7 WHERE ind_id = '$ind_id' AND status = '1'";
      $query2 = mysqli_query($conn, $strSQL);
      if($query2){
        $nrow = mysqli_num_rows($query2);
        if($nrow > 0){
          $strSQL = "UPDATE tb_inddata_thesis SET preterm = 'yes' WHERE ind_id = '$ind_id'";
          mysqli_query($conn, $strSQL);
        }

      }

      $strSQL = "SELECT * FROM tb_indicator8 WHERE ind_id = '$ind_id' AND status = '1'";
      $query2 = mysqli_query($conn, $strSQL);
      if($query2){
        $nrow = mysqli_num_rows($query2);
        if($nrow > 0){
          $strSQL = "UPDATE tb_inddata_thesis SET lbw = 'yes' WHERE ind_id = '$ind_id'";
          mysqli_query($conn, $strSQL);
        }

      }

      $strSQL = "SELECT * FROM tb_indicator5 WHERE ind_id = '$ind_id' AND status = '1'";
      $query2 = mysqli_query($conn, $strSQL);
      if($query2){
        $nrow = mysqli_num_rows($query2);
        if($nrow > 0){
          $strSQL = "UPDATE tb_inddata_thesis SET cs = 'yes' WHERE ind_id = '$ind_id'";
          mysqli_query($conn, $strSQL);
        }

      }
  }

  echo "Y";
}

?>
