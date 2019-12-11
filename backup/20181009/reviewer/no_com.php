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
<p><?php  include "menu.php" ?></p>
</div>
<?php
require "config.inc.php";
mysql_query("SET NAMES utf8");
require "config.inc.php";
$strSQL = "SELECT * from research as r
inner join year            as  y on r.id_year  = y.id_year
inner join pm as  m on r.id_pm    = m.id_pm
inner join prefix as p on p.id_prefix = m.id_prefix
inner join status_research as  s on r.id_status_research = s.id_status_research
inner join type_research   as  t on r.id_type = t.id_type
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery = mysql_query($strSQL) or die (mysql_error());
$objResult = mysql_fetch_array($objQuery);
?>
<form action="nocom_insert.php" id="add_form" method="post" class="formular"
name="add_form" enctype="multipart/form-data">
<table width="95%" height="778" border="0" align="center" cellpadding="2" cellspacing="3">
<tr>
<td height="49" colspan="3" align="center"><h1>แบบไม่ประเมินโครงการวิจัย</h1></td>
</tr>
<tr style="display:none;">
<td height="22" colspan="2"><strong>ลำดับที่:</strong></td>
<td><label for="id"></label>
<input name="id_rs"  type="text"  value="<?php print $objResult["id_rs"];?>" size="4">
-&nbsp;
<input name="id_reviewer" type="text" id="id_reviewer" value="<?php  echo $_SESSION['id']?>" size="8"></td>
</tr>
<tr>
<td height="22" colspan="2"><strong>รหัสโครงการ</strong></td>
<td><?php print $objResult["year_name"];?>-<?php print $objResult["id_rs"];?>-<?php print $objResult["id_dept"];?>-<?php print $objResult["id_personnel"];?></td>
</tr>
<tr>
<td height="36"><strong>ชื่อโครงการวิจัย: &nbsp;</strong></td>
<td height="36"><strong>(ภาษาไทย)</strong></td>
<td width="717"><?php print $objResult["title_th"];?></td>
</tr>

<tr>
<td width="180" height="22" align="right"></td>
<td width="69"><strong>(อังกฤษ)</strong></td>
<td><?php print $objResult["title_en"];?></td>
</tr>

<tr>
  <td height="6" colspan="3" align="left"><hr></td>
  </tr>
<tr>
<td height="22" colspan="2" align="left"><strong>ชื่อหัวหน้าโครงการ<b>:</b></strong></td>
<td>
<?php echo $objResult["prefix_name"];?><?php echo $objResult["name"];?>
&nbsp;<?php echo $objResult["surname"];?>
<?php echo $objResult["dept"];?>
<?php if ($objResult["status"]=="3"){echo"&nbsp;คณะแพทยศาสตร์&nbsp;มหาวิทยาลัยสงขลานครินทร์";}
else{echo"";}?>
<p><b>โทรศัพท์มือถือ:</b>&nbsp;<?php echo $objResult["tel_mobile"];?>
&nbsp;&nbsp;<b>Email:</b>&nbsp;<?php echo $objResult["email"];?>
</td>
</tr>

<tr>
  <td height="6" colspan="3" align="left" valign="top"><hr></td>
  </tr>
<tr>
  <td height="22" colspan="2" align="left" valign="top"><strong>ผู้ร่วมทดลอง</strong></td>
  <td><?php
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
<?php echo $row3["prefix_name"];?>
<?php echo $row3["name"];?>&nbsp;<?php echo $row3["surname"];?>
<?php echo $row3["dept_name"];?>&nbsp;<?php echo $row3["faculty_name"];?>
&nbsp;<?php echo $row3["university_name"];?>
<p><b>โทรศัพท์มือถือ:</b>&nbsp;<?php echo $row3["tel_mobile"];?>
&nbsp;&nbsp;<b>Email:</b>&nbsp;<?php echo $row3["email"];?>
</p>
<?php }}?></td>
</tr>
<tr>
  <td height="6" colspan="3" align="left"><hr></td>
  </tr>
<tr>
  <td height="22" colspan="2" align="left"><strong>คำสำคัญ</strong></td>
  <td><?php print $objResult["keywords_th"];?></td>
</tr>
<tr>
  <td height="22" colspan="2" align="left"><strong>Keywords</strong></td>
  <td><?php print $objResult["keywords_en"];?></td>
</tr>
<tr>
  <td height="22" colspan="2" align="left"><strong>ประเภทของการวิจัย</strong></td>
  <td><?php print $objResult["type_name"];?></td>
</tr>
<tr>
  <td height="22" colspan="2" align="left"><strong>ระยะเวลาโครงการ</strong></td>
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
  <td height="22" colspan="2" align="left"><strong>งบประมาณทั้งโครงการ</strong></td>
  <td><?php $num = $objResult["budget"]; echo number_format($num,0,".",",");?>
&nbsp;บาท </td>
</tr>
<tr>
  <td height="20" colspan="3"><hr></td>
</tr>
<tr>
<td height="30" colspan="2"><strong>แบบเสนอโครงการวิจัย:</strong></td>
<td><a class="ot-button-download" href="<?php print $objResult["file_upload"];?>" title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดแบบเสนอโครงการวิจัย</a></td>
</tr>

<tr>
<td height="20" colspan="3"><hr></td>
</tr>

<tr>
<td height="20" colspan="2" valign="top"><strong>ระบุสาเหตุ:</strong></td>
<script>
function checkCause(temp){
if(temp=='4'){document.getElementById("cause").disabled = false; }
else if(temp=='2'){document.getElementById("cause").disabled = true;}
}
</script>
<td>
<p>
<input type="radio" name="num" id="2" value="1"
onClick="JavaScript:checkCause(this.value);" />
ไม่มีเวลา
<input type="radio" name="num" id="2" value="2"
onClick="JavaScript:checkCause(this.value);" />
ไม่ตรงกับความเชี่ยวชาญ
<input type="radio" name="num" id="2" value="3"
onClick="JavaScript:checkCause(this.value);"/>ผลประโยชน์ทับซ้อน</p>
<p>
<input type="radio" name="num" id="4" value="4"
onClick="JavaScript:checkCause(this.value);" />
  อื่นๆ
<input name="cause" type="text" disabled="disabled" id="cause" size="40" />
</p></td>
</tr>

<tr>
<td height="20" colspan="3" align="center">&nbsp;</td>
</tr>

<tr>
<td height="24" colspan="3" align="center">
<input name="submit" type="submit" value="บันทึก" class="firstsubmit">
<input name="reset" type="reset" value="ยกเลิก" class="firstsubmit"></td>
</tr>
</table>
</form>
<br></br>
</table>
</div>
<?php  include ("footer.php"); ?>
</body>
</html>
