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
<?
require "config.inc.php";
$sql2 = "SELECT * from submit_feedback as s
inner join ec                   as e on s.id_ec     = e.id_ec
inner join prefix               as p on e.id_prefix = p.id_prefix
WHERE id_fb= '".$_GET["id_fb"]."' ";
$objQuery = mysql_query($sql2);
$objResult = mysql_fetch_array($objQuery);
?>
<!DOCTYPE html>
<html>
<head>
<title>แสดงข้อมูล</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" />
<!-- CSS -->
<link rel="stylesheet" href="css/show.css" type="text/css" />
<!-- JavaScript -->
</head>

<body >
<table width="69%" height="108" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
  <td height="22" align="left"><strong> ข้อคิดเห็นจากเลขา EC &nbsp;<?php echo $objResult["prefix_name"];?> <?php echo $objResult ["fname_ec"];?></strong></td>
  </tr>
<tr>
  <td height="6" align="left"><hr></td>
</tr>
<tr>
  <td height="22" align="left"><strong>รายละเอียด<b>:</b></strong></td>
  </tr>
<tr>
	<td height="22" align="left">
		<?php
			if($objResult["remarks"] == ""){
				print "ไม่มีข้อคิดเห็น";
			}else{
				print $objResult["remarks"];	
			}			
		?>
	</td>
</tr>


<tr>
<td height="24">&nbsp;</td>
</tr>
</table>

</div>
</body>
</html>