<?php
include "config.class.php";

$return = [];
$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$id = mysqli_real_escape_string($conn, $_POST['id']);
$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);

$strSQL = "SELECT * FROM research a
          INNER JOIN type_status_research b ON a.id_status_research = b.id_status_research
          INNER JOIN type_personnel c ON a.id_personnel = c.id_personnel
          INNER JOIN type_research d ON a.id_type = d.id_type
          INNER JOIN useraccount e ON a.id_pm = e.id_pm
          INNER JOIN userinfo g ON e.id = g.user_id
          INNER JOIN type_prefix f ON g.id_prefix = f.id_prefix
          INNER JOIN year h ON a.id_year = h.id_year
          INNER JOIN research_consider_type i ON a.id_rs = i.rct_id_rs
					INNER JOIN research_assign_fullboard_agendar j ON a.id_rs = j.rafa_id_rs
          WHERE a.id_rs = '$id_rs' ";
$query = mysqli_query($conn, $strSQL);

if(!$query){
	echo "ไม่สามารถสร้างต้นแบบเอกสารได้";
	mysqli_close($conn);
	die();
}
$rn = mysqli_num_rows($query);
// echo $rn;
if($rn == 0){
  // echo $strSQL;
}
$row = mysqli_fetch_assoc($query);
?>

<p style="margin-left:0cm; margin-right:0cm; text-align:center"><span style="font-size:10pt"><span style="font-family:Calibri"><strong><span style="font-size:14.0pt"><span style="font-family:&quot;EucrosiaUPC&quot;,&quot;serif&quot;">หนังสือรับรองฉบับนี้ให้ไว้เพื่อแสดงว่า</span></span></strong></span></span></p>

<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="width:20%"><strong>รหัสโครงการ </strong>:&nbsp;</td>
			<td style="width:80%"><?php echo $row['code_apdu']; ?></td>
		</tr>
		<tr>
			<td><strong>ชื่อโครงการ </strong>:</td>
			<td>
				<div class="">
					[ภาษาไทย] : <?php echo $row['title_th']; ?>
				</div>
				<div class="">
					[English] : <?php echo $row['title_en']; ?>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="width:30%"><strong>ผู้วิจัยหลัก</strong> :&nbsp; <?php echo $row['prefix_name'].$row['fname']." ".$row['lname']; ?></td>
			<td style="width:70%"><strong>สังกัด</strong> :&nbsp;</td>
		</tr>
		<tr>
			<td style="width:40%"><strong>ผู้ร่วมวิจัย</strong> :&nbsp;</td>
			<td style="width:60%"><strong>สังกัด</strong> :&nbsp;</td>
		</tr>
	</tbody>
</table>

<p><strong>เอกสารที่รับรอง</strong> :</p>

<ol>
	<li>แบบเสนอเพื่อขอรับการพิจารณาจริยธรรมการวิจัยในมนุษย์ เวอร์ชั่น 2.0 ฉบับวันที่ 26 กรกฎาคม 2560</li>
	<li>โครงการวิจัยฉบับสมบูรณ์ เวอร์ชั่น 2.0 ฉบับวันที่ 26 กรกฎาคม 2560</li>
	<li>เอกสารชี้แจงอาสาสมัคร เวอร์ชั่น 2.0 ฉบับวันที่ 26 กรกฎาคม 2560</li>
	<li>เอกสารแสดงเจตนายินยอมของอาสาสมัคร เวอร์ชั่น 2.0 ฉบับวันที่ 26 กรกฎาคม 2560</li>
	<li>แบบบันทึกข้อมูล เวอร์ชั่น 2.0 ฉบับวันที่ 26 กรกฎาคม 2560</li>
	<li>ประวัติผู้วิจัย</li>
</ol>

<p>ได้ผ่านการพิจารณาและรับรองจากคณะกรรมการพิจารณาจริยธรรมการวิจัยในมนุษย์คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์ โดยยึดหลักจริยธรรมของประกาศเฮลซิงกิ (Declaration of Helsinki) และแนวทางการปฏิบัติการวิจัยทางคลินิกที่ดี (The International Conference on Harmonization in Good Clinical Practice) ข้อมูลการพิจารณา บรรจุในบันทึกการประชุมคณะกรรมการ ครั้งที่ 19/2560 ชุดที่ 2 วาระที่ 4.2.02 วันที่ <?php echo $row['rafa_date'];?></p>

<p><strong>ขอให้นักวิจัยรายงานความก้าวหน้าโครงการวิจัย ทุก 12 เดือนและยื่นต่ออายุก่อนถึงวัหมดอายุอย่างน้อย 30 วัน</strong></p>

<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="width:50%">&nbsp;</td>
			<td style="text-align:center; width:50%">
			<p>..............................................................................</p>

			<p>(รองศาสตราจารย์นายแพทย์บุญสิน ตั้งตระกูลวนิช)<br />
			ประธานคณะกรรมการพิจารณาจริยธรรมการวิจัยในมนุษย์</p>
			</td>
		</tr>
		<tr>
			<td style="width:50%"><strong>วันที่รับรอง: </strong>11 สิงหาคม 2560</td>
			<td style="text-align:center; width:50%">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:50%"><strong>วัหมดอายุ:</strong> 10 สิงหาคม 2561</td>
			<td style="text-align:center; width:50%">&nbsp;</td>
		</tr>
	</tbody>
</table>
