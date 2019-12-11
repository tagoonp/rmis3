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
$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  $data = mysqli_fetch_assoc($query);
  $id_status = $data['id_status_research'];
}else{
  die();
}

$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN dept dd ON g.id_dept = dd.id_dept
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id' AND e.delete_status = '0'";

if(($id_status != '') && (($id_status == 19) || ($id_status == 20) || ($id_status == 21) || ($id_status == 28))){

  $strSQL2 = "SELECT * FROM research_consider_type WHERE rct_id_rs = '$id_rs'";
  if($qr = mysqli_query($conn, $strSQL2)){
    if(mysqli_num_rows($qr) > 0){
      $strSQL = "SELECT * FROM research a
                INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
                INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
                INNER JOIN type_research d ON a.id_type = d.id_type
                INNER JOIN useraccount e ON a.id_pm = e.id_pm
                INNER JOIN userinfo g ON e.id = g.user_id
                INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
                INNER JOIN year h ON a.id_year = h.id_year
                INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
                WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id' AND e.delete_status = '0'";
    }else{
      $strSQL = "SELECT * FROM research a
                INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
                INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
                INNER JOIN type_research d ON a.id_type = d.id_type
                INNER JOIN useraccount e ON a.id_pm = e.id_pm
                INNER JOIN userinfo g ON e.id = g.user_id
                INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
                INNER JOIN year h ON a.id_year = h.id_year
                WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id' AND e.delete_status = '0'";
    }
  }else{
    $strSQL = "SELECT * FROM research a
              INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
              INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
              INNER JOIN type_research d ON a.id_type = d.id_type
              INNER JOIN useraccount e ON a.id_pm = e.id_pm
              INNER JOIN userinfo g ON e.id = g.user_id
              INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
              INNER JOIN year h ON a.id_year = h.id_year
              WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id' AND e.delete_status = '0'";
  }

}

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){

          // if(($key == 'dept') && (($value != '') || ($value != null))){
          //   $b = explode('&nbsp;', $value);
          //   if(sizeof($b) > 0){
          //     $buf['dept'] = implode('&nbsp;', $b);
          //   }else{
          //     $buf['dept'] = $value;
          //   }
          //
          // }else{
          //   $buf[$key] = $value;
          // }

          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}


echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
