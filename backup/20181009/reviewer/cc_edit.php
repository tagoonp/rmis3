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
<title>::สำหรับผู้ทรงคุณวุฒิ::</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="" />
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
<!-- <script>
function check() { 
var detail = CKEDITOR.instances["message"].getData();
if(document.webb.title.value=="") { 
alert("กรุณากรอกหัวเรื่อง") ; 
document.webb.title.focus() ; 
return false ; }else if(detail=="") { 
alert("กรุณากรอกรายละเอียด") ; 
CKEDITOR.instances.message.focus(); 
return false ; 
}  }
</script> -->
<script>
jQuery(function(){
jQuery("#file_cc").validate({
expression: "if (VAL) return true; else return false;",
message: "*กรุณาเลือกไฟล์นามสกุล .pdf .zip .rar "});

jQuery("#id_university").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกมหาวิทยาลัย!"  })
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
<p><? include "menu.php" ?></p>
</div>
<form action="cc_pro_insert.php" name="add_form" id="add_form" 
method="post" enctype="multipart/form-data">
<?
require "config.inc.php";
$sql = "SELECT * from progress as p
inner join con_rw                as r on p.id_pro   = r.id_pro
inner join rec                   as e on p.id_com   = e.id_com
WHERE r.id_pro= '".$_GET["id_pro"]."'";

$result =  mysql_query($sql);
$num_rows = mysql_num_rows($result);	
if ($num_rows >=1){
$row    = mysql_fetch_array($result);
$id_year     = $fetcharr['id_year'];
$id_status_research = $fetcharr['id_status_research'];
$id_dept = $fetcharr['id_dept'];
}else{
echo"<center>-----ไม่พบข้อมูลที่ต้องการ -------</center> <br>";
die;}
?>
<table width="77%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<th colspan="2" scope="col"><h1>แบบพิจารณาสำหรับผู้ทรงคุณวุฒิ</h1></th>
</tr>
<td width="230"><strong>ลำดับโครงการ</strong></td>
<td width="551">
<input name="id_pro" type="text" id="id_rec" value="<?=$row["id_pro"];?>"size="3"readonly></td>
</tr>
<tr>
<td width="230"><strong>รหัสโครงการ</strong></td>
<td width="551"><input name="id_rec" type="text" id="id_rec" value="<?=$row["id_rec"];?>"readonly></td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td width="230"><strong>ชื่อโครงการ  ภาษาไทย	</strong></td>
<td width="551">
<?echo $row ["title_th"];?></td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td width="230"><strong>ชื่อโครงการ ภาษาอังกฤษ</strong></td>
<td width="551"><?echo $row ["title_en"];?></td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td width="230" valign="top"><strong>หัวหน้าโครงการ</strong></td>
<td width="551">
<?echo $row ["pm_name"];?>

<p>สังกัด  &nbsp;<?echo  $row["unit"];?>
</p>
</td>

</tr>
<tr>
<td colspan="2"><hr></td>
</tr>


<tr>
<td height="22"><strong>แหล่งทุน</strong></td>
<td><?echo  $row["source_funds"];?></td>
</tr>

<tr>
<td height="8" colspan="2"><hr></td>
</tr>

<tr>
<td height="36"><strong>ไฟล์แบบเสนอโครงการวิจัย</strong></td>
<td>
<a class="ot-button-download" href="<?echo $row["file_upload"];?>" 
title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดไฟล์</a>
</td>
</tr>

<tr>
<td height="8" colspan="2">
<hr>
</td>
</tr>

<tr>
<td valign="top"><strong>แบบประเมินสำหรับผู้ทรงคุณวุฒิ</strong></td>
<td align="left" valign="top">
<?
require "config.inc.php";
$sql3= "SELECT * from con_rw where id_reviewer ='".$_SESSION['id']."'";
$table3= mysql_query($sql3) or die (mysql_error());
$row3 = mysql_fetch_array($table3);
?>

<?if($row3["from_review"]=='1'){?>
<a href="../file_apdu/Form_Clinic.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินด้านคลินิก</a>
<?}?>
<?if($row3["from_review"]=='2'){?>
<a href="../file_apdu/Form_Society.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินด้านสังคม</a>
<?}?>
<?if($row3["from_review"]=='3'){?>
<a href="../file_apdu/Form_Expedite.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบ Expedite</a>
<?}?>
</td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td height="20" colspan="3"><h3><strong>- อัพโหลดแบบประเมิน นามสกุล .pdf .zip .rar</strong></h3></td>
</tr>

<tr>
<td><strong>อัพโหลดแบบประเมิน</strong></td>
<td><input type="file" name="file_cc" id="file_cc" class="task_doc" onChange="checkext();"/>
</td>
</tr>

<tr>
<td><strong>ความคิดเห็นเพิ่มเติม</strong></td>
<td></td>
</tr>

<tr>
<td colspan="2"><textarea name="detail" id="cause" class="ckeditor"></textarea></td>
</tr>

<tr>
<td colspan="2"></td>
</tr>

<tr>
<td height="53">&nbsp;</td>
<td>
<input name="submit" type="submit" id="summit" value="บันทึก"  class="firstsubmit">
<input name="reset"  type="reset"  id="reset"  value="ยกเลิก"  class="firstsubmit">
</td>
</tr>
</table>
</form>
</div>
<? include ("footer.php"); ?>
</body>
</html>