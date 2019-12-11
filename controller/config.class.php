<?php

header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");

// $host = 'localhost';
$host = '157.230.46.106';
$user = 'rmis5';
$password = 'rmis5';
// $password = 'rmis2#2016';
$dbname = 'rmis5';
// $dbname = 'rmis_dummy';
$conn = mysqli_connect($host, $user, $password, $dbname);


if (!$conn) {
  echo "string";
  die();
}

$conn->set_charset("utf8");

?>
