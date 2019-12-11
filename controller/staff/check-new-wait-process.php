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
          INNER JOIN research_new_progress f ON a.id_rs = f.rwp_id_rs
          INNER JOIN useraccount g ON a.id_pm = g.id_pm
          INNER JOIN userinfo h ON g.id = h.user_id
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND g.delete_status = '0'
            AND a.id_status_research not in ('1', '5')
            AND a.code_apdu != ''
            AND f.rwp_status = '0'
            AND i.rct_type NOT IN ('Fullboard (Social)', 'Fullboard (Bio)')
            ";

if(isset($_POST['id_year'])){
  $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
            INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN research_new_progress f ON a.id_rs = f.rwp_id_rs
            INNER JOIN useraccount g ON a.id_pm = g.id_pm
            INNER JOIN userinfo h ON g.id = h.user_id
            INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
            WHERE
              a.draft_status = '0'
              AND a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              AND g.delete_status = '0'
              AND a.id_status_research not in ('1', '5')
              AND a.code_apdu != ''
              AND f.rwp_status = '0'
              AND a.id_year = '".$_POST['id_year']."'
              AND i.rct_type NOT IN ('Fullboard (Social)', 'Fullboard (Bio)')
              ";
}


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

            $strSQL = "SELECT * FROM research_consider_type WHERE rct_id_rs = '".$row['id_rs']."' AND rct_status = '1'";
            if($query3 = mysqli_query($conn, $strSQL)){
              $rw = mysqli_fetch_assoc($query3);
              if(sizeof($rw) > 0){
                $buf['ec_fb'] = 'Y';
                $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.id = '".$rw['rct_fb_ec']."'";
                if($query4 = mysqli_query($conn, $strSQL)){
                  $rw = mysqli_fetch_assoc($query4);
                  $buf['ec_fb_name'] = $rw['fname'] . " " . $rw['lname'];
                }
              }
            }else{
              $buf['ec_fb'] = $strSQL;
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
// echo json_encode($strSQL);
mysqli_close($conn);
die();

?>
