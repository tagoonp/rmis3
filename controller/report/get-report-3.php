<?php
include "../config.class.php";
header('Content-type: application/json');

if(!isset($_POST['sd'])){
  // mysqli_close($conn);
  // die();
}

if(!isset($_POST['ed'])){
  // mysqli_close($conn);
  // die();
}

$sd = mysqli_real_escape_string($conn, $_POST['sd']);
$ed = mysqli_real_escape_string($conn, $_POST['ed']);

// $sd = '2018-01-01';
// $ed = '2018-05-01';

$sd = $sd." 00:00:00";
$ed = $ed." 23:59:59";

$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$data = '';

$strSQL = "SELECT DISTINCT a.rir_id_reviewer, c.fname, c.lname  FROM research_init_reviewer a INNER JOIN useraccount b ON a.rir_id_reviewer = b.id
           INNER JOIN userinfo c ON b.id = c.user_id
           INNER JOIN research d ON a.rir_id_rs =  d.id_rs
           WHERE
           d.draft_status = '0'
           AND d.delete_flag = 'N'
           AND d.sendding_status = 'Y'
           AND a.rw_sending_status = '1'
           AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
           AND d.id_status_research NOT IN ('26')
           AND a.rir_conf = '1'
           AND b.delete_status = '0'
           AND b.allow_status = '1'
           ORDER BY c.fname
          ";
if($query = mysqli_query($conn, $strSQL)){
  // echo "Y";
  while($row = mysqli_fetch_array($query)){
    $subdata = '';
    $subdata['reviewer_id'] = $row['rir_id_reviewer'];
    $subdata['reviewer_fullname'] = $row['fname']." ".$row['lname'];
    $subdata['reviewer_all'] = '0';
    $subdata['reviewer_type1'] = '0';
    $subdata['reviewer_type2'] = '0';
    $subdata['reviewer_type3'] = '0';
    $subdata['reviewer_type4'] = '0';
    $data[] = $subdata;
  }
}

if(sizeof($data) > 0){
  $i = 0;
  foreach ($data as $row) {
    $all = 0;
    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_all'] = $rownum['numrow'];
      $all = $rownum['numrow'];
    }


    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND (a.rw_reply_status IN ('1', '4') AND a.rw_reply_doc_mark = '0')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_type1'] = $rownum['numrow'];
    }else{
      // echo "ID > ". $row['reviewer_id'] . " No any assigned review<br>";
    }

    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND (a.rw_reply_status IN ('2', '4') AND a.rw_reply_doc_mark = '1')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_type2'] = $rownum['numrow'];
    }else{
      // echo "ID > ". $row['reviewer_id'] . " No any assigned review<br>";
    }

    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND a.rw_reply_doc_mark = '0'
               AND a.rw_reply_status IN ('3')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_type3'] = $rownum['numrow'];
    }else{
      // echo "ID > ". $row['reviewer_id'] . " No any assigned review<br>";
    }

    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               -- AND a.rw_reply_doc_mark = '0'
               AND a.rw_reply_status IN ('4')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_type4'] = $rownum['numrow'];
    }else{
      // echo "ID > ". $row['reviewer_id'] . " No any assigned review<br>";
    }

    $strSQL = "SELECT COUNT(*) numrow FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
               WHERE
               b.draft_status = '0'
               AND b.delete_flag = 'N'
               AND b.sendding_status = 'Y'
               AND a.rw_sending_status = '1'
               AND a.rw_reply_doc_mark = '0'
               AND a.rw_reply_status IN ('0')
               AND a.rw_sending_datetime BETWEEN '$sd' AND '$ed'
               AND b.id_status_research NOT IN ('26')
               AND a.rir_conf = '1'
               AND a.rir_id_reviewer = '".$row['reviewer_id']."'
              ";
    if($query = mysqli_query($conn, $strSQL)){
      $rownum = mysqli_fetch_assoc($query);
      // echo "ID > ". $row['reviewer_id'] . " Assign time : ". $rownum['numrow']. "<br>";
      $data[$i]['reviewer_type0'] = $rownum['numrow'];
    }else{
      // echo "ID > ". $row['reviewer_id'] . " No any assigned review<br>";
    }

    $i ++;
  }
}

// echo json_encode($data , JSON_PRETTY_PRINT);
echo json_encode($data);

mysqli_close($conn);
die();


?>
