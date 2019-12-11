<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

// $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
//           INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
//           INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
//           INNER JOIN dept e ON a.id_dept = e.id_dept
//           INNER JOIN research_retroact_info f ON a.id_rs = f.rri_id_rs
//           WHERE
//             a.draft_status = '0'
//             AND a.delete_flag = 'N'
//             AND a.sendding_status = 'Y'
//             AND a.research_status = 'retroact'
//             AND f.rri_conf_status = '0'
//             AND f.rri_delete_status = '0'";
$strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN useraccount f ON a.id_pm = f.id_pm
          -- INNER JOIN research_retroact_info f ON a.id_rs = f.rri_id_rs
          WHERE
            a.draft_status = '0'
            AND f.delete_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.code_apdu != ''
            AND a.research_status = 'retroact'";
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
