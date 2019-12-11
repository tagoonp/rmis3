<?php
include "controller/config.class.php";

$strSQL = "SELECT * FROM research_new_progress WHERE rwp_title = 'เจ้าหน้าที่ดำเนินการส่งผู้เชี่ยวชาญอิสระ'";
if($query = mysqli_query($conn, $strSQL)){
  echo "Found";
  while($row = mysqli_fetch_array($query)){
    $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
              VALUES ('EC Secretory choose reviewer', '".$row['rwp_info']."', '".$row['rwp_datetime']."', '0', '".$row['rwp_id_rs']."',  'EC : ".$row['rwp_notify_by']."')";
    mysqli_query($conn, $strSQL);
  }
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
