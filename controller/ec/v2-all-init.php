<?php
include "../config.class.php";

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$rrp = 20;
$start = 0;

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_year = mysqli_real_escape_string($conn, $_POST['id_year']);

if(isset($_POST['ppp'])){
  $rrp = $_POST['ppp'];
}

if(isset($_POST['start'])){
  $start = $_POST['start'];
}

$strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
          INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
          INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
          INNER JOIN dept e ON a.id_dept = e.id_dept
          INNER JOIN useraccount f ON a.id_pm = f.id_pm
          INNER JOIN userinfo g ON f.id = g.user_id
          INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            -- AND a.id_status_research in ('3', '28')
            AND a.code_apdu != ''
            AND a.id_year = '$id_year'
            -- AND f.delete_status = '0'
            -- AND a.id_rs NOT IN (SELECT rct_id_rs FROM research_consider_type WHERE 1)
            ORDER BY a.date_submit DESC
            LIMIT $start, $rrp";

if($id_year == ''){
  $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
            INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN useraccount f ON a.id_pm = f.id_pm
            INNER JOIN userinfo g ON f.id = g.user_id
            INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
            WHERE
              a.draft_status = '0'
              AND a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              -- AND a.id_status_research in ('3', '28')
              AND a.code_apdu != ''
              -- AND f.delete_status = '0'
              -- AND a.id_rs NOT IN (SELECT rct_id_rs FROM research_consider_type WHERE 1)
              ORDER BY a.date_submit DESC
              LIMIT $start, $rrp";
}
$query = mysqli_query($conn, $strSQL);

if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];

    $buf['ec_consider_name'] = '-';
    $buf['ec_consider_email'] = '-';

    $buf['ec_board_name'] = '-';
    $buf['ec_board_email'] = '-';

    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;
        }



        if($key == 'id_ec'){
          $strSQL = "SELECT b.fname, b.lname, a.email FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$value' AND a.delete_status = '0' AND allow_status = '1'";
          $query2 = mysqli_query($conn, $strSQL);
          if($query2){
            $buf['a1'] = 'a';
            if(mysqli_num_rows($query2) > 0){
              $buf['a1'] = 'a1';
              $data = mysqli_fetch_assoc($query2);
              $buf['ec_consider_name'] = $data['fname'] . " " . $data['lname'];
              $buf['ec_consider_email'] = $data['email'];
            }
          }
        }
    }
    $return[] = $buf;
  }
}

echo json_encode($return);
mysqli_close($conn);
die();

?>
