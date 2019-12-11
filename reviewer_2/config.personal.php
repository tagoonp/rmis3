<?php
$host="172.29.1.9";
$user="rmis";
$password="rmis#2013";
$db="STAFF";
$conn=mysql_connect($host,$user,$password);
mysql_query("USE $db");
mysql_query("SET NAMES UTF8");
mysql_query(" SET character_set_results='utf8'");
mysql_connect($host, $user, $password) or die("<hr><b>เชื่อมต่อฐานข้อมูลไม่ได้ ");
?>