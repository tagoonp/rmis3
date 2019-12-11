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


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "UPDATE research_init_reviewer SET rw_reply_status = '4' WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id' AND rir_conf = '1'";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "UPDATE research_file_assesment_reply SET fra_conf_status = '1' WHERE rfa_id_rs = '$id_rs' AND rfa_id_reviewer = '$id' AND fra_conf_status = '0'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO research_new_progress (rwp_title, rwp_info, rwp_id_rs, rwp_datetime, rwp_notify_by)
            VALUES ('ให้เจ้าหน้าที่สรุปผลการประเมินจากผู้เชี่ยวชาญอิสระ' , '', '$id_rs', '".date('Y-m-d H:i:s')."',  '$id')";
  mysqli_query($conn, $strSQL);


  // Check bio th form
  $strSQL = "SELECT * FROM eform_bio WHERE efb_reviewer_id = '$id' AND efb_id_rs= '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    if($data['efb_gc'] != null){
      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                 VALUES ('1', '1', '".$data['efb_gc']."', '$date','$id', '$id_rs', '0')
                ";
                mysqli_query($conn, $strSQL);
    }

    $id_efb = $data['efb_id'];

    $strSQL = "SELECT * FROM eform_bio_comment WHERE cfbc_efb_id = '$id_efb' AND cfbc_status = '1' ";
    $query2 = mysqli_query($conn, $strSQL);

    if($query2){
      while ($row3 = mysqli_fetch_array($query2)) {
        // foreach ($row as $key => $value) {
          $nrc = 1;
          $strSQL = "SELECT MAX(riwc_seq) mrc FROM research_init_rw_comment WHERE riwc_id_rs = '$id_rs' AND riwc_part = '2'";
          $query3 = mysqli_query($conn, $strSQL);
          if($query3){
            $datas = mysqli_fetch_assoc($query3);
            $nrc = $datas['mrc'] + 1;
          }

          $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                     VALUES ('$nrc', '2', '".$row3['cfbc_comment']."', '$date','$id', '$id_rs', '0')
                    ";
                    mysqli_query($conn, $strSQL);
      }
    }
  }
  // End check comment in bio form

  // Check social th form
  $strSQL = "SELECT * FROM eform_social WHERE efs_reviewer_id = '$id' AND efs_id_rs= '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    if($data['efs_gc'] != null){
      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                 VALUES ('1', '1', '".$data['efs_gc']."', '$date','$id', '$id_rs', '0')
                ";
                mysqli_query($conn, $strSQL);
    }

    $id_efb = $data['efs_id'];

    $strSQL = "SELECT * FROM eform_social_comment WHERE cfsc_efb_id = '$id_efb' AND cfsc_status = '1' ";
    $query2 = mysqli_query($conn, $strSQL);

    if($query2){
      while ($row3 = mysqli_fetch_array($query2)) {
        // foreach ($row as $key => $value) {
          $nrc = 1;
          $strSQL = "SELECT MAX(riwc_seq) mrc FROM research_init_rw_comment WHERE riwc_id_rs = '$id_rs' AND riwc_part = '2'";
          $query3 = mysqli_query($conn, $strSQL);
          if($query3){
            $datas = mysqli_fetch_assoc($query3);
            $nrc = $datas['mrc'] + 1;
          }

          $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                     VALUES ('$nrc', '2', '".$row3['cfsc_comment']."', '$date','$id', '$id_rs', '0')
                    ";
                    mysqli_query($conn, $strSQL);
      }
    }
  }
  // End check comment in social form

  // Check mta th form
    // 1. General comment
    $strSQL = "SELECT * FROM eform_mta WHERE efm_reviewer_id = '$id' AND efm_id_rs = '$id_rs' ";
    $query = mysqli_query($conn, $strSQL);
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      $data = mysqli_fetch_assoc($query);
      if($data['efm_gc'] != null){
        $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                   VALUES ('1', '1', '".$data['efm_gc']."', '$date','$id', '$id_rs', '0')
                  ";
                  mysqli_query($conn, $strSQL);
      }
    }

    // Get other comments
    $strSQL = "SELECT * FROM comment_mta WHERE cmta_msg = '$id' AND cmta_id_rs= '$id_rs' AND cmta_use_status = '1'";
    $query = mysqli_query($conn, $strSQL);
    $nrow = mysqli_num_rows($query);
    if($nrow > 0){
      $data = mysqli_fetch_assoc($query);

      $strSQL = "SELECT MAX(riwc_seq) mrc FROM research_init_rw_comment WHERE riwc_id_rs = '$id_rs' AND riwc_part = '2'";
      $query3 = mysqli_query($conn, $strSQL);
      if($query3){
        $datas = mysqli_fetch_assoc($query3);
        $nrc = $datas['mrc'] + 1;
      }

      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_status)
                 VALUES ('$nrc', '2', '".$row3['cmta_msg']."', '$date', '$id', '$id_rs', '0')
                ";
                mysqli_query($conn, $strSQL);
    }



  echo "Y";
}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
