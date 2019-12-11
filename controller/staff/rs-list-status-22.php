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
          LEFT JOIN userinfo g ON f.id = g.user_id
          WHERE
            a.draft_status = '0'
            AND f.delete_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.id_status_research = '22'";

if(isset($_POST['id_year'])){
  $id_year = mysqli_real_escape_string($conn, $_POST['id_year']);

  $strSQL = "SELECT * FROM research a INNER JOIN type_research b ON a.id_type  = b.id_type
            INNER JOIN type_status_research c ON a.id_status_research = c.id_status_research
            INNER JOIN type_personnel d ON a.id_personnel = d.id_personnel
            INNER JOIN dept e ON a.id_dept = e.id_dept
            INNER JOIN useraccount f ON a.id_pm = f.id_pm
            LEFT JOIN userinfo g ON f.id = g.user_id
            WHERE
              a.draft_status = '0'
              AND f.delete_status = '0'
              AND a.delete_flag = 'N'
              AND a.sendding_status = 'Y'
              AND a.id_status_research = '22'
              AND a.id_year = '$id_year'";
}

$query = mysqli_query($conn, $strSQL);

if($query){
  // while ($row = mysqli_fetch_array($query)) {
  //   $buf = [];
  //   foreach ($row as $key => $value) {
  //       if(!is_int($key)){
  //         $buf[$key] = $value;
  //       }
  //   }
  //   $return[] = $buf;
  // }

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
mysqli_close($conn);
die();

?>
