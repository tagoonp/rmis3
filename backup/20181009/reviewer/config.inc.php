<?php
$host="localhost";
$user="root";
// $password="rmis#2013";
$password="";
$db="db_rmis";
$conn=mysql_connect($host,$user,$password);
mysql_query("USE $db");
mysql_query("SET NAMES UTF8");
mysql_query("SET character_set_results='utf8'");
mysql_connect($host, $user, $password) or die("<h1>can not connect db</h1>");
?>
