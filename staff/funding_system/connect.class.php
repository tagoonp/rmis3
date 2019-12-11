<?php
$host = DB_HOST;
$user = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;
$db_prefix = TB_PREFIX;

$conn = mysqli_connect($host, $user, $password, $dbname);
if(!$conn){
  echo "Can not connect database";
  die();
}

$conn->set_charset("utf8");

// Define system parameters
$sysdate = date('Y-m-d');
$sysdatetime = date('Y-m-d H:i:s');
$sysdateu = date('U');
$sysdateyear = date('Y');
$ip = $_SERVER['REMOTE_ADDR'];
?>
