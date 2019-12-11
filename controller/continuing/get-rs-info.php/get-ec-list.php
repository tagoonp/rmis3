<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM useraccount a
          INNER JOIN userinfo b ON a.id = b.user_id
          INNER JOIN type_prefix f ON b.id_prefix = f.id_prefix
          WHERE a.ec_role = '1' AND a.active_status = '1' AND a.delete_status = '0'";
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
