<?php
include ("config.inc.php");
$id_comment=$_POST["id_comment"];
$id_rs=$_POST["id_rs"];
$id_reviewer=$_POST["id_reviewer"];
$num=$_POST["num"];
$cause=$_POST["cause"];
$status_review  =$_POST["status_review"];
$date_review = date ("y-m-d H:i:s");

$sql="SELECT * FROM  `no_comment` WHERE `id_comment` LIKE '$id_comment'";
$result_sql = mysql_query($sql);
$num_rows=mysql_num_rows($result_sql);

if($num_rows >= 1){
echo "<script>alert('ข้อมูลนี้มีอยู่แล้วในฐานข้อมูล  กรุณาตวรจสอบใหม่อีกครั้ง !')</script>";
echo"<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
}
else
$sql="UPDATE  `submit_feedback` SET `status_review`= '3' ,date_review ='$date_review' WHERE  `submit_feedback`.
`id_rs`=$id_rs and `id_reviewer`= $id_reviewer";
$sql2="insert into no_comment values
('$id_comment','$id_rs','$id_reviewer','$num','$cause','3','$date_review')";
$result_sql2 = mysql_query($sql2);
echo "<script>alert('คุณได้บันทึกข้อมูลเรียบร้อย! ')</script>";
echo"<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
mysql_query($sql);
mysql_close($conn);
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
