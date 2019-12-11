<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT a.*, b.*, c.*, d.*, e.*, h.fname, h.lname, i.rct_type contype, k.fname ec_fname, k.lname ec_lname
          FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
          LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
          LEFT JOIN dept e ON a.id_dept = e.id_dept
          LEFT JOIN useraccount g ON a.id_pm = g.id_pm
          LEFT JOIN userinfo h ON g.id = h.user_id
          LEFT JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          LEFT JOIN useraccount j ON i.rct_fb_ec = j.id
          LEFT JOIN userinfo k ON j.id = k.user_id
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.id_status_research = '5'
            AND g.delete_status = '0'
            AND a.code_apdu != ''
            -- AND
            -- AND i.rir_conf = '1'
            ";
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
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
