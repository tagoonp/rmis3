<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['doc_name'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['doc_id'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['doc_session'])){
  mysqli_close($conn);
  die();
}





$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$doc_lv = '1';

$return = [];
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id = mysqli_real_escape_string($conn, $_POST['id']);
$doc_name = mysqli_real_escape_string($conn, $_POST['doc_name']);
$doc_lv = mysqli_real_escape_string($conn, $_POST['doc_lv']);
$doc_id = mysqli_real_escape_string($conn, $_POST['doc_id']);
$doc_session = mysqli_real_escape_string($conn, $_POST['doc_session']);


$strSQL = "SELECT MAX(init_doc_seq) mseq FROM initial_approval_document WHERE init_doc_id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);

$new_seq = '1';

if($result){
  $r = mysqli_fetch_assoc($result);
  $new_seq = $r['mseq'] + 1;
}

if($doc_id == ''){
  $strSQL = "INSERT INTO
                initial_approval_document (init_doc_name, init_doc_level, init_doc_id_rs, init_doc_seq, init_doc_udate, init_doc_by, init_doc_session)
             VALUES
                ('<div>$doc_name</div>','$doc_lv','$id_rs','$new_seq','$date','$id', '$doc_session')
            ";

  if($doc_lv == '2'){
    $strSQL = "INSERT INTO
                  initial_approval_document (init_doc_name, init_doc_level, init_doc_id_rs, init_doc_seq, init_doc_udate, init_doc_by, init_doc_session)
               VALUES
                  ('<div style=padding-left: 100px;>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$doc_name</div>','$doc_lv','$id_rs','$new_seq','$date','$id', '$doc_session')
              ";
  }
  $result_insert = mysqli_query($conn, $strSQL);

  if($result_insert){
    echo "Y";
  }else{
    echo "N".$strSQL;
  }
}else{
  $strSQL = "UPDATE
                initial_approval_document
             SET
                init_doc_name = '$doc_name',
                init_doc_level = '$doc_lv',
                init_doc_udate = '$date',
                init_doc_by = '$id'
             WHERE
                init_doc_id = '$doc_id'
                AND init_doc_session = '$doc_session'
            ";
  $result_insert = mysqli_query($conn, $strSQL);

  if($result_insert){
    echo "Y";
  }else{
    echo "N".$strSQL;
  }
}


mysqli_close($conn);
die();


?>
