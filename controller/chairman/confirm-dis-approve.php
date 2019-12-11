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
$disapp_msg = mysqli_real_escape_string($conn, $_POST['disapp_msg']);
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


$strSQL = "UPDATE research SET id_status_research = '20' WHERE id_rs = '$id_rs'";
$query = mysqli_query($conn, $strSQL);

$strSQL = "UPDATE dis_approve_project SET dis_udatetime = '$date' WHERE dis_id_rs = '$id_rs' AND dis_status = '1' AND dis_stage = 'first'";
$query = mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO log_notification (log_activity, log_detail, log_datetime, user_id ) VALUES ('change_research_status', 'ผลการพิจารณาไม่รับรองโครงการ (Disapproval)', '$date', '$id_pm')";
mysqli_query($conn, $strSQL);

$strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, id_rs, log_by )
VALUES ('Project disapproval', '<p>[System message 1]<br>แจ้งผลผลการพิจารณา<br><h4 style=\'color:red;\'>มติ ไม่รับรองโครงการ<h4><p>สามารถดูรายละเอียดได้จากข้อคำถาม/ข้อเสนอแนะจากกรรมการ</p><p><br><br>จึงเรียนมาเพื่อทราบ หากท่านมีข้อสงสัยเกี่ยวกับผลการพิจารณา สามารถสอบถามที่ สำนักงานจริยธรรม ชั้น 4 อาคารบริหารคณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์ โทร 074-451149 และ 074-451157 <br><br>ท่านสามารถอุทธรณ์ผลการพิจารณาของคณะกรรมการ โดยแจ้งความจํานง และเหตุผลโต้แย้งต่อประธานคณะกรรมการเป็นลายลักษณ์อักษร ภายในวันที่ 1 เดือน หลังได้รับอีเมล์ฉบับนี้ หากพ้นกำหนดดังกล่าว คณะกรรมการจริยธรรมจะไม่รับพิจารณาที่เกี่ยวข้องกับโครงการนี้ต่อไป (โครงการจะถูกเปลี่ยนสถานะไม่รับรองถาวรโดยอัตโนมัติ)</p>', '$date', '$id_rs', 'Chairman : ".$id."')";
mysqli_query($conn, $strSQL);

echo "Y";
// echo json_encode($return);
mysqli_close($conn);
die();

?>
