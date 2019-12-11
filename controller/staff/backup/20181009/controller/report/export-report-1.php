<?php
header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment; Filename=expempt-".date('Y-m-d-H-i;s').".doc");
header("Content-Disposition: attachment; filename=expempt-".date('Y-m-d-H-i-s').".doc");

include "../config.class.php";

if(!isset($_GET['tm'])){
  mysqli_close($conn);
  die();
}

if(!isset($_GET['vara'])){
  mysqli_close($conn);
  die();
}



$vara = mysqli_real_escape_string($conn, $_GET['vara']);
$tm = mysqli_real_escape_string($conn, $_GET['tm']);


$log_ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d H:i:s');

$return = [];
$strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_pm = b.id_pm
          INNER JOIN userinfo c ON b.id = c.user_id
          LEFT JOIN dept d ON a.id_dept = d.id_dept
          INNER JOIN research_assign_fullboard_agendar e ON a.id_rs = e.rafa_id_rs
          INNER JOIN type_prefix h ON c.id_prefix = h.id_prefix
          WHERE
            a.draft_status = '0'
            AND a.delete_flag = 'N'
            AND a.sendding_status = 'Y'
            AND a.code_apdu != ''
            AND b.delete_status = '0'
            AND e.rafa_agn = '$tm' AND e.rafa_panal = '$vara'
            ORDER BY a.ord_id, a.id_rs
          ";

          if($query = mysqli_query($conn, $strSQL)){
            echo "<table style='font-size: 16px !important;'>";
            echo "<tr>";
            echo '<td colspan="2" style="text-align: center;"><h3>ข้อมูลรายงานที่ต้องการเพื่อบรรจุวาระในการประชุม board</h3></td></tr>';
            echo '<tr><td colspan=2 style="text-align: center;"><h4 class="text-center">วาระ 3.3 โครงการวิจัยใหม่ที่เข้าข่ายไม่ต้องขอรับพิจารณาจริยธรรมการวิจัย (Exempt Review)<br><small>วันที่ประชุม : <span id="rafa_date"></span></small></h4></td>';
            echo "</tr>";
            while ($row = mysqli_fetch_array($query)) {

              $fstring = 'ไม่ขอทุน';
              if(($row['source_funds'] == '') || ($row['source_funds'] == null)){

              }else{
                  $fstring = $row['source_funds'];
              }

              echo '<tr><td colspan="2"><hr></td></tr>';
              echo "<tr>";
                echo '<td width="30%">REC</td>';
                echo '<td >'.$row['code_apdu'].'</td>';
              echo "</tr>";

              echo "<tr>";
                echo "<td style='vertical-align: top;'>ชื่อโครงการภาษาไทย</td>";
                echo "<td>".$row['title_th']."</td>";
              echo "</tr>";

              echo "<tr>";
                echo "<td style='vertical-align: top;'>ชื่อโครงการภาษาอังกฤษ</td>";
                echo "<td>".$row['title_en']."</td>";
              echo "</tr>";

              echo "<tr>";
                echo "<td style='vertical-align: top;'>ชื่อหัวหน้าโครงการ</td>";
                echo "<td>".$row['fname']." ".$row['lname']."</td>";
              echo "</tr>";

              echo "<tr>";
                echo "<td style='vertical-align: top;'>แหล่งทุน</td>";
                echo "<td>".$fstring."</td>";
              echo "</tr>";

            }
            echo "</table>";
          }


mysqli_close($conn);
die();


?>
