<?php

include "../../controller/config.class.php";

if((!isset($_GET['pid'])) || (isset($_GET['pid']) == '')){
  header('Location: ./');
  die();
}

$id = mysqli_real_escape_string($conn, $_GET['pid']);

$strSQL = "SELECT * FROM research WHERE id_rs = '$id'";
$result = mysqli_query($conn, $strSQL);

$data = '';
if(($result) && (mysqli_num_rows($result) > 0)){
  $data = mysqli_fetch_assoc($result);
}else{
  echo $strSQL;
  header('Location: ./');
  die();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  	<title>:: RMIS Funding :: สำหรับเจ้าหน้าที่ ::</title>
    <!-- Data table CSS -->
  	<link href="../../v4/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--alerts CSS -->
  	<link href="../../v3/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Data table CSS -->
    <link href="../../v3/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-- Fontawesom -->
    <link href="../../v4/bower_components/fontawesome/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">
    <link href="../../v4/node_modules/preload.js/dist/css/preload.css">

    <style media="screen">
      html, body{
        padding: 0;
        margin: 0;
      }
    </style>
  </head>
  <body>

    <div style="padding: 10px; background: rgb(45, 144, 218); color: #fff;">
      <div class="container">
        <span style="font-size: 2em;">RMIS @ Funding</span>
      </div>
    </div>

    <div class="mt-3">
      <div class="container">
        <div class="row">
          <div class="col-12">

            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-primary" onclick="window.location = './'"><i class="fas fa-home"></i></button>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-12">
                <h5>ข้อมูลโครงการวิจัย</h5>
                <div class="card p-0">
                  <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                      <thead>
                        <tr>
                          <td>REC.</td>
                          <td><?php echo $data['code_apdu']; ?></td>
                        </tr>
                        <tr>
                          <td>ชื่อโครงการ (ไทย)</td>
                          <td><?php echo $data['title_th']; ?></td>
                        </tr>
                        <tr>
                          <td>ผู้รับทุน<br><span class="float-left btn btn-sm btn-primary mt-2"><i class="fas fa-pencil-alt"></span></td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>หลักฐานการให้ทุน<br><span class="float-left btn btn-sm btn-primary mt-2"><i class="fas fa-upload"></span</td>
                          <td></td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-12">
                <h5>บันทึกข้อมูลทุน</h5>
                <div class="row">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มรายการ</button>
                  </div>
                </div>
                <div class="card p-0 mt-2">
                  <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                      <thead>
                        <tr>
                          <td>วันที่</td>
                          <td>รายละเอียด</td>
                          <td>ประเภท</td>
                          <td>จำนวนเงิน</td>
                          <td>วันที่ส่งงานคลัง</td>
                          <td>คงเหลือ</td>
                          <td></td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="7" class="text-danger">ไม่พบข้อมูล</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- jQuery -->
    <script src="../../v3/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../v3/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  	<!-- Slimscroll JavaScript -->
  	<script src="../../v3/dist/js/jquery.slimscroll.js"></script>
  	<!-- Fancy Dropdown JS -->
  	<script src="../../v3/dist/js/dropdown-bootstrap-extended.js"></script>
    <!-- Sweet-Alert  -->
  	<script src="../../v3/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Data table JavaScript -->
    <script src="../../v3/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../v3/dist/js/dataTables-data.js"></script>
    <!-- Data table JavaScript -->
    <script src="../../v3/vendors/bower_components/ckeditor/ckeditor.js"></script>

    <script src="../../v4/config.js"></script>
    <script src="../../v3/main.js"></script>
    <script src="../../v4/staff.js"></script>

    <script type="text/javascript" src="../../v4/node_modules/preload.js/dist/js/preload.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        preload.hide()
      })
      $(function(){
        $('#search_project_form').submit(function(){
          $('#txtSearchbox').removeClass('is-invalid')
          if($('#txtSearchbox').val() == ''){
            $('#txtSearchbox').addClass('is-invalid')
            return ;
          }

          // preload.show()

          var param = {
            search_id: $('#txtSearchbox').val(),
            uid: current_user
          }

          var jxhr = $.post(ws_url + 'controller/funding/get_research_info.php', param, function(){},'json')
                      .always(function(snap){
                        if((snap.length > 0) && (snap != '')){
                          $('#result_list').empty()
                          $c = 1;
                          snap.forEach(i=>{
                            $btn = '<button class="btn btn-primary btn-sm" onclick="window.location = \'manage.php?pid=' + i.id_rs + '\'"><i class="fas fa-wrench"></i></button>'
                            $('#result_list').append('<tr>' +
                              '<td>' + $c + '</td>' +
                              '<td>' + i.code_apdu + '</td>' +
                              '<td>' + i.title_th + '</td>' +
                              '<td>' + $btn + '</td>' +
                            '</tr>')
                            $c++;
                          })
                        }
                      })
        })
      })
    </script>

  </body>
</html>
