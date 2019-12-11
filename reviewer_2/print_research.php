<!DOCTYPE html>
<html>
<head>
<title>: :สำหรับหัวหน้าโครงการ ::</title>
<!-- Meta Tags -->
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="generator" content="" />
<!-- CSS -->
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="css/structure.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/tab.css">
<link rel="stylesheet" href="css/form.css">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/scrolltable.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var tbl = $("table.tbl1");
addZebraStripe(tbl);
addMouseOver(tbl);
$("table.scroll").createScrollableTable({
width: '920px',
height: '350px'});
});
function addZebraStripe(table) {
table.find("tbody tr:odd").addClass("alt");
}
function addMouseOver(table) {
table.find("tbody tr").hover(
function() {
$(this).addClass("over");
},
function() {
$(this).removeClass("over");
}
);}
</script>

</head>
<body id="public">
<div id="container" class="ltr">
<header id="header" class="info">
<div align="left">
<table width="922" border="0">
<tr>
<th width="500" rowspan="3" scope="col">
<a href="index.php">
<img src="images/logo_header.png" width="500" height="104" alt="logo_haeder"></a></th>
<th width="55" rowspan="3" align="center" valign="top" scope="col">&nbsp;</th>
<th height="38" align="left" valign="bottom" scope="col">
<img src="images/info_account.gif" alt="online" width="31" height="22" align="top"> ชื่อผู้ใช้งาน :&nbsp;<?=$objResult["prefix_name"];?>&nbsp;<?=$objResult["full_name"];?></th>
</tr>
<tr>
<th height="21" align="left" valign="middle" scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานะ :&nbsp;
<font size="2" color="red"><?if($objResult["id_status"]=='1'){echo"หัวหน้าโครงการ";}?></font></th>
</tr>
<tr>
<th width="353" height="20" align="left" valign="middle" scope="col">
<a class="ot-button-green" href="#">แก้ไขข้อมูลส่วนตัว</a>&nbsp;&nbsp;
<a class="ot-button-green" href="logout.php">ออกจากระบบ</a></th>
</tr>
</table>
</div>
</header>
<table width="932" height="47" border="0" align="center" cellpadding="2" cellspacing="2">
<tr>
<td height="43"><?include"menu.php"?></td>
</tr>
</table>
</td>
</tr>
</table>
<p></p>
<form name="frmSearch" method="post" action="<?=$_SERVER['SCRIPT_NAME'];?>">
<table width="625" height="211" border="0" align="center" cellpadding="1">
<tr>
<th width="277" height="43" align="left" scope="col">
    ประเภท:
<select name="id_category" id="id_category"  >
<option>--เลือกรายการที่ค้นหา--</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM category ";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table)){ 
$id_category2= $row["id_category"];
$category_name=$row["category_name"];?>
<option value="<? echo $id_category2;?>"<?if($id_category2==$id_category)
{ print "selected";}?>><? echo $category_name;?></option>
<? } ?>
</select></th>
<th width="338" align="left" scope="col">คำที่ค้นหา:
<input type="search" name="txtKeyword"  id="txtKeyword" value="<?=$_POST["txtKeyword"];?>"></th>
</tr>
<tr>
<th height="25" align="left" scope="row">ประจำปี:
<select name="id_year" id="id_year">
<option>--เลือกรายการที่ค้นหา--</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM year ";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table)){ 
$id_year2= $row["id_year"];
$year_name=$row["year_name"];?>
<option value="<? echo $id_year2;?>"
<?if($id_year2==$id_year){print "selected";}?>><? echo $year_name;?></option>
<? } ?>
</select>
</th>
<td>-</td>
</tr>
<tr><th height="43" align="left" scope="row">วัน/เดือน/ปี:&nbsp;  <input name="date" type="text" id="date" size="20"></th>
<td><strong>ถึง &nbsp;&nbsp;</strong>  <input type="text" name="date2"  id="date2" size="20"></td></tr>
<tr>
<th height="81" colspan="2" align="center" valign="middle" scope="row"><p>
<input type="submit" value="ค้นหา">
<input type=button onClick="location.href='advanced_search.php'" value='ยกเลิก'>
</p></th>
</tr>
</table>
</form>
</table> 
</td>
</tr>
</table>

</div>
<? include ("footer.php"); ?> 
</body>
</html>