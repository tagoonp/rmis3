<?php
include "../config.class.php";

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['session_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['stage'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['choice'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['phase'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);
$stage = mysqli_real_escape_string($conn, $_POST['stage']);
$choice = mysqli_real_escape_string($conn, $_POST['choice']);
$p = mysqli_real_escape_string($conn, $_POST['phase']);

$strSQL = "SELECT * FROM useraccount WHERE id = '$id'";
$id_pm = '';
if($query = mysqli_query($conn, $strSQL)){
  $row = mysqli_fetch_assoc($query);
  $id_pm = $row['id_pm'];
}

if($id_pm == ''){
  mysqli_close($conn);
  die();
}

$id_rs = '';
$strSQL = "SELECT * FROM research WHERE id_pm = '$id_pm' AND session_id = '$session_id'";
if($query = mysqli_query($conn, $strSQL)){
  if(mysqli_num_rows($query) > 0){
    $row = mysqli_fetch_assoc($query);
    $id_rs = $row['id_rs'];
  }else{
    echo "NR";
    mysqli_close($conn);
    die();
  }
}else{
  echo "NR";
  mysqli_close($conn);
  die();
}

if($p == 'update'){

  $strSQL = "UPDATE research_init_budget_doc SET ribd_status = '0' WHERE ribd_id_rs = '$id_rs'";
  mysqli_query($conn, $strSQL);


  $strSQL = "INSERT INTO research_init_budget_doc (ribd_id_rs, ribd_stage, ribd_chioce, ribd_udate) VALUES ('$id_rs', '$stage', '$choice', '$date')";
  if($query = mysqli_query($conn, $strSQL)){
    echo "Y";
  }else{
    echo "N1";
  }

  mysqli_close($conn);
  die();
}else if($p == 'check'){

  $strSQL = "SELECT * FROM research_init_budget_doc WHERE ribd_id_rs = '$id_rs' AND ribd_status = '1'";
  if($query = mysqli_query($conn, $strSQL)){
    $n = mysqli_num_rows($query);
    if($n > 0){
      echo "Y";
    }else{
      echo "N";
    }
  }else{
    echo "N";
  }

  mysqli_close($conn);
  die();
}



?>
