<?php
include ("config.inc.php");
//$id_comment=$_POST["id_comment"];
$id_rs=$_POST["id_rs"];
$id_reviewer=$_POST["id_reviewer"];
$detail=$_POST["detail"];
//$file_upload=$_POST["file_upload"];
//$status_review  =$_POST["status_review"];
$date_review = date ("y-m-d H:i:s");
$DateNow=date("Y-m-d-H-i-s_");
$Path_front="../file_reviewer/";
$uploaddir = $Path_front;
$file_upload = $uploaddir.$DateNow.basename($_FILES['file_upload']['name']);
$date = date("y-m-d:H-i-s");
$sql="SELECT * FROM  `comment` WHERE `id_reviewer` LIKE '$id_reviewer' and id_rs LIKE '$id_rs'";
$result_sql = mysql_query($sql);
$num_rows=mysql_num_rows($result_sql);
if($num_rows >= 1){
echo "<script>alert('ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล  กรุณาตวรจสอบใหม่อีกครั้ง !')</script>";
echo"<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
}
else if (move_uploaded_file($_FILES['file_upload']['tmp_name'],$file_upload)){
$sql="UPDATE  `submit_feedback` SET `status_review`= '2',date_review ='$date_review' WHERE  `submit_feedback`.`id_rs`=$id_rs and `id_reviewer`= $id_reviewer";

$sql2="insert into comment values
('','$id_rs','$id_reviewer','$file_upload','$detail','2','$date_review')";
$result_sql2 = mysql_query($sql2);

$sql3="UPDATE`research` SET `id_status_research`='6' WHERE `research`.`id_rs`=$id_rs";
$result_sql3 = mysql_query($sql3);

echo "<script>alert('คุณได้บันทึกข้อมูลเรียบร้อย')</script>";
echo"<script>window.location.replace('index.php')</script>";

mysql_query($sql);
mysql_close($conn);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
</body>
</html>
