<?php
include "config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['role']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT * FROM research_init_reviewer
           WHERE rir_id_reviewer = '$id' AND rir_id_rs = '$id_rs' AND rir_summary_status = '0'";

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
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
