<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_status = '';
$strSQL = "SELECT * FROM research a INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs WHERE a.id_rs = '$id_rs'";
$contype = '';
$doc_table = '';

if($query = mysqli_query($conn, $strSQL)){
  $data = mysqli_fetch_assoc($query);
  $id_status = $data['id_status_research'];
  $contype = $data['rct_type'];
}else{
  mysqli_close($conn);
  die();
}

if($contype == 'Exempt'){
  $doc_table = 'research_acknowledge_info';
}else if($contype == 'Expedited'){
  $doc_table = 'research_expedited_info';
}else if($contype == 'Fullboard (Bio)'){
  // $doc_table = 'research_fullboard_info';
  $doc_table = 'research_expedited_info';
}else if($contype == 'Fullboard (Social)'){
  // $doc_table = 'research_fullboard_info';
  $doc_table = 'research_expedited_info';
}

$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          INNER JOIN research_assign_fullboard_agendar j ON a.id_rs = j.rafa_id_rs
          INNER JOIN ".$doc_table." k ON a.id_rs = k.rai_id_rs
          WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id' AND k.rai_status = '1'";


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
