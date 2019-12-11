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
<?php include "menu_user.php" ?>
</div>
<p><?php include "menu.php" ?></p>
</div>
<table width="85%" height="420" border="0" align="center" cellpadding="1" cellspacing="3">
<tr>
<td height="48" colspan="2" align="center">
<h1>ข้อเสนอแนะจากผู้ทรงคุณวุฒิ </h1></td>
</tr>

<?php
require "config.inc.php";
include "datethai.php";

// MM: Checked for uploaded file
/*$sql2 = "SELECT *, r.file_upload AS rf_upload, g.file_upload AS pf_upload,
c.detail AS reviewer_detail, con.detail AS officer_detail
FROM cc_pro as c
inner join progress  as g   on c.id_pro = g.id_pro
inner join reviewer  as  m on c.id_reviewer= m.id_reviewer
inner join prefix    as  p on p.id_prefix = m.id_prefix
inner join steps     as  s on g.id_steps = s.id_steps
inner join rec       as  r on g.id_rec = r.id_rec
inner join con_rw  as con on (c.id_pro = con.id_pro AND c.id_reviewer = con.id_reviewer)
WHERE g.id_pro = '".$_GET["id_pro"]."' ";*/

$get_id_con = $_GET["id_con"];
$session_id = $_SESSION["id"];
$sql2 = "SELECT *, r.file_upload AS rf_upload, g.file_upload AS pf_upload,
cc.detail AS reviewer_detail
FROM con_rw as c
inner join progress  as g   on c.id_pro = g.id_pro
inner join reviewer  as  m on c.id_reviewer= m.id_reviewer
inner join prefix    as  p on p.id_prefix = m.id_prefix
inner join steps     as  s on g.id_steps = s.id_steps
inner join rec       as  r on g.id_com = r.id_com
inner join status_rec as sr on sr.id_status_rec = g.id_status_rec
inner join cc_pro    as cc on c.id_con = cc.id_con
WHERE c.id_con = '$get_id_con' AND c.id_reviewer = '$session_id'
LIMIT 1";

$result2 = mysql_query($sql2);
if(mysql_num_rows($result2) > 0) {
while($row = mysql_fetch_array($result2)){
$_GET['id_pro']=$row['id_pro'];
$strDate3 = $row["date_review"];
$id_cc    = $row["id_cc"];
?>
<tr>
<td width="206" height="20"><strong>ผู้ประเมิน:</strong></td>
<td width="574"><?php echo $row["prefix_name"];?><?php echo $row["name"];?>
&nbsp;<?php echo $row["surname"];?></td>
</tr>
<tr>
<td width="206" height="20">
<strong>รหัสโครงการ:</strong></td>
<td width="574"><?php echo $row["id_rec"];?></td>
</tr>

<tr>
<td height="6" colspan="2"><hr></td>
</tr>

<? // MM Document: Share the same file on show description of report.
require '../share/general_pro_body.inc'; ?>

<tr>
  <td height="4" colspan="2"><hr></td>
  </tr>
  <?php /*
<tr>
  <td><strong>รายละเอียดเพิ่มเติมสำหรับการประเมิน:</strong></td>
  <td><?php if($row["officer_detail"]!=="") echo $row["reviewer_detail"]; else { echo "-"; }?></td>
</tr>
*/?>
<tr>
  <td height="46"><strong>ผลการประเมินจากท่าน:</strong></td>
  <td><a class="ot-button-download" href="<?php echo $row["file_cc"];?>" title="ดาวน์โหลด" target="_new">ดาวน์โหลดผลการประเมิน</a></td>
</tr>
<tr>
  <td><strong>ความเห็นเพิ่มเติมเกี่ยวกับการประเมินจากท่าน:</strong></td>
  <td><?php if($row["reviewer_detail"]!=="") echo $row["reviewer_detail"]; else { echo "-"; }?></td>
</tr>
<tr>
  <td height="20" colspan="2"><hr></td>
  </tr>
<tr>
  <td height="20"><strong>ประเมินเมื่อวันที่: </strong></td>
<td>
<?php echo DateThai3($strDate3);?>
<?}
} else {
  echo"<script>alert('เกิดความผิดพลาด กรุณาติดต่อเจ้าหน้าที่ หรือลองใหม่อีกครั้งในภายหลัง')</script>";
  echo"<script>window.location.replace('index.php')</script>";
}?>
</td>
</tr>

<tr>
<td height="20" colspan="2"><hr></td>
</tr>

<!-- <tr>
<td height="46"></td>
<td>
<a class="ot-button-edit"
href="cc_edit.php?id_cc=<?php echo $row["id_cc"];?>">แก้ไขข้อมูล</a>
</td>
</tr>
 -->

</table>

<div align="center" style="margin-top: 15px; margin-bottom: 5px">
  <input name="back_to_list" type="button" id="back_to_list" onClick="location.href='./index.php'" value="กลับไปยังหน้าหลัก" class="firstsubmit">
</div>

</div>
<? include ("footer.php"); ?>
</body>
</html>
