<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

if(isset($_POST['year'])){
  $y = $_POST['year'];

  $strSQL = "SELECT * FROM research a INNER JOIN rec_progress b ON a.id_rs  = b.rp_id_rs
            INNER JOIN type_status_research c ON b.rp_progress_status = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN useraccount f ON a.id_pm = f.id_pm
            INNER JOIN userinfo  g ON f.id = g.user_id
            INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
            WHERE
              a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              AND b.rp_progress_status = '1'
              AND b.rp_use_status = '1'
              AND b.rp_year = '$y'
              ORDER BY b.rp_submit_date";

}else{
  $strSQL = "SELECT * FROM research a INNER JOIN rec_progress b ON a.id_rs  = b.rp_id_rs
            INNER JOIN type_status_research c ON b.rp_progress_status = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN useraccount f ON a.id_pm = f.id_pm
            INNER JOIN userinfo  g ON f.id = g.user_id
            INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
            WHERE
              a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              AND b.rp_progress_status = '1'
              AND b.rp_use_status = '1'
              ORDER BY b.rp_submit_date";
}

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
