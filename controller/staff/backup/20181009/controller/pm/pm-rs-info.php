<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  echo "string-1";
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess'])){
  echo "string0";
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess']);


$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id WHERE a.id = '$id'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
  }else{
    echo "string1";
    mysqli_close($conn);
    die();
  }
}else{
  echo "string2";
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  echo "string3";
  mysqli_close($conn);
  die();
}
$return = [];

$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
          INNER JOIN userinfo  d ON b.id = d.user_id
          -- INNER JOIN dept e ON d.id_dept = e.id_dept
          LEFT JOIN type_research e ON a.id_type = e.id_type
          WHERE a.id_pm = '$id_pm' and a.session_id = '$sess_id'";
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
