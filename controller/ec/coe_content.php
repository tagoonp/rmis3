<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

// $strSQL = "SELECT * FROM research a INNER JOIN research_file_approve_document b ON a.id_rs = b.rfad_id_rs
//           WHERE
//             a.id_rs = '$id_rs' AND b.rfad_doctype = 'COA' AND b.rfad_status = 'buffer' ";
$strSQL = "SELECT * FROM research_expedited_info WHERE rai_id_rs = '$id_rs' AND rai_status = '1'";
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
