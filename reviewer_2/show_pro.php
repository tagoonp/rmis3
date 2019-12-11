<?php
/* MM Document: Phase II
    Show details of selected report (formerly 'progress'). All of show_pro.php variation
    (pm, staff, ec) is based on share/report_details.inc
*/
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
<title>:: สำหรับหัวหน้าโครงการ ::  </title>
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
<? include "menu_user.php" ?>
</div>
<p><? include "menu.php" ?></p>

<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<br>

<table width="85%" height="456" border="0" align="center" cellpadding="2" cellspacing="3">
<? // MM Document: Share the same file on show description of report.
require '../share/report_details.inc'; ?>
</table>

</div></div>
<? include ("footer.php"); ?>
</body>
</html>
