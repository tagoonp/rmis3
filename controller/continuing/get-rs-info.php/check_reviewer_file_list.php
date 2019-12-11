<?php
include "../config.class.php";

if(!isset($_POST['rir_id'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];

$ririd = mysqli_real_escape_string($conn, $_POST['rir_id']);

$strSQL = "SELECT * FROM research_init_reviewer_file_attached a INNER JOIN file_assesment b ON a.rif_fileid = b.fid
          WHERE a.rif_rir_id = '$ririd'";
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
