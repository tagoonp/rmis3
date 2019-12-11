<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['doctype'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['lang'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$doctype = mysqli_real_escape_string($conn, $_POST['doctype']);
$lang = mysqli_real_escape_string($conn, $_POST['lang']);

$return = [];

$strSQL = "SELECT * FROM research_acknowledge_info a
           WHERE a.rai_id_rs = '$id_rs' AND a.rai_status != '1' AND a.rai_lang = '$lang' AND a.rai_sign_status = '0'
           ORDER BY a.rai_id DESC LIMIT 1
           ";

if($doctype == '2'){
  $strSQL = "SELECT * FROM research_expedited_info a
             WHERE a.rai_id_rs = '$id_rs' AND a.rai_status != '1' AND a.rai_lang = '$lang' AND a.rai_sign_status = '0'
             ORDER BY a.rai_id DESC LIMIT 1
             ";
}


$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}


echo json_encode($return);
mysqli_close($conn);
die();
