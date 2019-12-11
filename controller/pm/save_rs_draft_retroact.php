<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$th_title = mysqli_real_escape_string($conn, $_POST['th_title']);
$en_title = mysqli_real_escape_string($conn, $_POST['en_title']);
$keywords_th = mysqli_real_escape_string($conn, $_POST['keywords_th']);
$keywords_en = mysqli_real_escape_string($conn, $_POST['keywords_en']);
$id_type = mysqli_real_escape_string($conn, intval($_POST['id_type']));
$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
$finish_date = mysqli_real_escape_string($conn, $_POST['finish_date']);
$cotype = mysqli_real_escape_string($conn, $_POST['cotype']);
$number_rs = mysqli_real_escape_string($conn, $_POST['number_rs']);
if($number_rs==''){
  $number_rs = 0;
}
$rate_pm = mysqli_real_escape_string($conn, $_POST['rate_pm']);
$pm_job = mysqli_real_escape_string($conn, $_POST['pm_job']);
$budget = mysqli_real_escape_string($conn, $_POST['budget']);
$ts0 = mysqli_real_escape_string($conn, $_POST['ts0']);
$ts1 = mysqli_real_escape_string($conn, $_POST['ts1']);
$ts2 = mysqli_real_escape_string($conn, $_POST['ts2']);
$ts3 = mysqli_real_escape_string($conn, $_POST['ts3']);
$ts4 = mysqli_real_escape_string($conn, $_POST['ts4']);
$ts5 = mysqli_real_escape_string($conn, $_POST['ts5']);
$ts6 = mysqli_real_escape_string($conn, $_POST['ts6']);
$ts7 = mysqli_real_escape_string($conn, $_POST['ts7']);

$ts1f = mysqli_real_escape_string($conn, $_POST['ts1f']);
$ts2f = mysqli_real_escape_string($conn, $_POST['ts2f']);
$ts3f = mysqli_real_escape_string($conn, $_POST['ts3f']);
$ts4f = mysqli_real_escape_string($conn, $_POST['ts4f']);
$ts5f = mysqli_real_escape_string($conn, $_POST['ts5f']);
$ts7f = mysqli_real_escape_string($conn, $_POST['ts7f']);

$protocol_no  = mysqli_real_escape_string($conn, $_POST['protocol_no']);

$source_funds = mysqli_real_escape_string($conn, $_POST['source_funds']);
$brief_reports = mysqli_real_escape_string($conn, $_POST['brief_reports']);
$draft_status = mysqli_real_escape_string($conn, $_POST['draft_status']);
$sess_id = mysqli_real_escape_string($conn, $_POST['sess_id']);
$rstatus = mysqli_real_escape_string($conn, $_POST['rstatus']);
$id_rec = mysqli_real_escape_string($conn, $_POST['id_rec']);
if($ts0 == 0){
  $ts1 = 0;
  $ts2 = 0;
  $ts3 = 0;
  $ts4 = 0;
  $ts5 = 0;
  $ts6 = 0;
  $ts7 = 0;
}

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id WHERE a.id = '$id'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';
$id_dept = '';
$id_personnel = '';

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
    $id_dept = $row['id_dept'];
    $id_personnel = $row['id_personnel'];
  }else{
    echo "N1";
    mysqli_close($conn);
    die();
  }
}else{
  echo $strSQL;
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  echo "N3";
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm'";
$query = mysqli_query($conn, $strSQL);

$prev = 1;
if($query){
  $prev = mysqli_num_rows($query);
  $prev = $prev + 1;
}

$yid_tmp = date('Y');
$yid = 2037 - $yid_tmp;


$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm' AND session_id = '$sess_id'";
$query = mysqli_query($conn, $strSQL);

$prev = 1;
if($query){
  $rn = mysqli_num_rows($query);
  if($rn == 0){
    $strSQL = "INSERT INTO research (id_lrRec, ep, id_pm, id_year, id_dept, id_personnel, title_th, title_en,
              keywords_th, keywords_en, id_type, start_date, finish_date, number_rs, rate_pm, pm_job, budget,
              ts0, ts1, ts2, ts3, ts4, ts5, ts6, ts7, ts1_budget, ts2_budget, ts3_budget, ts4_budget, ts5_budget, ts7_budget, protocol_no,
              source_funds, brief_reports, id_status_research, research_status, research_retroact_status, code_apdu, ip_add, date_submit,
              cotype, id_adv, submit_year, draft_status, session_id
            ) VALUES ('$prev', '1', '$id_pm', '$yid', '$id_dept', '$id_personnel', '$th_title', '$en_title',
              '$keywords_th', '$keywords_en', '$id_type', '$start_date', '$finish_date', '$number_rs', '$rate_pm', '$pm_job','$budget',
              '$ts0', '$ts1','$ts2','$ts3','$ts4','$ts5','$ts6','$ts7',
              '$ts1f','$ts2f','$ts3f','$ts4f','$ts5f','$ts7f', '$protocol_no',
              '$source_funds', '$brief_reports', '1','retroact','$rstatus','$id_rec', '$ip_add', '$date', '$cotype', '', '$yid_tmp', '1', '$sess_id'
            )";

    if($query = mysqli_query($conn, $strSQL)){
      echo "Y";

      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Register new research', 'ผู้วิจัยลงทะเบียนโครงการวิจัยใหม่', '$date', '0', '$sess_id', 'PM : ".$id_pm."')";
      mysqli_query($conn, $strSQL);

    }else{
      echo $strSQL;
    }
  }else{
    $strSQL = "UPDATE research SET
              id_dept = '$id_dept',
              id_personnel = '$id_personnel',
              title_th = '$th_title',
              title_en = '$en_title',
              keywords_th = '$keywords_th',
              keywords_en = '$keywords_en',
              id_type = '$id_type',
              start_date = '$start_date',
              finish_date = '$finish_date',
              number_rs = '$number_rs',
              rate_pm = '$rate_pm',
              pm_job = '$pm_job',
              budget = '$budget',
              ts0 = '$ts0',
              ts1 = '$ts1',
              ts2 = '$ts2',
              ts3 = '$ts3',
              ts4 = '$ts4',
              ts5 = '$ts5',
              ts6 = '$ts6',
              ts7 = '$ts7',
              ts1_budget = '$ts1f',
              ts2_budget = '$ts2f',
              ts3_budget = '$ts3f',
              ts4_budget = '$ts4f',
              ts5_budget = '$ts5f',
              ts7_budget = '$ts7f',
              protocol_no = '$protocol_no',
              source_funds = '$source_funds',
              brief_reports = '$brief_reports',
              ip_add = '$ip_add',
              cotype = '$cotype',
              id_adv = '',
              research_retroact_status = '$rstatus'
              WHERE id_pm = '$id_pm' AND session_id = '$sess_id' AND code_apdu = '$id_rec'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      echo "Y";
      $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('PM update draft research', 'ผู้วิจัยบันทึกแบบร่างของโครงการวิจัย', '$date', '0', '$sess_id', 'PM : ".$id_pm."')";
      mysqli_query($conn, $strSQL);
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO research (id_lrRec, ep, id_pm, id_year, id_dept, id_personnel, title_th, title_en,
            keywords_th, keywords_en, id_type, start_date, finish_date, number_rs, rate_pm, budget,
            ts0, ts1, ts2, ts3, ts4, ts5, ts6, ts7, ts1_budget, ts2_budget, ts3_budget, ts4_budget, ts5_budget, ts7_budget, protocol_no
            source_funds, brief_reports, id_status_research, research_status, research_retroact_status, code_apdu, ip_add, date_submit,
            cotype, id_adv, submit_year, draft_status, session_id
          ) VALUES ('$prev', '1', '$id_pm', '$yid', '$id_dept', '$id_personnel', '$th_title', '$en_title',
            '$keywords_th', '$keywords_en', '$id_type', '$start_date', '$finish_date', '$number_rs', '$rate_pm', '$budget',
            '$ts0', '$ts1','$ts2','$ts3','$ts4','$ts5','$ts6','$ts7',
            '$ts1f','$ts2f','$ts3f','$ts4f','$ts5f','$ts7f', '$protocol_no',
            '$source_funds', '$brief_reports', '1', 'retroact', '$rstatus', '$id_rec', '$ip_add', '$date', '$cotype', '', '$yid_tmp', '1', '$sess_id'
          )";

  if($query = mysqli_query($conn, $strSQL)){
    echo "Y";
    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by) VALUES ('Register new research', 'ผู้วิจัยลงทะเบียนโครงการวิจัยใหม่', '$date', '0', '$sess_id', 'PM : ".$id_pm."')";
    mysqli_query($conn, $strSQL);
  }else{
    echo $strSQL;
  }
}



mysqli_close($conn);
die();

?>
