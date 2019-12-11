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
}else{
  if(($_GET['next'] != 'aknowledge') && ($_GET['next'] != 'aknowledgehardcopy') && ($_GET['next'] != 'cannotassesment')){
    mysqli_close($conn);
    echo "ข้อมูลสำหรับการเข้าถึงไม่ครบถ้วน";
    die();
  }
}

$ip_add =$_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");

$email = mysqli_real_escape_string($conn, $_GET['email']);
$pwd = mysqli_real_escape_string($conn, $_GET['sid']);
$rir_id = mysqli_real_escape_string($conn, $_GET['pid']);
$next = mysqli_real_escape_string($conn, $_GET['next']);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  	<title>:: RMIS :: ตอบรับการพิจารณาสำหรับผู้เชี่ยวชาญอิสระ ::</title>

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
                    <a href="profile.html" class="nav-link text-white">ยินดีต้อนรับ, คุณ<span class="userFullname text-white">NA</span> (REVIEWER)</a>
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
          <div class="col-sm-12">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 mb-10">
            <div class="card mb-10">
              <div class="card-header" style="background: rgb(31, 147, 12); color: #fff;">
                การตัดสินใจของท่านต่อการพิจารณาโครงการ
              </div>
              <div class="card-body" id="responseAble">
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="text-center pb-30" style="color: rgb(15, 133, 16);">ข้อตกลงการรักษาความลับของโครงการวิจัยและเอกสารราชการ<br>
สำหรับ ผู้เชี่ยวชาญอิสระ คณะแพทยศาสตร์มหาวิทยาลัยสงขลานครินทร์<br>
Confidentiality Agreement: Independent Reviewer</h4>

                    <p>
                      ข้าพเจ้า ผู้ลงนามท้ายเอกสารนี้ ในฐานะที่เป็นผู้เชี่ยวชาญอิสระ ผู้ทำหน้าที่พิจารณาโครงร่างการวิจัย ตกลงที่จะไม่ใช้ข้อมูลที่เป็นความลับและส่วนบุคคลเพื่อผลประโยชน์ส่วนตัว และจะไม่เปิดเผยข้อมูลนี้ต่อบุคคลที่สาม รวมทั้งไม่ทำสำเนาหรือทำซ้ำข้อมูลเหล่านี้ในทุกวิธีการ เว้นแต่ในส่วนที่ต้องกระทำเนื่องจากกฎหมายข้อบังคับ หรือคำสั่งศาล
                    </p>

                    <p>
                      ข้อมูลที่เป็นความลับและส่วนบุคคล หมายถึงข้อมูลหรือวัสดุต่างๆ ซึ่งจัดเตรียมไว้โดยผู้วิจัย ผู้สนับสนุนการวิจัย เพื่อประกอบการพิจารณาทบทวนของคณะกรรมการจริยธรรมการวิจัยในมนุษย์ ไม่ว่าจะปรากฏในรูปของลายลักษณ์อักษรหรือโดยวาจา รวมถึงข้อมูลทางเทคนิควิทยาศาสตร์ การเงิน ข้อมูลส่วนบุคคลเกี่ยวข้องกับค่าจ้าง ค่าตอบแทน เงินเดือนและสิทธิประโยชน์ในการพิจารณาโครงการวิจัยแต่ละครั้ง ข้าพเจ้าตกลงที่จะทำลายหรือส่งคืนเอกสาร ซึ่งจัดส่งมาให้ข้าพเจ้าดำเนินการในส่วนที่เกี่ยวข้องกับกิจกรรมของข้าพเจ้า
                    </p>

                    <p>
                      ในกรณีที่จำเป็นจะต้องเปิดเผยข้อมูลส่วนบุคคลและข้อมูลที่เป็นความลับ ทั้งนี้ไม่ว่าจะโดยกฎหมายหรือคำสั่งศาล ข้าพเจ้าจะแจ้งให้คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์ทราบ โดยไม่เกิน 2 วันทำการปกตินับแต่ที่ได้รับแจ้งถึงคำร้องขอ ทั้งนี้ไม่รวมถึงข้อมูลที่ ก) อยู่ในการครอบครอง เป็นหลักฐานโดยการบันทึกของข้าพเจ้า ข) ข้อมูลที่สามารถเข้าถึงได้โดยสาธารณะ ค) ข้าพเจ้าได้รับจากบุคคลที่สามอย่างถูกต้องตามกฎหมายและด้วยความสุจริต
                    </p>

                    <p>
                      ข้าพเจ้าเข้าใจว่าการละเมิดข้อตกลงจะทำความเสียหายให้เกิดขึ้นกับคณะกรรมการจริยธรรมการวิจัยในมนุษย์มหาวิทยาลัยสงขลานครินทร์ ข้าพเจ้ายอมรับเป็นหน้าที่ที่จะปฏิบัติตามข้อตกลงนี้ต่อไปแม้ว่าการปฏิบัติหน้าที่ในฐานะผู้เชี่ยวชาญอิสระจะสิ้นสุดลง
                    </p>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group dn">
                          <input type="text" name="txtEmail" id="txtEmail" value="<?php echo $_GET['email'];?>" class="form-control">
                        </div>
                        <div class="form-group dn">
                          <input type="text" name="txtUid" id="txtUid" value="" class="form-control">
                        </div>
                        <div class="form-group dn">
                          <input type="text" name="txtSid" id="txtSid" value="<?php echo $_GET['sid'];?>" class="form-control">
                        </div>
                        <div class="form-group dn">
                          <input type="text" name="txtRid" id="txtPid" value="<?php echo $_GET['pid'];?>" class="form-control">
                        </div>
                        <div class="form-group dn">
                          <select class="form-control" name="txtNext" id="txtNext">
                            <option value="">-- Chooose type --</option>
                            <option value="aknowledge" <?php if($_GET['next'] == 'aknowledge'){ echo "selected";}?> >aknowledge</option>
                            <option value="aknowledgehardcopy" <?php if($_GET['next'] == 'aknowledgehardcopy'){ echo "selected";}?> >aknowledgehardcopy</option>
                            <option value="cannotassesment" <?php if($_GET['next'] == 'cannotassesment'){ echo "selected";}?> >cannotassesment</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12 pt-20 text-center">
                        <div class="checkbox checkbox-success text-danger">
                          <input id="checkbox3" type="checkbox">
                          <label for="checkbox3"> ข้าพเจ้าได้อ่านและยอมรับในข้อตกลงการรักษาความลับของโครงการวิจัยและเอกสารราชการฉบับนี้ </label>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12 pt-20 text-center pb-20">
                        <button class="btn btn-success btn-block btn-lg dn" disabled id="btnAggrement_1">ตอบรับการพิจารณาและดำเนินการผ่านระบบออนไลน์</button>
                        <button class="btn btn-success btn-block btn-lg dn" disabled id="btnAggrement_2">ยินดีพิจารณาและขอรับไฟล์โครงการในรูปแบบเอกสาร</button>
                        <button class="btn btn-success btn-block btn-lg mt-10" id="" onclick="window.location = '../reviewer/research_info_before_review.html'">ขออ่านข้อมูลโครงการเบื้องต้นก่อนตัดสินใจ</button>

                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="card-body dn" id="non-responseAble">
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="text-center pb-10 pt-10" style="color: rgb(15, 133, 16);">กรุณาระบุเหตุผลที่ท่านไม่สามารถตอบรับการพิจาารณาโครงการนี้</h4>
                    <div class="row">
                      <div class="col-sm-12 pt-20 text-center">
                          <textarea name="txtNonresponseable" id="txtNonresponseable" rows="8" cols="80"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12 pt-20 text-center pb-20">
                        <button class="btn btn-danger btn-block btn-lg dn" id="btnAggrement_3">ส่งข้อมูลไปยังสำนักงาน</button>
                        <button class="btn btn-success btn-block btn-lg mt-10" id="" onclick="window.location = '../reviewer/research_info_before_review.html'">ไปอ่านข้อมูลเบื้องต้นโครงการก่อนตัดสินใจพิจารณา</button>
                      </div>
                    </div>

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
    <!-- <script src="../v3/vendors/bower_components/jquery/dist/jquery.min.js"></script> -->
    <script src="../v3/vendors/bower_components/jquery/dist/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../v3/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <script type="text/javascript" src="../v3/vendors/bower_components/ckeditor_lite/ckeditor.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="../v4/node_modules/mdbootstrap/js/mdb.min.js"></script>

  	<!-- Init JavaScript -->
    <script src="../v4/config.js"></script>
  	<script src="../v3/dist/js/init.js"></script>
    <script src="../v3/main.js"></script>
    <script src="../v4/reviewer.js"></script>

    <script type="text/javascript" src="../v4/node_modules/preload.js/dist/js/preload.js"></script>

    <script type="text/javascript">

      var current_rs = window.localStorage.getItem('current_selected_project_session')
      var current_rs_id = window.localStorage.getItem('current_selected_project_id')
      var comment_other_1 = '', comment_other_2 = ''
      var editData = '';
      var reply_status = '0';
      var numreplyfile = 0;
      var files;
      var eformnum = 0
      var eformnum_success = 0
      var nr_comment

      $(document).ready(function(){


        nr_comment = CKEDITOR.replace( 'txtNonresponseable', { height: '250px' });

        <?php

        $strSQL = "SELECT * FROM useraccount a INNER JOIN userinfo b ON a.id = b.user_id
                   WHERE a.email = '$email' AND a.password = '$pwd' AND a.active_status = '1' AND a.allow_status = '1' AND a.reviewer_role = '1'";
        if($query = mysqli_query($conn, $strSQL)){
          $row = mysqli_fetch_assoc($query);
          ?>
          localStorage.clear();
          $('#txtUid').val(<?php echo $row['id']; ?>)
          window.localStorage.setItem('rmis_current_user', $('#txtUid').val());
          window.localStorage.setItem('rmis_current_role', 'reviewer');

          current_user = $('#txtUid').val()
          current_role = 'reviewer'

          reviewer.init()

          // Check project
          <?php
          $strSQL = "SELECT * FROM research_init_reviewer a INNER JOIN research b ON a.rir_id_rs = b.id_rs
                     WHERE a.rir_id = '$rir_id'
                    ";
          $query2 = mysqli_query($conn, $strSQL);



          if($query2){


            $row2 = mysqli_fetch_assoc($query2);
            $review_status = $row2['rw_reply_status'];
            $id_rs = $row2['rir_id_rs'];
            $session_id = $row2['session_id'];
            // echo ;
            ?>
            window.localStorage.setItem('current_selected_project_id', <?php echo $id_rs; ?>);
            window.localStorage.setItem('current_selected_project_session', '<?php echo $session_id; ?>' );

            var current_rs = window.localStorage.getItem('current_selected_project_session')
            var current_rs_id = window.localStorage.getItem('current_selected_project_id')

            <?php
            if($review_status == 3){
              ?>
              window.location = '../reviewer/research_info_already_disresponse.html'
              <?php
            }
            else if($review_status == 4){
              ?>
              window.location = '../reviewer/research_info_already_review.html'
              <?php
            }else if(($review_status == 1) || ($review_status == 2)){
              ?>
              window.location = '../reviewer/research_info.html'
              <?php
            }
            ?>

            // Check response type
            var rtype = $('#txtNext').val()
            console.log(rtype);
            if(rtype == 'aknowledge'){
              $('#btnAggrement_1').removeClass('dn')
            }else if(rtype == 'aknowledgehardcopy'){
              $('#btnAggrement_2').removeClass('dn')
            }else if(rtype == 'cannotassesment'){
              $('#non-responseAble').removeClass('dn')
              $('#responseAble').addClass('dn')
              $('#btnAggrement_3').removeClass('dn')
            }

            setTimeout(function(){
              preload.hide()
            }, 1000)

            <?php
          }else{
            // Project not found
            // User not found
            ?>
            window.location = 'bp.php'
            <?php
          }
        }else{
          // User not found
          ?>
          window.location = 'bp.php'
          <?php
        }
        ?>

        reviewer.load_rs_info_2();
        return ;




        $('#txtIdReviewer').val(current_user)
        $('#txtIdRS').val(current_rs_id)

        setTimeout(function(){
          preload.hide()
        }, 1000)

      })

      $(function(){
        $('#checkbox3').click(function(){
          if($("#checkbox3").is(':checked')){
            $('#btnAggrement_1').prop('disabled', '')
            $('#btnAggrement_2').prop('disabled', '')
            $('#btnAggrement_3').prop('disabled', '')
          }else{
            $('#btnAggrement_1').prop('disabled', 'disabled')
            $('#btnAggrement_2').prop('disabled', 'disabled')
            $('#btnAggrement_3').prop('disabled', 'disabled')
          }
        })

        $('#btnAggrement_3').click(function(){
          var param = {
            uid: current_user,
            rir_id: $('#txtPid').val(),
            id_rs: current_rs_id,
            msg: nr_comment.getData()
          }

          swal({   title: "คำเตือน",
             text: "ท่านยืนยันการส่ง",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes, delete it!",
             cancelButtonText: "No, cancel plx!",
             closeOnConfirm: false,
             closeOnCancel: false },
             function(isConfirm){
                 if (isConfirm) {
                     swal("Deleted!", "Your imaginary file has been deleted.", "success");   }
                 else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");   }
            });
        })

        $('#btnAggrement_1').click(function(){

          preload.show()

          var param = {
            id: current_user,
            id_rs: current_rs_id
          }

          var jxhr = $.post(ws_url + 'controller/reviewer/acknowledge_1.php', param, function(){})
                      .always(function(resp){
                        console.log(resp);
                        preload.hide()
                        if(resp == 'Y'){
                          swal({
                            title: "รับทราบ",
                            text: "ระบบทำการปรับปรุงข้อมูลการรับพิจารณาโครงการของท่านและส่งไปยังเจ้าหน้าที่เรียบร้อยแล้ว กด -รับทราบ- เพื่อทำการรีโหลดข้อมูลโครงการวิจัย!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#08b989",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: true
                          },
                          function(){
                            window.location = '../reviewer/research_info.html'
                          });

                        }else{
                          preload.hide()
                          swal("ขออภัย", "เกิดข้อผิดพลาดของระบบ กรุณาติดต่อเจ้าหน้าที่", "error")
                          return ;
                        }
                      })
                      .fail(function(){
                        preload.hide()
                        swal("ขออภัย", "ไม่สามารถเชื่มอต่อฐานจ้อมูลได้", "error")
                        return ;
                      })
        })

        $('#btnAggrement_2').click(function(){

          preload.show()

          var param = {
            id: current_user,
            id_rs: current_rs_id
          }

          var jxhr = $.post(ws_url + 'controller/reviewer/acknowledge_2.php', param, function(){})
                      .always(function(resp){
                        preload.hide()
                        if(resp == 'Y'){
                          swal({
                            title: "ขอบพระคุณในความอนุเคราะห์",
                            text: "เจ้าหน้าที่จะจัดส่งเอกสารให้ท่านโดยเร็ว หากไม่ได้รับภายใน 3 วันทำการกรุณาติดต่อสำนักงานฯ (1157) กด -รับทราบ- เพื่อทำการรีโหลดข้อมูลโครงการวิจัย!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#08b989",
                            confirmButtonText: "รับทราบ",
                            closeOnConfirm: true
                          },
                          function(){
                            window.location = '../reviewer/research_info.html'
                          });
                        }else{
                          preload.hide()
                          swal("ขออภัย", "เกิดข้อผิดพลาดของระบบ กรุณาติดต่อเจ้าหน้าที่", "error")
                          return ;
                        }
                      })
                      .fail(function(){
                        preload.hide()
                        swal("ขออภัย", "ไม่สามารถเชื่มอต่อฐานจ้อมูลได้", "error")
                        return ;
                      })
        })

      })



      // Grab the files and set them to our variable
      function prepareUpload(event){

        files = event.target.files;

        console.log(files[0].type);

        if((files[0].type != 'application/pdf') && (files[0].type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') && (files[0].type != 'application/msword')){ //application/msword
          swal("ขออภัย", "กรุณาเลือกไฟล์ .doc, .docx หรือ .pdf เท่านั้น", "error")
          files = '';
          $('#media').val('')
          return ;
        }
      }

      function uploadFiles(event){

        if ( document.getElementById('media').value.length == 0 ){
          swal("ขออภัย", "กรุณาเลือกไฟล์ก่อนทำการอัพโหลด", "error")
          return ;
        }

        // event.stopPropagation()
        event.preventDefault();



        // START A LOADING SPINNER HERE
        $('#progressbar').removeClass('dn')

        var formData = new FormData($('form')[0]);

        // var formData = new FormData();
        $.each(files, function(key, value)
        {
            $.each(value, function(key, value){
              formData.append(key, value);
            })
        });

        $.ajax({
          xhr: function(){
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function(e){

              if(e.lengthComputable){
                console.log('Byte loaded : ' + e.loaded);
                console.log('Total size : ' + e.total);
                console.log('Percentage : ' + (e.loaded / e.total));

                var percentage = Math.round((e.loaded / e.total) * 100);

                $('#progressUploadBar').attr('aria-valuenow', percentage).css('width', percentage + '%')
              }
            })
            return xhr;
          },
          url: '../controller/upload_file_assesment_back_2.php?files',
          type: 'POST',
          data: formData,
          processData: false, // Don't process the files
          contentType: false, // Set content type to false as jQuery will tell the server its a query string request
          success: function(data, textStatus, jqXHR)
          {
                console.log(data);
                console.log(textStatus);
                console.log(jqXHR);
                setTimeout(function(){
                  $('#progressbar').addClass('dn')
                  swal({    title: "อัพโหลดไฟล์สำเร็จ",
                    text: "กด 'รับทราบ' เพื่อดำเนินการต่อ",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#55a0dd",
                    confirmButtonText: "รับทราบ",
                    closeOnConfirm: true },
                  function(){

                  });
                }, 1000)

                $('#media').val('')
                checkDataReplyFile()
                return ;
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
                swal({    title: "ไม่สามารถอัพโหลดไฟล์ได้",
                  text: "กรุณาลองใหม่ หรือส่งไฟล์ให้เจ้าหน้าที่ผ่านทางอีเมล์!",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "รับทราบ",
                  closeOnConfirm: true },
                function(){

                });

                // Handle errors here
                console.log('ERRORS: ' + textStatus);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                setTimeout(function(){
                  $('#progressbar').addClass('dn')
                }, 1000)
                $('#progressbar').addClass('dn')
          }
        })



        return ;
      }


    </script>

  </body>
</html>
