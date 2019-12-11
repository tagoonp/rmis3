<?php
include "../../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sess_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['next_status'])){
  mysqli_close($conn);
  die();
}


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$y = date("Y");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$next_status = mysqli_real_escape_string($conn, $_POST['next_status']);
$info = mysqli_real_escape_string($conn, $_POST['info']);
$id_progress = mysqli_real_escape_string($conn, $_POST['id_progress']);
$id_ec = mysqli_real_escape_string($conn, $_POST['id_ec']);

$strSQL = "SELECT MAX(rp_ord) mor FROM rec_progress WHERE rp_progress_status > 2 AND rp_year = '$y'";
$query = mysqli_query($conn, $strSQL);
if($query){
  // echo "A";
  $row = mysqli_fetch_assoc($query);
  $ord = $row['mor'] + 1;
  $newid = $y."-".$id_progress.'-'.$ord;
  $strSQL = "UPDATE rec_progress SET rp_ord = '$ord', rp_id_staff = '$id', rp_id_ec = '$id_ec', rp_code_progress = '$newid', rp_id_pm = '$id', rp_progress_status = '$next_status'
            WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$id_progress' AND rp_session = '$sess_id' AND rp_use_status = '1'";
            mysqli_query($conn, $strSQL);

            // echo $strSQL;
}else{
  // echo "B";
  $ord = 1;
  $newid = $y."-".$id_progress.'-'.$ord;
  $strSQL = "UPDATE rec_progress SET rp_ord = '$ord', rp_id_staff = '$id', rp_id_ec = '$id_ec', rp_code_progress = '$newid', rp_id_pm = '$id', rp_progress_status = '$next_status'
            WHERE rp_id_rs = '$id_rs' AND rp_progress_id = '$id_progress' AND rp_session = '$sess_id' AND rp_use_status = '1'";
            mysqli_query($conn, $strSQL);
}

$strSQL = "INSERT INTO rec_progress_log (rpl_activity, rpl_detail, rpl_datetime, rpl_user, rpl_sess_id, rpl_id_rs, rpl_pi_view )
          VALUES ('Change_research_status to $next_status ', '$info', '".date('Y-m-d H:i:s')."', '$id', '$sess_id', '$id_rs', '0')";
mysqli_query($conn, $strSQL);

if($id_progress == '2'){
  $strSQL = "UPDATE rec_progress_2 SET rp2_progress_status = '$next_status' WHERE rp2_key = '$sess_id' AND rp2_id_rs = '$id_rs' AND rp2_conf = '1'";
            mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE rec_progress SET rp_progress_status = '3'
            WHERE rp_id_rs = '$id_rs' AND rp_session = '$sess_id' AND rp_use_status = '1'";
            mysqli_query($conn, $strSQL);
}


$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          INNER JOIN rec_progress i ON a.id_rs = i.rp_id_rs
          WHERE a.id_rs = '$id_rs' AND e.delete_status = '0' AND i.rp_code_progress IS NOT NULL AND i.rp_use_status = '1'";
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
