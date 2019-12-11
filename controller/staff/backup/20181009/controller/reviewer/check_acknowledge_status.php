<?php
include "../config.class.php";

if((!isset($_POST['user']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

$user = mysqli_real_escape_string($conn, $_POST['user']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");


$strSQL = "SELECT * FROM research_init_reviewer WHERE rir_id_rs = '$id_rs' AND rir_conf = '1' AND rw_sending_status = '1' AND rir_id_reviewer = '$user' ";
$query = mysqli_query($conn, $strSQL);

$ryear = '';

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

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
