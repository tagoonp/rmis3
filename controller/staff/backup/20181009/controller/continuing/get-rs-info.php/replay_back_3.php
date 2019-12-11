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

if(!isset($_POST['ec'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['year'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['dept'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ptype'])){
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
$ec = mysqli_real_escape_string($conn, $_POST['ec']);
$dept = mysqli_real_escape_string($conn, $_POST['dept']);
$ptype = mysqli_real_escape_string($conn, $_POST['ptype']);
$year = mysqli_real_escape_string($conn, $_POST['year']);
$info = mysqli_real_escape_string($conn, $_POST['info']);

$year_code = $year + 42;
$ec_email = '';
$ec_fullname = '';
$strSQL = "SELECT * FROM useraccount a
          INNER JOIN userinfo b ON a.id = b.user_id
          INNER JOIN type_prefix f ON b.id_prefix = f.id_prefix
          WHERE a.id = '$ec' AND a.delete_status = '0'";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $ec_email = $row['email'];
    $ec_fullname = $row['prefix_name'].$row['fname']." ".$row['lname'];
  }
}else{
  mysqli_close($conn);
  die();
}

if($ec_email == ''){
  mysqli_close($conn);
  die();
}

$neworder = 1;
// $strSQL = "SELECT max(ord_id) mord FROM research WHERE id_year = '$year' AND ";
// $query = mysqli_query($conn, $strSQL);
// if($query){
//     while ($row = mysqli_fetch_array($query)) {
//       $neworder = $row['mord'] + 1;
//     }
// }

$strSQL = "SELECT * FROM research WHERE id_year = '$year' AND ord_id != '000' AND code_apdu != '' AND research_status = 'new' ORDER BY ord_id DESC LIMIT 1";
$query = mysqli_query($conn, $strSQL);
$ordIdOnly = '';
if($query){
    // while ($row = mysqli_fetch_array($query)) {
    //   $ordIdOnly[] = intval($row['ord_id']);
    // }

  $data = mysqli_fetch_assoc($query);
  $ordIdOnly = $data['ord_id'];
}

// if($ordIdOnly != ''){
//     $maxData = max($ordIdOnly);
//     $neworder = $maxData + 1;
// }
 $neworder = intval($ordIdOnly) + 1;



if($neworder < 10){
  $neworder = '00'.$neworder;
}else if($neworder < 100){
  $neworder = '0'.$neworder;
}



$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          WHERE a.id_rs = '$id_rs' and a.session_id = '$sess_id'";


if($query = mysqli_query($conn, $strSQL)){
  $rn = mysqli_num_rows($query);
  if($rn > 0){

    while ($row = mysqli_fetch_array($query)) {
      $buffer = [];
      $buffer['fullname'] = $row['prefix_name'].$row['fname']." ".$row['lname'];
      $buffer['email'] = $row['email'];
      $buffer['ec_email'] = $ec_email;
      $buffer['ec_fullname'] = $ec_fullname;
      //
      // $strSQL = "UPDATE research SET code_apdu = '".$year_code."-".$neworder."-".$dept."-".$ptype."', ord_id = '$neworder', id_status_research = '$next_status', id_ec = '$ec', id_year = '$year' WHERE session_id = '$sess_id' AND id_rs = '$id_rs'";
      // $query2 = mysqli_query($conn, $strSQL);
      $query2 = '';
      if($row['code_apdu'] != ''){
        $strSQL = "UPDATE research SET id_status_research = '$next_status', id_ec = '$ec', id_year = '$year', id_dept = '$dept', id_personnel = '$ptype' WHERE session_id = '$sess_id' AND id_rs = '$id_rs'";
        $query2 = mysqli_query($conn, $strSQL);
      }else{
        $strSQL = "UPDATE research SET code_apdu = '".$year_code."-".$neworder."-".$dept."-".$ptype."', ord_id = '$neworder', id_status_research = '$next_status', id_ec = '$ec', id_year = '$year', id_dept = '$dept', id_personnel = '$ptype' WHERE session_id = '$sess_id' AND id_rs = '$id_rs'";
        $query2 = mysqli_query($conn, $strSQL);
      }

      if($query2){
        $buffer['status'] = 'Y';
      }else{
        $buffer['status'] = 'N';
        // $buffer['status'] = $strSQL;
      }

      $buffer['rec_id'] = $year_code."-".$neworder."-".$dept."-".$ptype;

      $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('change_research_status', 'เจ้าหน้าที่ได้เพิ่มผลการตรวจสอบเอกสาร (เอกสารถูกต้องและส่งต่อเลขา EC)', '".date('Y-m-d H:i:s')."', '".$row['id']."')";
      mysqli_query($conn, $strSQL);

      if(($row['id_status_research'] != '8') && ($row['id_status_research'] != '9')){

        $strSQL = "INSERT INTO research_approve_version (rav_id_rs, rav_version_id, rav_update_date )
                   VALUES ('$id_rs', '1', '".date('Y-m-d H:i:s')."')";
        mysqli_query($conn, $strSQL);

      }else{

        $strSQL = "SELECT MAX(rav_version_id) mra FROM research_approve_version WHERE rav_id_rs = '$id_rs'";
        if($q2 = mysqli_query($conn, $strSQL)){
          $rf = mysqli_fetch_assoc($q2);
          $nver = intval($rf['mra']) + 1;

          $strSQL = "INSERT INTO research_approve_version (rav_id_rs, rav_version_id, rav_update_date )
                     VALUES ('$id_rs', '$nver', '".date('Y-m-d H:i:s')."')";
          mysqli_query($conn, $strSQL);
        }else{
          $strSQL = "INSERT INTO research_approve_version (rav_id_rs, rav_version_id, rav_update_date )
                     VALUES ('$id_rs', '1', '".date('Y-m-d H:i:s')."')";
          mysqli_query($conn, $strSQL);
        }
      }


      $return[] = $buffer;

      $strSQL = "UPDATE pm SET id_dept = '$dept', id_personnel = '$ptype' WHERE user_id = '".$row['id']."'";
      $query2 = mysqli_query($conn, $strSQL);

      $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('assign_rec_id', 'เจ้าหน้าทำการระบุรหัสโครงการวิจัย (REC.".$year_code."-".$neworder."-".$dept."-".$ptype.")', '".date('Y-m-d H:i:s')."', '".$row['id']."')";
      mysqli_query($conn, $strSQL);

      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('reply_doc_correct', '$info', '".date('Y-m-d H:i:s')."', '$id_rs', 'Staff : ".$id."')";
      mysqli_query($conn, $strSQL);

      // if($info != ''){
      //   $strSQL = "INSERT INTO research_init_rw_comment (riwc_part, rirc_key, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status, riwc_ustatus)
      //             VALUES ('5', 'Note จากเจ้าหน้าที่ ID : ".$id."', '$info', '$date', '$id', '$id_rs', '4', '1')
      //             ";
      //   mysqli_query($conn, $strSQL);
      //   // echo $strSQL;
      // }

    }
  }


}else{
  mysqli_close($conn);
  die();
}


echo json_encode($return);
mysqli_close($conn);
die();

?>
