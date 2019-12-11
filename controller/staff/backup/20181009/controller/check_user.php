<?php
include "config.class.php";

if((!isset($_POST['id'])) || (!isset($_POST['role']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

$return = [];
$buffer = [];
$strSQL = '';

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
           INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
           INNER JOIN type_personnel d ON b.id_personnel = d.id_personnel
           WHERE a.id = '$id' AND delete_status = '0' AND allow_status = '1' AND pm_role = '1'";
if($role == 'pm'){
  $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
             -- INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
             -- INNER JOIN type_personnel d ON b.id_personnel = d.id_personnel
             WHERE a.id = '$id' AND delete_status = '0' AND allow_status = '1' AND pm_role = '1'";
}else if($role == 'staff'){
  $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
             INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
             INNER JOIN type_personnel d ON b.id_personnel = d.id_personnel
             WHERE a.id = '$id' AND delete_status = '0' AND allow_status = '1' AND staff_role = '1'";
}else if($role == 'ec'){
  $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
             INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
             WHERE a.id = '$id' AND delete_status = '0' AND allow_status = '1' AND ec_role = '1'";
}else if($role == 'reviewer'){
  $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
             INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
             WHERE a.id = '$id' AND delete_status = '0' AND allow_status = '1' AND reviewer_role = '1'";
}
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
