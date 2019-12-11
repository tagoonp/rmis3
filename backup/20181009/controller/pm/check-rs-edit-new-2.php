<?php
include "../config.class.php";

if((!isset($_POST['id']))){
  mysqli_close($conn);
  die();
}

$id = mysqli_real_escape_string($conn, $_POST['id']);

$return = [];
$buffer = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo  b ON a.id = b.user_id
WHERE a.id = '$id'  AND a.delete_status = '0'";
$query = mysqli_query($conn, $strSQL);
$id_pm = '';

// echo json_encode($strSQL);
// die();

if($query){
  $rn = mysqli_num_rows($query);
  if($rn > 0){
    $row = mysqli_fetch_assoc($query);
    $id_pm = $row['id_pm'];
  }else{
    mysqli_close($conn);
    die();
  }
}else{
  mysqli_close($conn);
  die();
}

if($id_pm == ''){
  mysqli_close($conn);
  die();
}

$strSQL = "SELECT * FROM research a INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
           INNER JOIN useraccount c ON a.id_pm = c.id_pm
           INNER JOIN userinfo d ON c.id = d.user_id
           INNER JOIN type_prefix e ON d.id_prefix = e.id_prefix
           WHERE
           a.id_pm = '$id_pm'
           AND a.draft_status = '0'
           AND a.delete_flag = 'N'
           AND a.sendding_status = 'Y'
           -- AND a.research_status = 'new'
           AND a.id_status_research in ('20')
           ";
$query = mysqli_query($conn, $strSQL);
// echo json_encode($strSQL);
if($query){
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    foreach ($row as $key => $value) {
        if(!is_int($key)){
          if($key == 'id_rs'){
            $buf[$key] = $value;
            $strSQL = "SELECT * FROM research_init_rw_comment WHERE riwc_id_rs = '$value' AND riwc_ustatus = '1' ";
            $qr = mysqli_query($conn, $strSQL);
            if($qr){
              $nr = mysqli_num_rows($qr);
              if($nr > 0){
                $buf['q_rw'] = '1';
              }else{
                $buf['q_rw'] = '0';
              }
            }
          }else{
            $buf[$key] = $value;
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
