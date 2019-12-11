<?php
include "config.class.php";

if(!isset($_POST['copid'])){
  mysqli_close($conn);
  die();
}

$copid = mysqli_real_escape_string($conn, $_POST['copid']);
$codept = mysqli_real_escape_string($conn, $_POST['codept']);
$cofname = mysqli_real_escape_string($conn, $_POST['cofname']);
$colname = mysqli_real_escape_string($conn, $_POST['colname']);

$return = [];

$strSQL = "UPDATE pm_team
           SET
            co_dept = '$codept',
            co_fname = '$cofname',
            co_lname = '$colname'
           WHERE copi_id = '$copid'";
$query = mysqli_query($conn, $strSQL);
if($query){
  echo "Y";
}

mysqli_close($conn);
die();
