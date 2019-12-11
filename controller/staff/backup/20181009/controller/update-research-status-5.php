<?php
session_start();

include "../lib/connect.class.php";
$db = new database();
$db->connect();



if ((isset($_POST['id_rs'])) && (isset($_SESSION['id']))) {

    $log_ip=$_SERVER['REMOTE_ADDR'];
    $log_date = date ("y-m-d H:i:s");

    $strSQL = "SELECT * FROM research WHERE id_rs = '".$_POST['id_rs']."'";
    $resultRS = $db->select($strSQL, false, true);

    if($resultRS){
      $strSQL = "UPDATE research SET status_research = '5' WHERE id_rs = '".$_POST['id_rs']."'";
      $result = $db->update($strSQL);

      $detail = "เจ้าหน้าที่ปรับปรุงสถานะโครงการวิจัยเป็นรอผลพิจารณาจากผู้ทรงคุณวุฒิ (Researh_id: ".$_POST["id_rs"].") โดยเจ้าหน้าที่ (ID : ".$_SESSION['id'].")";
      $strSQL = "INSERT INTO research_log (rl_detail, other_msg, rl_ip, rl_datetime, rl_by, rl_role)
                VALUES
                  ('".$detail."', '','".$log_ip."','".$log_date."','".$_SESSION['id']."','staff')
                ";
      $resultInsert = $db->insert($strSQL,false,true);

      $strSQL = "SELECT email FROM pm WHERE id_pm = '".$resultRS[0]['id_pm']."'";
      $resultPM = $db->select($strSQL, false, true);
    }



}

$db->disconnect();
?>
