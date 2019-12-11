<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN research_assign_fullboard_agendar f ON a.id_rs = f.rafa_id_rs
          INNER JOIN research_consider_type g ON a.id_rs = g.rct_id_rs
          INNER JOIN useraccount h ON a.id_pm = h.id_pm
          INNER JOIN userinfo i ON h.id = i.user_id
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.id_status_research = '25'
            AND a.id_rs IN (SELECT dis_id_rs FROM dis_approve_project WHERE dis_stage = 'first' AND dis_status = '1')
            AND a.code_apdu != ''
            AND a.id_year > 18
            AND g.rct_conf = '1'
            AND h.delete_status = '0'
            ORDER BY a.date_submit DESC";
$query = mysqli_query($conn, $strSQL);

if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }
    }
    $return[] = $buf;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
