<?php
include "config.class.php";

if(!isset($_POST['id_rs'])){
  mysqli_close($conn);
  die();
}

$log_ip = $_SERVER['REMOTE_ADDR'];
$sysdate = date('Y-m-d H:i:s');

$id_rs = mysqli_real_escape_string($conn, $_POST['id_rs']);
$id_status = mysqli_real_escape_string($conn, $_POST['id_status']);
$return = [];

if(($id_status == '3') || ($id_status == '24')){
  $strSQL = "SELECT * FROM research a INNER JOIN useraccount b ON a.id_ec = b.id
             INNER JOIN userinfo c ON b.id = c.user_id
             WHERE a.id_rs = '$id_rs'
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    while ($row = mysqli_fetch_array($query)) {
      $buf = [];
      foreach ($row as $key => $value) {
          if(!is_int($key)){
            $buf[$key] = $value;
          }
      }

      if($id_status == '3'){
        $buf['email_content'] = '<h3>ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์ REC.'.$row['code_apdu'].'</h3>'.
                                '<p>เรียน '.$row['fname']." ".$row['lname'].'</p>'.
                                '<p>เจ้าหน้าที่สำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสารเรียบร้อยแล้ว มีรายการรอการพิจารณาจากท่านในส่วนการตรวจสอบความถูกต้องจากเลขา EC'.
                                '</p>'.
                                '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
        $buf['email_to_fullname'] = $row['fname']." ".$row['lname'];
      }else{
        $buf['email_content'] = '<h3>ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์ REC.'.$row['code_apdu'].'</h3>'.
                                '<p>เรียน '.$row['fname']." ".$row['lname'].'</p>'.
                                '<p>เจ้าหน้าที่สำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการเพิ่มข้อมูลใบรับรองแล้ว มีรายการรอการตรวจสอบใบรับรองจากท่าน'.
                                '</p>'.
                                '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
        $buf['email_to_fullname'] = $row['fname']." ".$row['lname'];
      }

      $return[] = $buf;
    }
  }else{
    echo "N1";
  }
}else if($id_status == '6'){
  $strSQL = "SELECT * FROM research_consider_type a INNER JOIN useraccount b ON a.rct_fb_ec = b.id
             INNER JOIN userinfo c ON b.id = c.user_id
             INNER JOIN research d on a.rct_id_rs = d.id_rs
             WHERE a.rct_id_rs = '$id_rs' AND a.rct_status = '1'
            ";
  $query = mysqli_query($conn, $strSQL);
  if($query){
    while ($row = mysqli_fetch_array($query)) {
      $buf = [];
      foreach ($row as $key => $value) {
          if(!is_int($key)){
            $buf[$key] = $value;
          }
      }

      $buf['email_content'] = '<h3>ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์ REC.'.$row['code_apdu'].'</h3>'.
                              '<p>เรียน '.$row['fname']." ".$row['lname'].'</p>'.
                              '<p>เจ้าหน้าที่สำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการส่งรายการรอการตรวจสอบข้อเสนอแนะจากผู้เชี่ยวชาญมายังท่าน'.
                              '</p>'.
                              '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

      $return[] = $buf;
    }
  }
}

echo json_encode($return);
mysqli_close($conn);
die();
?>
