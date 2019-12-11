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
          INNER JOIN useraccount f ON a.id_pm = f.id_pm
          INNER JOIN userinfo  g ON f.id = g.user_id
          INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.research_status = 'new'
            AND f.delete_status = '0'
            AND a.id_year >= '19'
            AND (a.id_status_research = '1' OR a.id_status_research = '9')
            ORDER BY a.date_submit";

if(isset($_POST['id_year'])){
  $id_year = mysqli_real_escape_string($conn, $_POST['id_year']);
  $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
            INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN useraccount f ON a.id_pm = f.id_pm
            INNER JOIN userinfo  g ON f.id = g.user_id
            INNER JOIN type_prefix h ON g.id_prefix = h.id_prefix
            WHERE
              a.draft_status = '0'
              AND a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              AND a.research_status = 'new'
              AND f.delete_status = '0'
              AND a.id_year = '$id_year'
              AND (a.id_status_research = '1' OR a.id_status_research = '9')
              ORDER BY a.date_submit";
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
