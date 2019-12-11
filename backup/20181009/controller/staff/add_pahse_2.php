<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}


$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$dateonly = date("Y-m-d");
$return = [];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
          WHERE a.id_rs = '$id_rs' AND i.rct_conf = 1";


if($query = mysqli_query($conn, $strSQL)){

  $row = mysqli_fetch_assoc($query);

  $strSQL = "INSERT INTO rec (id_rs, id_apdu, id_pm, rs_type, approve_date, udate, uby)
            VALUES ('".$row["id_rs"]."','".$row["code_apdu"]."','".$row["id_pm"]."','".$row["rct_type"]."','".$dateonly."','$date','$id')";
  $query2 = mysqli_query($conn, $strSQL);
  if($query2){
    echo "Y";
  }else{
    echo $strSQL;
  }

}else{
  echo "N";
}

mysqli_close($conn);
die();

?>
