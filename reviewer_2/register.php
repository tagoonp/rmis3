<!DOCTYPE html>
<html>
<head>
<title>ระบบสารสนเทศการจัดการงานวิจัย</title>
<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="โครงการการพัฒนาระบบสารสนเทศเพื่อการบริหารจัดการงานวิจัย คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์" />
<!-- CSS -->
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<link rel="shortcut icon" href="./favicon.ico">
<link rel="stylesheet" href="css/structure.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/reveal.css">	
<link rel="stylesheet"href="css/jquery.validate.css">

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery.reveal.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.validation.functions.js"></script>
<script>
jQuery(function(){
jQuery("#prefix_name").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกคำนำหน้าชื่อ"});

jQuery("#full_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"}); 

jQuery("#id_number").validate({
expression: "if (VAL.match(/^[0-9]{13}$/))  return true; else return false;",
message: "*กรุณากรอกให้เป็นตัวเลข 13 หลัก!"});

jQuery("#tel").validate({
expression: "if (VAL.match(/^[0][0-9]{9}$/)) return true; else return false;",
message: "*กรุณากรอกให้เป็นตัวเลข 10 หลัก!"});

jQuery("#email").validate({
expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
message: "*กรุณากรอก E-mail ให้ถูกรูปแบบ"});

jQuery("#ValidConfirmPassword").validate({
expression: "if ((VAL == jQuery('#ValidPassword').val()) && VAL) return true; else return false;",message: "Confirm password field doesn't match the password field"});

jQuery("#id_university").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกมหาวิทยาลัย!"  });           

jQuery("#university_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"}); 


jQuery("#id_faculty").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกคณะ!"  }); 

jQuery("#faculty_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"}) ;

jQuery("#id_department").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกภาควิชา!"} ) ;

jQuery("#department_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"}) ;

jQuery("#id_unit").validate({
expression: "if (VAL != '0') return true; else return false;",
message: "*กรุณาเลือกหน่วยงาน!"} ) ;

jQuery("#unit_name").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"}) ;

jQuery("#position").validate({
expression: "if (VAL.match(/^[A-Za-zก-ฮฯ-๙ ]+$/)) return true; else return false;",
message: "*กรุณากรอกเป็นตัวอักษร!"});

jQuery("#username").validate({
expression: "if (VAL) return true; else return false;",
message: "*กรุณากรอก UserName!"
});

jQuery("#password").validate({
expression: "if (VAL.length > 3 && VAL) return true; else return false;",
message: "*กรุณากรอก Password"});

jQuery("#ConfirmPassword").validate({
expression: "if ((VAL == jQuery('#password').val())&& VAL) return true; else return false;",
message: "*กรุณากรอกยืนยัน Password ให้ตรงกัน"});

});
</script>
</head>
<body id="public">
<div id="container" class="ltr">
<header id="header" class="info">
<div align="left"><a href="index.php">
<img src="images/logo_header.png" width="500" height="104" alt="logo_haeder"></a></div>
<? include "menu.php" ?>
</header>
<form action="register_insert.php" method="post" class="addform">
<table width="80%" height="996" border="0" align="center" cellpadding="3" cellspacing="3">
<tr>
<td height="48" colspan="2" align="center">
<h1>แบบฟอร์มลงทะเบียนเพื่อใช้งานระบบ</h1></td>
</tr>
<tr>
<td height="23" colspan="2"><h3>ขั้นตอนที่ 1 - กรอกข้อมูลส่วนตัวผู้ลงทะเบียน </h3></td>
</tr>
<tr>
<td>
<b>*คำนำหน้าชื่อ :</b>
</td>
<td>
<select name="prefix_name" id="prefix_name">
<option value="0">------ เลือกคำนำหน้า -----</option>
<option value="นาย">นาย</option>
<option value="นาง">นาง</option>
<option value="นางสาว">นางสาว</option>  
<option value="ผศ.">ผศ.</option>
<option value="ศ.">ศ.</option> 
<option value="ดร.">ดร.</option>  
<option value="รศ.">รศ.</option>  
<option value="ผศ.ดร.">ผศ.ดร.</option>     
<option value="รศ.ดร.">รศ.ดร.</option>   
<option value="ศ.ดร.">ศ.ดร.</option>
<option value="นพ.">นพ.</option>
<option value="พญ.">พญ.</option> 
<option value="อ.นพ.">อ.นพ.</option>
  <option value="อ.พญ.">อ.พญ.</option>  
  <option value="ผศ.นพ.">ผศ.นพ.</option>
  <option value="ผศ.พญ.">ผศ.พญ.</option> 
  <option value="ศ.นพ">ศ.นพ.</option>
  <option value="ศ.พญ.">ศ.พญ.</option> 
  <option value="ดร.นพ.">ดร.นพ.</option>
  <option value="ดร.พญ.">ดร.พญ.</option >   
</select>
</td>
</tr>
<tr>
<td width="198" height="43"><b>*ชื่อ-นามสกุล:</b></td>
<td width="533" ><label for="full_name"></label>
<input name="full_name" type="text" id="full_name" size="30"></td>
</tr>
<tr>
<td rowspan="2" valign="top"><strong><b>*</b>หมายเลขบัตรประชาชน:</strong></td>
<td><input name="id_number" type="text" id="id_number"size="13" maxlength="13"></td>
</tr>
<tr>
<td>(ตัวอย่าง 3456789100123)</td>
</tr>
<tr>
<td rowspan="2" valign="top"><strong><b>*</b>เบอร์โทรศัพท์มือถือ:</strong></td>
<td><input name="tel" type="text" id="tel"size="10" maxlength="10"></td>
</tr>
<tr>
<td>(ตัวอย่าง  0854398543)</td>
</tr>
<tr>
<td><strong><b>*</b>E-mail:</strong></td>
<td><input type="text"name="email" size="30" id="email"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><h3>ขั้นตอนที่ 2 - กรอกข้อมูลหน่วยงานในสังกัด</h3></td>
</tr>
<tr>
<td><strong><b>*</b>มหาวิทยาลัย/สถาบัน:</strong></td>
<td><select name="id_university" id="id_university" class="required">
<option value="0">------- เลือกมหาวิทยาลัย -------</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM university";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table))
{$id_university = $row["id_university"];
$university_name=$row["university_name"];
echo "<option value='$id_university'>$university_name</option>";
}?>
</select> 
<a href="#" class="big-link" data-reveal-id="university" data-animation="fade">
    + เพิ่มข้อมูลมหาวิทยาลัย/สถาบัน</a>
</td></tr>

<td><strong><b>*</b>คณะ:</strong></td>
<td><select name="id_faculty" id="id_faculty">
<option value="0">------- เลือกคณะ -------</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM faculty";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table))
{$id_faculty = $row["id_faculty"];
$faculty_name=$row["faculty_name"];
echo "<option value='$id_faculty'>$faculty_name</option>";
}?>
</select>
<a href="#" class="big-link" data-reveal-id="facullty" data-animation="fade">
+ เพิ่มข้อมูลคณะ</a>
</td></tr>

<td><strong><b>*</b>ภาควิชา:</strong></td>
<td><select name="id_department" id="id_department">
<option value="0">------- เลือกภาควิชา -------</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM department";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table))
{$id_department = $row["id_department"];
$department_name=$row["department_name"];
echo "<option value='$id_department'>$department_name</option>";
}?>
</select>
<a href="#" class="big-link" data-reveal-id="department" data-animation="fade">
+ เพิ่มข้อมูลภาควิชา</a>
</td></tr>
<tr>
<td><strong><b>*</b>หน่วยงาน:</strong></td>
<td><select name="id_unit" id="id_unit">
<option value="0" selected>------เลือกหน่วยงาน -------</option>
<?include ("config.inc.php");
$sql = "SELECT * FROM unit";
$table = mysql_query($sql);
while($row = mysql_fetch_array($table))
{$id_unit = $row["id_unit"];
$unit_name=$row["unit_name"];
echo "<option value='$id_unit'>$unit_name</option>";
}?>
</select>
<a href="#" class="big-link" data-reveal-id="unit" data-animation="fade">
+ เพิ่มข้อมูลหน่วยงาน</a>
</td>
</tr>
<tr>
<td><strong><b>*</b>ตำแน่ง:</strong></td>
<td><input type="text" name="position" id="position"size="30" class="required"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><h3>ขั้นตอนที่ 3- แนบไฟล์บันทึกข้อความจากต้นสังกัด</h3></td>
</tr>
<tr>
<td><strong>*ไฟล์เอกสาร</strong></td>
<td><input type="file" name="file_upload" id="file_upload"></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
<td colspan="2"><h3>ขั้นตอนที่ 4 -  ยืนยันการใช้งานระบบ</h3></td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
<tr>
<td colspan="2" align="center">
<input name="submit" type="submit" value="บันทึก"/>
<input name="reset" type="reset" value="ยกเลิก"></td>
</tr>
</table>
</form>
</table>
<div id="university" class="reveal-modal">
<h1>เพิ่มข้อมูลมหาวิทยาลัย/สถาบัน</h1>
<form action="university_insert.php" id="addform" method="post"
class="formular" name="add_form" enctype="multipart/form-data">
<table width="500" height="34" border="0" align="left" cellpadding="3" cellspacing="3">
<tr>
<td width="60" height="28"><strong>ชื่อมหาวิทยาลัย/สถาบัน:</strong></td>
<td width="282" ><label for="university_name"></label>
<input name="university_name" type="text" id="university_name" size="30" class="required">
<input class="submit" type="submit" value="บันทึก"/></td>
</tr>
<tr>
<td height="28">&nbsp;</td>
<td><font size="2" color="red">EX.มหาวิทยาลัยXXXXXXXX</font></td>
</tr>
</table>
</form>
<a class="close-reveal-modal">&#215;</a>
</div>
<!--  -->
<div id="facullty" class="reveal-modal">
<h1>เพิ่มข้อมูลคณะ</h1>
<form action="faculty_insert.php" id="add_form" method="post"name="addform">
<table width="500" height="34" border="0" align="left" cellpadding="3" cellspacing="3">
<tr>
<td width="60" height="28"><strong>ชื่อคณะ:</strong></td>
<td width="282" ><label for="faculty_name"></label>
<input name="faculty_name" type="text" id="faculty_name" size="30">
<input class="submit" type="submit" value="บันทึก"/></td>
</tr>
<tr>
<td height="28">&nbsp;</td>
<td><font size="2" color="red">EX.คณะXXXXXXXX</font></td>
</tr>
</table>
</form>
<a class="close-reveal-modal">&#215;</a>
</div>
<!--  -->
<div id="department" class="reveal-modal">
<h1>เพิ่มข้อมูลภาควิชา</h1>
<form action=" department_insert.php" id="addform" method="post"
class="formular" name="add_form" enctype="multipart/form-data">
<table width="500" height="34" border="0" align="left" cellpadding="3" cellspacing="3">
<tr>
<td width="60" height="28"><strong>ชื่อภาควิชา:</strong></td>
<td width="282" ><label for="department_name"></label>
<input name="department_name" type="text" id="department_name" size="30">
<input class="submit" type="submit" value="บันทึก"/></td>
</tr>
<tr>
<td height="28">&nbsp;</td>
<td><font size="2" color="red">EX.ภาควิชาxxxxxxxxx</font></td>
</tr>
</table>
</form>


<a class="close-reveal-modal">&#215;</a>
</div>
<!--  -->
<div id="unit" class="reveal-modal">
<h1>เพิ่มข้อมูลหน่วยงาน</h1>
<form action="unit_insert.php" id="addform" method="post"
class="formular" name="add_form" enctype="multipart/form-data">
<table width="500" height="34" border="0" align="left" cellpadding="3" cellspacing="3">
<tr>
<td width="60" height="28"><strong>ชื่อหน่วยงาน:</strong></td>
<td width="282" ><label for="unit_name"></label>
<input  type="text" name="unit_name" id="unit_name" size="30">
<input class="submit" type="submit" value="บันทึก"/></td>
</tr>
<tr>
<td height="28">&nbsp;</td>
<td><font size="2" color="red">EX.XXXXXXXX</font></td>
</tr>
</table>
</form>
<a class="close-reveal-modal">&#215;</a>
</div>
<br><br>
</div>
<? include ("footer.php"); ?> 
</body>
</html>