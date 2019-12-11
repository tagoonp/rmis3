<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

function DateThai($strDate)
{
	$strYear		=		date("Y",strtotime($strDate))+543;
	$strMonth=		date("n",strtotime($strDate));
	$strDay=		date("j",strtotime($strDate));
	$strHour=		date("H",strtotime($strDate));
	$strMinute=		date("i",strtotime($strDate));
	$strSeconds=	date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];				
	return "$strDay $strMonthThai $strYear";
}

function DateThai2($reDate)
{
	$strYear		=		date("Y",strtotime($reDate))+543;
	$strMonth=		date("n",strtotime($reDate));
	$strDay=		date("j",strtotime($reDate));
	$strHour=		date("H",strtotime($reDate));
	$strMinute=		date("i",strtotime($reDate));
	$strSeconds=	date("s",strtotime($reDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];				
	return "$strDay $strMonthThai $strYear";
}

function DateThai3($reDate3)
{
	$strYear		=		date("Y",strtotime($reDate3))+543;
	$strMonth=		date("n",strtotime($reDate3));
	$strDay=		date("j",strtotime($reDate3));
	$strHour=		date("H",strtotime($reDate3));
	$strMinute=		date("i",strtotime($reDate3));
	$strSeconds=	date("s",strtotime($reDate3));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];				
	return "$strDay $strMonthThai $strYear";
}
?>
</body>
</html>