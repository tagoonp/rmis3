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
// $by = mysqli_real_escape_string($conn, $_POST['by']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

// if($by == 'id_rs'){
//
// }else{
//
// }


// $strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs' AND delete_flag = 'N' AND sendding_status = 'Y' AND ord_id != '000' ";
$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs' AND delete_flag = 'N' AND sendding_status = 'Y' ";
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
              $strSQL = "UPDATE research SET session_id = '$sess' WHERE id_rs = '$id_rs'";
              mysqli_query($conn, $strSQL);
              $buf['session_id'] = $sess;
            }
          }

          if($key == 'submit_year'){
            if($value == 'na'){
              $sy = intval(date('Y')) - $ryear + 18;
              $strSQL = "UPDATE research SET submit_year = '$sy' WHERE id_rs = '$id_rs'";
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
