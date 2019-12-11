<?php
include "../../config.class.php";

if((!isset($_POST['user']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['id_rs']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['progress_id']))){
  mysqli_close($conn);
  die();
}

if((!isset($_POST['session_id']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['user']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$progress_id = mysqli_real_escape_string($conn, $_POST['progress_id']);
$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);
$report_round = mysqli_real_escape_string($conn, $_POST['report_round']);
$th_title = mysqli_real_escape_string($conn, $_POST['th_title']);
$en_title = mysqli_real_escape_string($conn, $_POST['en_title']);
$start_progress_date = mysqli_real_escape_string($conn, $_POST['start_progress_date']);
$end_progress_date = mysqli_real_escape_string($conn, $_POST['end_progress_date']);
$report_type = mysqli_real_escape_string($conn, $_POST['report_type']);


$q_0 = mysqli_real_escape_string($conn, $_POST['q_0']);
$q_0_info = mysqli_real_escape_string($conn, $_POST['q_0_info']);
$q_1_a = mysqli_real_escape_string($conn, $_POST['q_1_a']);
$q_1_b = mysqli_real_escape_string($conn, $_POST['q_1_b']);
$q_1_c = mysqli_real_escape_string($conn, $_POST['q_1_c']);
$q_1_d = mysqli_real_escape_string($conn, $_POST['q_1_d']);
$q_1_e = mysqli_real_escape_string($conn, $_POST['q_1_e']);
$q_1_f = mysqli_real_escape_string($conn, $_POST['q_1_f']);
$q_1_g = mysqli_real_escape_string($conn, $_POST['q_1_g']);
$q_2 = mysqli_real_escape_string($conn, $_POST['q_2']);
$q_2_info = mysqli_real_escape_string($conn, $_POST['q_2_info']);
$q_3 = mysqli_real_escape_string($conn, $_POST['q_3']);
$q_3_info = mysqli_real_escape_string($conn, $_POST['q_3_info']);
$q_4 = mysqli_real_escape_string($conn, $_POST['q_4']);
$q_4_info = mysqli_real_escape_string($conn, $_POST['q_4_info']);
$q_5 = mysqli_real_escape_string($conn, $_POST['q_5']);
$q_5_info = mysqli_real_escape_string($conn, $_POST['q_5_info']);
$q_6 = mysqli_real_escape_string($conn, $_POST['q_6']);
$q_6_info = mysqli_real_escape_string($conn, $_POST['q_6_info']);
$q_7 = mysqli_real_escape_string($conn, $_POST['q_7']);
$q_7_info = mysqli_real_escape_string($conn, $_POST['q_7_info']);
$q_8 = mysqli_real_escape_string($conn, $_POST['q_8']);
$q_8_info = mysqli_real_escape_string($conn, $_POST['q_8_info']);
$q_9 = mysqli_real_escape_string($conn, $_POST['q_9']);
$q_9_info = mysqli_real_escape_string($conn, $_POST['q_9_info']);
$q_10 = mysqli_real_escape_string($conn, $_POST['q_10']);
$q_10_info = mysqli_real_escape_string($conn, $_POST['q_10_info']);
$q_11 = mysqli_real_escape_string($conn, $_POST['q_11']);
$q_11_info = mysqli_real_escape_string($conn, $_POST['q_11_info']);
$q_12 = mysqli_real_escape_string($conn, $_POST['q_12']);
$q_12_info = mysqli_real_escape_string($conn, $_POST['q_12_info']);
$q_13 = mysqli_real_escape_string($conn, $_POST['q_13']);
$q_13_info = mysqli_real_escape_string($conn, $_POST['q_13_info']);
$q_14 = mysqli_real_escape_string($conn, $_POST['q_14']);
$q_14_info = mysqli_real_escape_string($conn, $_POST['q_14_info']);
$q_15 = mysqli_real_escape_string($conn, $_POST['q_15']);
$q_15_info = mysqli_real_escape_string($conn, $_POST['q_15_info']);
$q_16 = mysqli_real_escape_string($conn, $_POST['q_16']);
$q_17 = mysqli_real_escape_string($conn, $_POST['q_17']);
$q_18 = mysqli_real_escape_string($conn, $_POST['q_18']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

// $strSQL = "SELECT * FROM rec_progress_2 a INNER JOIN research b ON a.rp2_id_rs = b.id_rs
//           INNER JOIN type_status_research c ON a.rp2_progress_status = c.id_status_research
//           WHERE a.rp_2_user = '$id' AND a.rp2_usestatus = '1' AND a.rp2_status != 'deleted by PI' ORDER BY a.rp2_adddate DESC";

$code_apdu = '';
$strSQL = "SELECT code_apdu FROM research WHERE id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $row = mysqli_fetch_assoc($query);
  $code_apdu = $row['code_apdu'];
}else{
  mysqli_close($conn);
  die();
}

if($code_apdu == ''){
  mysqli_close($conn);
  die();
}

// echo "string";
// die();

$strSQL = "SELECT * FROM rec_progress WHERE rp_progress_id = '1' AND rp_id_pm = '$id' AND rp_session = '$session_id' ORDER BY rp_ord, rp_year DESC";
$query = mysqli_query($conn, $strSQL);

if($query){


  if($query->num_rows != 0){

    $frow = mysqli_fetch_assoc($query);
    $ref = $frow['rp_id'];

    $strSQL = "UPDATE rec_progress_1 SET rp1_usestatus = '0' WHERE rp1_id_rs = '$id_rs' AND rp1_session = '$session_id' ";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO rec_progress_1 (rp1_refkey, rp1_session, rp1_t1type,
              rp1_title_th, rp1_title_en, rp1_rount, rp1_start, rp1_end, q_0,
              q_0_info, q_1_a, q_1_b, q_1_c, q_1_d, q_1_e, q_1_f, q_1_g, q_2,
              q_2_info, q_3, q_3_info, q_4, q_4_info, q_5, q_5_info, q_6, q_6_info,
              q_7, q_7_info, q_8, q_8_info, q_9, q_9_info, q_10, q_10_info, q_11,
              q_11_info, q_12, q_12_info, q_13, q_13_info, q_14, q_14_info, q_15,
              q_15_info, q_16, q_17, q_18, rp1_id_rs)
              VALUES
              ('$ref', '$session_id', '$report_type', '$th_title', '$en_title', '$report_round', '$start_progress_date', '$end_progress_date',
               '$q_0', '$q_0_info', '$q_1_a', '$q_1_b', '$q_1_c', '$q_1_d', '$q_1_e', '$q_1_f', '$q_1_g',
               '$q_2', '$q_2_info', '$q_3', '$q_3_info', '$q_4', '$q_4_info', '$q_5', '$q_5_info',
               '$q_6', '$q_6_info', '$q_7', '$q_7_info', '$q_8', '$q_8_info', '$q_9', '$q_9_info',
               '$q_10', '$q_10_info', '$q_11', '$q_11_info', '$q_12', '$q_12_info', '$q_13', '$q_13_info',
               '$q_14', '$q_14_info', '$q_15', '$q_15_info', '$q_16', '$q_17', '$q_18', '$id_rs'
              )
              ";
    if($query3 = mysqli_query($conn, $strSQL)){
      echo "Y";
    }else{
      echo "N3";
      echo $strSQL;
    }

  }else{
    $strSQL = "INSERT INTO rec_progress (rp_year, rp_id_rs, rp_id_pm, rp_code_apdu, rp_progress_id, rp_session)
              VALUES ('".date('Y')."', '$id_rs', '$id', '$code_apdu', '$progress_id', '$session_id')
              ";
    if($query2 = mysqli_query($conn, $strSQL)){

      $insert_id = mysqli_insert_id($conn);
      // echo "Y";

      $strSQL = "UPDATE rec_progress_1 SET rp1_usestatus = '0' WHERE rp1_id_rs = '$id_rs' AND rp1_session = '$session_id' ";
      mysqli_query($conn, $strSQL);



      $strSQL = "INSERT INTO rec_progress_1 (rp1_refkey, rp1_session, rp1_t1type,
                rp1_title_th, rp1_title_en, rp1_rount, rp1_start, rp1_end, q_0,
                q_0_info, q_1_a, q_1_b, q_1_c, q_1_d, q_1_e, q_1_f, q_1_g, q_2,
                q_2_info, q_3, q_3_info, q_4, q_4_info, q_5, q_5_info, q_6, q_6_info,
                q_7, q_7_info, q_8, q_8_info, q_9, q_9_info, q_10, q_10_info, q_11,
                q_11_info, q_12, q_12_info, q_13, q_13_info, q_14, q_14_info, q_15,
                q_15_info, q_16, q_17, q_18, rp1_id_rs)
                VALUES
                ('$insert_id', '$session_id', '$report_type', '$th_title', '$en_title', '$report_round', '$start_progress_date', '$end_progress_date',
                 '$q_0', '$q_0_info', '$q_1_a', '$q_1_b', '$q_1_c', '$q_1_d', '$q_1_e', '$q_1_f', '$q_1_g',
                 '$q_2', '$q_2_info', '$q_3', '$q_3_info', '$q_4', '$q_4_info', '$q_5', '$q_5_info',
                 '$q_6', '$q_6_info', '$q_7', '$q_7_info', '$q_8', '$q_8_info', '$q_9', '$q_9_info',
                 '$q_10', '$q_10_info', '$q_11', '$q_11_info', '$q_12', '$q_12_info', '$q_13', '$q_13_info',
                 '$q_14', '$q_14_info', '$q_15', '$q_15_info', '$q_16', '$q_17', '$q_18', '$id_rs'
                )
                ";
      if($query3 = mysqli_query($conn, $strSQL)){
        echo "Y";
      }else{
        echo "N1";
        echo $strSQL;
      }
    }else{
      echo "N2";
      echo $strSQL;
    }
  }

}else{
  $strSQL = "INSERT INTO rec_progress (rp_year, rp_id_rs, rp_id_pm, rp_code_apdu, rp_progress_id, rp_session)
            VALUES ('".date('Y')."', '$id_rs', '$id', '$code_apdu', '$progress_id', '$session_id')
            ";
  if($query2 = mysqli_query($conn, $strSQL)){
    echo "Y";

    $strSQL = "UPDATE rec_progress_1 SET rp1_usestatus = '0' WHERE rp1_id_rs = '$id_rs' AND rp1_session = '$session_id' ";
    mysqli_query($conn, $strSQL);

    $insert_id = mysqli_insert_id($query2);

    $strSQL = "INSERT INTO rec_progress_1 (rp1_refkey, rp1_session, rp1_t1type,
              rp1_title_th, rp1_title_en, rp1_rount, rp1_start, rp1_end, q_0,
              q_0_info, q_1_a, q_1_b, q_1_c, q_1_d, q_1_e, q_1_f, q_1_g, q_2,
              q_2_info, q_3, q_3_info, q_4, q_4_info, q_5, q_5_info, q_6, q_6_info,
              q_7, q_7_info, q_8, q_8_info, q_9, q_9_info, q_10, q_10_info, q_11,
              q_11_info, q_12, q_12_info, q_13, q_13_info, q_14, q_14_info, q_15,
              q_15_info, q_16, q_17, q_18, rp1_id_rs)
              VALUES
              ('$insert_id', '$session_id', '$report_type', '$th_title', '$en_title', '$report_round', '$start_progress_date', '$end_progress_date',
               '$q_0', '$q_0_info', '$q_1_a', '$q_1_b', '$q_1_c', '$q_1_d', '$q_1_e', '$q_1_f', '$q_1_g',
               '$q_2', '$q_2_info', '$q_3', '$q_3_info', '$q_4', '$q_4_info', '$q_5', '$q_5_info',
               '$q_6', '$q_6_info', '$q_7', '$q_7_info', '$q_8', '$q_8_info', '$q_9', '$q_9_info',
               '$q_10', '$q_10_info', '$q_11', '$q_11_info', '$q_12', '$q_12_info', '$q_13', '$q_13_info',
               '$q_14', '$q_14_info', '$q_15', '$q_15_info', '$q_16', '$q_17', '$q_18', '$id_rs'
              )
              ";
    if($query3 = mysqli_query($conn, $strSQL)){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }else{
    echo $strSQL;
  }
}

// echo json_encode($return);
mysqli_close($conn);
die();

?>
