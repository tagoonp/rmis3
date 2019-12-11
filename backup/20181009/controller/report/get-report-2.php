<?php
include "../config.class.php";


if(!isset($_POST['fid'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['sd'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['ed'])){
  mysqli_close($conn);
  die();
}

$fid = mysqli_real_escape_string($conn, $_POST['fid']);
$sd = mysqli_real_escape_string($conn, $_POST['sd']);
$ed = mysqli_real_escape_string($conn, $_POST['ed']);
$status = mysqli_real_escape_string($conn, $_POST['status']);

$sd = $sd." 00:00:00";
$ed = $ed." 23:59:59";

$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

if($fid == 1){
  $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
             WHERE
             b.draft_status = '0'
             AND b.delete_flag = 'N'
             AND b.sendding_status = 'Y'
             AND a.rw_sending_status = '1'
             AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
             AND b.id_status_research NOT IN ('26')
             AND a.rir_conf = '1'
            ";
  if($query = mysqli_query($conn, $strSQL)){
    $row = mysqli_fetch_assoc($query);
    echo $row['numrow'];
  }else{
    echo $strSQL;
  }
}

if($fid == 2){

  if($status == 2){
    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND (a.rw_reply_status IN ('$status', '4') AND a.rw_reply_doc_mark = '1')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
              ";
  }else if($status == 1){
    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND (a.rw_reply_status IN ('$status', '4') AND a.rw_reply_doc_mark = '0')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
              ";
  }else if($status == 3){
    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND a.rw_reply_doc_mark = '0'
               AND a.rw_reply_status IN ('$status')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
              ";
  }else if($status == 0){
    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND a.rw_reply_status IN ('$status')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
              ";
  }else if($status == 4){
    // $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
    //            WHERE
    //            b.draft_status = '0'
    //            AND b.delete_flag = 'N'
    //            AND b.sendding_status = 'Y'
    //            AND a.rw_sending_status = '1'
    //            AND (a.rw_reply_status IN ('4') AND a.rw_reply_doc_mark = '0')
    //            AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
    //            AND b.id_status_research NOT IN ('26')
    //            AND a.rir_conf = '1'
    //           ";
  }

  if($query = mysqli_query($conn, $strSQL)){
    $row = mysqli_fetch_assoc($query);
    echo $row['numrow'];
  }else{
    echo $strSQL;
  }
}



mysqli_close($conn);
die();


?>
