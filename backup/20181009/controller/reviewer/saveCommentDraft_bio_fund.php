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
$efb_24 = mysqli_real_escape_string($conn, $_POST['efb_24']);
$efb_25 = mysqli_real_escape_string($conn, $_POST['efb_25']);
$efb_26 = mysqli_real_escape_string($conn, $_POST['efb_26']);
$efb_27 = mysqli_real_escape_string($conn, $_POST['efb_27']);
$efb_28 = mysqli_real_escape_string($conn, $_POST['efb_28']);
$efb_29 = mysqli_real_escape_string($conn, $_POST['efb_29']);
$efb_30 = mysqli_real_escape_string($conn, $_POST['efb_30']);
$efb_31 = mysqli_real_escape_string($conn, $_POST['efb_31']);
$efb_32 = mysqli_real_escape_string($conn, $_POST['efb_32']);
$efb_33 = mysqli_real_escape_string($conn, $_POST['efb_33']);
$efb_34 = mysqli_real_escape_string($conn, $_POST['efb_34']);
$efb_35 = mysqli_real_escape_string($conn, $_POST['efb_35']);
$efb_36 = mysqli_real_escape_string($conn, $_POST['efb_36']);
$efb_37 = mysqli_real_escape_string($conn, $_POST['efb_37']);
$efb_38 = mysqli_real_escape_string($conn, $_POST['efb_38']);
$efb_39 = mysqli_real_escape_string($conn, $_POST['efb_39']);
$efb_40 = mysqli_real_escape_string($conn, $_POST['efb_40']);
$efb_41 = mysqli_real_escape_string($conn, $_POST['efb_41']);
$efb_42 = mysqli_real_escape_string($conn, $_POST['efb_42']);
$efb_43 = mysqli_real_escape_string($conn, $_POST['efb_43']);
$efb_44 = mysqli_real_escape_string($conn, $_POST['efb_44']);
$efb_45 = mysqli_real_escape_string($conn, $_POST['efb_45']);
$efb_46 = mysqli_real_escape_string($conn, $_POST['efb_46']);
$efb_47 = mysqli_real_escape_string($conn, $_POST['efb_47']);
$efb_48 = mysqli_real_escape_string($conn, $_POST['efb_48']);
$efb_49 = mysqli_real_escape_string($conn, $_POST['efb_49']);
$efb_50 = mysqli_real_escape_string($conn, $_POST['efb_50']);
$efb_51 = mysqli_real_escape_string($conn, $_POST['efb_51']);
$efb_52 = mysqli_real_escape_string($conn, $_POST['efb_52']);
$efb_53 = mysqli_real_escape_string($conn, $_POST['efb_53']);

$strSQL = "SELECT * FROM eform_bio_fund WHERE efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs'";
$query = mysqli_query($conn, $strSQL);
if($query){
  $nrow = mysqli_num_rows($query);
  if($nrow > 0){
    $strSQL = "UPDATE eform_bio_fund
              SET
              efb_gc = '$efb_gc',
              efb_1 = '$efb_1',
              efb_2 = '$efb_2',
              efb_3 = '$efb_3',
              efb_4 = '$efb_4',
              efb_5 = '$efb_5',
              efb_6 = '$efb_6',
              efb_7 = '$efb_7',
              efb_8 = '$efb_8',
              efb_9 = '$efb_9',
              efb_10 = '$efb_10',
              efb_11 = '$efb_11',
              efb_12 = '$efb_12',
              efb_13 = '$efb_13',
              efb_14 = '$efb_14',
              efb_15 = '$efb_15',
              efb_16 = '$efb_16',
              efb_17 = '$efb_17',
              efb_18 = '$efb_18',
              efb_19 = '$efb_19',
              efb_20 = '$efb_20',
              efb_21 = '$efb_21',
              efb_22 = '$efb_22',
              efb_23 = '$efb_23',
              efb_24 = '$efb_24',
              efb_25 = '$efb_25',
              efb_26 = '$efb_26',
              efb_27 = '$efb_27',
              efb_28 = '$efb_28',
              efb_29 = '$efb_29',
              efb_30 = '$efb_30',
              efb_31 = '$efb_31',
              efb_32 = '$efb_32',
              efb_33 = '$efb_33',
              efb_34 = '$efb_34',
              efb_35 = '$efb_35',
              efb_36 = '$efb_36',
              efb_37 = '$efb_37',
              efb_38 = '$efb_38',
              efb_39 = '$efb_39',
              efb_40 = '$efb_40',
              efb_41 = '$efb_41',
              efb_42 = '$efb_42',
              efb_43 = '$efb_43',
              efb_44 = '$efb_44',
              efb_45 = '$efb_45',
              efb_46 = '$efb_46',
              efb_47 = '$efb_47',
              efb_48 = '$efb_48',
              efb_49 = '$efb_49',
              efb_50 = '$efb_50',
              efb_51 = '$efb_51',
              efb_52 = '$efb_52',
              efb_53 = '$efb_53',
              efb_status = 'draft',
              efb_udate = '$date'
              WHERE efb_reviewer_id = '$id_reviewer' AND efb_id_rs= '$id_rs'
              ";
              mysqli_query($conn, $strSQL);
  }else{
    $strSQL = "INSERT INTO eform_bio_fund (efb_gc, efb_1, efb_2, efb_3, efb_4, efb_5,
              efb_6, efb_7, efb_8, efb_9, efb_10, efb_11, efb_12, efb_13, efb_14, efb_15, efb_16
              , efb_17, efb_18, efb_19, efb_20, efb_21, efb_22, efb_23, efb_24, efb_25, efb_26, efb_27
              , efb_28, efb_29, efb_30, efb_31, efb_32, efb_33, efb_34, efb_35, efb_36, efb_37, efb_38
              , efb_39, efb_40, efb_41, efb_42, efb_43, efb_44, efb_45, efb_46, efb_47, efb_48, efb_49,
               efb_50, efb_51, efb_52, efb_53, efb_status, efb_udate, efb_reviewer_id, efb_id_rs)
              VALUES ('$efb_gc', '$efb_1', '$efb_2', '$efb_3', '$efb_4'
              , '$efb_5', '$efb_6', '$efb_7', '$efb_8', '$efb_9', '$efb_10', '$efb_11', '$efb_12'
              , '$efb_13', '$efb_14', '$efb_15', '$efb_16', '$efb_17', '$efb_18', '$efb_19', '$efb_20'
              , '$efb_21', '$efb_22', '$efb_23', '$efb_24', '$efb_25', '$efb_26', '$efb_27', '$efb_28'
              , '$efb_29', '$efb_30', '$efb_31', '$efb_32', '$efb_33', '$efb_34', '$efb_35', '$efb_36'
              , '$efb_37', '$efb_38', '$efb_39', '$efb_40', '$efb_41', '$efb_42', '$efb_43', '$efb_44'
              , '$efb_45', '$efb_46', '$efb_47', '$efb_48', '$efb_49', '$efb_50', '$efb_51', '$efb_52', '$efb_53'
              , 'draft', '$date', '$id_reviewer', '$id_rs'
            )";
    $result = mysqli_query($conn, $strSQL);
    if($result){
      echo "Y";
    }else{
      echo $strSQL;
    }
  }
}else{
  $strSQL = "INSERT INTO eform_bio_fund (efb_gc, efb_1, efb_2, efb_3, efb_4, efb_5,
            efb_6, efb_7, efb_8, efb_9, efb_10, efb_11, efb_12, efb_13, efb_14, efb_15, efb_16
            , efb_17, efb_18, efb_19, efb_20, efb_21, efb_22, efb_23, efb_24, efb_25, efb_26, efb_27
            , efb_28, efb_29, efb_30, efb_31, efb_32, efb_33, efb_34, efb_35, efb_36, efb_37, efb_38
            , efb_39, efb_40, efb_41, efb_42, efb_43, efb_44, efb_45, efb_46, efb_47, efb_48, efb_49,
             efb_50, efb_51, efb_52, efb_53, efb_status, efb_udate, efb_reviewer_id, efb_id_rs)
            VALUES ('$efb_gc', '$efb_1', '$efb_2', '$efb_3', '$efb_4'
            , '$efb_5', '$efb_6', '$efb_7', '$efb_8', '$efb_9', '$efb_10', '$efb_11', '$efb_12'
            , '$efb_13', '$efb_14', '$efb_15', '$efb_16', '$efb_17', '$efb_18', '$efb_19', '$efb_20'
            , '$efb_21', '$efb_22', '$efb_23', '$efb_24', '$efb_25', '$efb_26', '$efb_27', '$efb_28'
            , '$efb_29', '$efb_30', '$efb_31', '$efb_32', '$efb_33', '$efb_34', '$efb_35', '$efb_36'
            , '$efb_37', '$efb_38', '$efb_39', '$efb_40', '$efb_41', '$efb_42', '$efb_43', '$efb_44'
            , '$efb_45', '$efb_46', '$efb_47', '$efb_48', '$efb_49', '$efb_50', '$efb_51', '$efb_52', '$efb_53'
            , 'draft', '$date', '$id_reviewer', '$id_rs'
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
