<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

// $strSQL = "SELECT * FROM useraccount a
//           INNER JOIN reviewer b ON a.id = b.account_id
//           INNER JOIN type_prefix f ON b.id_prefix = f.id_prefix
//           WHERE a.usertype = 'reviewer' AND a.delete_status = '0' ORDER BY b.fname";

$strSQL = "SELECT * FROM research_init_reviewer_summary a INNER JOIN research_init_reviewer_summary_file b ON a.rirs_id = b.rirsf_rirs_id
          WHERE a.rirs_id_rs = '$id_rs'
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


echo json_encode($return);
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
