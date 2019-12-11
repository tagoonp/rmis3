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
//           INNER JOIN useraccount f ON a.id_pm = f.id_pm
//           INNER JOIN userinfo g ON f.id = g.user_id
//           WHERE
//             a.draft_status = '0'
//             AND a.delete_flag = 'N'
//             AND a.sendding_status = 'Y'
//             -- AND a.id_status_research IN (2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18)
//             -- AND a.id_rs NOT IN (SELECT id_rs FROM rec WHERE 1)
//             AND a.id_year = '".$_POST['id_year']."'
//             AND a.ord_id != '000'";

// $strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
//          LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
//          LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
//          LEFT JOIN dept e ON a.id_dept = e.id_dept
//          LEFT JOIN useraccount f ON a.id_pm = f.id_pm
//          LEFT JOIN userinfo g ON f.id = g.user_id
//           WHERE
//             a.draft_status = '0'
//             AND a.delete_flag = 'N'
//             AND a.sendding_status = 'Y'
//             -- AND a.id_status_research IN (2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18)
//             -- AND a.id_rs NOT IN (SELECT id_rs FROM rec WHERE 1)
//             AND a.id_year = '".$_POST['id_year']."'
//             AND a.ord_id != '000'
//             ORDER BY a.ord_id";

// $strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
//          LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
//          LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
//          LEFT JOIN dept e ON a.id_dept = e.id_dept
//          LEFT JOIN useraccount f ON a.id_pm = f.id_pm
//          LEFT JOIN userinfo g ON f.id = g.user_id
//           WHERE
//             a.draft_status = '0'
//             AND a.delete_flag = 'N'
//             AND f.delete_status = '0'
//             AND a.sendding_status = 'Y'
//             AND a.id_year = '".$_POST['id_year']."'
//             ORDER BY a.ord_id";
$strSQL = "SELECT * FROM research a LEFT JOIN type_research b ON a.id_type  = b.id_type
         LEFT JOIN type_status_research c ON a.id_status_research = c.id_status_research
         LEFT JOIN type_personnel d ON a.id_personnel = d.id_personnel
         LEFT JOIN dept e ON a.id_dept = e.id_dept
         LEFT JOIN useraccount f ON a.id_pm = f.id_pm
         LEFT JOIN userinfo g ON f.id = g.user_id
          WHERE
            a.draft_status = '0'
            AND f.delete_status = '0'
            AND a.sendding_status = 'Y'
            AND a.id_year = '".$_POST['id_year']."'
            AND f.delete_status = '0'
            ORDER BY a.ord_id";

$query = mysqli_query($conn, $strSQL);

if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          $buf[$key] = $value;

          if($key == 'id_ec'){
            $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '$value'";
            if($query2 = mysqli_query($conn, $strSQL)){
              $rw = mysqli_fetch_assoc($query2);
              $buf['ec_name'] = $rw['fname'] . " " . $rw['lname'];
            }
          }

          if($key == 'id_rs'){
            $strSQL = "SELECT * FROM research_consider_type WHERE rct_id_rs = '$value' AND rct_conf = '1'";
            if($query3 = mysqli_query($conn, $strSQL)){
              $rw = mysqli_fetch_assoc($query3);
              $buf['consider_type'] = $rw['rct_type'];
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
