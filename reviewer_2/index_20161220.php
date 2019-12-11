<?php
/* MM Document: Phase I & Phase II
		This file mixed of 2 list

		- Review for Phase I
			Show a list of proposals that describe on Phase I flow (Out of my scope)

		- Review for Phase II
			Show a list of reports that need reviewer to be review (from 'con_rw' table)
			There is a status for each review, which are:
				if 'status_review' = 0 (Not yet review) --> reviewer/cc_add.php
				if 'status_review' = 2 (Not to review) --X (No Action)
				if 'status_review' = 3 (Reviewed) --> reviewer/show_cc.php

		Status: OK

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

// MM: Mode of this page
$mode = "active";
if(isset($_GET["m"]) && ($_GET["m"] === "active" || $_GET["m"]==="finished")) {
	$mode = $_GET["m"];
}
// echo $mode;
?>
<!DOCTYPE html>
<html>
<head>
<title>:: สำหรับผู้ทรงคุณวุฒิ ::</title>
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
<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/js/jquery.reveal.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script  type="text/javascript"src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/jquery.validation.functions.js"></script>

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

<div id="info-user"><?php  include "menu_user.php"; ?></div>
<p><?php  include "menu.php" ?></p>
<?php if($mode === "active") { ?><h1>รายการโครงการวิจัยที่รอการประเมิน</h1><?php } ?>
<?php if($mode === "finished") { ?><h1>รายการโครงการวิจัยที่ประเมินแล้ว</h1><?php } ?>

					<table width="100%" align="center" cellpadding="1">
                        <tbody>
                            <tr>
                                <td width="33%" align="left" valign="top">
                                    <ul class="vertical-list">
                                        <li><a href='index.php?m=active'  class='button' onMouseover="return hidestatus()">แสดงรายการโครงการวิจัยที่รอการประเมิน</a></li>
                                	</ul>
                                </td>
								<td width="33%" align="left" valign="top">
									<ul class="vertical-list">
										<li><a href='index.php?m=finished'  class='button' onMouseover="return hidestatus()">แสดงรายการโครงการวิจัยประเมินแล้ว</a></li>
									</ul>
								</td>
                            </tr>
                    </table>



<table width="98%" class="tbl1 scroll" id="result_table">
<thead>
<tr>
<th width="95" align="center">รหัส</th>
<th width="462" align="center">ชื่อโครงการ</th>
<th width="90" align="center">วันที่ได้รับ</th>
<th width="92" align="center">วันกำหนดส่ง</th>
<th width="83" align="center">วันที่ประเมิน</th>
<th width="93" align="center">สถานะ </th>
<th width="94" align="center">ดำเนินการ</th>
</tr>
</thead>
<tbody>
	<?php
	include "config.inc.php";
	include "datethai.php";

	if($mode === "active") {
		$sql = "SELECT * FROM (SELECT CONCAT(year_name, \"-\", s.id_rs,\"-\", m.id_dept,\"-\", m.id_personnel) as id, s.id_rs as doc_link, title_th as title, id_fb as detail_link,
		date_fb as date_recv, set_date as date_deadline, date_review as date_consider, status_review as status_review, \"1\" as doc_type, s.id_rs as result_link
		from submit_feedback as s
		inner join research         as r on s.id_rs= r.id_rs
		inner join pm as m on r.id_pm = m.id_pm
		inner join year             as y on r.id_year = y.id_year
		inner join prefix           as p on p.id_prefix =m.id_prefix
		inner join reviewer         as w on s.id_reviewer= w.id_reviewer
		where w.id_reviewer ='".$_SESSION['id']."' AND (status_review = 0 OR status_review = 1)
		UNION
		SELECT id_rec as id, p.id_pro as doc_link, title_th as title, id_con as detail_link,
		date_submit as date_recv, due_date as date_deadline, date_review as date_consider, status_review as status_review, \"2\" as doc_type,
		id_con as result_link
		from con_rw  as c
		INNER JOIN progress as p on c.id_pro = p.id_pro
		where c.id_reviewer ='".$_SESSION['id']."' AND (status_review = 0 OR status_review = 1)) dt ORDER BY date_deadline" ;
	} else if($mode === "finished") {
		$sql = "SELECT * FROM (SELECT CONCAT(year_name, \"-\", s.id_rs,\"-\", m.id_dept,\"-\", m.id_personnel) as id, s.id_rs as doc_link, title_th as title, id_fb as detail_link,
		date_fb as date_recv, set_date as date_deadline, date_review as date_consider, status_review as status_review, \"1\" as doc_type, s.id_rs as result_link
		from submit_feedback as s
		inner join research         as r on s.id_rs= r.id_rs
		inner join pm as m on r.id_pm = m.id_pm
		inner join year             as y on r.id_year = y.id_year
		inner join prefix           as p on p.id_prefix =m.id_prefix
		inner join reviewer         as w on s.id_reviewer= w.id_reviewer
		where w.id_reviewer ='".$_SESSION['id']."' AND (status_review = 2 OR status_review = 3)
		UNION
		SELECT id_rec as id, p.id_pro as doc_link, title_th as title, id_con as detail_link,
		date_submit as date_recv, due_date as date_deadline, date_review as date_consider, status_review as status_review, \"2\" as doc_type,
		id_con as result_link
		from con_rw  as c
		INNER JOIN progress as p on c.id_pro = p.id_pro
		where c.id_reviewer ='".$_SESSION['id']."' AND (status_review = 2 OR status_review = 3)) dt ORDER BY status_review ASC, date_consider DESC" ;
	}
	$objQuery = mysql_query($sql) or die (mysql_error());
	$Num_Rows = mysql_num_rows($objQuery);
	$i=1;
	if($objQuery!=""){
	while($objResult = mysql_fetch_array($objQuery)){
	$strDate = $objResult["date_recv"];
	$strDate = $objResult["date_deadline"];
	$strDate2 = $objResult["date_consider"];
	?>

<tr>
<td width="95" align="left"><div id="number" style="text-align:center">
<?php print $objResult["id"];?></div></td>
<td width="462">
	<?php if($objResult["doc_type"] == 1) { ?>
		<a href="show.php?id_rs=<?php  echo $objResult["doc_link"];?>" title="แสดงรายละเอียดงานวิจัย"><strong> <?php  echo $objResult["title"];?></strong></a>
	<?php } else if($objResult["doc_type"] == 2) {?>
		<a href="show_pro.php?id_pro=<?php  echo $objResult["doc_link"];?>" title="แสดงรายละเอียดงานวิจัย"><strong> <?php  echo $objResult["title"];?></strong></a>
	<? } ?>

<?php if($objResult["detail_link"]!=""){ echo"&nbsp;|&nbsp;";?>
<?php if($objResult["doc_type"] == 1) { ?>
	<a href="JavaScript:SmallWindow1('detail.php?id_fb=<?php  echo $objResult["detail_link"];?>')">ข้อคิดเห็นจากเลขา EC</a>
<?php } else if($objResult["doc_type"] == 2) { ?>
	<a href="JavaScript:SmallWindow1('detail.php?id_con=<?php  echo $objResult["detail_link"];?>')">ประเด็นการประเมินโดยเจ้าหน้าที่</a>
<?php } ?>
<?php }?>

</td>
<td width="90" align="center">
<font color="blue">
<?php  echo DateThai($objResult["date_recv"]);?>
</font></td>

<td width="92" align="center">
<font  color="red">
<?php  echo DateThai($objResult["date_deadline"]);?>
</td>

<td width="83" align="center">
<?php if($objResult["date_consider"]=='0000-00-00'){echo " - ";}
else {echo DateThai2($strDate2);}?>
</td>

<td width="93" align="center">
<?php if($objResult["status_review"]=='1' || $objResult["status_review"]=='0'){echo"<font color='red'>ยังไม่ได้ประเมิน</font>";}
else if ($objResult ["status_review"]=='2'){echo"<font color='#33993'>ประเมินเรียบร้อย</font>";}
else if ($objResult ["status_review"]=='3'){echo"<font color='blue'>ไม่ประเมิน</font>";}
?>
</td>
<td width="94" align="center">
<?php if($objResult["doc_type"] == 1) { ?>

		<?php if($objResult["status_review"] =='2'){?>
			<a href="show_comment.php?id_rs=<?php  echo $objResult["result_link"];?>"title="แสดงข้อมูล" ><font color="blue"><b>แสดงข้อมูล</b></font></a>
		<?php }else if($objResult["status_review"] =='3'){?>
			<a href="show_nocom.php?id_rs=<?php  echo $objResult["result_link"];?>"><font  color="blue"><b>แสดงข้อมูล</b></font></a>
		<?php }else{?>
			<a href="comment_add.php?id_rs=<?php print $objResult["result_link"];?>">ประเมิน</a>&nbsp;|&nbsp;
			<a href="no_com.php?id_rs=<?php print $objResult["result_link"];?>">ไม่ประเมิน</a>
		<?php }?>
<?php } else if($objResult["doc_type"] == 2) {?>
	<?php if($objResult["status_review"] =='2'){ ?>
	<a href="show_cc.php?id_con=<?php echo $objResult["result_link"]?>"title="แสดงข้อมูล" >
	<font color="blue"><b>แสดงข้อมูล</b></font>
	</a>
	<?php }else if($objResult["status_review"] =='0' || $objResult["status_review"] =='1'){?>
	<a href="cc_add.php?id_con=<?php echo $objResult["result_link"];?>">ประเมิน</a>&nbsp;|&nbsp;
	<a href="cc_nocom.php?id_con=<?php echo $objResult["result_link"];?>">ไม่ประเมิน</a>
	<?php }else if($objResult["status_review"] =='3'){ ?>
	<a href="show_cc_nocom.php?id_con=<?php echo $objResult["result_link"]?>"title="แสดงข้อมูล" >
	<font color="blue"><b>แสดงข้อมูล</b></font>
	</a>
	<?php }?>
<? } ?>
</td>


</tr>

<?php $i++;}}
// if($objQuery=="" || mysql_num_rows($objQuery) == 0)
// {
// 	include '../share/list_functions.inc.php';
// 	if($mode === "active") {
// 		echo nothing_to_show(7, "ขออภัย ยังไม่มีโครงการให้ท่านพิจารณาในขณะนี้");
// 	} else if ($mode === "finished") {
// 		echo nothing_to_show(7, "ขออภัย ท่านยังไม่ได้พิจารณาโครงการใด ๆ เลย");
// 	}
// }
mysql_close($conn); ?>
</tbody>
</table>
</br>
</div></div>
<?php include("../share/datatable.inc.php");
createZeroConfDataTable("result_table"); ?>
<?php  include ("footer.php"); ?>
</body>
</html>
