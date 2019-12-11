<?php

/* MM Document: Phase II
    This file will be create a row in 'cc_pro' and update 'con_rw'.'status_review' = 2
    (ประเมินแล้ว) and 'progress'.'id_status_rec' = 7 (รอเลขา EC พิจารณาความเห็นจากผู้ทรงฯ)
    'cc_pro' will contain detail and file that get from reviewer.
    See next -->

    Known issues:
      [/] There is the same 'id_pro', 'id_con', 'id_off' and 'id_reviewer' which is
        not expect to happen (So, EC secretary may have ability to add same reviewer
        for the same project)

      [ ] This file will update 'con_rw' of same 'id_pro' as reviewed if there is a case
        like mentioned above. (Not per 'id_cr')

    Status: OK (with some issues)

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

$sql="SELECT * FROM  `cc_pro` WHERE `id_reviewer` LIKE '$id_reviewer' and id_pro LIKE '$id_pro'";
$result_sql = mysql_query($sql);
$num_rows=mysql_num_rows($result_sql);

if($num_rows >= 1){
echo "<script>alert('ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล  กรุณาตวรจสอบใหม่อีกครั้ง '<script>";
echo"<script>window.location.replace('index.php')</script>";
}

else if (move_uploaded_file($_FILES['file_cc']['tmp_name'],$file_cc)){
$sql="UPDATE  `con_rw` SET `status_review`='2',date_review='$date_review'
WHERE `con_rw`.`id_cr`=$id_cr"; // MM: Fixed from id_pro to id_cr

$sql2="insert into cc_pro values ('$id_cc','$id_pro','1','$id_reviewer','$file_cc','$detail','2','$date_review','$id_con','')";
$result_sql2 = mysql_query($sql2);

// MM: Get required reviewer from consider table
$strSQL = "SELECT results_ec FROM consider WHERE id_con = $id_con";
$required_reviewer_result = mysql_query($strSQL);
$required_reviewer_table = mysql_fetch_array($required_reviewer_result);
$required_reviewer =$required_reviewer_table['results_ec'] - 1;

$strSQL = "SELECT COUNT(id_cc) AS num_reviewed FROM cc_pro WHERE id_pro = $id_pro";
$reviewed_reviewer_result = mysql_query($strSQL);
$reviewed_reviewer_table = mysql_fetch_array($reviewed_reviewer_result);
$reviewed_reviewer = $reviewed_reviewer_table['num_reviewed'];

if($reviewed_reviewer >= $required_reviewer) {
  $sql3="UPDATE `progress` SET `id_status_rec`='7', progress_date='$progress_date'
  WHERE `progress`.`id_pro`=$id_pro";
  $result_sql3 = mysql_query($sql3);

} else {
  $sql3="UPDATE `progress` SET `id_status_rec`='5', progress_date='$progress_date'
  WHERE `progress`.`id_pro`=$id_pro";
  $result_sql3 = mysql_query($sql3);
}

//echo"SQL = $sql3";
echo"<script>alert('คุณได้บันทึกข้อมูลเรียบร้อย')</script>";

echo"<script>window.location.replace('index.php')</script>";

mysql_query($sql);
mysql_close($conn);
}
?>

</body>
</html>
