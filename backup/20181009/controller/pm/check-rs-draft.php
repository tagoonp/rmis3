<?php
include "../config.class.php";

if((!isset($_POST['id']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
WHERE a.id = '$id'  AND a.delete_status = '0'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
  }else{
    mysqli_close($conn);
    die();
  }
}else{
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  mysqli_close($conn);
  die();
}

// $strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm' AND draft_status = '1' AND delete_flag = 'N' AND sendding_status = 'N' AND (code_apdu = '' OR code_apdu IS NULL)";
$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm'
          AND delete_flag = 'N' AND sendding_status = 'N' AND (code_apdu = '' OR code_apdu IS NULL) AND research_status = 'new'";
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
