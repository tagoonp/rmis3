<?php
require("../lib/connect.class.php");
$db = new database();
$db->connect();

$searchkey = '';
$return = [];

if(isset($_POST['searchKey'])){
  $searchkey = $_POST['searchKey'];
}else{
  die();
}

$strSQL = "SELECT * FROM research a INNER JOIN pm b ON a.id_pm = b.id_pm
          INNER JOIN prefix c ON b.id_prefix = c.id_prefix
          LEFT JOIN type_research d ON a.id_type = d.id_type
          LEFT JOIN status_research e ON a.id_status_research = e.id_status_research
          WHERE a.delete_flag = 'N' AND a.code_apdu != '' AND a.sendding_status = 'Y' AND a.research_status = 'new'
          AND
          (  a.title_th LIKE '%".$searchkey."%'
            OR a.title_en LIKE '%".$searchkey."%'
            OR b.name LIKE '%".$searchkey."%'
            OR b.surname LIKE '%".$searchkey."%'
            OR a.code_apdu LIKE '%".$searchkey."%'
            OR b.id_pm = '".$searchkey."' )
          ORDER BY a.id_rs DESC
          ";
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
