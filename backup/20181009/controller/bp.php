<?php
include "config.class.php";

if(!isset($_GET['email'])){
  mysqli_close($conn);
  echo "ข้อมูลสำหรับการเข้าถึงไม่ครบถ้วน";
  die();
}

if(!isset($_GET['sid'])){
  mysqli_close($conn);
  echo "ข้อมูลสำหรับการเข้าถึงไม่ครบถ้วน";
  die();
}

if(!isset($_GET['pid'])){
  mysqli_close($conn);
  echo "ข้อมูลสำหรับการเข้าถึงไม่ครบถ้วน";
  die();
}

if(!isset($_GET['next'])){
  mysqli_close($conn);
  echo "ข้อมูลสำหรับการเข้าถึงไม่ครบถ้วน";
  die();
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$email = mysqli_real_escape_string($conn, $_GET['email']);
$pwd = mysqli_real_escape_string($conn, $_GET['sid']);
$rir_id = mysqli_real_escape_string($conn, $_GET['pid']);
$next = mysqli_real_escape_string($conn, $_GET['next']);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!--alerts CSS -->
    <link href="../v3/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Sweet-Alert  -->
    <script src="../v3/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../v3/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../v3/vendors/bower_components/dropzonejs/dropzone.min.js"></script>
  </head>
  <body>

  </body>
</html>

<?php

//Check user
$strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id WHERE a.email = '$email' AND a.password = '$pwd' AND a.active_status = '1' AND a.allow_status = '1' AND a.reviewer_role = '1'";
if($query = mysqli_query($conn, $strSQL)){
  $rw = mysqli_num_rows($query);
  if($rw > 0){
    $row = mysqli_fetch_assoc($query);
    ?>
    <script type="text/javascript">
      localStorage.clear();
      window.localStorage.setItem('rmis_current_user', <?php echo $row['id']; ?>);
      window.localStorage.setItem('rmis_current_role', 'reviewer');
    </script>
    <?php



    $strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs   WHERE a.rir_id = '$rir_id'";
    $query2 = mysqli_query($conn, $strSQL);

    // echo $strSQL;
    // die();
    $row2 = mysqli_fetch_assoc($query2);
    // var_dump($row2);
    // echo $row2['rir_id_rs'];
    $id_rs = $row2['rir_id_rs'];
    $session_id = $row2['session_id'];
    ?>
    <script type="text/javascript">
      window.localStorage.setItem('current_selected_project_id', <?php echo $id_rs; ?>);
      window.localStorage.setItem('current_selected_project_session', '<?php echo $session_id; ?>' );
    </script>

    <?php

    if($next == 'aknowledge'){
      ?>
      <script type="text/javascript">
      window.localStorage.setItem('current_review_status', 'aknowledge');
        window.location = '../reviewer/research_info.html'
      </script>
      <?php
    }else if($next == 'aknowledgehardcopy'){

      ?>
      <script type="text/javascript">
      window.localStorage.setItem('current_review_status', 'aknowledgehardcopy');
        window.location = '../reviewer/research_info_1.html'
      </script>
      <?php
    }else if($next == 'cannotassesment'){
      $strSQL = "UPDATE research_init_reviewer SET rw_reply_status = '3', rw_reply_datetime = '".date('Y-m-d H:i:s')."' WHERE rir_id_reviewer = '".$row['id']."' AND rir_id_rs = '".$id_rs."'";
      mysqli_query($conn, $strSQL);
      ?>
      <script type="text/javascript">
      // window.localStorage.setItem('current_review_status', 'cannotassesment');
        // window.location = '../reviewer/dis_consided.html'
        swal({
          title: "ดำเนินการสำเร็จ",
          text: "หวังเป็นอย่างยิ่งว่าจะได้รับการอนุเคราะห์จากท่านในครั้งต่อไป ท่านยังคงสามารถเปลี่ยนใจเลือกตอบรับพิจารณาข้อ 1 หรือ 2 ได้จากอีเมล์ฉบับเดิม!",
          type: "success",
          showCancelButton: false,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "รับทราบ",
          closeOnConfirm: true
        },
        function(){
          window.top.close();
        });

      </script>
      <?php
    }
  }
}

?>
