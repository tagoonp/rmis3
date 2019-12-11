<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  	<title>:: RMIS :: สำหรับผู้เชี่ยวชาญอิสระ ::</title>

    <!-- Data table CSS -->
  	<link href="../v4/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--alerts CSS -->
  	<link href="../v3/vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Data table CSS -->
    <link href="../v3/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- Fontawesom -->
    <link href="../v4/bower_components/fontawesome/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="../v3/dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="../v3/fonts.css" rel="stylesheet" type="text/css">
    <link href="../v3/style_v2.css" rel="stylesheet" type="text/css"> -->
    <!-- Preload -->
    <link rel="stylesheet" href="../v4/node_modules/preload.js/dist/css/preload.css">

    <!-- Material Design Bootstrap -->
    <link href="../v4/node_modules/mdbootstrap/css/mdb.min.css" rel="stylesheet">
    <link href="../v4/node_modules/mdbootstrap/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="../v4/assets/css/style.css">
    <link rel="stylesheet" href="../v4/assets/css/fonts.css">

  </head>

  <style media="screen">
    body{
      background: rgb(245, 245, 245);
    }
  </style>

  <body>

    <div class="header fixed-top" style="background: rgb(31, 147, 12) !important; border: solid; border-width: 0px 0px 1px 0px; border-color: rgb(233, 233, 233);">
      <div class="container">
        <!--Navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark blue" style="background: rgb(31, 147, 12) !important; box-shadow: none;">

          <!-- Navbar brand -->
          <a class="navbar-brand th_font fw500  text-white" href="index.html" style="font-size: 1.9em; margin-top: -3px;">RMIS@Medicine</a>

          <!-- Collapse button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Collapsible content -->
          <div class="collapse navbar-collapse" id="basicExampleNav" style="margin-top: -4px;">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active dn">
                  <a href="index.html" class="nav-link active">หน้าแรก</a>
                </li>
              </ul>

              <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item ">
                    <a href="profile.html" class="nav-link text-white">ยินดีต้อนรับ, คุณ<span class="userFullname text-white">NA</span> (STAFF)</a>
                  </li>
                  <li class="nav-item ">
                    <a href="changepassword.html" class="nav-link text-white">เปลี่ยนรหัสผ่าน</a>
                  </li>
                  <li class="nav-item ">
                    <a href="#" class="nav-link text-white" onclick="main.signout()">ออกจากระบบ</a>
                  </li>
                </ul>
              </div>
          </div>
          <!-- Collapsible content -->

        </nav>
        <!--/.Navbar-->
      </div>
    </div>

    <div class="group-1 pb-50" style="padding-top: 90px;">
      <div class="container">



        <div class="row">
          <div class="col-sm-12 pb-20">
            <button class="btn btn-success" onclick="window.history.back()"><i class="fas fa-home mr-10"></i>กลับสู่หน้าโครงการ</button>
            <button class="btn btn-success"  onclick="printForm('printArea')"><i class="fas fa-print mr-10"></i>พิมพ์ผลการประเมิน</button>
          </div>
          <div class="col-sm-12 mb-10">
            <div class="card mb-10">
              <div class="card-body" id="printArea">
                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="fw500 text-center">แบบประเมินเอกสารด้านกฎหมายโครงการวิจัย<br><small>(ทบทวนครั้งแรก)</small></h3>
                    <hr>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="pl-20 txt-dark">
                      <div class="row">
                        <div class="col-sm-3 f500">รหัสโครงการ</div>
                        <div class="col-sm-9"><span id="txtCode" class="txt-danger">ยังไม่กำหนด</span></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 f500">ชื่อโครงการ (ภาษาไทย)</div>
                        <div class="col-sm-9"><span id="txtThtitle">NA</span></div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 f500">ชื่อโครงการ (ภาษาอังกฤษ)</div>
                        <div class="col-sm-9"><span id="txtEntitle">NA</span></div>
                      </div>
                    </div>

                    <div class="pl-20 pr-20 pt-20">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 1</span> :: กรุณาพิมพ์ความเห็นในภาพรวมเกี่ยวกับโครงการ (General comment)
                              <span class="text-danger">** </span></label>
                              <div class="general_comment" style="margin-top: 10px; padding: 20px; border: dashed; border-color: rgb(130, 130, 130); color: #000; border-width: 1px;">-</div>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive_">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" class="form-control dn" name="q_assesment_id_bio" id="q_assesment_id_bio">
                          </div>
                        </div>
                        <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 2</span> :: หากท่านมีประเด็นข้อคำถามหรือข้อเสนอแนะ ให้กดปุ่ม "เพิ่มคำถามหรือข้อเสนอแนะ" เพื่อเพิ่มประเด็นข้อคำถามหรือข้อเสนอแนะ <span class="text-danger">** </span></label>

                        <table class="table table-bordered">
                          <thead>
                            <tr style="background: rgb(117, 120, 119);">
                              <th class="txt-light" style="width: 10%;">ข้อ</th>
                              <th class="txt-light">คำถามหรือข้อเสนอแนะจากกรรมการ</th>
                            </tr>
                          </thead>
                          <tbody id="mtaComment">
                            <tr>
                              <td class="text-center" colspan="3" >
                                ยังไม่มีข้อคำถามหรือข้อเสนอแนะจากกรรมการ
                              </td>
                            </tr>
                          </tbody>
                        </table>

                      </div>

                      <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 3</span> ::  โดยสรุป ท่านเห็นชอบกับเอกสารทางกฏหมายที่พิจารณาหรือไม่ <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 10%;" class="text-center">
                              <span class="radio042-1">

                              </span>
                            </td>
                            <td>เห็นชอบ</td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-2">

                              </span>
                            </td>
                            <td>เห็นชอบ หากแก้ไขตามข้อเสนอแนะ</td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-3">

                              </span>
                            </td>
                            <td>ไม่เห็นชอบ เนื่องจาก
                              <div class="pt-5 dn" id="notFitInfo" style="margin-top: 10px; padding: 20px; border: dashed; border-color: rgb(130, 130, 130); color: #000; border-width: 1px;"></div>
                            </td>
                          </tr>

                        </tbody>
                      </table>

                    </div>
                    <!-- .assesment_panal -->
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!-- .row -->




      </div>
    </div>

    <div class="custom-footer pt-30 pb-30">
      <div class="container text-center">
        2017 © RMIS. หน่วยส่งเสริมและพัฒนาทางวิชาการ คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์. .
      </div>
    </div>

    <!-- jQuery -->
    <script src="../v3/vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../v3/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <script src="../v4/bower_components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  	<!-- Slimscroll JavaScript -->
  	<script src="../v3/dist/js/jquery.slimscroll.js"></script>
  	<!-- Fancy Dropdown JS -->
  	<script src="../v3/dist/js/dropdown-bootstrap-extended.js"></script>
    <!-- Sweet-Alert  -->
  	<script src="../v3/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Data table JavaScript -->
    <script src="../v3/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../v3/dist/js/dataTables-data.js"></script>
    <!-- Data table JavaScript -->
    <script type="text/javascript" src="../v3/vendors/bower_components/ckeditor/ckeditor.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../v4/node_modules/mdbootstrap/js/mdb.min.js"></script>

  	<!-- Init JavaScript -->
    <script src="../v4/config.js"></script>
  	<script src="../v3/dist/js/init.js"></script>
    <script src="../v3/main.js"></script>
    <script src="../v4/staff.js"></script>

    <script type="text/javascript" src="../v4/node_modules/preload.js/dist/js/preload.js"></script>

    <script type="text/javascript">

      var current_rs = window.localStorage.getItem('current_selected_project_session')
      var current_rs_id = window.localStorage.getItem('current_selected_project_id')
      var current_form = window.localStorage.getItem('rmis_current_assesment_form')
      var current_review_status = window.localStorage.getItem('current_selected_project_review_status');
      var comment_other_1 = '', comment_other_2 = ''
      var editData = '';
      var reply_status = '0';
      var numreplyfile = 0;
      var files;
      var eformnum = 0
      var eformnum_success = 0
      var gc_bio = '';
      var gc_icf = '';
      var notfin_info  = '';

      $(document).ready(function(){

        if(current_rs == null){
          swal({    title: "เกิดข้อผิดพลาด",
                      text: "ไม่พบข้อมูลงานวิจัยที่ต้องการ กรุณาลองใหม่ หรือติดต่อเจ้าหน้าที่!",
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "รับทราบ",
                      closeOnConfirm: false },
                      function(){
                       window.location = './'
                      });
        }


        staff.init()
        staff.load_rs_info_2();

        loadMTAInfo()

        setTimeout(function(){
          preload.hide()
        }, 1000)

      })

      $(function(){

      })

      function loadMTAInfo(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }

        var jxr = $.post(ws_url + 'controller/reviewer/load-mta-info.php', param, function(){}, 'json')
                   .always(function(snap){
                     console.log(snap);
                     if((snap != '') && (snap.length > 0)){
                      snap.forEach(function(i){

                        $('.general_comment').html(i.efm_gc)
                        $('.radio042-' + i.efm_conclustion).html('<i class="far fa-check-circle text-danger"></i>')
                        if(i.efm_conclustion == '3'){
                          $('#notFitInfo').removeClass('dn')
                          $('#notFitInfo').html(i.efm_conclusion_comment)
                        }
                      })
                     }
                   })

          loadMTACommentList()
      }

      function loadMTACommentList(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }

        var jxr = $.post(ws_url + 'controller/reviewer/load-mta-comment.php', param, function(){}, 'json')
                   .always(function(snap){
                     // console.log(snap);
                     if((snap != '') && (snap.length > 0)){
                      $('#mtaComment').empty()
                      $c = 1;
                      snap.forEach(function(i){
                        $data = '<tr>' +
                                  '<td>' + $c + '</td>' +
                                  '<td>' + i.cmta_msg + '</td>' +
                                '</tr>'
                        $('#mtaComment').append($data)
                        $c++;
                      })
                     }else{
                      $('#mtaComment').empty()
                      $('#mtaComment').append('<tr><td class="text-center" colspan="3" >ยังไม่มีข้อคำถามหรือข้อเสนอแนะจากกรรมการ</td></tr>')
                     }
                   })
      }

    </script>

  </body>
</html>
