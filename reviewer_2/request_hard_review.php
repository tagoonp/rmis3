<?php
session_start();
session_regenerate_id();

if ($_SESSION['id'] == "")
{
    header("location:../index.php");
    exit();
}

include "../lib/connect.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("select * from reviewer a INNER JOIN prefix b on a.id_prefix = b.id_prefix where a.id_reviewer ='%s'", mysql_real_escape_string($_SESSION['id']));
$result = $db->select($strSQL,false,true);
if(!$result){
  header("location:../index.php");
  exit();
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title>::: RMIS for Reviwer Role :::</title>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="shortcut icon" href="./favicon.ico">
        <!-- js -->
        <!-- <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/scrolltable.js"></script> -->


        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="../lib/assets/js/plugins/slick/slick.min.css" />
        <link rel="stylesheet" href="../lib/assets/js/plugins/slick/slick-theme.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Prompt:300,400,500" rel="stylesheet">

				<!-- Page JS Plugins CSS -->
        <link rel="stylesheet" type="text/css" href="../lib/sweetalert/dist/sweetalert.css">
        <link rel="stylesheet" href="../lib/assets/js/plugins/dropzonejs/dropzone.min.css" />
        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="../lib/assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="../lib/assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="../lib/assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="../lib/assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="../lib/assets/css/app-custom.css" />
        <link rel="stylesheet" type="text/css" href="../lib/sweetalert/dist/sweetalert.css">

    </head>
    <body>

      <?php

      if((isset($_GET['id_rs'])) && (isset($_GET['id_reviewer']))){

        $strSQL = sprintf("UPDATE reviewer_seleted_by_ec SET response_status = '%s', response_datetime = '%s' WHERE id_rs = '%s' AND reviewer_id = '%s'",
                  mysql_real_escape_string('2'),
                  mysql_real_escape_string(date('Y-m-d H:i:s')),
                  mysql_real_escape_string($_GET['id_rs']),
                  mysql_real_escape_string($_SESSION['id'])
                  );
        $resultUpdate = $db->update($strSQL);

        $strSQL = sprintf("INSERT INTO submit_feedback_hardcopy (id_reviewer, id_rs, date_req) VALUES ('%s', '%s', '%s') ",
                    mysql_real_escape_string($_GET['id_reviewer']),
                    mysql_real_escape_string($_GET['id_rs']),
                    mysql_real_escape_string(date('Y-m-d'))
                  );

        $resultInsert = $db->insert($strSQL,false,true);

        $log_ip=$_SERVER['REMOTE_ADDR'];
        $log_date = date ("y-m-d H:i:s");

        $detail = "ผู้ทรงคุณวุฒิขอโครงการวิจัยแบบเอกสาร (Researh_id: ".$_GET["id_rs"].") โดยผู้ทรง (ID : ".$_SESSION['id'].")";
        $strSQL = "INSERT INTO research_log (rl_detail, other_msg, rl_ip, rl_datetime, rl_by, rl_role)
                  VALUES
                    ('".$detail."', '','".$log_ip."','".$log_date."','".$_SESSION['id']."','reviewer')
                  ";
        $resultInsert = $db->insert($strSQL,false,true);

        // header('Location: ./');
        // die();


      }else{
        echo "Error";
        die();
      }
      ?>

      <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
      <script src="../lib/assets/js/core/jquery.min.js"></script>
      <script src="../lib/assets/js/core/bootstrap.min.js"></script>
      <script src="../lib/assets/js/core/jquery.slimscroll.min.js"></script>
      <script src="../lib/assets/js/core/jquery.scrollLock.min.js"></script>
      <script src="../lib/assets/js/core/jquery.placeholder.min.js"></script>
      <script src="../lib/assets/js/app.js"></script>
      <script src="../lib/assets/js/app-custom.js"></script>

      <!-- <script src="../lib/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script> -->
      <!-- Page JS Code -->
      <!-- <script src="../lib/assets/js/pages/base_tables_datatables.js"></script> -->
      <script src="../lib/sweetalert/dist/sweetalert.min.js"></script>
      <script src="../lib/assets/js/plugins/dropzonejs/dropzone.min.js"></script>

  		<script src="../lib/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">
      swal({
        title: "ดำเนินการสำเร็จ",
        text: "ความต้องการของท่านได้ถูกส่งไปยังสำนักงานฯ แล้ว กรุณารอเอกสารโครงการวิจัยหรือการตอบกลับจากทางเจ้าหน้าที่!",
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "รับทราบ",
        closeOnConfirm: false
        },
      function(){
        window.location = './';
      });
      </script>

    </body>
</html>
