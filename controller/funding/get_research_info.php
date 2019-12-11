<?php
include "../config.class.php";

if(!isset($_POST['uid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['search_id'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['uid']);
$search_id = mysqli_real_escape_string($conn, $_POST['search_id']);


$strSQL = "SELECT * FROM research a
          LEFT JOIN type_status_research b ON a.id_status_research = b.id_status_research
          LEFT JOIN type_personnel c ON a.id_personnel = c.id_personnel
          LEFT JOIN type_research d ON a.id_type = d.id_type
          LEFT JOIN useraccount e ON a.id_pm = e.id_pm
          LEFT JOIN userinfo g ON e.id = g.user_id
          LEFT JOIN type_prefix f ON g.id_prefix = f.id_prefix
          LEFT JOIN year h ON a.id_year = h.id_year
          WHERE a.code_apdu LIKE '$search_id%' AND e.delete_status = '0'";
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
