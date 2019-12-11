<?php
include "../config.class.php";


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$strSQL = "SELECT *
          FROM useraccount a
          INNER JOIN userinfo b ON a.id = b.user_id
          INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
          WHERE a.delete_status = '0' AND a.staff_role = '1'";

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
