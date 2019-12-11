<?php
// Co-pi Institution export
// 2019-02-20
// By Tagoon Prappre
include "config.class.php";
header('Content-type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$return = [];
$buffer = [];
$strSQL = '';
$data = '';

// $strSQL = "SELECT * FROM research a LEFT JOIN useraccount b ON a.id_pm = b.id_pm
//           LEFT JOIN userinfo c ON b.id = c.user_id
//           LEFT JOIN research_consider_type d ON a.id_rs = d.rct_id_rs
//           LEFT JOIN type_status_research e ON a.id_status_research = e.id_status_research
//           LEFT JOIN dept f ON c.id_dept = f.id_dept
//           WHERE
//           -- a.delete_flag = 'N' AND
//           a.sendding_status = 'Y' AND
//           a.draft_status = '0' AND
//           a.code_apdu != '' AND
//           a.code_apdu IS NOT NULL AND
//           -- d.rct_status = '1' AND
//           a.id_year = '19' AND
//           b.delete_status = '0' AND
//           b.allow_status = '1' AND
//           b.active_status = '1'
//           ORDER BY a.ord_id
//           -- LIMIT 400, 200
//           ";

$strSQL = "SELECT rs.code_apdu as 'รหัส', pmt.co_fname as 'ชื่อ', pmt.co_lname as 'นามสกุล', pmt.co_dept AS 'หน่วยงาน', pmt.co_job AS 'หน้าที่รับผิดชอบ' FROM pm_team pmt INNER JOIN research rs ON pmt.co_sess_id = rs.session_id
           WHERE pmt.co_sess_id IS NOT NULL AND pmt.co_sess_id IN (
            SELECT session_id FROM research a LEFT JOIN useraccount b ON a.id_pm = b.id_pm
              WHERE
              a.delete_flag = 'N' AND
              a.sendding_status = 'Y' AND
              a.draft_status = '0' AND
              a.code_apdu != '' AND
              a.code_apdu IS NOT NULL AND
              a.id_year in ('19', '20') AND
              b.delete_status = '0' AND
              b.allow_status = '1' AND
              b.active_status = '1'
          ) ORDER BY rs.code_apdu";

// echo $strSQL;
// die();
$return = [];
$query = mysqli_query($conn, $strSQL);
if($query){
  $c = 1;
  while ($row = mysqli_fetch_array($query)) {
            $buf = [];
            foreach ($row as $key => $value) {
                if(!is_int($key)){
                  $buf[$key] = $value;
                }
            }
            $return[] = $buf;
  }

  if(sizeof($return) > 0){
      // echo json_encode($return);
      echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  }
}

// echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
mysqli_close($conn);
die();

?>
