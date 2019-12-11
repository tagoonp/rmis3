<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);
$return = [];

$strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
          INNER JOIN research_consider_type c ON a.rir_id_rs = c.rct_id_rs
          WHERE
          a.rir_id_reviewer = '$id'
          AND a.rir_conf = '1'
          AND a.rw_sending_status = '1' AND a.rw_reply_status in ('3','4')";

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
