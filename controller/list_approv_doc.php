<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}


$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$doc_lv = '1';

$return = [];
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM initial_approval_document WHERE init_doc_id_rs = '$id_rs'";
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


?>
