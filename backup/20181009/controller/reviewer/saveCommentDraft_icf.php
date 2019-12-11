<?php
include "../config.class.php";

if(!isset($_POST['user'])){
  mysqli_close($conn);
  die();
}

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");
$return = [];
$cm_id = '';

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_POST['user']);
$efb_gc = mysqli_real_escape_string($conn, $_POST['efb_gc']);
$efb_1 = mysqli_real_escape_string($conn, $_POST['efb_1']);
$efb_2 = mysqli_real_escape_string($conn, $_POST['efb_2']);
$efb_3 = mysqli_real_escape_string($conn, $_POST['efb_3']);
$efb_4 = mysqli_real_escape_string($conn, $_POST['efb_4']);
$efb_5 = mysqli_real_escape_string($conn, $_POST['efb_5']);
$efb_6 = mysqli_real_escape_string($conn, $_POST['efb_6']);
$efb_7 = mysqli_real_escape_string($conn, $_POST['efb_7']);
$efb_8 = mysqli_real_escape_string($conn, $_POST['efb_8']);
$efb_9 = mysqli_real_escape_string($conn, $_POST['efb_9']);
$efb_10 = mysqli_real_escape_string($conn, $_POST['efb_10']);
$efb_11 = mysqli_real_escape_string($conn, $_POST['efb_11']);
$efb_12 = mysqli_real_escape_string($conn, $_POST['efb_12']);
$efb_13 = mysqli_real_escape_string($conn, $_POST['efb_13']);
$efb_14 = mysqli_real_escape_string($conn, $_POST['efb_14']);
$efb_15 = mysqli_real_escape_string($conn, $_POST['efb_15']);
$efb_16 = mysqli_real_escape_string($conn, $_POST['efb_16']);
$efb_17 = mysqli_real_escape_string($conn, $_POST['efb_17']);
$efb_18 = mysqli_real_escape_string($conn, $_POST['efb_18']);
$efb_19 = mysqli_real_escape_string($conn, $_POST['efb_19']);
$efb_20 = mysqli_real_escape_string($conn, $_POST['efb_20']);
$efb_21 = mysqli_real_escape_string($conn, $_POST['efb_21']);
$efb_22 = mysqli_real_escape_string($conn, $_POST['efb_22']);
$efb_23 = mysqli_real_escape_string($conn, $_POST['efb_23']);
$efb_42 = mysqli_real_escape_string($conn, $_POST['efb_42']);

$strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $strSQL = "UPDATE eform_icf
              SET
              efi_gc = '$efb_gc',
              efi_1 = '$efb_1',
              efi_2 = '$efb_2',
              efi_3 = '$efb_3',
              efi_4 = '$efb_4',
              efi_5 = '$efb_5',
              efi_6 = '$efb_6',
              efi_7 = '$efb_7',
              efi_8 = '$efb_8',
              efi_9 = '$efb_9',
              efi_10 = '$efb_10',
              efi_11 = '$efb_11',
              efi_12 = '$efb_12',
              efi_13 = '$efb_13',
              efi_14 = '$efb_14',
              efi_15 = '$efb_15',
              efi_16 = '$efb_16',
              efi_17 = '$efb_17',
              efi_18 = '$efb_18',
              efi_19 = '$efb_19',
              efi_20 = '$efb_20',
              efi_21 = '$efb_21',
              efi_22 = '$efb_22',
              efi_23 = '$efb_23',
              efi_42 = '$efb_42',
              efi_status = 'draft',
              efi_udate = '$date'
              WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs= '$id_rs'
              ";
              mysqli_query($conn, $strSQL);
  }else{
    $strSQL = "INSERT INTO eform_icf (efi_gc, efi_1, efi_2, efi_3, efi_4, efi_5,
              efi_6, efi_7, efi_8, efi_9, efi_10, efi_11, efi_12, efi_13, efi_14, efi_15, efi_16
              , efi_17, efi_18, efi_19, efi_20, efi_21, efi_22, efi_23, efi_42, efi_status, efi_udate, efi_reviewer_id, efi_id_rs)
              VALUES ('$efb_gc', '$efb_1', '$efb_2', '$efb_3', '$efb_4'
              , '$efb_5', '$efb_6', '$efb_7', '$efb_8', '$efb_9', '$efb_10', '$efb_11', '$efb_12'
              , '$efb_13', '$efb_14', '$efb_15', '$efb_16', '$efb_17', '$efb_18', '$efb_19', '$efb_20'
              , '$efb_21', '$efb_22', '$efb_23', '$efb_42', 'draft', '$date', '$id_reviewer', '$id_rs'
            )";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO eform_icf (efi_gc, efi_1, efi_2, efi_3, efi_4, efi_5,
            efi_6, efi_7, efi_8, efi_9, efi_10, efi_11, efi_12, efi_13, efi_14, efi_15, efi_16
            , efi_17, efi_18, efi_19, efi_20, efi_21, efi_22, efi_23, efi_42, efi_status, efi_udate, efi_reviewer_id, efi_id_rs)
            VALUES ('$efb_gc', '$efb_1', '$efb_2', '$efb_3', '$efb_4'
            , '$efb_5', '$efb_6', '$efb_7', '$efb_8', '$efb_9', '$efb_10', '$efb_11', '$efb_12'
            , '$efb_13', '$efb_14', '$efb_15', '$efb_16', '$efb_17', '$efb_18', '$efb_19', '$efb_20'
            , '$efb_21', '$efb_22', '$efb_23', '$efb_42', 'draft', '$date', '$id_reviewer', '$id_rs'
          )";
  $result = mysqli_query($conn, $strSQL);
  if($result){
    echo "Y";
  }else{
    echo $strSQL;
  }
}

mysqli_close($conn);
die();

?>
