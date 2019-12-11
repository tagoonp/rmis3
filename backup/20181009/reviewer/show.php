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
<title>::ผู้ทรงคุณวุฒิ ::</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="" />
<!-- CSS -->
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet"href="css/jquery.validate.css">
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.10.custom.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.validation.functions.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
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
<?php  include "menu_user.php" ?>
</div>
<?php  include "menu.php" ?>

<?php
require "config.inc.php";
mysql_query("SET NAMES utf8");
require "config.inc.php";
$strSQL = "SELECT * from research as r
inner join year            as  y on r.id_year  = y.id_year
inner join pm              as  m on r.id_pm    = m.id_pm
inner join prefix          as  x on m.id_prefix   = x.id_prefix
inner join type_research   as  t on r.id_type     = t.id_type
inner join status_research as  s on r.id_status_research = s.id_status_research
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery = mysql_query($strSQL) or die (mysql_error());
$objResult = mysql_fetch_array($objQuery);
$strDate = $objResult["date_submit"];

//print $strSQL;
?>
<table width="80%" height="718" border="0" align="center" cellpadding="2" cellspacing="3">
<tr>
<td height="48" colspan="3" align="center">
<h1>รายละเอียดโครงการวิจัย </h1></td>
</tr>
<tr>
<td width="229"><strong>รหัสโครงการ</strong></td>
<td width="587">
<?php print $objResult["year_name"];?>-<?php print $objResult["id_rs"];?>-<?php print $objResult["id_dept"];?>-<?php print $objResult["id_personnel"];?>
</td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td width="229"><strong>ชื่อโครงการ  ภาษาไทย	</strong></td>
<td width="587">
<?php echo $objResult["title_th"];?></td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
<td width="229"><strong>ชื่อโครงการ ภาษาอังกฤษ</strong></td>
<td width="587"><?php echo $objResult ["title_en"];?></td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
<td width="229" valign="top"><strong>หัวหน้าโครงการ</strong></td>
<td width="587">
<?php echo $objResult["prefix_name"];?>
<?php echo $objResult["name"];?>
&nbsp;<?php echo $objResult["surname"];?>
<p><?php echo $objResult["dept"];?>
<?php if ($objResult["status"]=="3")
{echo"&nbsp;คณะแพทยศาสตร์&nbsp;มหาวิทยาลัยสงขลานครินทร์";}
else{echo"";}
?>
</p>

</td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>

<tr>
<td height="28" valign="top">
<strong>ผู้ร่วมทดลอง</strong>
</td>
<td>
<?php
require "config.inc.php";
$sql3 = "SELECT * from  team  as r
inner join  prefix  as  p on r.id_prefix = p.id_prefix
WHERE id_rs = '".$_GET["id_rs"]."'";
$result = mysql_query($sql3);
$Num_Rows = mysql_num_rows($result);
$i=2;
if(($result!="")){
while($row3 = mysql_fetch_array($result)){
?>
<?php echo $row3["prefix_name"];?>
<?php echo $row3["name"];?>&nbsp;<?php echo $row3["surname"];?>
</p>
<?php }}?>
</td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>
<tr>
<td height="22"><strong>คำสำคัญ</strong></td>
<td><?php print $objResult["keywords_th"];?></td>
</tr>
<tr>
  <td height="22"><strong>Keywords</strong></td>
  <td><?php print $objResult["keywords_en"];?></td>
</tr>
<tr>
  <td height="8" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="22"><strong>ประเภทของการวิจัย</strong></td>
  <td><?php print $objResult["type_name"];?></td>
</tr>
<tr>
  <td height="8" colspan="2"><hr></td>
  </tr>
<tr>
<td height="26"><strong>ระยะเวลาโครงการ</strong></td>
<td>วันที่เริ่มต้น:&nbsp;<?php echo $objResult["start_date"];?>&nbsp;
วันที่สิ้นสุด:&nbsp;
<?php print $objResult["finish_date"];?>
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
$date_current= $expire-date('Y-m-d');//หาวันที่เหลืออยู่
echo "&nbsp;จำนวนวัน:&nbsp;$period_of_time&nbsp;วัน</p>";
?></td>
</tr>
<tr>
<td height="24"><strong>งบประมาณทั้งโครงการ</strong></td>
<td>
<?php $num = $objResult["budget"]; echo number_format($num,0,".",",");?>
&nbsp;บาท
</td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>
<tr>
<td height="24"><strong>ประเภทแหล่งทุนที่คาดว่าจะได้รับ</strong></td>
<td>
<?php if($objResult["ts1"]=='1'){echo"ทุนคณะแพทยศาสตร์ ";}?>
<?php if($objResult["ts2"]=='2'){ echo"ทุนมหาวิทยาลัย";}?>
<?php if($objResult["ts3"]=='3'){ echo"ทุนนอกมหาวิทยาลัย";}?>
<?php if($objResult["ts4"]=='4'){ echo"ทุนต่างประเทศ";}?>
<?php if($objResult["ts5"]=='5'){ echo $objResult["other_funds"];}?>
</td>
</tr>
<tr>
<td height="24"><strong><span lang="en-US"><span lang="th">ชื่อหน่วยงาน</span></span>ที่คาดว่าจะว่าจะให้ทุน</strong></td>
<td><?php print $objResult["source_funds"];?></td>
</tr>

<tr>
<td height="8" colspan="2"><hr></td>
</tr>
<?php
require "config.inc.php";
mysql_query("SET NAMES utf8");

$strSQL2 = "SELECT * from research as r
inner join officer   as  e on r.id_off = e.id_off
inner join prefix    as  x on e.id_prefix   = x.id_prefix
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
$objResult2 = mysql_fetch_array($objQuery2);
?>

<tr>
<td height="22"><strong>ไฟล์แบบเสนอโครงการวิจัย</strong></td>
<td><a class="ot-button-green" href  ="<?php print $objResult["file_upload"];?>" title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดไฟล์</a></td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>

<tr>
<td height="22"><strong>ผู้ดำเนินการต่อ</strong></td>
<td>
<?php if($objResult2["id_off"]=='0'){echo"---";}?>
<?php if($objResult2["id_off"]!='0'){echo $objResult2["prefix_name"];echo $objResult2["fname_off"];}?>
</td>
</tr>
<tr>
  <td height="22"><strong>วันที่</strong></td>
  <td><?php print $objResult["date_submit"];?></td>
</tr>
<tr>
  <td height="22">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
<td height="8" colspan="2"><hr></td>
</tr>

<tr>
<td colspan="2">
</td>
</tr>
<?php
require "config.inc.php";
require "datethai.php";
$strSQL2 = "SELECT * from research as r
inner join officer   as  e on r.id_off = e.id_off
inner join prefix    as  x on e.id_prefix   = x.id_prefix
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
$objResult2 = mysql_fetch_array($objQuery2);
?>

</table>
</div></div>
<?php  include ("footer.php"); ?>
</body>
</html>
