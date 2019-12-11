<?php
include "../config.class.php";

$return = [];
$return_data = '';
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$status = mysqli_real_escape_string($conn, $_POST['status']);

// $msg_send = mysqli_real_escape_string($conn, $_POST['msg_send']);
// $recom_status = mysqli_real_escape_string($conn, $_POST['recom_status']);


// $strSQL = "UPDATE research_init_reviewer_summary_file SET rirsf_status = '1' WHERE rirsf_id_rs_buffer = '$id_rs'";
// if(mysqli_query($conn, $strSQL)){
//
//   $strSQL = "DELETE FROM research_init_reviewer_summary WHERE rirs_id_rs = '$id_rs'";
//   mysqli_query($conn, $strSQL);
//
//   $strSQL = "INSERT INTO research_init_reviewer_summary (rirs_id_rs, rirs_note, rirs_datetime, rirs_status, rirs_by)
//             VALUES ('$id_rs', '$msg_send', '".date('Y-m-d H:i:s')."', '$recom_status', '$id') ";
//   if($query = mysqli_query($conn, $strSQL)){
//
//     $strSQL = "UPDATE research SET id_status_research = '6' WHERE id_rs = '$id_rs'";
//     mysqli_query($conn, $strSQL);
//
//
//
//     $strSQL = "SELECT * FROM research a INNER JOIN research_init_reviewer_summary b ON a.id_rs = b.rirs_id_rs
//               INNER JOIN useraccount c ON a.id_ec = c.id
//               INNER JOIN userinfo d ON c.id = d.user_id
//               INNER JOIN type_prefix e ON e.id_prefix = d.id_prefix
//               WHERE a.id_rs = '$id_rs'";
//     if($query = mysqli_query($conn, $strSQL)){
//
//       $return['status'] = 'Y';
//
//       $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
//       mysqli_query($conn, $strSQL);
//
//       while ($row = mysqli_fetch_assoc($query)) {
//         $buf = [];
//         foreach ($row as $key => $value) {
//             if(!is_int($key)){
//               $buf[$key] = $value;
//             }
//
//             if($key == 'rirs_id'){
//               $strSQL = "UPDATE research_init_reviewer_summary_file SET rirsf_rirs_id = '$value' WHERE rirsf_id_rs_buffer = '$id_rs'";
//               mysqli_query($conn, $strSQL);
//             }
//         }
//         $return_data[] = $buf;
//       }
//     }
//   }
// }


$strSQL = "UPDATE research SET id_status_research = '6' WHERE id_rs = '$id_rs'";
if(mysqli_query($conn, $strSQL)){
  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
            mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เจ้าหน้าส่งผลการประเมินไปยังเลขา EC</p>', '$ip_add', '$date', '$id_rs', 'staff', '$id')";
  mysqli_query($conn, $strSQL);

  if($status == '4'){
    $strSQL = "UPDATE dis_approve_project
               SET dis_status = '1'
               WHERE dis_id_rs = '$id_rs'
               ORDER BY dis_reg_datetime DESC
               LIMIT 1" ;
    mysqli_query($conn, $strSQL);
  }

  echo "Y";
}else{
  echo "N";
}



// echo json_encode($return);
mysqli_close($conn);
die();

?>
