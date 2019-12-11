<?php
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
<!DOCTYPE html>
<html>
<head>
<title>:: สำหรับผู้ทรงคุณวุฒิ ::</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<!-- CSS -->
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/jquery.validate.css">
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.10.custom.css">

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.validation.functions.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>

<script>
jQuery(function(){
jQuery("#id_prefix").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกคำนำหน้าชื่อ"});

jQuery("#full_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"});     

jQuery("#tel").validate({
expression: "if (VAL.match(/^[0][0-9]{9}$/)) return true; else return false;",
message: "*กรุณากรอกให้เป็นตัวเลข 10 หลัก!"});

jQuery("#email").validate({
expression: "if(VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{1,}$/))return true; else return false;",
message: "*กรุณากรอก E-mail ให้ถูกรูปแบบ"}); 

jQuery("#username").validate({
expression: "if (VAL) return true; else return false;",
message: "*กรุณากรอก username"});
       
jQuery("#password").validate({
expression: "if (VAL.length > 3 && VAL) return true; else return false;",
message: "กรุณากำหนดรหัสผ่านใหม่"});

jQuery("#ConfirmPassword").validate({
expression: "if ((VAL == jQuery('#password').val()) && VAL) return true; else return false;",message: "กรุณายืนยันรหัสผ่านให้ตรงกัน"});
});

</script>
</head>
<body id="public">
<div id="container" class="ltr">
<header id="header" class="info">
<div id="jqm-homeheader"> 
<div id="jqm-logo">
<a href="index.php"title="Research Management Information System (RMIS) ">
<img src="images/logo_header.png" alt="logo_header.png" 
width="500px" height="104px">
</a>
</div> 
<div id="info-user">
<? include "menu_user.php" ?>
</div>
<?include"menu.php"?>
</div>
</header>
<p></p>
<table width="80%"border="0" align="center">
<tr>
<td colspan="2" align="center">
<h1><strong>แก้ไขข้อมูลผู้ทรงคุณวุฒิ</strong></h1>
</td>
</tr>
<?
include ("config.inc.php");
$sql = "SELECT * from reviewer where id_reviewer ='".$_SESSION['id']."'";
$result = mysql_query( $sql);
$num_rows = mysql_num_rows($result);	
if ($num_rows >= 1) {
$row= mysql_fetch_array($result);
$id_prefix = $row['id_prefix'];
$id_university=$row['id_university'];
$id_faculty=$row['id_faculty'];
$id_dept=$row['id_dept'];
} else {echo" <center>No-data! </center><br>";die;}
?>
<form action="re_update.php?id_reviewer=<?=$_GET["id_reviewer"];?>" method="post">
<tr>
<td width="190"><b>คำนำหน้าชื่อ :</b></td>
<td height="14">
<select name="id_prefix" id="id_prefix"> 
<?include ("config.inc.php");
$sql2= "SELECT * FROM prefix order by prefix_name asc";
$table2 = mysql_query($sql2);
while($row2 = mysql_fetch_array($table2)){ 
$id2= $row2["id_prefix"];
$prefix_name=$row2["prefix_name"];?>
<option value="<? echo $id2;?>"<?if($id2==$id_prefix)
{print "selected";}?>><? echo $prefix_name;?></option>
<?}?>
</select>
</td>
</tr>

<tr>
<td width="160"><b>ชื่อ:</b></td>
<td width="322" ><label for="name"></label>
<input type="text" name="name" id="name" 
value="<?echo $row["name"];?>" size="30" ></td>
</tr>

<tr>
<td width="160"><b>นามสกุล:</b></td>
<td width="322" ><label for="surname"></label>
<input type="text" name="surname" id="surname" 
value="<?echo $row["surname"];?>" size="30" ></td>
</tr>

<tr>
<td height="26"><strong>ความเชี่ยวชาญ:</strong></td>
<td>

<textarea name="expertise" id="expertise" 
cols="45" rows="5"><?php echo $row["expertise"];?></textarea></td>
</tr>

<tr>
<td><strong>เบอร์โทรศัพท์มือถือ:</strong></td>
<td><label for="tel"></label>
<input type="text" name="tel" id="tel" value="<?=$row["tel"];?>" size="30"></td>
</tr>

<tr>
<td><strong>อีเมล์:</strong></td>
<td><label for="email"></label>
<input type="text" name="email"  id="email" value="<?=$row["email"];?>" size="30"></td>
</tr>

<tr>
<td><strong>Username:</strong></td>
<td><label for="username"></label>
<input type="text" name="username" value="<?=$row["username"];?>"size="20"></td>
</tr>

<tr>
<td height="48"><strong>Password:</strong></td>
<td>
<input type="password"  name="password" id="password" value="<?=$row["password"];?>" size="20"></td>
</tr>

<tr>
<td height="26"><strong>มหาวิทยาลัย/สถาบัน:</strong></td>
<td><select name= "id_university"  id="id_university">
<?include ("config.inc.php");
$sql4= "SELECT * FROM university ";
$table4 = mysql_query($sql4);
while($row4= mysql_fetch_array($table4)){ 
$id2= $row4["id_university"];
$university_name=$row4["university_name"];?>
<option value="<? echo $id2;?>"<?if($id2==$id_university)
{print "selected";}?>><? echo $university_name;?></option>
<?}?>
</td>
</tr>

<td height="26"><strong>คณะ:</strong></td>
<td><select name="id_faculty" id="id_faculty">
<option value="0">---------------------- กรุณาเลือกคณะ ----------------------</option>
<?include ("config.inc.php");
$sql5 = "SELECT * FROM faculty ";
$table5 = mysql_query($sql5);
while($row5= mysql_fetch_array($table5)){ 
$id2= $row5["id_faculty"];
$faculty_name=$row5["faculty_name"];?>
<option value="<? echo $id2;?>"<?if($id2==$id_faculty)
{print "selected";}?>><? echo $faculty_name;?></option>
<?}?>
</td>
</tr>

<td height="26"><strong>ภาควิชา/หน่วยงาน:</strong></td>
<td><select name="id_dept" id="id_dept">
<option value="0">---------------------- กรุณาเลือกภาควิชา -----------------------</option>
<?include ("config.inc.php");
$sql6 = "SELECT * FROM dept";
$table6 = mysql_query($sql6);
while($row6= mysql_fetch_array($table6)){ 
$id2= $row6["id_dept"];
$dept_name=$row6["dept_name"];?>
<option value="<? echo $id2;?>"<?if($id2==$id_dept)
{print "selected";}?>><? echo $dept_name;?></option>
<?}?>
</td>
</tr>

<tr>
<td height="53" colspan="3" align="center">
<input name="submit" type="submit" value="บันทึก" class="firstsubmit">
<input name="reset" type="reset" value="ยกเลิก" class="firstsubmit"></td>
</tr>

</table>
</form>
<br></br>

</div>
<? include ("footer.php"); ?>
</body>
</html>