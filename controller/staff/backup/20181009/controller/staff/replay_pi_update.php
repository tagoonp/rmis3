<?php
include "../config.class.php";

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
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$next_status = mysqli_real_escape_string($conn, $_POST['next_status']);
$info = mysqli_real_escape_string($conn, $_POST['info']);

$strSQL = "SELECT * FROM research_consider_type WHERE rct_id_rs = '$id_rs' AND rct_conf = '1'";
$query = mysqli_query($conn, $strSQL);

if($query){

  if(mysqli_num_rows($query) > 0){
    if($next_status == 6){
      $next_status = '3';
    }

    $strSQL = "SELECT * FROM research_init_pi_edit_log WHERE pipe_id_rs = '' AND pipe_status = '1'";
    if($query = mysqli_query($conn, $strSQL)){
      $next_status = '28';
    }
  }else{
    $next_status = '3';
  }
}else{
  $next_status = '3';
}

$strSQL = "UPDATE research SET id_status_research = '$next_status' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_correct', '$info', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id )
            VALUES ('Add note', '<p>[System] เอกสารถูกต้อง เจ้าหน้าที่ส่งต่อเลขา EC</p>".$info."', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
  mysqli_query($conn, $strSQL);

  $id_ec = '';
  $strSQL = "SELECT id_ec FROM research WHERE id_rs  = '$id_rs'";
  $resultEc = mysqli_query($conn, $strSQL);
  if($resultEc){
    $data_ec = mysqli_fetch_assoc($resultEc);
    $id_ec = $data_ec['id_ec'];

    $strSQL = "INSERT INTO log_timeline (lt_datetime, lt_id_rs, lt_from_role, lt_to_role, lt_p1, lt_p2, lt_info )
               VALUES ('".date('Y-m-d H:i:s')."', '$id_rs', 'staff', 'ec', '$id', '$id_ec', 'เจ้าหน้าที่ได้เพิ่มผลการตรวจสอบเอกสาร (เอกสารถูกต้อง)')";
    mysqli_query($conn, $strSQL);
  }



  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  // echo "Y";

  $strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_ec = b.id
            INNER JOIN userinfo c ON b.id = c.user_id
            INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
            WHERE a.id_rs = '$id_rs'
            ";
  if($query = mysqli_query($conn, $strSQL)){
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

echo json_encode($return);
mysqli_close($conn);
die();

?>
