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
jQuery("#file_upload").validate({
expression: "if (VAL) return true; else return false;",
message: "*กรุณาเลือกไฟล์ "});

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
<?php  include "menu_user.php" ?>
</div>
<p><?php  include "menu.php" ?></p>
</div>
<?php
require "config.inc.php";

$strSQL = "SELECT * from research as r
inner join year  as  y on r.id_year  = y.id_year
inner join pm as  m on r.id_pm    = m.id_pm
inner join prefix as p on p.id_prefix =m.id_prefix
inner join status_research as  s on r.id_status_research = s.id_status_research
-- inner join field_research  as  f on r.id_field = f.id_field
inner join type_research   as  t on r.id_type = t.id_type
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<form action="comment_insert.php" name="add_form" id="add_form" method="post" enctype="multipart/form-data">
<table width="95%" height="720" border="0" align="center" cellpadding="2" cellspacing="3">
<tr>
<td height="49" colspan="3" align="center">
<h1>แบบประเมินโครงการวิจัย</h1></td>
</tr>
<tr>
<td height="20" colspan="3"><h3><strong>ขั้นตอนที่ 1 - ดาวน์โหลดเอกสารโครงการวิจัย</strong></h3></td>
</tr>
<tr style="display:none;">
<td height="22" colspan="2"><strong>ลำดับที่:</strong></td>
<td><label for="id"></label>
<input name="id_rs"  type="text"  value="<?php print $objResult["id_rs"];?>" size="5"readonly>
-&nbsp;
<input name="id_reviewer" type="text" id="id_reviewer" value="<?php  echo $_SESSION['id']?>" size="5"readonly></td>
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
<td height="7" colspan="3" align="left"><hr></td>
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
<td height="30" colspan="2"><strong>ดาวน์โหลดเอกสารโครงการวิจัย:</strong></td>
<td><a class="ot-button-download" href="<?php print $objResult["file_upload"];?>" title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดแบบเสนอโครงการวิจัย</a></td>
</tr>
<tr>
  <td height="20" colspan="3"><hr></td>
  </tr>
<tr>
  <td height="40" colspan="2"><strong>แบบฟอร์มสำหรับผู้ทรงคุณวุฒิใช้ประเมิน</strong></td>
  <td><?php
require "config.inc.php";
$sql= "SELECT * from submit_feedback where id_reviewer ='".$_SESSION['id']."' and id_rs = '".$_GET['id_rs']."'";
$table= mysql_query($sql) or die (mysql_error());
$row = mysql_fetch_array($table);

//print $sql;
// 02 Social, 04  Biomedical, 
if($row["from_review"]=='1'){
  // print "Full board";
	  if($objResult["id_type"]=='04'){
		?>
		<a href="../file_apdu/Editor2/AF_10_03_แบบประเมินจริยธรรมการวิจัยในมนุษย์สำหรับโครงการวิจัยทางคลินิก.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a>
		<a href="../file_apdu/Editor2/AF11-03.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินยาหลอก</a>
		<!-- <a href="../file_apdu/Editor2/Biomedical.zip" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a> -->
		<?php
	  }else if($objResult["id_type"]=='02'){
		?>
		<a href="../file_apdu/Editor2/AF_12_03_แบบประเมินจริยธรรมการวิจัยในมนุษย์สำหรับโครงการวิจัยทางสังคมศาสตร์.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a>
		<!-- <a href="../file_apdu/Editor2/SocialBehavioral.zip" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a> -->
		<?php
	  }
}else if($row["from_review"]=='2'){
  // print "Form 2";
  if($objResult["id_type"]=='04'){
    ?>
    <a href="../file_apdu/Editor2/AF_13_03_แบบประเมินโครงการใหม่ที่เข้าข่ายพิจารณาแบบเร็ว.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a>
	<a href="../file_apdu/Editor2/AF11-03.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินยาหลอก</a>
	<!-- <a href="../file_apdu/Editor2/BiomedicalExpedited.zip" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a> -->
    <?php
  }else if($objResult["id_type"]=='02'){
    ?>
	<a href="../file_apdu/Editor2/AF_13_03_แบบประเมินโครงการใหม่ที่เข้าข่ายพิจารณาแบบเร็ว.doc" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a>
    <!-- <a href="../file_apdu/Editor2/SocialBehavioralExpedied.zip" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมิน</a> -->
    <?php
  }
}else if($row["form_review"]=='3'){
  // print "Exemped";
}
?>

<!-- <?php if($row["from_review"]=='1'){?>
<a href="../file_apdu/Form_Clinic.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินด้านคลินิก</a>
<?php }?>
<?php if($row["from_review"]=='2'){?>
<a href="../file_apdu/Form_Society.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบประเมินด้านสังคม</a>
<?php }?>
<?php if($row["from_review"]=='3'){?>
<a href="../file_apdu/Form_Expedite.rar" target="_new" class="ot-button-download">ดาวน์โหลดแบบ Expedite</a> -->
<!-- <?php }?> -->
</td>
</tr>
<tr>
  <td height="20" colspan="3"><h3><strong>ขั้นตอนที่ 3 - อัพโหลดแบบประเมิน นามสกุล .doc .docx</strong></h3></td>
</tr>
<tr>
  <td height="20" colspan="2"><strong>อัพโหลดแบบประเมินของท่าน:</strong>
    <script>
function checkext(){
var permittedFileType = ['doc','docx'];/*'doc', 'docx', 'xls', 'xlsx'*/
var fext = $(".task_doc").val().split('.').pop().toLowerCase();
var resultFile = validate_filetype(fext, permittedFileType);
if(resultFile === false){
$(".task_doc").replaceWith("<input type='file' name='file_upload' class='task_doc'  onChange='checkext();'>");
alert("เกิดความผิดพลาด รูปแบบไฟล์ต้องเป็น doc docx เท่านั้น!");}}
function validate_filetype(fext, ftype)
{for(var num in ftype){if(fext == ftype[num])
return true;}return false;}
    </script></td>
  <td><input type="file" name="file_upload" id="file_upload"
class="task_doc"  onChange="checkext();"/></td>
</tr>
<tr>
  <td height="20" colspan="2"><strong>ความคิดเห็นเพิ่มเติม:</strong></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td height="20" colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td height="56" colspan="3"><textarea name="detail" id="cause" class="ckeditor"></textarea></td>
  </tr>
<tr>
  <td height="24" colspan="3" align="center">
    <p>&nbsp;      </p>
    <p>
      <input name="submit" type="submit" value="บันทึก" class="firstsubmit">
      <input name="reset" type="reset" value="ยกเลิก" class="firstsubmit">
    </p></td>
</tr>
</table>
</form>
<br></br>
</table>
</div>
<?php  include("footer.php"); ?>
</body>
</html>
