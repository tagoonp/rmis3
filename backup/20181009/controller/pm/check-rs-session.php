<?php
include "../config.class.php";

if((!isset($_POST['id']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$id'";
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

$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm' AND id_rs = '$id_rs' AND delete_flag = 'N' ";
$query = mysqli_query($conn, $strSQL);

$ryear = '';

if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;

          if($key == 'id_year'){
            $ryear = $value;
          }

          if($key == 'session_id'){
            if($value == ''){
              $sess = generateRandomString(20);
              $strSQL = "UPDATE research SET session_id = '$sess' WHERE id_pm = '$id_pm' AND id_rs = '$id_rs'";
              mysqli_query($conn, $strSQL);
              $buf['session_id'] = $sess;
            }
          }

          if($key == 'submit_year'){
            if($value == 'na'){
              $sy = intval(date('Y')) - $ryear + 18;
              $strSQL = "UPDATE research SET submit_year = '$sy' WHERE id_pm = '$id_pm' AND id_rs = '$id_rs'";
              mysqli_query($conn, $strSQL);
              $buf['submit_year'] = $sy;
            }
          }
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
