<?php
session_start();
if($_SESSION['id'] == ""){
  header("location:../index.php");
  exit();
}
else
require "config.inc.php";
$sql = "select * from reviewer where id_reviewer ='".$_SESSION['id']."'";
$result = mysql_query($sql);
$row    = mysql_fetch_array($result);
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
<link rel="stylesheet" href="css/jquery.validate.css">
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
<p><?php  include "menu.php" ?></p>
</div>
<?php
require "config.inc.php";
$strSQL = "SELECT * from research as r
inner join year            as  y on r.id_year  = y.id_year
inner join pm              as  m on r.id_pm    = m.id_pm
inner join prefix          as  p on p.id_prefix = m.id_prefix
inner join status_research as  s on r.id_status_research = s.id_status_research
inner join type_research   as  t on r.id_type = t.id_type
WHERE id_rs = '".$_GET["id_rs"]."' ";
$objQuery = mysql_query($strSQL) or die (mysql_error());
$objResult = mysql_fetch_array($objQuery);
?>
<table width="85%" height="420" border="0" align="center" cellpadding="1" cellspacing="3">
<tr>
<td height="48" colspan="2" align="center">
<h1>ข้อเสนอแนะจากผู้ทรงคุณวุฒิ </h1></td>
</tr>

<?php
require "config.inc.php";
$sql2 = "SELECT * FROM comment as c
inner join reviewer        as  m on c.id_reviewer    = m.id_reviewer
inner join prefix          as  p on p.id_prefix = m.id_prefix
WHERE id_rs= '".$_GET["id_rs"]."' and m.id_reviewer = '".$_SESSION['id']."'";
$result2 = mysql_query($sql2);
while($row = mysql_fetch_array($result2)){
?>
<tr>
<td width="206" height="20"><strong>ผู้ประเมิน:</strong></td>
<td width="574"><?php  echo $row["prefix_name"];?><?php  echo $row["name"];?>
&nbsp;<?php  echo $row["surname"];?></td>
</tr>
<tr>
<td width="206" height="20"><strong>รหัสโครงการ:</strong></td>
<td width="574"><?php print $objResult["year_name"];?>-<?php print $objResult["id_rs"];?>-<?php print $objResult["id_dept"];?>-<?php print $objResult["id_personnel"];?></td>
</tr>
<tr>
  <td height="6" colspan="2"><hr></td>
  </tr>
<tr>
<td height="30"><strong>ชื่อโครงการวิจัย: </strong><strong>(ภาษาไทย)</strong></td>
<td width="574"><?php print $objResult["title_th"];?></td>
</tr>
<tr>
  <td height="6" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="30"><strong>ชื่อโครงการวิจัย: </strong><strong>(อังกฤษ)</strong></td>
  <td><?php print $objResult["title_en"];?></td>
</tr>
<tr>
  <td height="11" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="30"><strong>ไฟล์เอกสารโครงการ :</strong></td>
  <td><a class="ot-button-download" href="<?php print $objResult["file_upload"];?>" title="ดาวน์โหลดไฟล์" target="_new">ดาวน์โหลดเอกสารโครงการ</a></td>
</tr>
<tr>
  <td height="6" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="20"><strong>หัวหน้าโครงการ:</strong></td>
  <td><?php print $objResult["prefix_name"];?><?php print $objResult["name"];?>&nbsp;<?php print $objResult["surname"];?></td>
</tr>
<tr>
<td height="46"><strong>ไฟล์แบบประเมิน:</strong></td>
<td><a class="ot-button-download" href="<?php  echo $row["file_upload"];?>" title="ดาวน์โหลด" target="_new">ดาวน์โหลดแบบประเมิน</a></td>
</tr>
<tr>
  <td height="4" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="29"><strong>รายละเอียดเพิ่มเติม:</strong></td>
  <td><?php  echo $row["detail"];?></td>
</tr>
<tr>
  <td height="20" colspan="2"><hr></td>
  </tr>
<tr>
<td height="20"><strong>เมื่อวันที่: </strong></td>
<td><?php  echo $row["date_review"];?>
  <?php }?></td>
</tr>
<hr>
<tr>
  <td height="20" colspan="2">
  </td>
</tr>
</table>

</div>
<?php  include ("footer.php"); ?>
</body>
</html>
