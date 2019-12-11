<?php
require("../lib/connect.class.php");
$db = new database();
$db->connect();

$searchkey = '';
$return = [];

$strSQL = "SELECT * FROM status_research
          WHERE 1";
$result = $db->select($strSQL,false,true);
if($result){
  foreach ($result as $row) {
    $buffer = [];
    foreach ($row as $key => $value) {
      if(!is_int($key)){
        $buffer[$key] = $value;
      }
    }
    $return[] = $buffer;
  }
}

echo json_encode($return);
$db->disconnect();
die();
?>
