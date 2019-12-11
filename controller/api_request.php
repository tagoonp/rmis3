<?php
include "config.class.php";

if((!isset($_POST['api_key'])) || (!isset($_POST['username'])) || (!isset($_POST['password']))){
  mysqli_close($conn);
  die();
}

$api_key = mysqli_real_escape_string($conn, $_POST['api_key']);
$email = mysqli_real_escape_string($conn, $_POST['username']);
$password = base64_encode(mysqli_real_escape_string($conn, $_POST['password']));

$return = [];
$buffer = [];

$strSQL = "SELECT * FROM useraccount a
            LEFT JOIN userinfo  b ON a.id = b.user_id
            LEFT JOIN type_personnel d ON b.id_personnel = d.id_personnel
           WHERE
           (a.email = '$email' OR a.username = '$email')
           AND a.password = '$password'
           AND a.delete_status = '0' AND a.allow_status = '1'";
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
