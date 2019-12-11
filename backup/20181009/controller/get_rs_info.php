<?php
require("../lib/connect.class.php");
$db = new database();
$db->connect();

$searchkey = '';
$return = [];

if(isset($_POST['id_rs'])){
  $searchkey = $_POST['id_rs'];
}else{
  die();
}

$strSQL = "SELECT * FROM research a INNER JOIN pm b ON a.id_pm = b.id_pm
          INNER JOIN prefix c ON b.id_prefix = c.id_prefix
          LEFT JOIN type_research d ON a.id_type = d.id_type
          LEFT JOIN status_research e ON a.id_status_research = e.id_status_research
          WHERE a.id_rs = '".$searchkey."'";
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
