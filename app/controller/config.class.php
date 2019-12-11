<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set("Asia/Bangkok");

// Define other system value
$sys_date = date('Y-m-d');
$sys_datetime = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];

$host = 'localhost';
$user = 'root';
// $password = 'mandymorenn';
// $password = 'jjqbqs%4';
$password = 'rmis2#2016';
$dbname = 'rmis_2017';
// $dbname = 'rmis';


$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
  echo "Can not connect";
  die();
}

if(mysqli_connect_errno()){
  echo mysqli_connect_error();
}

$conn->set_charset("utf8");
?>
