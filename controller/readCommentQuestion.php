<?php
include "config.class.php";

if(!isset($_POST['part_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}



$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');
$return = [];

$id_part = mysqli_real_escape_string($conn, $_POST['part_id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

// $strSQL = "SELECT * FROM research_init_reviewer a LEFT JOIN research_init_rw_comment b ON a.rir_id_rs = b.riwc_id_rs"

$strSQL = "SELECT * FROM research_init_rw_comment a
            LEFT JOIN research_init_reviewer b ON a.riwc_staff_id = b.rir_id_reviewer
           WHERE
           a.riwc_id_rs = '$id_rs'
           AND a.riwc_part = '$id_part'
           AND a.riwc_ustatus = '1'
           AND b.rir_id_rs = '$id_rs'
           ORDER BY
           a.riwc_iform, a.riwc_update_seq, a.riwc_part, a.riwc_seq";
$query = mysqli_query($conn, $strSQL);

// echo $strSQL;
// die();

$riwc_id = [];
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    $id = '';
    foreach ($row as $key => $value) {

        if(!is_int($key)){
          $buf[$key] = $value;
        }

        if($key == 'riwc_id'){
          $riwc_id[] = $value;
          // $id = $value;

          // if($row['riwc_iform'] != null){
          //   if($row['riwc_iform'] == 'icf'){
          //     $strSQL = "SELECT * FROM eform_icf_comment WHERE cfic_comment_id = '$id'";
          //     $query2 = mysqli_query($conn, $strSQL);
          //     if($query2){
          //       $data = mysqli_fetch_assoc($query2);
          //       $buf['q_title'] = $data['cfic_title'].$value;
          //     }
          //   }
          // }
        }

        // if($key == 'riwc_iform'){
        //   if($value != null){
        //     if($value == 'icf'){
        //       $strSQL = "SELECT * FROM eform_icf_comment WHERE cfic_comment_id = '$id'";
        //       $query2 = mysqli_query($conn, $strSQL);
        //       if($query2){
        //         $data = mysqli_fetch_assoc($query2);
        //         $buf['q_title'] = $data['cfic_title'];
        //       }
        //     }
        //   }
        // }

        // $q = $row['riwc_id'];
        // if($key == 'riwc_iform'){
        //   if($value == 'bio'){
        //     if(!is_int($q)){
        //       // $strSQL = "SELECT cfbc_title FROM eform_bio_comment WHERE cfbc_comment LIKE '%".substr($q, 0, -1)."%' AND cfbc_status = '1' LIMIT 1";
        //       $strSQL = "SELECT cfbc_element, cfbc_title FROM eform_bio_comment WHERE cfbc_comment_id = '$q'";
        //
        //       $query2 = mysqli_query($conn, $strSQL);
        //       if($query2){
        //         $data = mysqli_fetch_assoc($query2);
        //         $buf['q_title'] = $data['cfbc_title'];
        //         $buf['q_ele'] = $data['cfbc_element'];
        //       }else{
        //         $buf['q_title'] = 'ไม่สามารถระบุได้';
        //         $buf['q_ele'] = 99;
        //       }
        //     }
        //   }else if($value == 'social'){
        //     if(!is_int($q)){
        //       // $strSQL = "SELECT cfsc_title FROM eform_social_comment WHERE cfsc_comment LIKE '%".substr($q, 0, -1)."%' AND cfsc_status = '1' LIMIT 1";
        //       $strSQL = "SELECT cfsc_element, cfsc_title FROM eform_social_comment WHERE cfsc_comment_id = '$q'";
        //       $query2 = mysqli_query($conn, $strSQL);
        //       if($query2){
        //         $data = mysqli_fetch_assoc($query2);
        //         $buf['q_title'] = $data['cfsc_title'];
        //         $buf['q_ele'] = $data['cfsc_element'];
        //       }else{
        //         $buf['q_title'] = 'ไม่สามารถระบุได้';
        //         $buf['q_ele'] = 99;
        //       }
        //     }
        //   }else if($value == 'icf'){
        //     if(!is_int($q)){
        //       // $strSQL = "SELECT cfic_title FROM eform_icf_comment WHERE cfic_comment LIKE '%".substr($q, 0, -1)."%' AND cfic_status = '1' LIMIT 1";
        //       $strSQL = "SELECT cfic_element, cfic_title FROM eform_icf_comment WHERE cfic_comment_id = '$q'";
        //       $query2 = mysqli_query($conn, $strSQL);
        //       if($query2){
        //         $data = mysqli_fetch_assoc($query2);
        //         $buf['q_title'] = $data['cfic_title'];
        //         $buf['q_ele'] = $data['cfic_element'];
        //       }else{
        //         $buf['q_title'] = 'ไม่สามารถระบุได้';
        //         $buf['q_ele'] = '99';
        //       }
        //     }
        //   }else if($value == 'mta'){
        //     $buf['q_title'] = 'ข้อเสนอแนะด้านกฏหมาย';
        //     $buf['q_ele'] = '99';
        //   }else{
        //     if($row['riwc_part']==1){
        //       $buf['q_title'] = 'General comment อื่น ๆ';
        //     }else if($row['riwc_part']==2){
        //       $buf['q_title'] = 'ระเบียบวิธีวิจัยอื่น ๆ';
        //     }else if($row['riwc_part']==3){
        //       $buf['q_title'] = 'กระบวนการขอความยินยอมอื่น ๆ';
        //     }else if($row['riwc_part']==4){
        //       $buf['q_title'] = 'อื่น ๆ';
        //     }
        //     $buf['q_ele'] = '99';
        //   }
        // }
    }
    $return[] = $buf;
  }
}

$riwc_id_i = implode("', '", $riwc_id);

// echo $riwc_id_i;
// die();

foreach ($return as $row) {
  if($row['riwc_iform'] != null){
    if($row['riwc_iform'] == 'icf'){
      $id = $row['riwc_id'];
      $strSQL = "SELECT * FROM eform_icf_comment WHERE cfic_comment_id = '$id'";
      $query2 = mysqli_query($conn, $strSQL);
      if($query2){
        $data = mysqli_fetch_assoc($query2);
        $buf['q_title'] = $data['cfic_title'].$value;
      }else{
        $buf['q_title'] = $strSQL;
      }
    }
  }
}

$strSQL = "SELECT * FROM research_init_rw_comment a
           WHERE
           a.riwc_id_rs = '$id_rs'
           AND a.riwc_id NOT IN ('$riwc_id_i')
           AND a.riwc_part = '$id_part'
           AND a.riwc_ustatus = '1'
           ORDER BY a.riwc_iform, a.riwc_part, a.riwc_seq";

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
        $q = $row['riwc_id'];
        if($key == 'riwc_iform'){
          if($value == 'bio'){
            if(!is_int($q)){
              // $strSQL = "SELECT cfbc_title FROM eform_bio_comment WHERE cfbc_comment LIKE '%".substr($q, 0, -1)."%' AND cfbc_status = '1' LIMIT 1";
              $strSQL = "SELECT cfbc_element, cfbc_title FROM eform_bio_comment WHERE cfbc_comment_id = '$q'";

              $query2 = mysqli_query($conn, $strSQL);
              if($query2){
                $data = mysqli_fetch_assoc($query2);
                $buf['q_title'] = $data['cfbc_title'];
                $buf['q_ele'] = $data['cfbc_element'];
              }else{
                $buf['q_title'] = 'ไม่สามารถระบุได้';
                $buf['q_ele'] = 99;
              }
            }
          }else if($value == 'social'){
            if(!is_int($q)){
              // $strSQL = "SELECT cfsc_title FROM eform_social_comment WHERE cfsc_comment LIKE '%".substr($q, 0, -1)."%' AND cfsc_status = '1' LIMIT 1";
              $strSQL = "SELECT cfsc_element, cfsc_title FROM eform_social_comment WHERE cfsc_comment_id = '$q'";
              $query2 = mysqli_query($conn, $strSQL);
              if($query2){
                $data = mysqli_fetch_assoc($query2);
                $buf['q_title'] = $data['cfsc_title'];
                $buf['q_ele'] = $data['cfsc_element'];
              }else{
                $buf['q_title'] = 'ไม่สามารถระบุได้';
                $buf['q_ele'] = 99;
              }
            }
          }else if($value == 'icf'){
            if(!is_int($q)){
              // $strSQL = "SELECT cfic_title FROM eform_icf_comment WHERE cfic_comment LIKE '%".substr($q, 0, -1)."%' AND cfic_status = '1' LIMIT 1";
              $strSQL = "SELECT cfic_element, cfic_title FROM eform_icf_comment WHERE cfic_comment_id = '$q'";
              $query2 = mysqli_query($conn, $strSQL);
              if($query2){
                $data = mysqli_fetch_assoc($query2);
                $buf['q_title'] = $data['cfic_title'];
                $buf['q_ele'] = $data['cfic_element'];
              }else{
                $buf['q_title'] = 'ไม่สามารถระบุได้';
                $buf['q_ele'] = '99';
              }
            }
          }else if($value == 'mta'){
            $buf['q_title'] = 'ข้อเสนอแนะด้านกฏหมาย';
            $buf['q_ele'] = '99';
          }else{
            if($row['riwc_part']==1){
              $buf['q_title'] = 'General comment อื่น ๆ';
            }else if($row['riwc_part']==2){
              $buf['q_title'] = 'ระเบียบวิธีวิจัยอื่น ๆ';
            }else if($row['riwc_part']==3){
              $buf['q_title'] = 'กระบวนการขอความยินยอมอื่น ๆ';
            }else if($row['riwc_part']==4){
              $buf['q_title'] = 'อื่น ๆ';
            }
            $buf['q_ele'] = '99';
          }
        }
    }
    $return[] = $buf;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();


?>
