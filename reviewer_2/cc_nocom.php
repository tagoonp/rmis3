<?php

/* MM Document: Phase II
        This file is for reviewer's no comment choice. This file is a form that ask a question to
        reviewer that why he/she is not review this report.
*/

session_start();
if($_SESSION['id'] == ""){
header("location:../index.php");
exit();}
else{
require "config.inc.php";
require "datethai.php";
$user_id = $_SESSION['id'];
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
<form action="cc_nocom_insert.php" name="add_form" id="add_form"
method="post" enctype="multipart/form-data">
<?
require "config.inc.php";
$sql = "SELECT *, e.file_upload AS rf_upload, p.file_upload AS pf_upload  from progress as p
inner join con_rw                as r on p.id_pro   = r.id_pro
inner join rec                   as e on p.id_com   = e.id_com
inner join steps ON p.id_steps = steps.id_steps
inner join status_rec on status_rec.id_status_rec = p.id_status_rec
WHERE r.id_con= '".$_GET["id_con"]."'";

$result =  mysql_query($sql);
$num_rows = mysql_num_rows($result);
if ($num_rows >=1) {
    $row    = mysql_fetch_array($result);
    $_GET['id_pro']=$row['id_pro'];
    $id_pro = $row['id_pro'];
    $id_year     = $fetcharr['id_year'];
    $id_status_research = $fetcharr['id_status_research'];
    $id_dept = $fetcharr['id_dept'];
}else{
echo"<center>-----ไม่พบข้อมูลที่ต้องการ -------</center> <br>";
die;
}
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

<? // MM Document: Share the same file on show description of report.
require '../share/general_pro_body.inc'; ?>

<tr>
<td height="8" colspan="2">
<hr>
</td>
</tr>

 <?
require "config.inc.php";
$sql3= "SELECT * from con_rw WHERE id_reviewer = $user_id AND id_pro = $id_pro";
$table3= mysql_query($sql3) or die (mysql_error());
$row3 = mysql_fetch_array($table3);
?>

<tr>
    <td>
        <strong>รายละเอียดจากเจ้าหน้าที่</strong>
    </td>
    <td>
        <? if($row['detail'] !== '') echo $row['detail']; else echo '-';?>
    </td>
</tr>

<tr>
    <td height="20" colspan="2"><h3><strong>รายละเอียดสาเหตุที่ไม่ประเมิน</strong></h3></td>
</tr>

<tr>
    <td height="20" valign="top"><strong>ระบุสาเหตุ:</strong></td>
    <td valign="top">
                    <input type="radio" name="num" value="1" />&nbsp;ไม่มีเวลา<p/>
                    <input type="radio" name="num" value="2"/>&nbsp;ไม่ตรงกับความเชี่ยวชาญ<p/>
                    <input type="radio" name="num" value="3"/>&nbsp;ผลประโยชน์ทับซ้อน<p/>
                    <input type="radio" name="num" value="4" id="other_reason"/>&nbsp;อื่นๆ&nbsp;
                    <input name="cause" type="text" disabled="disabled" id="cause" size="40" />
                </p>
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
<td colspan="2" height="53" style="text-align: center">
  <input type="hidden" name="id_cr" id="id_cr" value="<?=$row3['id_cr']?>">
  <input type="hidden" name="id_con" id="id_con" value="<?=$_GET['id_con']?>">
  <input name="submit" type="submit" id="summit" value="บันทึก"  class="firstsubmit">
  <input name="reset"  type="reset"  id="reset"  value="ยกเลิก"  class="firstsubmit">
  <script>
  jQuery('input[name=num]').change(function() {
      if($('input[name=num]:checked').val() != 4) {
          $("#cause").attr("disabled", "disabled");
      } else { $("#cause").removeAttr("disabled"); }
  });
  </script>
</td>
</tr>
</table>
</form>
</div>
<? include ("footer.php"); ?>
</body>
</html>
