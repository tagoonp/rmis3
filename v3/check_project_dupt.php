<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// echo "string";
// die();

include "../lib/connect.class.php";
$db = new database();
$db->connect();

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$check_dupt = 0;
$dupt_val = array();
$dupt_name = array();

// echo "string";
// echo $_POST['lang'];
// die();
//Thai check
if($_POST['lang']=='th'){
  if(($_POST['key']!='') && ($_POST['key']!='-')){
    $strSQL = sprintf("SELECT id_rs, title_th FROM research WHERE id_pm = '%s' ",
              mysql_real_escape_string($_SESSION['id']));
    $resultTitleTH = $db->select($strSQL,false,true);
    if($resultTitleTH){
      $i = 0;
      foreach ($resultTitleTH as $value) {
        similar_text($_POST['key'], $value['title_th'],$percent);
        if($percent > 90){
          $dupt_val[$i] = $value['id_rs'];
          $dupt_name[$i] = $value['title_th'];
          $i++;
        }
      }

      // print_r($dupt_val);

      if(sizeof($dupt_val) > 0){
        ?>
        <strong style="font-size: 14px;">พบชื่อโครงการที่มีความคล้ายคลีงกัน (Similarlity > 90%) ดังนี้</strong><br>
        <?php
        for($i = 0; $i < sizeof($dupt_val); $i++) {
          echo "<strong>ID</strong> : ".$dupt_val[$i]." <strong> ชื่อโครงการ</strong> : ".$dupt_name[$i]."<br>";
        }
        ?>
        <strong style="font-size: 16px;">** กรุณาตรวจสอบให้ถูกต้อง เนื่องจากหากทางสำนักงานจริยธรรมการวิจัยในมนุษย์ตรวจพบการลงทะเบียนซ้ำ อาจทำให้การพิจารณาล่าช้า กรุณากลับไปตรวจสอบโครงการวิจัยที่ท่านเคยลงทะเบียนไว้ที่หน้า <a href="rs_list.php">- โครการวิจัยทั้งหมด -</a> ของท่าน (ในกรณีไม่แน่ใจโปรดติดต่อคุณณัฎฐา 074-451149)</strong><br>
        <?php
      }else{
        // echo "BA";
      }
    }else{
      // echo "NA";
    }
  }

  die();
}


if($_POST['lang']=='en'){
  if(($_POST['key']!='') && ($_POST['key']!='-')){
    $strSQL = sprintf("SELECT id_rs, title_en FROM research WHERE id_pm = '%s' ",
              mysql_real_escape_string($_SESSION['id']));
    $resultTitleTH = $db->select($strSQL,false,true);
    if($resultTitleTH){
      $i = 0;
      foreach ($resultTitleTH as $value) {
        similar_text($_POST['key'], $value['title_en'],$percent);
        if($percent > 90){
          $dupt_val[$i] = $value['id_rs'];
          $dupt_name[$i] = $value['title_en'];
          $i++;
        }
      }

      if(sizeof($dupt_val) > 0){
        ?>
        <strong style="font-size: 14px;">พบชื่อโครงการที่มีความคล้ายคลีงกัน (Similarlity > 90%) ดังนี้</strong><br>
        <?php
        for($i = 0; $i < sizeof($dupt_val); $i++) {
          echo "<strong>ID</strong> : ".$dupt_val[$i]." <strong> ชื่อโครงการ</strong> : ".$dupt_name[$i]."<br>";
        }
        ?>
        <strong style="font-size: 16px;">** กรุณาตรวจสอบให้ถูกต้อง เนื่องจากหากทางสำนักงานจริยธรรมการวิจัยในมนุษย์ตรวจพบการลงทะเบียนซ้ำ อาจทำให้การพิจารณาล่าช้า กรุณากลับไปตรวจสอบโครงการวิจัยที่ท่านเคยลงทะเบียนไว้ที่หน้า <a href="rs_list.php">- โครการวิจัยทั้งหมด -</a> ของท่าน (ในกรณีไม่แน่ใจโปรดติดต่อคุณณัฎฐา 074-451149)</strong><br>
        <?php
      }
    }


  }

  die();
}
?>
