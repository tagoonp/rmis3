<?php
include "config.class.php";

if(!isset($_POST['fid'])){
  mysqli_close($conn);
  die();
}

$fid = mysqli_real_escape_string($conn, $_POST['fid']);

$strSQL = "DELETE FROM file_research_retroact_attached WHERE fid = '$fid'";
$query = mysqli_query($conn, $strSQL);

mysqli_close($conn);
die();



?>
