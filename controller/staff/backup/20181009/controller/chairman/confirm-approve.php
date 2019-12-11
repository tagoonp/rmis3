<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$date_2 = date("Y-m-d");
$contype = '';
$doc_table = '';
$id_pm = '';
$id_pm_code = '';
$code_apdu = '';
$tmeet = '';
$tdate = '';

$id = mysqli_real_escape_string($conn, $_POST['user']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM research a INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          INNER JOIN research_assign_fullboard_agendar d ON a.id_rs = d.rafa_id_rs
          INNER JOIN useraccount c ON a.id_pm = c.id_pm
          WHERE a.id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){
  $data = mysqli_fetch_assoc($query);
  $id_status = $data['id_status_research'];
  $contype = $data['rct_type'];
  $id_pm = $data['id'];
  $code_apdu = $data['code_apdu'];
  $id_pm_code = $data['id_pm'];
  $tmeet = $data['rafa_agn'];
  $tdate = $data['rafa_date'];
  if($data['rafa_date'] == null){
    $tdate = $date_2;
  }
}else{
  mysqli_close($conn);
  die();
}

if($contype == 'Exempt'){
  $doc_table = 'research_acknowledge_info';
}else if($contype == 'Expedited'){
  $doc_table = 'research_expedited_info';
}else if($contype == 'Fullboard (Bio)'){
  // $doc_table = 'research_fullboard_info';
  $doc_table = 'research_expedited_info';
}else if($contype == 'Fullboard (Social)'){
  // $doc_table = 'research_fullboard_info';
  $doc_table = 'research_expedited_info';
}else{
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT * FROM ".$doc_table." WHERE rai_id_rs = '$id_rs' AND rai_status = '1'";
$query = mysqli_query($conn, $strSQL);
if($query){

  $dd = mysqli_fetch_assoc($query);

  if(($dd['rai_report_round'] > 0) || ($dd['rai_report_round']  != null)){
    // $expire_date = date('Y-m-d', strtotime($date .' +'.(intval($dd['rai_report_round']) * 30).' day'));
    // $expire_date = date('Y-m-d', strtotime($date .' +'.intval($dd['rai_report_round']).' month'));
    $expire_date = date('Y-m-d', strtotime($date .' +12 month'));
    $expire_date = date('Y-m-d', strtotime($expire_date .' -1 day'));

    $strSQL = "UPDATE ".$doc_table." SET rai_expired_date = '$expire_date' WHERE rai_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);

    // echo $strSQL;
  }

  $strSQL = "UPDATE ".$doc_table." SET rai_sign_status = '1', rai_sign_date= '$date', rai_sign_id = '$id' WHERE rai_id_rs = '$id_rs'";
  $query2 = mysqli_query($conn, $strSQL);

  if($query2){
    echo "Y";

    $strSQL = "UPDATE research SET id_status_research = '18' WHERE id_rs = '$id_rs'";
    $query2 = mysqli_query($conn, $strSQL);

    $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
    mysqli_query($conn, $strSQL);


    if($contype == 'Exempt'){
      $strSQL = "INSERT INTO rec (id_apdu, id_rs, id_pm, rs_type, tmeeting, approve_date, udate, uby)
                VALUES ('$code_apdu', '$id_rs', '$id_pm_code','$contype','$tmeet','$date_2','$date_2','$id')
                ";
      // echo $strSQL;
      mysqli_query($conn, $strSQL);
    }else{
      $strSQL = "INSERT INTO rec (id_apdu, id_rs, id_pm, rs_type, tmeeting, dmeeting, approve_date, expored_date, udate, uby)
                VALUES ('$code_apdu', '$id_rs', '$id_pm_code','$contype','$tmeet','$tdate','$date_2','$date_2','$id')
                ";
      mysqli_query($conn, $strSQL);
    }


    $strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('change_research_status', 'ผลการพิจารณาผ่านการรับรอง (Exempt)', '".date('Y-m-d H:i:s')."', '$id_pm')";
    mysqli_query($conn, $strSQL);

    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by ) VALUES ('Exempt approved', 'ประธานลงนาม', '$date', '$id_rs', 'Chairman : ".$id."')";
    mysqli_query($conn, $strSQL);

    $y = date('Y');

    $strSQL = "SELECT MAX(rafa_docnumber) mno FROM research_assign_fullboard_agendar WHERE rafa_status = '1' AND rafa_docyear = '$y' ";
    if($pp = mysqli_query($conn, $strSQL)){
      $ro = mysqli_fetch_assoc($pp);
      $newno = intval($ro['mno']) + 1;
      $docf = date('Ymd').$newno;
      $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_docnumber = '$newno', rafa_docnumber_full = '$docf', rafa_docyear = '$y' WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1'";
      mysqli_query($conn, $strSQL);
      // echo $strSQL;
    }else{
      $docf = date('Ymd').'1';
      $strSQL = "UPDATE research_assign_fullboard_agendar SET rafa_docnumber = '1', rafa_docnumber_full = '$docf', rafa_docyear = '$y' WHERE rafa_id_rs = '$id_rs' AND rafa_status = '1'";
      mysqli_query($conn, $strSQL);
      // echo $strSQL;
    }
  }else{
    echo "N";
  }

}else{
  mysqli_close($conn);
  die();
}

// echo json_encode($return);
mysqli_close($conn);
die();

?>
