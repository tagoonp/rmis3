<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id_year = mysqli_real_escape_string($conn, $_POST['id_year']);

$strSQL = "SELECT
            *
          FROM `research` a LEFT JOIN useraccount b ON a.id_pm = b.id_pm
            LEFT JOIN userinfo c ON b.id = c.user_id
            INNER JOIN dept d ON a.id_dept = d.id_dept
            INNER JOIN type_personnel e ON a.id_personnel = e.id_personnel
            INNER JOIN type_status_research f ON a.id_status_research = f.id_status_research
            INNER JOIN useraccount h ON a.id_pm = h.id_pm
            -- LEFT JOIN useraccount g ON a.id_pm = g.id_pm
            -- LEFT JOIN userinfo h ON g.id = h.user_id
          WHERE a.research_status = 'new'
            AND a.`sendding_status` = 'Y'
            AND a.`delete_flag` = 'N'
            AND a.code_apdu != ''
            AND a.ord_id != '000'
            AND a.draft_status = '0'
            AND a.id_year = '$id_year'
            AND h.delete_status = '0'
            -- AND a.id_rs = '1593'
          GROUP BY a.id_pm ORDER BY a.ord_id ";

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
