<?php
session_start();
if($_SESSION['id'] == ""){
header("location:../index.php");
exit();}
else{
require "config.inc.php";
$sql_ec    = "select * from ec  where id_ec ='".$_SESSION['id']."'";
$result_ec = mysql_query($sql_ec);
$row_ec    = mysql_fetch_array($result_ec);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>::สำหรับเลขา EC::</title>
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
<script>
jQuery(function(){
jQuery("#id_reviewer").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "* กรุณาเลือกผู้ทรงคุณวุฒิ "});
jQuery("#from_review").validate({
expression: "if (isChecked(SelfID)) return true; else return false;",
message: "* กรุณาเลือกประเภทของการประเมิน"});
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
<? include "menu.php" ?>
</div>
<p></p>
<?
require "config.inc.php";
$strSQL = "SELECT * from research as r
inner join year        as  y on r.id_year   = y.id_year
inner join pm          as  m on r.id_pm     = m.id_pm
inner join prefix      as  p on p.id_prefix = m.id_prefix
inner join dept        as  d on m.id_dept   = d.id_dept
inner join status_research as  s on r.id_status_research = s.id_status_research
inner join field_research  as  f on r.id_field = f.id_field
inner join type_research   as  t on r.id_type = t.id_type
WHERE id_rs = '".$_GET["id_rs"]."'";

$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$id_status_research = $objResult['id_status_research'];
?>
<form action="feedback_insert.php" id="add_form" method=post>
<?
require "config.inc.php";
$sql = "SELECT * from research
WHERE id_rs= '".$_GET["id_rs"]."'";
$result =  mysql_query($sql);
$num_rows = mysql_num_rows($result);
if ($num_rows >=1){
$row    = mysql_fetch_array($result);
$id_year     = $fetcharr['id_year'];
$id_status_research = $fetcharr['id_status_research'];
$id_dept = $fetcharr['id_dept'];
}
else{
echo"<center>--ไม่พบข้อมูลที่ต้องการ--</center> <br>";
die;
}
?>
<table width="75%" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<th colspan="2" scope="col"><h1>ดูผลการพิจารณาจากผู้ทรงคุณวุฒิ</h1></th>
</tr>
<td width="193"><strong>ลำดับโครงการ</strong></td>
<td width="567">
<input name="id_rs" type="text" id="id_rs" value="<?=$row["id_rs"];?>"size="3"readonly></td>
</tr>
<tr>
<td width="193"><strong>รหัสโครงการ</strong></td>
<td width="567">
<?=$objResult["year_name"];?>-<?=$objResult["id_rs"];?>-<?=$objResult["id_dept"];?>-<?=$objResult["id_personnel"];?>
</td>
</tr>

<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
<td width="193"><strong>ชื่อโครงการ  ภาษาไทย	</strong></td>
<td width="567">
<?echo $row ["title_th"];?></td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
<td width="193"><strong>ชื่อโครงการ ภาษาอังกฤษ</strong></td>
<td width="567"><?echo $row ["title_en"];?></td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
<td width="193" valign="top"><strong>หัวหน้าโครงการ</strong></td>
<td width="567">
<?echo $objResult["prefix_name"];?><?echo $objResult["name"];?>
&nbsp;<?echo $objResult["surname"];?>
<? if ($objResult["dept_name"]=="19"){;
echo"";}
?>
<?if ($objResult["status"]=="3"){
echo"&nbsp;คณะแพทยศาสตร์&nbsp;มหาวิทยาลัยสงขลานครินทร์";}
else if ($objResult["status"]=="2")
{echo $objResult["dept"];}?>
</p>
</td>

</tr>
<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td height="28" valign="top"><strong>ผู้ร่วมทดลอง</strong></td>
<td>
<?php
require "config.inc.php";
$sql3 = "SELECT * from  team  as r
inner join  prefix  as  p on r.id_prefix = p.id_prefix
inner join university       as  u on r.id_university  = u.id_university
inner join faculty          as  f on r.id_faculty     = f.id_faculty
inner join dept_ex          as  d on r.id_dept        = d.id_dept
WHERE id_rs = '".$_GET["id_rs"]."'";
$result = mysql_query($sql3);
$Num_Rows = mysql_num_rows($result);
$i=2;
if(($result!="")){
while($row3 = mysql_fetch_array($result)){
$university_name =$row3["university_name"];
$fuculty_name =$row3["fuculty_name"];
?>
<?echo $row3["prefix_name"];?>
<?echo $row3["name"];?>&nbsp;<?echo $row3["surname"];?>
&nbsp;
<p><?echo $row3["dept_name"];?>&nbsp;
<?echo $row3["faculty_name"];?>
&nbsp;<?echo $row3["university_name"];?>
</p>
<?}}?>
</td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>
<!-- <tr>
<td height="22"><strong>คำสำคัญ</strong></td>
<td><?=$objResult["keywords_th"];?></td>
</tr>
<tr>
  <td height="22"><strong>Keywords</strong></td>
  <td><?=$objResult["keywords_en"];?></td>
</tr>
<tr>
  <td height="8" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="22"><strong>ประเภทของการวิจัย</strong></td>
  <td><?=$objResult["field_name"];?></td>
</tr>
<tr>
  <td height="22"><strong>สาขาการวิจัย</strong></td>
  <td><?=$objResult["type_name"];?></td>
</tr>
<tr>
  <td height="8" colspan="2"><hr></td>
  </tr> -->
<tr>
  <td height="22"><strong>ระยะเวลาโครงการ</strong></td>
  <td>วันที่เริ่มต้น:&nbsp;<?echo $objResult["start_date"];?>&nbsp;
วันที่สิ้นสุด:&nbsp;
<?=$objResult["finish_date"];?>
<?php
####### รูปแบบของวันที่ ที่อาจจะเก็บลงในฐานข้อมูลแบบนี้ ######
$start_date=$objResult["start_date"]; // วันที่เริ่มใช้บริการ
$expire_date=$objResult["finish_date"];//วันสิ้นสุดการใช้บริการ
$today_date=date("d-m-Y ");//วันที่ของวันนี้

$start_explode = explode("-", $start_date);
$start_day = $start_explode[0];
$start_month = $start_explode[1];
$start_year = $start_explode[2];

$expire_explode = explode("-", $expire_date);
$expire_day = $expire_explode[0];
$expire_month = $expire_explode[1];
$expire_year = $expire_explode[2];

$today_explode = explode("-", $today_date);
$today_day = $today_explode[0];
$today_month = $today_explode[1];
$today_year = $today_explode[2];

$start = GregorianToJD($start_month,$start_day,$start_year);
$expire = GregorianToJD($expire_month,$expire_day,$expire_year);


$period_of_time  = $expire-$start; //หาระยะเวลาการใช้งาน
$date_current= $expire-$today;//หาวันที่เหลืออยู่
echo "&nbsp;จำนวนวัน:&nbsp;$period_of_time&nbsp;วัน</p>";
?></td>
</tr>
<tr>
<td height="24"><strong>งบประมาณทั้งโครงการ</strong></td>
<td>
<?$num = $objResult["budget"]; echo number_format($num,0,".",",");?>
&nbsp;บาท
</td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>
<tr>
<td height="24"><strong>ประเภทแหล่งทุนที่คาดว่าจะได้รับ</strong></td>
<td>
<?if($objResult["ts1"]=='1'){echo"ทุนคณะแพทยศาสตร์ ";}?>
<?if($objResult["ts2"]=='2'){ echo"ทุนมหาวิทยาลัย";}?>
<?if($objResult["ts3"]=='3'){ echo"ทุนนอกมหาวิทยาลัย";}?>
<?if($objResult["ts4"]=='4'){ echo"ทุนต่างประเทศ";}?>
<?if($objResult["ts5"]=='5'){ echo $objResult["other_funds"];}?>
</td>
</tr>
<tr>
<td height="24"><strong>ชื่อหน่วยงานที่คาดว่าจะว่าจะให้ทุน</strong></td>
<td><?=$objResult["source_funds"];?></td>
</tr>
<tr>
  <td height="8" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="22"><strong>ไฟล์แบบเสนอโครงการวิจัย</strong></td>
  <td><a class="ot-button-download" href  ="<?=$objResult["file_upload"];?>" title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดไฟล์</a></td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td></tr>

<tr>
<td height="28"><strong>แก้ไขการพิจารณาเลือกผู้ทรงคุณวุฒิ</strong></td>
<td><a class="ot-button-edit" href="feedback_add.php?
id_rs=<?echo $objResult["id_rs"];?>">เลือกผู้ทรงคุณวุฒิ</a>

</td>
</tr>

</table>
</form>
<hr width="90%">
<table width="90%" border="1" align="center">
<thead>
<tr>
<th width="17" height="20" align="center" bgcolor="#E2E2E3"><strong>ลำดับที่</strong></th>
<th width="226" align="center" bgcolor="#E2E2E3"><strong>ผู้ทรงคุณวุฒิ</strong></th>
<th width="52" align="center" bgcolor="#E2E2E3"><strong>ประเภท</strong></th>
<th width="191" align="center" bgcolor="#E2E2E3"><strong>ผู้ส่ง</strong></th>
<th width="88" align="center" bgcolor="#E2E2E3"><strong>วันที่</strong></th>
<th width="106" align="center" bgcolor="#E2E2E3"><strong>กำหนดวันส่ง</strong></th>
<th width="116" align="center" bgcolor="#E2E2E3"><strong>สถานะ</strong></th>
<th width="89"  align="center" bgcolor="#E2E2E3"><strong>ดำเนินการ</strong></th>
</tr>
</thead>
<?
include "config.inc.php";
include "datethai.php";

$sql2 = "SELECT * from submit_feedback  as r
inner join reviewer         as w on r.id_reviewer = w.id_reviewer
inner join ec               as f on r.id_ec       = f.id_ec
inner join prefix           as p on w.id_prefix   = p.id_prefix
WHERE id_rs= '".$_GET["id_rs"]."'";
$table2 = mysql_query($sql2);
$num_rows2 = mysql_num_rows($table2);
$i=1;
if(($table2!="")){
while($row2 = mysql_fetch_array($table2)){
$id_rs= $row2['id_rs'];
$id_fb= $row2['id_fb'];
$id_ec= $row2['id_ec'];
$strDate = $row2["date_fb"];
$inputDate = $row2["date_submit"];
$countDate = $inputDate;
?>
<tbody>
<tr>
<td width="17" height="23"align="center"><?=+$i?></td>
<td width="226" >
&nbsp;<?php echo $row2["prefix_name"];?>
<?php echo $row2["name"];?>&nbsp;
<?php echo $row2["surname"];?>
</td>
<td width="52" align="center">
<?if($row2[	"type"]=='1'){ echo"ภายใน";}
else if($row2["type"]=='2'){ echo"ภายนอก";}?>
</td>
<td width="191" align="left">
<?
require "config.inc.php";
$sql3 = "SELECT * from ec  as f
inner join prefix               as x on f.id_prefix   = x.id_prefix
inner join submit_feedback      as r on f.id_ec       = r.id_ec
where id_fb='$id_fb'";
$result3    = mysql_query($sql3);
$row3       = mysql_fetch_array($result3);
?>
&nbsp;

&nbsp;
</td>
<td width="88" align="center">
<?php echo $row2["date_fb"];?>
</td>
<td width="106" align="center">
<font  color="red">
<?php echo $row2["set_date"];?>
</font>
</td>
<td width="116" align="center">
<? if($row2["status_review"]=='1')
{echo"<font color='red'>ยังไม่ได้ประเมิน</font>";}
else if ($row2["status_review"]=='2'){echo"<font color='#33993'>ประเมินเรียบร้อย</font>";}
else if ($row2["status_review"]=='3'){echo"<font color='blue'>ไม่ประเมิน</font>";}
?>
</td>
<td width="89" align="center">
<?if($row2 ["status_review"]=='2'){echo"";}
else if($row2 ["status_review"]=='3'){echo"";}
else{echo"<a href=feedback_delete.php?id_fb=$id_fb&id_rs=$id_rs
onClick=\"return confirm('คุณแน่ใจว่าจะลบข้อมูล?')\" title=\"Delete\"> <b>ลบข้อมูล</b>";}?>
<a>
</td>
</tr>
</tbody>
<?$i++;}}
mysql_close($conn);?>
</table>
<p>&nbsp;</p>
</br>
</div>
<? include ("footer.php"); ?>
</body>
</html>
