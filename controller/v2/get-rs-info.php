<?php
include "../config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_status = '';

$strSQL = "SELECT * FROM research a LEFT JOIN type_status_research b ON a.id_status_research = b.id_status_research
           LEFT JOIN type_personnel c ON a.id_personnel = c.id_personnel
           LEFT JOIN type_research d ON a.id_type = d.id_type
           LEFT JOIN useraccount e ON a.id_pm = e.id_pm
           LEFT JOIN userinfo g ON e.id = g.user_id
           LEFT JOIN dept dd ON g.id_dept = dd.id_dept
           LEFT JOIN year h ON a.id_year = h.id_year
           WHERE
            a.id_rs = '$id_rs'
            AND e.delete_status = '0'
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

echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($conn);
die();

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

          if($key == 'id_ec'){
            $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$value'";
            $res = mysqli_query($conn, $strSQL);
            $row_b = mysqli_fetch_assoc($res);
            $buf['rct_ec_name'] = $row_b['fname']." ".$row_b['lname'];
          }

          if($key == 'rct_fb_ec'){
            $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$value'";
            $res = mysqli_query($conn, $strSQL);
            $row_b = mysqli_fetch_assoc($res);
            $buf['rct_fb_name'] = $row_b['fname']." ".$row_b['lname'];
          }

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
