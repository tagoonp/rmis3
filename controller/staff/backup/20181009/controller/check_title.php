<?php
include "config.class.php";

// if((!isset($_POST['en_title'])) || (!isset($_POST['th_title']))){
//   mysqli_close($conn);
//   die();
// }

$en_title = mysqli_real_escape_string($conn, $_POST['en_title']);
$th_title = mysqli_real_escape_string($conn, $_POST['th_title']);
$session_id = mysqli_real_escape_string($conn, $_POST['session_id']);

$return = [];
$buffer = [];
$strSQL = '';
$data = '';

if(($th_title != '-') && ($th_title != '')){
  $strSQL = "SELECT * FROM research WHERE delete_flag = 'N' AND session_id != '$session_id'";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    while($row = mysqli_fetch_array($query)){
      $dupt = '';
      similar_text($th_title, $row['title_th'], $percent);
      if($percent > 90){
        $dupt['value'] = $row['id_rs'];
        $dupt['name'] = $row['title_th'];
        $dupt['pct'] = $percent;
        $dupt['lang'] = 'TH';
        $return[] = $dupt;
      }
    }
  }



}else{
  // Search in English
  $strSQL = "SELECT * FROM research WHERE delete_flag = 'N' AND session_id != '$session_id' ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    while($row = mysqli_fetch_array($query)){
      $data = '';
      similar_text($en_title, $row['title_en'], $percent);
      if($percent > 90){
        $dupt['value'] = $row['id_rs'];
        $dupt['name'] = $row['title_en'];
        $dupt['pct'] = $percent;
        $dupt['lang'] = 'EN';
        $return[] = $dupt;
      }
      // if($data != ''){
      //   $return[] = $dupt;
      // }
    }
  }
}


echo json_encode($return);
mysqli_close($conn);
die();

?>
