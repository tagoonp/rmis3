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
$efs_gc = mysqli_real_escape_string($conn, $_POST['efb_gc']);
$efs_1 = mysqli_real_escape_string($conn, $_POST['efb_1']);
$efs_2 = mysqli_real_escape_string($conn, $_POST['efb_2']);
$efs_3 = mysqli_real_escape_string($conn, $_POST['efb_3']);
$efs_4 = mysqli_real_escape_string($conn, $_POST['efb_4']);
$efs_5 = mysqli_real_escape_string($conn, $_POST['efb_5']);
$efs_6 = mysqli_real_escape_string($conn, $_POST['efb_6']);
$efs_7 = mysqli_real_escape_string($conn, $_POST['efb_7']);
$efs_8 = mysqli_real_escape_string($conn, $_POST['efb_8']);
$efs_9 = mysqli_real_escape_string($conn, $_POST['efb_9']);
$efs_10 = mysqli_real_escape_string($conn, $_POST['efb_10']);
$efs_11 = mysqli_real_escape_string($conn, $_POST['efb_11']);
$efs_12 = mysqli_real_escape_string($conn, $_POST['efb_12']);
$efs_13 = mysqli_real_escape_string($conn, $_POST['efb_13']);
$efs_14 = mysqli_real_escape_string($conn, $_POST['efb_14']);
$efs_15 = mysqli_real_escape_string($conn, $_POST['efb_15']);
$efs_16 = mysqli_real_escape_string($conn, $_POST['efb_16']);
$efs_17 = mysqli_real_escape_string($conn, $_POST['efb_17']);
$efs_18 = mysqli_real_escape_string($conn, $_POST['efb_18']);
$efs_19 = mysqli_real_escape_string($conn, $_POST['efb_19']);
$efs_20 = mysqli_real_escape_string($conn, $_POST['efb_20']);
$efs_21 = mysqli_real_escape_string($conn, $_POST['efb_21']);
$efs_22 = mysqli_real_escape_string($conn, $_POST['efb_22']);
$efs_23 = mysqli_real_escape_string($conn, $_POST['efb_23']);
$efs_24 = mysqli_real_escape_string($conn, $_POST['efb_24']);
$efs_25 = mysqli_real_escape_string($conn, $_POST['efb_25']);
$efs_26 = mysqli_real_escape_string($conn, $_POST['efb_26']);
$efs_27 = mysqli_real_escape_string($conn, $_POST['efb_27']);
$efs_28 = mysqli_real_escape_string($conn, $_POST['efb_28']);
$efs_29 = mysqli_real_escape_string($conn, $_POST['efb_29']);
$efs_30 = mysqli_real_escape_string($conn, $_POST['efb_30']);
$efs_42 = mysqli_real_escape_string($conn, $_POST['efb_42']);

$strSQL = "SELECT * FROM eform_social WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $data = mysqli_fetch_assoc($query);
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    if($data['efs_status'] != 'draft'){
      $strSQL = "UPDATE eform_social
                SET
                efs_gc = '$efs_gc',
                efs_1 = '$efs_1',
                efs_2 = '$efs_2',
                efs_3 = '$efs_3',
                efs_4 = '$efs_4',
                efs_5 = '$efs_5',
                efs_6 = '$efs_6',
                efs_7 = '$efs_7',
                efs_8 = '$efs_8',
                efs_9 = '$efs_9',
                efs_10 = '$efs_10',
                efs_11 = '$efs_11',
                efs_12 = '$efs_12',
                efs_13 = '$efs_13',
                efs_14 = '$efs_14',
                efs_15 = '$efs_15',
                efs_16 = '$efs_16',
                efs_17 = '$efs_17',
                efs_18 = '$efs_18',
                efs_19 = '$efs_19',
                efs_20 = '$efs_20',
                efs_21 = '$efs_21',
                efs_22 = '$efs_22',
                efs_23 = '$efs_23',
                efs_24 = '$efs_24',
                efs_25 = '$efs_25',
                efs_26 = '$efs_26',
                efs_27 = '$efs_27',
                efs_28 = '$efs_28',
                efs_29 = '$efs_29',
                efs_30 = '$efs_30',
                efs_42 = '$efs_42',
                efs_udate = '$date'
                WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs'
                ";
                mysqli_query($conn, $strSQL);
                echo "Y";
    }else{
      $strSQL = "UPDATE eform_social
                SET
                efs_gc = '$efs_gc',
                efs_1 = '$efs_1',
                efs_2 = '$efs_2',
                efs_3 = '$efs_3',
                efs_4 = '$efs_4',
                efs_5 = '$efs_5',
                efs_6 = '$efs_6',
                efs_7 = '$efs_7',
                efs_8 = '$efs_8',
                efs_9 = '$efs_9',
                efs_10 = '$efs_10',
                efs_11 = '$efs_11',
                efs_12 = '$efs_12',
                efs_13 = '$efs_13',
                efs_14 = '$efs_14',
                efs_15 = '$efs_15',
                efs_16 = '$efs_16',
                efs_17 = '$efs_17',
                efs_18 = '$efs_18',
                efs_19 = '$efs_19',
                efs_20 = '$efs_20',
                efs_21 = '$efs_21',
                efs_22 = '$efs_22',
                efs_23 = '$efs_23',
                efs_24 = '$efs_24',
                efs_25 = '$efs_25',
                efs_26 = '$efs_26',
                efs_27 = '$efs_27',
                efs_28 = '$efs_28',
                efs_29 = '$efs_29',
                efs_30 = '$efs_30',
                efs_42 = '$efs_42',
                efs_status = 'draft',
                efs_udate = '$date'
                WHERE efs_reviewer_id = '$id_reviewer' AND efs_id_rs= '$id_rs'
                ";
                mysqli_query($conn, $strSQL);
                echo "Y";
    }
  }else{
    $strSQL = "INSERT INTO eform_social (efs_gc, efs_1, efs_2, efs_3, efs_4, efs_5,
              efs_6, efs_7, efs_8, efs_9, efs_10, efs_11, efs_12, efs_13, efs_14, efs_15, efs_16
              , efs_17, efs_18, efs_19, efs_20, efs_21, efs_22, efs_23, efs_24, efs_25, efs_26, efs_27
              , efs_28, efs_29, efs_30, efs_42, efs_status, efs_udate, efs_reviewer_id, efs_id_rs)
              VALUES ('$efs_gc', '$efs_1', '$efs_2', '$efs_3', '$efs_4'
              , '$efs_5', '$efs_6', '$efs_7', '$efs_8', '$efs_9', '$efs_10', '$efs_11', '$efs_12'
              , '$efs_13', '$efs_14', '$efs_15', '$efs_16', '$efs_17', '$efs_18', '$efs_19', '$efs_20'
              , '$efs_21', '$efs_22', '$efs_23', '$efs_24', '$efs_25', '$efs_26', '$efs_27', '$efs_28'
              , '$efs_29', '$efs_30', '$efs_42', 'draft', '$date', '$id_reviewer', '$id_rs'
            )";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO eform_social (efs_gc, efs_1, efs_2, efs_3, efs_4, efs_5,
            efs_6, efs_7, efs_8, efs_9, efs_10, efs_11, efs_12, efs_13, efs_14, efs_15, efs_16
            , efs_17, efs_18, efs_19, efs_20, efs_21, efs_22, efs_23, efs_24, efs_25, efs_26, efs_27
            , efs_28, efs_29, efs_30, efs_42, efs_status, efs_udate, efs_reviewer_id, efs_id_rs)
            VALUES ('$efs_gc', '$efs_1', '$efs_2', '$efs_3', '$efs_4'
            , '$efs_5', '$efs_6', '$efs_7', '$efs_8', '$efs_9', '$efs_10', '$efs_11', '$efs_12'
            , '$efs_13', '$efs_14', '$efs_15', '$efs_16', '$efs_17', '$efs_18', '$efs_19', '$efs_20'
            , '$efs_21', '$efs_22', '$efs_23', '$efs_24', '$efs_25', '$efs_26', '$efs_27', '$efs_28'
            , '$efs_29', '$efs_30', '$efs_42', 'draft', '$date', '$id_reviewer', '$id_rs'
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
