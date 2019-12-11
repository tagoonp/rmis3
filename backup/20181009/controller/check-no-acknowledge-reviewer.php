<?php
include "config.class.php";


$log_ip = $_SERVER['REMOTE_ADDR'];
$return = [];

$strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN useraccount b on a.rir_id_reviewer = b.id
          INNER JOIN userinfo c ON b.id = c.user_id
          INNER JOIN type_prefix d ON c.id_prefix = d.id_prefix
          WHERE a.rir_conf = '1' AND a.rw_sending_status = '1' AND a.rw_reply_status = 0 ORDER BY a.rir_id";
$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    // $buf = [];
    // foreach ($row as $key => $value) {
    //     if(!is_int($key)){
    //       $buf[$key] = $value;
    //     }
    // }
    // $return[] = $buf;

    getDatediff($row['rw_sending_notify_date']);
  }
}


echo json_encode($return);
mysqli_close($conn);
die();


function getDatediff($cdate){
  $cdate = date('Y-m-d');
  $date1 = new DateTime($cdate);
  $date2 = new DateTime("2009-06-26");
  $interval = $date1->diff($date2);
  echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";

  // shows the total amount of days (not divided into years, months and days like above)
  echo "difference " . $interval->days . " days ";
}

?>
