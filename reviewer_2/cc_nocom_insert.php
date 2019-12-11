<?php

/* MM Document: Phase II - cc_nocom_insert.php -> Variant of cc_pro_insert.php

    This file will be create a row in 'cc_pro' and update 'con_rw'.'status_review' = 3
    (ไม่ประเมิน) 'cc_pro' will contain detail and file that get from reviewer.

    Status: TODO

*/

session_start();
if($_SESSION['id'] == ""){
header("location:../index.php");
exit();}
else{
require "config.inc.php";
$sql = "select * from reviewer where id_reviewer ='".$_SESSION['id']."'";
$result = mysql_query($sql);
$row    = mysql_fetch_array($result);}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title></title>
</head>
<body>
<?
include("config.inc.php");
$id_cc=$_POST["id_cc"];
$id_cr=$_POST["id_cr"];
$id_pro=$_POST["id_pro"];
$id_ep=$_POST["id_ep"];
$id_con = $_POST["id_con"];
$id_reviewer=$_SESSION['id'];
$detail=$_POST["detail"];
$file_cc=$_POST["file_cc"];
$status_review=$_POST["status_review"];
$date_review=date ("y-m-d");
$progress_date=date ("y-m-d");
$DateNow=date("Y-m-d-H-i-s_");
$Path_front="../file_rec/";
$txt="cc_";
$uploaddir = $Path_front;
$file_cc = $uploaddir.$txt.$DateNow.basename($_FILES['file_cc']['name']);
$date = date("y-m-d:H-i-s");
$nocom_choice = $_POST["num"];
$nocom_cause = $_POST["cause"];

$nocom_text[1] = "ไม่มีเวลา";
$nocom_text[2] = "ไม่ตรงกับความเชี่ยวชาญ";
$nocom_text[3] = "ผลประโยชน์ทับซ้อน";

if($nocom_choice != 4) {
    $nocom_cause = $nocom_text[$nocom_choice];
}

$sql="SELECT * FROM  `cc_pro` WHERE `id_reviewer` LIKE '$id_reviewer' and id_pro LIKE '$id_pro'";
$result_sql = mysql_query($sql);
$num_rows=mysql_num_rows($result_sql);

if($num_rows >= 1){
echo "<script>alert('ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล  กรุณาตรวจสอบใหม่อีกครั้ง '<script>";
echo"<script>window.location.replace('index.php')</script>";
}

else {
$sql="UPDATE  `con_rw` SET `status_review`='3',date_review='$date_review'
WHERE `con_rw`.`id_cr`=$id_cr";

// MM: Don't know what is ep = 1 stands for?, Fixed: status_review = 3 (Not Review)
$sql2="insert into cc_pro values ('$id_cc','$id_pro','1','$id_reviewer','$file_cc','$detail','3','$date_review','$id_con','$nocom_cause')";
$result_sql2 = mysql_query($sql2);

//echo"SQL = $sql3";
echo"<script>alert('คุณได้บันทึกข้อมูลเรียบร้อย')</script>";

echo"<script>window.location.replace('index.php')</script>";

mysql_query($sql);
mysql_close($conn);
}
?>

</body>
</html>
