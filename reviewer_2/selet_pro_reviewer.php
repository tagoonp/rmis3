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
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/jquery.validate.css">
<!-- js -->
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script  type="text/javascript"src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.validation.functions.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var tbl = $("table.tbl1");
addZebraStripe(tbl);
addMouseOver(tbl);
$("table.scroll").createScrollableTable({
width: '95%',
height: '400px'});
});
function addZebraStripe(table) {
table.find("tbody tr:odd").addClass("alt");}
function addMouseOver(table) {
table.find("tbody tr").hover(
function() {
$(this).addClass("over");},
function() {
$(this).removeClass("over");}
);}
</script>
<script>
function SmallWindow1(wintype) {
SmallWin=window.open(wintype,"SmallWin","toolbar=no,directories=no,status=no,scrollbars=auto,menubar =no,width=640,height=405"); SmallWin.window.focus() }
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
<table width="98%" class="tbl1 scroll">
<thead>
<tr>
<th width="25" align="center">ลำดับที่</th>
<th width="357" align="center">ชื่อโครงการ</th>
<th width="173" align="center">หัวหน้าโครงการ</th>
<th width="173" align="center">สถานะการดำเนินงาน</th>
<th width="40" align="center">ครั้งที่</th>
<th width="239" align="center">สถานะโครงการ </th >
<th width="85" align="center">วันที่</th>
<th width="85" align="center">ดำเนินการ</th>
</tr>
</thead>
<?php
require "config.inc.php";
require "datethai.php";
$sql = "SELECT * from  progress as p 
inner join pm                   as m on p.id_pm = m.id_pm
inner join steps                as t on p.id_steps      = t.id_steps 
inner join status_rec           as s on p.id_status_rec = s.id_status_rec
where s.id_status_rec='3' AND id_ec ='".$_SESSION['id']."'";

$result = mysql_query($sql);
$num_rows = mysql_num_rows($result);

$i=1;
if(($result!="")){
while($row = mysql_fetch_array($result)){
$strDate = $row["progress_date"];
$id_no   = $row["id_no"];

?>

<tbody>
<tr>
<td width="25" align="center">
<div id="number">
<?php echo $i;?>
</div>
</td>

<td width="357" >
<a href="show_pro.php?id_pro=<?php echo $row["id_pro"];?>">
<?php echo $row ["title_th"];?></a>
</td>
<td width="173" align="center">
<?php echo $row["pm_name"];?></td>
<td width="239" align="center">
<font color="#FF6801">
<?php echo $row["steps_name"];?>
</font>
</td> 
<td width="40" align="center">
<?php echo $row["progress_no"];?>
</td> 

<td width="89" align="center">
<font color="red">
<?php echo $row["status_name"];?></font>
</td>
<td width="85" align="center">
<?echo DateThai($strDate);?>
</td>

<td width="137" align="center">
<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='1')){?>
<a href="consideration_add.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [1]</a>
<?}?>
<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='2')){?>
<a href="consideration_renewal_update.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [2]</a>
<?}?>

<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='3')){?>
<a href="consideration_renewal_update.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [3]</a>
<?}?>

<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='4')){?>
<a href="consideration_renewal_update.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [3]</a>
<?}?>

<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='5')){?>
<a href="consideration_renewal_update.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [3]</a>
<?}?>

<?if(($row ["id_status_rec"]=='3')AND($row ["id_steps"]=='6')){?>
<a href="consideration_renewal_update.php?id_pro=<?php echo $row["id_pro"];?>">
พิจารณาเบื้องต้น [3]</a>
<?}?>



</td>
</tr>
</tbody>
<?$i++;}}
mysql_close($conn);
?>

</table>
<br></br>
</div></div>
<? include ("footer.php"); ?> 
</body>
</html>

