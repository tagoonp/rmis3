<?php
include "../config.class.php";
// header('Content-type: application/json');

if(!isset($_POST['sd'])){
  // mysqli_close($conn);
  // die();
}

if(!isset($_POST['ed'])){
  // mysqli_close($conn);
  // die();
}

$sd = mysqli_real_escape_string($conn, $_POST['sd']);
$ed = mysqli_real_escape_string($conn, $_POST['ed']);

$sd = '2018-01-01';
$ed = '2018-05-31';

$sd = $sd." 00:00:00";
$ed = $ed." 23:59:59";

$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$data = '';
$rsdata = '';
$return = [];

$strSQL = "SELECT a.rct_id_rs id_rs, a.rct_datetime, b.rai_sign_date, c.code_apdu
           FROM research_consider_type a INNER JOIN research_acknowledge_info b ON a.rct_id_rs = b.rai_id_rs
           INNER JOIN research c ON a.rct_id_rs = c.id_rs
           WHERE a.rct_type = 'Exempt'
           AND a.rct_id_rs IN (SELECT id_rs FROM research WHERE sendding_status = 'Y' AND delete_flag = 'N') AND c.id_year = '19' ORDER BY a.rct_id_rs";

// $strSQL = "SELECT a.rct_id_rs id_rs, a.rct_datetime, b.rai_sign_date, c.code_apdu
//           FROM research_consider_type a INNER JOIN research_expedited_info b ON a.rct_id_rs = b.rai_id_rs
//           INNER JOIN research c ON a.rct_id_rs = c.id_rs
//           WHERE a.rct_type = 'Expedited'
//           AND a.rct_id_rs IN (SELECT id_rs FROM research WHERE sendding_status = 'Y' AND delete_flag = 'N')
//           AND c.id_year = '19'
//           AND a.rct_conf = '1'
//           AND b.rai_status = '1'
//           ORDER BY a.rct_id_rs";

$strSQL = "SELECT count(*), rafa_id_rs id_rs FROM research_assign_fullboard_agendar
          WHERE rafa_status = '1' AND rafa_id_rs IN (SELECT id_rs FROM research WHERE sendding_status = 'Y' AND delete_flag = 'N' AND id_year = '19' AND code_apdu IS NOT NULL)
          AND rafa_id_rs IN (SELECT rct_id_rs FROM research_consider_type WHERE rct_status = '1' AND rct_conf = '1' AND rct_type IN ('Fullboard (Bio)', 'Fullboard (Social)'))
          GROUP BY rafa_id_rs";


$query = mysqli_query($conn, $strSQL);

$dataarr = '';
$id_rs_arr = '';
if($query){
  $rs = 1;
  while ($row = mysqli_fetch_array($query)) {
    $buf = [];
    $id_rs_arr[] = $row['id_rs'];
    $date1 = $row['log_datetime'];
    $date2 = $row['rai_sign_date'];
    $rsdata[] = $row['id_rs'];
    $rs++;

  }
}else{
  echo $strSQL;
}

// print_r($rsdata);
//
// die();

$rs_and_d1 = '';
$rs_and_d1_buffer = '';
foreach ($id_rs_arr as $key => $value) {
  $rs_and_d1_buffer = '';
  $strSQL = "SELECT * FROM log_notification WHERE log_detail LIKE '%เจ้าหน้าที่ได้เพิ่มผลการตรวจสอบเอกสาร (เอกสารถูกต้องและส่งต่อเลขา EC)%'
             AND user_id IN (SELECT id FROM useraccount WHERE id_pm = (
               SELECT id_pm FROM research WHERE id_rs = '$value'
             )) ORDER BY log_datetime LIMIT 1";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    $row = mysqli_fetch_assoc($query);
    // echo $value." -> ".$row['log_datetime']."<br>";
    $rs_and_d1_buffer['id_rs'] = $value;
    $rs_and_d1_buffer['start_date'] = $row['log_datetime'];

  }else{
    // echo $strSQL;
  }

  $rs_and_d1[] = $rs_and_d1_buffer;
}

// echo json_encode($rs_and_d1);

$rs_and_d2 = '';
$rs_and_d2_buffer = '';

for ($i=0; $i < sizeof($rs_and_d1); $i++) {
  $rs_and_d2_buffer = '';
  // $strSQL = "SELECT * FROM research_acknowledge_info WHERE rai_sign_status = '1' AND rai_status = '1' AND
  //            rai_id_rs = '".$rs_and_d1[$i]['id_rs']."'
  //            ORDER BY rai_sign_date desc LIMIT 1";
  $strSQL = "SELECT * FROM research_expedited_info WHERE rai_sign_status = '1' AND rai_status = '1' AND
             rai_id_rs = '".$rs_and_d1[$i]['id_rs']."' AND rai_sign_date IS NOT NULL
             ORDER BY rai_sign_date desc LIMIT 1";
  $query = mysqli_query($conn, $strSQL);
  if($query){
      if($row = mysqli_fetch_assoc($query)){
        $rs_and_d2_buffer['id_rs'] = $rs_and_d1[$i]['id_rs'];
        $rs_and_d2_buffer['start_date'] = $rs_and_d1[$i]['start_date'];
        $rs_and_d2_buffer['end_date'] = $row['rai_sign_date'];
        $rs_and_d2_buffer['diff_date'] = calDiffDate($rs_and_d1[$i]['start_date'], $row['rai_sign_date']);

        $rs_and_d2[] = $rs_and_d2_buffer;
      }
      // echo $value." -> ".$row['log_datetime']."<br>";

    }else{
      echo $strSQL;
      echo $rs_and_d1[$i]['id_rs']." no data sign <br>";

    }

    print_r($rs_and_d2_buffer);
    // echo "<br>";

    // $rs_and_d2[] = $rs_and_d2_buffer;
}

die();
// echo json_encode($rs_and_d2);
// print_r($rs_and_d2);
// foreach ($rs_and_d2 as $key => $value) {
//   if($key == 'diff_date'){
//     echo $value."<br>";
//   }
// }
// foreach ($rs_and_d1 as $key => $value) {
//   $rs_and_d2_buffer = '';
//   $strSQL = "SELECT * FROM log_research WHERE log_detail LIKE 'ประธานลงนาม%'
//             id_rs =
//              ORDER BY log_datetime desc LIMIT 1";
//   $query = mysqli_query($conn, $strSQL);
//   if($query){
//     $row = mysqli_fetch_assoc($query);
//     // echo $value." -> ".$row['log_datetime']."<br>";
//     $rs_and_d1_buffer['id_rs'] = $value;
//     $rs_and_d1_buffer['start_date'] = $row['log_datetime'];
//   }else{
//     // echo $strSQL;
//   }
// }

// $dataarr[] = '150';
// $dataarr[] = '150';
// $dataarr[] = '150';

// print_r($dataarr);
// sort($rsdata);
// print_r($rsdata);

// echo "Med > ". calculate_median($dataarr)."\n";
// echo "Avg > ". calculate_average($dataarr)."\n";

// echo json_encode($return);
mysqli_close($conn);
die();

function calculate_median($arr) {
    sort($arr);
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

function calculate_average($arr) {
    $count = count($arr); //total numbers in array
    foreach ($arr as $value) {
        $total = $total + $value; // total value of array numbers
    }
    $average = ($total/$count); // get average value
    return $average;
}

function calDiffDate($date1, $date2){
  $diff = abs(strtotime($date2) - strtotime($date1));

  $years = floor($diff / (365*60*60*24));
  // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 )/ (60*60*24));

  // printf("%d years, %d months, %d days<br>", $years, $months, $days);
  // echo "<br>";

  echo $days."<br>";
  // echo $months.;
  return $days;

}
?>
