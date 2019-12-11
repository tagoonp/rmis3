<?php

header("Access-Control-Allow-Origin: *");
date_default_timezone_set("Asia/Bangkok");
$host = 'localhost';
$user = 'root';
// $password = 'mandymorenn';
$password = 'rmis2#2016';
$dbname = 'rmis_2017';
$conn = mysqli_connect($host, $user, $password, $dbname);


if (!$conn) {
  die();
}

$conn->set_charset("utf8");

?>
