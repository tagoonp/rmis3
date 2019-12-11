<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);


$strSQL = "SELECT * FROM research_init_reviewer a
          LEFT JOIN useraccount b ON a.rir_id_reviewer = b.id
          LEFT JOIN userinfo c ON a.rir_id_reviewer = c.user_id
          LEFT JOIN type_prefix d ON c.id_prefix = d.id_prefix
          LEFT JOIN research e ON a.rir_id_rs = e.id_rs
          LEFT JOIN research_consider_type f ON a.rir_id_rs = f.rct_id_rs
          WHERE a.rir_id_rs = '$id_rs' AND a.rir_conf = '1' AND b.delete_status = '0' ORDER BY a.rir_id";
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
