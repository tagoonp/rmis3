<?php
include "../config.class.php";


if(!isset($_POST['tm'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['vara'])){
  mysqli_close($conn);
  die();
}

$vara = mysqli_real_escape_string($conn, $_POST['vara']);
$tm = mysqli_real_escape_string($conn, $_POST['tm']);


$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$return = [];
$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
          INNER JOIN userinfo c ON b.id = c.user_id
          LEFT JOIN dept d ON a.id_dept = d.id_dept
          INNER JOIN research_assign_fullboard_agendar e ON a.id_rs = e.rafa_id_rs
          INNER JOIN type_prefix h ON c.id_prefix = h.id_prefix
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.code_apdu != ''
            AND b.delete_status = '0'
            AND e.rafa_agn = '$tm' AND e.rafa_panal = '$vara'
            ORDER BY a.ord_id, a.id_rs
          ";

          if($query = mysqli_query($conn, $strSQL)){


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
