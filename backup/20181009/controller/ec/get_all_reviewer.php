<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

// $strSQL = "SELECT * FROM useraccount a
//           INNER JOIN reviewer b ON a.id = b.account_id
//           INNER JOIN type_prefix f ON b.id_prefix = f.id_prefix
//           WHERE a.usertype = 'reviewer' AND a.delete_status = '0' ORDER BY b.fname";

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
           INNER JOIN type_prefix c ON b.id_prefix = c.id_prefix
           WHERE a.delete_status = '0' AND a.allow_status = '1' AND a.reviewer_role = '1' ORDER BY b.fname";

$query = mysqli_query($conn, $strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){

          if($key == 'id'){

            $strSQL = "SELECT rt_tag FROM reviewer_tag WHERE rt_id_reviewer = '$value' ";
            if($query2 = mysqli_query($conn, $strSQL)){
              $buf2 = [];
              while ($row2 = mysqli_fetch_array($query2)) {
                foreach ($row2 as $key2 => $value2) {
                    if(!is_int($key2)){
                      $buf2[] = $value2;
                    }
                }
                $buf['tag'] = implode(', ', $buf2);
              }
            }
          }

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
