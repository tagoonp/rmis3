<?php
//session_start();
if($_SESSION['id'] == ""){
header("location:../index.php");
exit();}
else
require "config.inc.php";
$sql    = "select * from reviewer as r
inner join prefix as p on p.id_prefix =r.id_prefix
where id_reviewer ='".$_SESSION['id']."'";
$result = mysql_query($sql);
$row    = mysql_fetch_array($result);
?>
<table width="300" height="68">
<tr>
<th width="15" align="left" valign="middle" scope="col">
<img src="images/user_online.gif" alt="online" align="top" /></th>
<th height="24" align="left" valign="middle" scope="col">
  <strong>ชื่อผู้ใช้:</strong>&nbsp;<?php /*echo $row["prefix_name"];*/?><?php echo $row["name"];?>&nbsp;<?php echo $row["surname"];?></th>
</tr>
<tr>
<th align="left" valign="middle" scope="col"></th>
<th height="17" align="left" valign="middle" scope="col">
<strong>สถานะ</strong> &nbsp;ผู้ทรงคุณวุฒิ
</th>
</tr>
<tr>
<td height="17">&nbsp;</td>
<td>
<a class="ot-button-edit"
href="re_edit.php?id_reviewer=<?php  print $row["id_reviewer"];?>">แก้ไขข้อมูลส่วนตัว</a>
<a class="ot-button-logout" href="logout.php"> &nbsp;ออกจากระบบ </a>
</td>
</tr>
</table>
