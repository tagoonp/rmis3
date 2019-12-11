<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("../lib/connect.class.php");
$db = new database();
$db->connect();

$searchkey = '';
$return = [];

if(!isset($_POST['id_rs'])){
  die();
}

$strSQL = "UPDATE research SET id_status_research = '".$_POST['toStatus']."' WHERE id_rs = '".$_POST['id_rs']."'";
$result = $db->update($strSQL);
if($result){
  echo "Y";
}

$strSQL = "INSERT INTO log_research (lr_info, lr_id_rs, lr_by, lr_role, lr_datetime ) VALUES
          ('ปรับปรุงสถานะแบบ bypass เป็น " .$_POST['toStatus']. " (Research_id: " .$_POST['id_rs']. ")',
          '".$_POST['id_rs']."',
          '".$_SESSION['id']."',
          'staff',
          '".date('Y-m-d H:i:s')."')";
$resultInsert = $db->insert($strSQL,false,true);
// echo $strSQL;

$db->disconnect();
die();
?>
