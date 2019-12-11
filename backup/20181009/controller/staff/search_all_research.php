<?php
include "../config.class.php";

$searchkey = '';
$return = [];

if(isset($_POST['searchkey'])){
  $searchkey = $_POST['searchkey'];
}else{
  echo "'asd'";
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
          INNER JOIN userinfo z ON b.id = z.user_id
          INNER JOIN type_prefix c ON z.id_prefix = c.id_prefix
          LEFT JOIN type_research d ON a.id_type = d.id_type
          LEFT JOIN type_status_research e ON a.id_status_research = e.id_status_research
          WHERE
          a.delete_flag = 'N' AND a.code_apdu != '' AND a.sendding_status = 'Y' AND a.research_status = 'new' AND b.delete_status = '0'
          AND a.id_year = '".$_POST['year']."'
          AND a.id_rs NOT IN (SELECT id_rs FROM rec WHERE 1)
          AND
          (  a.title_th LIKE '%".$searchkey."%'
            OR a.title_en LIKE '%".$searchkey."%'
            OR z.fname LIKE '%".$searchkey."%'
            OR z.lname LIKE '%".$searchkey."%'
            OR a.code_apdu LIKE '%".$searchkey."%'
            OR b.id_pm = '".$searchkey."' )
          ORDER BY a.id_rs DESC
          ";
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
