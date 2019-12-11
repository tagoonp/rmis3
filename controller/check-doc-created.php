<?php
include "config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT init_doc_session, init_doc_lang FROM initial_approval_document
          WHERE
            init_doc_id_rs = '$id_rs'
          GROUP BY init_doc_session, init_doc_lang
          ";
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

foreach ($return as $row) {
  $strSQL = "SELECT "
}
echo json_encode($return);
mysqli_close($conn);
die();

?>
