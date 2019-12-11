<?php
include "../config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_status = mysqli_real_escape_string($conn, $_POST['id_status']);
$msg = mysqli_real_escape_string($conn, $_POST['msg']);

$strSQL = "UPDATE research SET id_status_research = '25' WHERE id_rs = '$id_rs'";
if($query = mysqli_query($conn, $strSQL)){

  // echo "Y";

  $strSQL = "UPDATE research_new_progress SET rwp_status = '1' WHERE rwp_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);

  if(!$query){
    echo $strSQL;
    die();
  }

  $datetime = date('Y-m-d H:i:s');

  $strSQL = "SELECT * FROM dis_approve_project WHERE dis_id_rs = '$id_rs' AND dis_stage = '1'";
  if($q = mysqli_query($conn, $strSQL)){
    if(mysqli_num_rows($q) == 0){
      $strSQL = "INSERT INTO dis_approve_project (dis_id_rs, dis_reg_datetime, dis_stage)
                VALUES ('$id_rs', '$datetime', 'first')
                ";
      mysqli_query($conn, $strSQL);
    }
  }else{
    $strSQL = "INSERT INTO dis_approve_project (dis_id_rs, dis_reg_datetime, dis_stage)
              VALUES ('$id_rs', '$datetime', 'first')
              ";
    mysqli_query($conn, $strSQL);
  }

  $strSQL = "INSERT INTO log_research (log_activity, log_detail, log_datetime, log_view, id_rs, log_by)
            VALUES ('Send to chaiman dis-approval stage', '$msg', '$datetime', '0', '$id_rs',  'EC : $id')";
  mysqli_query($conn, $strSQL);

  $strSQL = "INSERT INTO log_note (log_activity, log_detail, log_ip, log_datetime, log_id_rs, log_by_role, log_by_id ) VALUES ('Add note', '<p>[System] เลขาส่งประธานแจ้งไม่รับรอง</p>$msg', '$ip_add', '$date', '$id_rs', 'ec', '$id')";
  mysqli_query($conn, $strSQL);

  echo "Y";

}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
