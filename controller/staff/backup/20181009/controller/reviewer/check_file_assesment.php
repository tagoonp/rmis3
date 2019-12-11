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


$strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN research_init_reviewer_file_attached b ON a.rir_id = b.rif_rir_id
          INNER JOIN file_assesment c ON b.rif_fileid = c.fid
          WHERE
          a.rir_id_rs = '$id_rs' AND a.rir_id_reviewer = '$id' AND a.rw_sending_status = '1' ";
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
