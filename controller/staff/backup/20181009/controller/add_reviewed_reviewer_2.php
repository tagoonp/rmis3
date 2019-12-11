<?php
include "config.class.php";

if(!isset($_POST['reviewer_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ssid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$return = [];
$id_reviewer = mysqli_real_escape_string($conn, $_POST['reviewer_id']);
$id_session = mysqli_real_escape_string($conn, $_POST['ssid']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$rtype = mysqli_real_escape_string($conn, $_POST['rtype']);


// $cstage = 'Reviewer 1';
$strSQL = "SELECT * FROM research_init_reviewer WHERE rir_id_reviewer = '$id_reviewer' AND rir_id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);

if(!$query){

  $strSQL = "INSERT INTO research_init_reviewer (rir_id_reviewer, rir_session, rir_id_rs) VALUES ('$id_reviewer', '$id_session', '$id_rs')";
  $query = mysqli_query($conn, $strSQL);

  if($query){

    $strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN useraccount b on a.rir_id_reviewer = b.id
              INNER JOIN userinfo c ON b.id = c.user_id
              INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
              WHERE a.rir_id_rs = '$id_rs' AND a.rir_conf = '0' ";
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

  }

}else{

  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN useraccount b on a.rir_id_reviewer = b.id
              INNER JOIN userinfo c ON b.id = c.user_id
              INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
              WHERE a.rir_id_rs = '$id_rs'  AND a.rir_conf = '0' ORDER BY a.rir_id";
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
  }else{

    $strSQL = "INSERT INTO research_init_reviewer (rir_id_reviewer, rir_status, rir_session, rir_id_rs) VALUES ('$id_reviewer', '$rtype', '$id_session', '$id_rs')";
    $query = mysqli_query($conn, $strSQL);

    if($query){

      $strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN useraccount b on a.rir_id_reviewer = b.id
                INNER JOIN userinfo c ON b.id = c.user_id
                INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
                WHERE a.rir_id_rs = '$id_rs'  AND a.rir_conf = '0' ORDER BY a.rir_id";
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

    }
  }

}





echo json_encode($return);
mysqli_close($conn);
die();


?>
