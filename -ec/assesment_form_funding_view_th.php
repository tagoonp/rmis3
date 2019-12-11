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
                    <a href="profile.html" class="nav-link text-white">ยินดีต้อนรับ, คุณ<span class="userFullname text-white">NA</span> (เลขา EC)</a>
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
            <button class="btn btn-success" onclick="printForm('printArea')"><i class="fas fa-print mr-10"></i>พิมพ์ผลการประเมิน</button>
          </div>
        </div>



        <div class="row">

          <div class="col-sm-12 mb-10">
            <div class="card mb-10">
              <div class="card-body" id="printArea">
                <div class="">
                  <div class="row">
                    <div class="col-sm-12">
                      <h3 class="fw500 text-center">แบบประเมินโครงการที่ขอการสนับสนุนจากกองทุนวิจัยคณะแพทยศาสตร์<br><small>(ทุนวิจัยทั่วไป)</small></h3>
                      <hr>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="txt-dark pl-20 pr-20">
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
                      <div class="row">
                        <div class="col-sm-3 f500">ทุนวิจัยที่ขอ</div>
                        <div class="col-sm-9"><span id="txtBudget">NA</span> บาท</div>
                      </div>
                    </div>

                    <div class="pl-20 pr-20 pt-20">
                      <div class="table-responsive_">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" class="form-control dn" name="q_assesment_id_bio" id="q_assesment_id_bio">
                          </div>
                        </div>
                        <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 1</span> :: กรุณาอ่านความหมายของคะแนนก่อนจะคลิกเพื่อทำเครื่องหมาย (หากทำผ่านโทรศัพท์มือถือ ความหมายคะแนนจะปรากฏเมื่อทดลองกดให้คะแนน) <span class="text-danger">** </span></label>
                        <table class="table table-bordered">
                          <thead>
                            <tr style="background: rgb(19, 161, 114);">
                              <th class="txt-light">ข้อ</th>
                              <th class="txt-light">หัวข้อ</th>
                              <th class="txt-light text-center">น้อย<br>(1)</th>
                              <th class="txt-light text-center">ค่อนข้างน้อย<br>(2)</th>
                              <th class="txt-light text-center">ปานกลาง<br>(3)</th>
                              <th class="txt-light text-center">มาก<br>(4)</th>
                              <th class="txt-light text-center">อย่างมาก<br>(5)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td id="e1" style="font-size: 0.9em;">คุณวุฒิ และความเชี่ยวชาญของนักวิจัยหลักและมีทีมวิจัยระหว่างสหสาขาหรือต่างหน่วยงาน
                              </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio01-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-5">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td id="e2" style="font-size: 0.9em;">ประสบการณ์บริหารโครงการวิจัยของ<u>นักวิจัยหลัก</u>และมีผลลัพธ์ที่ดี</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio02-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-5">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td id="e3" style="font-size: 0.9em;">สร้างองค์ความรู้ใหม่ (Originality)</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio03-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-5">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td id="e4" style="font-size: 0.9em;">คุณภาพโครงการ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio04-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-5">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td id="e5" style="font-size: 0.9em;">โอกาสนำผลงานไปใช้ประโยชน์ (research impact) เช่น โอกาสการตีพิมพ์ เกิดแนวปฏิบัติใหม่ ประโยชน์เชิงพาณิชย์, ประสิทธิภาพขององค์กร, ประโยชน์ในการเรียนการสอน, เพิ่มคุณภาพชีวิตของชุมชนที่ร่วมวิจัย ฯลฯ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio05-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-5">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td id="e6">การตั้งงบประมาณเป็นไปตามหลักเกณฑ์และสอดคล้องกับรายละเอียดโครงการ </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio06-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-2">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-3">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-4">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-5">

                                </span>
                              </td>
                            </tr>
                            <tr style="background: rgb(235, 235, 235);">
                              <td colspan="2" class="text-dark text-right">รวม (เต็ม 100  คะแนน)</td>
                              <td colspan="5" class="text-dark text-center" id="totalyScore">กรุณาตอบให้ครบทุกข้อ</td>
                            </tr>


                          </tbody>
                        </table>

                        <div class="row mb-30 dn">
                          <div class="col-sm-12">
                            <h6>เกณฑ์คะแนนประกอบการพิจารณาให้ทุนเกิน 200,000 บาท</h6>
                            <div class="row">
                              <div class="col-sm-5 pl-30">•	นักวิจัยใหม่ (อายุงาน < 5 ปี)</div>
                              <div class="col-sm-7">ไม่น้อยกว่า 50 คะแนน </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 pl-30">•	นักวิจัยรุ่นกลาง (อายุงาน 6-10 ปี)</div>
                              <div class="col-sm-7">ไม่น้อยกว่า  60 คะแนน </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-5 pl-30">•	นักวิจัยอาวุโส (อายุงานมากกว่า 10 ปี)  </div>
                              <div class="col-sm-7">ไม่น้อยกว่า 70 คะแนน </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 2</span> :: สรุปผลการพิจารณา (สำหรับกรรมการ) <span class="text-danger">** </span></label> -->
                      <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 2</span> :: สรุปความเห็นของท่าน <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-1">

                              </span>
                            </td>
                            <td>1. ควรสนับสนุนทุนวิจัย โดยไม่ต้องแก้ไข (Approval) </td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-2">

                              </span>
                            </td>
                            <td>2. ควรสนับสนุนทุนหากปรับปรุงตามคำแนะนำ (Minor revision)</td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-3">

                              </span>
                            </td>
                            <td>3. ยังต้องปรับปรุงค่อนข้างมาก/ข้อมูลไม่เพียงพอ (Major revision)</td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-4">

                              </span>
                            </td>
                            <td> 4. ไม่ควรสนับสนุน (Reject)
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
    <!-- <script src="../v3/vendors/bower_components/bootstrap/dist/js/bootstrap.js"></script> -->
    <script src="../v4/bower_components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../v4/bower_components/popper.js/dist/popper.js"></script> -->
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
    <script src="../v4/ec.js"></script>

    <script type="text/javascript" src="../v4/node_modules/preload.js/dist/js/preload.js"></script>
    <!-- <script type="text/javascript" src="../v3/vendors/bower_components/ckeditor_lite/ckeditor.js"></script> -->

    <script type="text/javascript">

      var current_rs = window.localStorage.getItem('current_selected_project_session')
      var current_rs_id = window.localStorage.getItem('current_selected_project_id')
      var current_form = window.localStorage.getItem('rmis_current_assesment_form')
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
      var notfin_info2 = '';
      var sum_score = 0
      var reviewer_uid = <?php echo $_GET['id_reviewer']; ?>

      $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip()

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

        ec.init()
        ec.load_rs_info_2();

        // notfin_info2  = CKEDITOR.replace( 'q_generalcomment_notfit2', { height: '250px' });

        loadFundingInfo_view()

        setTimeout(function(){
          preload.hide()
        }, 1000)


      })

      $(function(){

      })

      function loadFundingInfo_view(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }

        var jxr = $.post(ws_url + 'controller/reviewer/load-funding-info.php', param, function(){}, 'json')
                   .always(function(snap){
                     if((snap != '') && (snap.length > 0)){
                      snap.forEach(function(i){
                        $('.radio01-' + i.eff_c1).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio02-' + i.eff_c2).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio03-' + i.eff_c3).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio04-' + i.eff_c4).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio05-' + i.eff_c5).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio06-' + i.eff_c6).html('<i class="far fa-check-circle text-danger"></i>')

                        $('.radio042-' + i.eff_summary).html('<i class="far fa-check-circle text-danger"></i>')
                        if(i.eff_summary == '4'){
                          $('#notFitInfo').removeClass('dn')
                          $('#notFitInfo').html(i.eff_summary_message)
                        }

                        $('#totalyScore').text(i.eff_totalscore)
                      })
                    }
                   })
      }

    </script>

  </body>
</html>
