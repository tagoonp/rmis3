<?php
include "config.class.php";
header('Content-type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$return = [];
$buffer = [];
$strSQL = '';
$data = '';

$strSQL = "SELECT * FROM research a LEFT JOIN useraccount b ON a.id_pm = b.id_pm
          LEFT JOIN userinfo c ON b.id = c.user_id
          LEFT JOIN research_consider_type d ON a.id_rs = d.rct_id_rs
          LEFT JOIN type_status_research e ON a.id_status_research = e.id_status_research
          LEFT JOIN dept f ON c.id_dept = f.id_dept
          WHERE
          a.delete_flag = 'N' AND
          a.sendding_status = 'Y' AND
          a.draft_status = '0' AND
          a.code_apdu != '' AND
          a.code_apdu IS NOT NULL AND
          -- d.rct_status = '1' AND
          a.id_year = '19' AND
          b.delete_status = '0'
          ORDER BY a.ord_id
          ";

// echo $strSQL;
// die();

$query = mysqli_query($conn, $strSQL);
if($query){
  $c = 1;
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    $buf['ลำดับที่'] = $c;

    $buf['เลขที่โครงการ'] = $row['code_apdu'];
    $buf['ปี'] = intval($row['id_year']) + 1999;
    $buf['นักวิจัย'] = $row['fname']." ".$row['lname'];
    $buf['ภาควิชา/หน่วยงาน'] = $row['dept_name'];
    $buf['ชื่อโครงการ (ภาษาไทย)'] = $row['title_th'];
    $buf['ชื่อโครงการ (ภาษาอังกฤษ)'] = $row['title_en'];
    $buf['คำสำคัญ (ภาษาไทย)'] = $row['keywords_th'];
    $buf['ชื่อโครงการ (ภาษาอังกฤษ)'] = $row['keywords_en'];
    $buf['วันที่เริ่มต้น'] = $row['start_date'];
    $buf['วันที่สิ้นสุด'] = $row['finish_date'];
    $buf['สัดส่วนการทดลอง'] = $row['rate_pm'];
    $buf['จำนวนผู้ร่วมทดลอง'] = $row['number_rs'];

    $buf['ผู้ร่วมทดลอง'] = "";

    $strSQL = "SELECT * FROM pm_team WHERE co_sess_id = '".$row['session_id']."'";
    $query2 = mysqli_query($conn, $strSQL);
    if($query2){
      $j = 1;
      $buf2 = [];
      while ($row2 = mysqli_fetch_array($query2)) {
        $buf2 .= "[".$j."]. ".$row2['co_fname']." ".$row2['co_lname']." - ".$row2['co_ratio'].'%, ';
        $j++;
      }
      $buf['ผู้ร่วมทดลอง'] = $buf2;
    }else{
      $buf['ผู้ร่วมทดลอง'] = "";
    }

    $buf['งบประมาณทั้งโครงการ'] = $row['budget'];
    $buf['ชื่อแหล่งทุน'] = $row['source_funds'];
    $buf['สถานะโครงการ'] = $row['status_name'];
    $buf['ประเภทการพิจารณา'] = $row['rct_type'];
    //
    $return[] = $buf;
    $c++;
  }
}

echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($conn);
die();

?>
