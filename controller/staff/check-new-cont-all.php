<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM research a INNER JOIN rec b ON a.id_rs = b.id_rs
          INNER JOIN rec_progress c ON a.id_rs = c.rp_id_rs
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          WHERE
            a.draft_status = '0'
            AND e.delete_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND c.rp_progress_status = '1'
            AND c.rp_sending_status = '1'
            AND c.rp_code_apdu != ''
            AND c.rp_delete_status = '0'
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
