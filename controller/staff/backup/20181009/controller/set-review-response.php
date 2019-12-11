<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../lib/connect.class.php";
$db = new database();
$db->connect();

$log_ip=$_SERVER['REMOTE_ADDR'];
$log_date = date ("y-m-d H:i:s");

if((isset($_POST['id_rs'])) && (isset($_SESSION['id']))){
  $strSQL = "UPDATE temp_file_comment_response
            SET
              tf_confirm_id = '".$_POST['id_rs']."'
            WHERE
              tf_id_rs = '".$_POST['id_rs']."'
              AND
              tf_id_reviewer = '".$_SESSION['id']."'";
  $resultUpdate = $db->update($strSQL);

  $detail = "ผู้ทรงเพิ่มผลการพิจารณาโครงการวิจัย (Researh_id: ".$_POST["id_rs"].") โดยผู้ทรง (ID : ".$_SESSION['id'].")";
  $detail2 = "Exempt project (Status:16)";

  $strSQL = "INSERT INTO research_log (rl_detail, other_msg, rl_ip, rl_datetime, rl_by, rl_role)
            VALUES
              ('".$detail."', '".$_POST['comments']."','".$log_ip."','".$log_date."','".$_SESSION['id']."','ec')
            ";
  $resultInsert = $db->insert($strSQL,false,true);

  $strSQL = "UPDATE reviewer_seleted_by_ec
            SET
              response_status = '1',
              response_datetime = '".date('Y-m-d H:i:s')."',
              review_status = '1',
              review_datetime = '".date('Y-m-d H:i:s')."',
              review_comment = '".$_POST['comments']."'
            WHERE
              id_rs = '".$_POST['id_rs']."'
              AND
              reviewer_id = '".$_SESSION['id']."'";
  $resultUpdate = $db->update($strSQL);

  $strSQL = "DELETE FROM temp_file_comment_response WHERE tf_id_rs = '".$_POST['id_rs']."'
  AND
  tf_id_reviewer = '".$_SESSION['id']."' AND tf_session_id != '".session_id()."'";
  $result = $db->delete($strSQL);


  echo "Y";
  $db->disconnect();
  die();
}else{
  echo "N";
  $db->disconnect();
  die();
}
?>
