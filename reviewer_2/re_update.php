<?
include ("config.inc.php");
$id_reviewer   = $_REQUEST['id_reviewer'];
$id_prefix= $_REQUEST['id_prefix'];
$name     = $_REQUEST['name'];
$surname  = $_REQUEST['surname'];
$expertise = $_REQUEST['expertise'];
$tel   = $_REQUEST['tel'];
$email    = $_REQUEST['email'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$id_university=$_REQUEST['id_university'];
$id_faculty= $_REQUEST['id_faculty'];
$id_dept=$_REQUEST['id_dept'];


$sql= "UPDATE `reviewer` SET id_prefix='$id_prefix',name='$name',
surname='$surname',expertise ='$expertise',tel='$tel',email='$email',username='$username',
password='$password',id_university = '$id_university',id_faculty='$id_faculty',
id_dept='$id_dept' WHERE`reviewer`.`id_reviewer`=$id_reviewer" ;

echo "<script>alert('คุณได้บันทึกข้อมูลเรียบร้อย! ')</script>";    
echo"<script>window.location.replace('re_edit.php?id_reviewer=$id_reviewer')</script>";
mysql_query($sql);
$result = mysql_query($sql);
mysql_close($conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
</body>
</html>
