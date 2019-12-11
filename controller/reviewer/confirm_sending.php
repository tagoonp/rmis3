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

$asses_1 = '';
$asses_2 = '';
$asses_3 = '';
$asses_4 = '';

if(isset($_POST['asses_1'])){
  $asses_1 = mysqli_real_escape_string($conn, $_POST['asses_1']);
}

if(isset($_POST['asses_2'])){
  $asses_2 = mysqli_real_escape_string($conn, $_POST['asses_2']);
}

if(isset($_POST['asses_3'])){
  $asses_3 = mysqli_real_escape_string($conn, $_POST['asses_3']);
}

if(isset($_POST['asses_4'])){
  $asses_4 = mysqli_real_escape_string($conn, $_POST['asses_4']);
}






$rir_status = '';
$strSQL = "SELECT * FROM research_init_reviewer WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id' AND rir_conf = '1' AND rir_review_success = 'N'";
if($query = mysqli_query($conn, $strSQL)){
  $r = mysqli_fetch_assoc($query);
  $rir_status = $r['rir_status'];
}

$rir_seq = 1;
$strSQL = "SELECT MAX(rir_sending_seq) mrsq FROM research_init_reviewer WHERE rir_status = '$rir_status' AND rir_id_rs = '$id_rs' AND rir_review_success = 'N' AND ris_sending_seq IS NULL";
if($query = mysqli_query($conn, $strSQL)){
  $r = mysqli_fetch_assoc($query);
  $rir_seq = intval($r['mrsq']) + 1;
}

$rir_label = $rir_status."-".$rir_seq;

// $strSQL = "UPDATE research_init_reviewer SET rir_binding_label = '$rir_label', rw_reply_status = '4', rir_sending_seq = '$rir_seq' WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id' AND rir_conf = '1'";
$strSQL = "UPDATE research_init_reviewer SET rir_binding_label = '$rir_label', rw_reply_status = '4' WHERE rir_id_rs = '$id_rs' AND rir_id_reviewer = '$id' AND rir_conf = '1'";
if($query = mysqli_query($conn, $strSQL)){

  $strSQL = "UPDATE research_file_assesment_reply SET fra_conf_status = '1' WHERE rfa_id_rs = '$id_rs' AND rfa_id_reviewer = '$id' AND fra_conf_status = '0'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "DELETE FROM assessment_survey WHERE asq_id_rs = '$id_rs' AND  asq_id_rw = '$id'";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO assessment_survey (asq_1, asq_2, asq_3, asq_4, asq_id_rs, asq_id_rw, asq_datetime) VALUES ('$asses_1','$asses_2','$asses_3','$asses_4','$id_rs','$id', '$date')";
  mysqli_query($conn, $strSQL);

  // echo $strSQL;
  // die();

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
      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                 VALUES ('1', '1', '".$data['efb_gc']."', '$date','$id', '$id_rs', 'bio', '0')
                ";
                mysqli_query($conn, $strSQL);

                $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                           VALUES ('1', '1', '".$data['efb_gc']."', '$date','$id', '$id_rs', 'bio', '0')
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

          $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                     VALUES ('$nrc', '2', '".$row3['cfbc_comment']."', '$date','$id', '$id_rs', 'bio', '0')
                    ";
                    mysqli_query($conn, $strSQL);

          $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                     VALUES ('$nrc', '2', '".$row3['cfbc_comment']."', '$date','$id', '$id_rs', 'bio', '0')
                    ";
                    mysqli_query($conn, $strSQL);

          $insert_id = mysqli_insert_id($conn);

          $strSQL = "UPDATE eform_bio_comment SET cfbc_comment_id = '$insert_id' WHERE cfbc_id = '".$row3['cfbc_id']."'"; mysqli_query($conn, $strSQL);
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
      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                 VALUES ('1', '1', '".$data['efs_gc']."', '$date','$id', '$id_rs', 'social', '0')
                ";
                mysqli_query($conn, $strSQL);

                $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                           VALUES ('1', '1', '".$data['efs_gc']."', '$date','$id', '$id_rs', 'social', '0')
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

          $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                     VALUES ('$nrc', '2', '".$row3['cfsc_comment']."', '$date','$id', '$id_rs', 'social', '0')
                    ";
                    mysqli_query($conn, $strSQL);

                    $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                               VALUES ('$nrc', '2', '".$row3['cfsc_comment']."', '$date','$id', '$id_rs', 'social', '0')
                              ";
                              mysqli_query($conn, $strSQL);

          $insert_id = mysqli_insert_id($conn);

          $strSQL = "UPDATE eform_social_comment SET cfsc_comment_id = '$insert_id' WHERE cfsc_id = '".$row3['cfsc_id']."'";
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
        $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                   VALUES ('1', '1', '".$data['efm_gc']."', '$date','$id', '$id_rs', 'mta', '0')
                  ";
                  mysqli_query($conn, $strSQL);

                  $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                             VALUES ('1', '1', '".$data['efm_gc']."', '$date','$id', '$id_rs', 'mta', '0')
                            ";
                            mysqli_query($conn, $strSQL);
      }
    }

    // 2. Get other comments
    $strSQL = "SELECT * FROM comment_mta WHERE cmta_uby = '$id' AND cmta_id_rs= '$id_rs' AND cmta_use_status = '1'";
    $query = mysqli_query($conn, $strSQL);
    if($query){
      while ($row3 = mysqli_fetch_array($query)) {
        $nrc = 1;
        $strSQL = "SELECT MAX(riwc_seq) mrc FROM research_init_rw_comment WHERE riwc_id_rs = '$id_rs' AND riwc_part = '2'";
        $query3 = mysqli_query($conn, $strSQL);
        if($query3){
          $datas = mysqli_fetch_assoc($query3);
          $nrc = $datas['mrc'] + 1;
        }

        $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                   VALUES ('$nrc', '4', '".$row3['cmta_msg']."', '$date', '$id', '$id_rs', 'mta', '0')
                  ";
                  mysqli_query($conn, $strSQL);

        $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                   VALUES ('$nrc', '4', '".$row3['cmta_msg']."', '$date', '$id', '$id_rs', 'mta', '0')
                 ";
                 mysqli_query($conn, $strSQL);
      }
    }

  //Check ICF th form
  $strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id' AND efi_id_rs = '$id_rs'";
  $query = mysqli_query($conn, $strSQL);

  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $data = mysqli_fetch_assoc($query);

    if($data['efi_gc'] != null){
      $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                 VALUES ('1', '1', '".$data['efi_gc']."', '$date','$id', '$id_rs', 'icf', '0')
                ";
                mysqli_query($conn, $strSQL);

                $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                           VALUES ('1', '1', '".$data['efi_gc']."', '$date','$id', '$id_rs', 'icf', '0')
                          ";
                          mysqli_query($conn, $strSQL);

                          // echo $strSQL;
    }

    $id_efb = $data['efi_id'];

    $strSQL = "SELECT * FROM eform_icf_comment WHERE cfic_efb_id = '$id_efb' AND cfic_status = '1' ";
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

          $strSQL = "INSERT INTO research_init_rw_comment_original (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                     VALUES ('$nrc', '3', '".$row3['cfic_comment']."', '$date','$id', '$id_rs', 'icf', '0')
                    ";
                    mysqli_query($conn, $strSQL);

          $strSQL = "INSERT INTO research_init_rw_comment (riwc_seq, riwc_part, riwc_q, riwc_staff_add_date, riwc_staff_id, riwc_id_rs, riwc_iform, riwc_status)
                     VALUES ('$nrc', '3', '".$row3['cfic_comment']."', '$date','$id', '$id_rs', 'icf', '0')
                    ";
                    mysqli_query($conn, $strSQL);
          $insert_id = mysqli_insert_id($conn);

          $strSQL = "UPDATE eform_icf_comment SET cfic_comment_id = '$insert_id' WHERE cfic_id = '".$row3['cfic_id']."'"; mysqli_query($conn, $strSQL);
      }
    }
  }
  // End checking comment ICF

  $strSQL = "UPDATE eform_mta SET efm_active_status = '0', efm_status = 'sended' WHERE efm_reviewer_id = '$id' AND efm_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE eform_icf SET efi_status = 'sended' WHERE efi_reviewer_id = '$id' AND efi_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE eform_funding SET eff_draft_status = 'sended' WHERE eff_reviewer_id = '$id' AND eff_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE eform_bio SET efb_status = 'sended' WHERE efb_reviewer_id = '$id' AND efb_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  $strSQL = "UPDATE eform_social SET efs_status = 'sended' WHERE efs_reviewer_id = '$id' AND efs_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  echo "Y";
}else{
  echo "N".$strSQL;
}

mysqli_close($conn);
die();

?>
