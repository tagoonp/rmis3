<?php
session_start();
include "../lib/connect.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("select * from reviewer a INNER JOIN prefix b on a.id_prefix = b.id_prefix where a.id_reviewer ='%s'", mysql_real_escape_string($_SESSION['id']));
$result = $db->select($strSQL,false,true);
if(!$result){
  header("location:../index.php");
  exit();
}

$status = 0;
if(isset($_GET['status'])){
  $status = $_GET['status'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>:: RMIS for Reviwer role ::</title>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="shortcut icon" href="./favicon.ico">
        <!-- <link rel="stylesheet" href="css/theme.css"> -->
        <!-- <link rel="stylesheet" href="css/form.css"> -->
        <!-- <link rel="stylesheet" href="css/menu.css"> -->
        <!-- js -->
        <!-- <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="js/scrolltable.js"></script> -->


        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="../lib/assets/js/plugins/slick/slick.min.css" />
        <link rel="stylesheet" href="../lib/assets/js/plugins/slick/slick-theme.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Prompt:300,400,500" rel="stylesheet">

        <link rel="stylesheet" href="../lib/assets/js/plugins/datatables/jquery.dataTables.min.css" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="../lib/assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="../lib/assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="../lib/assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="../lib/assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="../lib/assets/css/app-custom.css" />

        <link rel="stylesheet" type="text/css" href="../lib/sweetalert/dist/sweetalert.css">
    		<script src="../lib/sweetalert/dist/sweetalert.min.js"></script>


    </head>
    <body>
      <?php
      include "header.php";
      ?>

      <div class="container-fluid" style="padding-top: 20px;">
        <div class="row">
          <div class="col-sm-6">
            <a href="index.php" class="btn btn-menu-custom7 btn-block thfont" style="text-align: left;"><i class="fa fa-bars"></i> รายการโครงการวิจัยที่รอการประเมิน</a>
          </div>
          <div class="col-sm-6">
            <a href="index.php?status=1" class="btn btn-menu-custom7 btn-block thfont" style="text-align: left;"><i class="fa fa-bars"></i> รายการโครงการวิจัยที่ประเมินแล้ว</a>
          </div>
        </div>
        <div class="row" style="padding-top: 20px;">
          <div class="col-sm-12">
            <h3>รายการโครงการวิจัยที่รอการประเมิน</h3>
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full thfont f14">
              <thead>
                  <tr>
                      <th class="text-center w-10">รหัส</th>
                      <th>ชื่อโครงการ</th>
                      <th class="hidden-xs w-10 ">ฉบับที่</th>
                      <th class="hidden-xs w-30 ">สถานะ</th>
                      <th class="" style="width: 10%;">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                require "datethai.php";


                $strSQL = "SELECT * from research as r
                inner join pm as m on r.id_pm = m.id_pm
                inner join prefix as p on p.id_prefix =m.id_prefix
                inner join year as  y on r.id_year = y.id_year
                inner join status_research as s on r.id_status_research = s.id_status_research
                INNER JOIN reviewer_seleted_by_ec d on r.id_rs = d.id_rs
                WHERE d.reviewer_id = '".$_SESSION['id']."'
                AND d.conf = '1'
                AND d.response_status IN ('1', '2')
                AND d.review_status = '0'
                ORDER BY d.sendding_date DESC";

                if($status==1){
                  $strSQL = "SELECT * from research as r
                  inner join pm as m on r.id_pm = m.id_pm
                  inner join prefix as p on p.id_prefix =m.id_prefix
                  inner join year as  y on r.id_year = y.id_year
                  inner join status_research as s on r.id_status_research = s.id_status_research
                  INNER JOIN reviewer_seleted_by_ec d on r.id_rs = d.id_rs
                  WHERE d.reviewer_id = '".$_SESSION['id']."'
                  AND d.conf = '1'
                  AND d.response_status IN ('1', '2', '3')
                  ORDER BY d.sendding_date DESC";
                }

                // echo $strSQL;
                $resultResearch = $db->select($strSQL, false,true);
                if($resultResearch){
                  foreach ($resultResearch as $value) {
                    $strDate = $value["sendding_date"];
                    ?>
                    <tr>
                        <td class="text-center" style="vertical-align: top;">
                          <?php
                          echo $value['code_apdu'];
                          ?>
                        </td>
                        <td class="" style="vertical-align: top;">
                          <?php  echo $value ["title_th"];?><br>
                          <span style="font-size: 0.8em;"><strong>วันที่ลงทะเบียน</strong> <?php echo DateThai($strDate);?></span>
                        </td>
                        <td class="hidden-xs text-center" style="vertical-align: top;"><?php  echo $value["ep"];?></td>
                        <?php
                          $strSQL = "SELECT * FROM date_meeting WHERE	md_id_rs = '".$value['id_rs']."'";
                          $resultDM = $db->select($strSQL,false,true);
                        ?>
                        <td class="hidden-xs text-center" style="vertical-align: top;">
                          <font color="red">
                          <?php
                          if($value['review_status']==1){
                            echo "ดำเนินการแล้ว";
                          }else{
                            if($value['response_status']==1){
                              echo "ผู้ทรงคุณวุฒิยินดีทำการพิจารณา และอยู่ระหว่างรอข้อเสนอแนะจากผู้ทรง ฯ <br> - กดปุ่ม เพิ่มลการพิจารณา เพื่อดาวโหลดแบบฟอร์มและให้ทำการประเมิน -";
                            }else if($value['response_status']==2){
                              echo "ผู้ทรงคุณวุฒิขอข้อมูลโครงการในรูปแบบเอกสาร";
                            }else if($value['response_status']==3){
                              echo "ผู้ทรงคุณวุฒิขอไม่พิจารณาโครงการวิจัย";
                            }
                          }
                          ?>


                        </td>
                        <td class="text-center" style="vertical-align: top;">
                            <div class="btn-group">


                              <?php
                              if($status==1){

                                if($value['response_status']==3){
                                  ?>
                                  <a href="javascript:refresh_comment('<?php echo $value["id_rs"];?>')" class="btn btn-xs btn-app-red btn-block" data-toggle="tooltip" title="ขอกลับไปพิจารณาโครงการ">ขอกลับไปพิจารณาโครงการ</a>
                                  <?php
                                }else{
                                  ?>
                                  <a href="comment_update.php?id_rs=<?php echo $value["id_rs"];?>" class="btn btn-xs btn-default btn-block" data-toggle="tooltip" title="แก้ไขข้อมูลการพิจารณา"><i class="fa fa-wrench"></i> แก้ไขผลการพิจารณา</a>
                                  <a href="javascript:delete_comment('<?php echo $value["id_rs"];?>')" class="btn btn-xs btn-app-red btn-block" data-toggle="tooltip" title="ลบผลการพิจารณา"><i class="fa fa-trash"></i> ลบผลการพิจารณา</a>
                                  <?php
                                }

                              }else{
                                ?>
                                <a href="comment_add.php?id_rs=<?php echo $value["id_rs"];?>" class="btn btn-xs btn-app-blue btn-block" data-toggle="modal" title="เพิ่มผลการพิจารณา"><i class="fa fa-commenting-o"></i> เพิ่มผลการพิจารณา</a>
                                <!-- <a href="#" class="btn btn-xs btn-app-red btn-block" data-toggle="modal" data-target="#modal-normal" title="ไม่พิจารณา" id="noCommentBtn" onclick="setValue('<?php //echo $value['id_rs']; ?>')"><i class="fa fa-close"></i> ไม่พิจารณา</a> -->
                                <a href="#" class="btn btn-xs btn-app-red btn-block" title="ไม่พิจารณา" id="noCommentBtn" onclick="setValue('<?php echo $value['id_rs']; ?>')"><i class="fa fa-close"></i> ไม่พิจารณา</a>
                                <?php

                              }
                              ?>

                            </div>
                        </td>
                    </tr>
                    <?php
                  }
                }

                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    <!--container-->
    <div class="thfont text-center">
      <hr>
      <?php include ("footer.php"); ?>
    </div>

    <!-- Normal Modal -->
    <div class="modal" id="modal-normal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <form class="js-validation-bootstrap form-horizontal" action="base_forms_validation.html" method="post">
                <div class="card-header bg-red bg-inverse">
                    <h4>รายงานการขอไม่พิจารณาโครงการวิจัย</h4>
                    <ul class="card-actions">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                        </li>
                    </ul>
                </div>
                <div class="card-block">

                    <div class="form-group" id="" style="display:none;">
                      <label class="col-md-4 control-label thfont" for="val-username">รหัสโครงการวิจัย <span class="text-red">**</span></label>
                      <div class="col-md-7">
                          <input class="form-control" type="text" id="val-id" name="val-id" placeholder="ระบุสาเหตุอื่นๆ..." readonly  />
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label thfont" for="val-username">กรุณาระบุสาเหตุ <span class="text-red">**</span></label>
                        <div class="col-md-7">
                          <label class="css-input css-radio css-radio-lg css-radio-danger m-r-sm thfont">
                            <input type="radio" name="radio-reason" id="ch1" value="0" checked /><span></span> ไม่ระบุ
                          </label><br>
                          <label class="css-input css-radio css-radio-lg css-radio-danger m-r-sm thfont">
                            <input type="radio" name="radio-reason" value="1" /><span></span> ไม่มีเวลา
                          </label><br>
                          <label class="css-input css-radio css-radio-lg css-radio-danger m-r-sm thfont">
                            <input type="radio" name="radio-reason" value="2" /><span></span> ไม่ตรงกับความเชี่ยวชาญ
                          </label><br>
                          <label class="css-input css-radio css-radio-lg css-radio-danger m-r-sm thfont">
                            <input type="radio" name="radio-reason"  value="3" /><span></span> ผลประโยชน์ทับซ้อน
                          </label><br>
                          <label class="css-input css-radio css-radio-lg css-radio-danger m-r-sm thfont">
                            <input type="radio" name="radio-reason" value="99" /><span></span> อื่นๆ
                          </label>
                        </div>
                    </div>

                    <div class="form-group" id="option_other" style="display:none;">
                      <label class="col-md-4 control-label thfont" for="val-username">ระบุสาเหตุอื่นๆ <span class="text-red">**</span></label>
                      <div class="col-md-7">
                          <input class="form-control" type="text" id="val-otherreason" name="val-otherreason" placeholder="ระบุสาเหตุอื่นๆ..." />
                      </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm btn-default thfont" type="button" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-sm btn-app-red thfont" type="submit"><i class="ion-checkmark"></i> บันทึกและส่งผล</button>
                </div>

                </form>
            </div>
        </div>
    </div>
    <!-- End Normal Modal -->

    <div class="app-ui-mask-modal"></div>

    <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
    <script src="../lib/assets/js/core/jquery.min.js"></script>
    <script src="../lib/assets/js/core/bootstrap.min.js"></script>
    <script src="../lib/assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="../lib/assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="../lib/assets/js/core/jquery.placeholder.min.js"></script>
    <script src="../lib/assets/js/app.js"></script>
    <script src="../lib/assets/js/app-custom.js"></script>

    <!-- Page JS Plugins -->
    <script src="../lib/assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- Page JS Code -->
    <script src="../lib/assets/js/pages/base_tables_datatables.js"></script>

    <script type="text/javascript">
      function setValue(id){
        swal({
          title: "คุณแน่ใจหรือไม่?",
          text: "คุณยืนยันหรือไม่ที่จะขอไม่พิจารณาโครงการวิจัยนี้!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        },
        function(){
          window.location = 'cannot_review.php?id_rs=' + id;
        });
      }

      function delete_comment(id){
        swal({
          title: "คุณแน่ใจหรือไม่?",
          text: "คุณยืนยันหรือไม่ที่จะลบผลการพิจารณานี้!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        },
        function(){
          $stage = $.post('../controller/delete-comment.php', {id_rs: id}, function(){});
          $stage.always(function(res){
            setTimeout(function(){
              window.location = './';
            }, 3000);
          });
        });
      }

      function refresh_comment(id){
        swal({
          title: "คุณแน่ใจหรือไม่?",
          text: "คุณยืนยันหรือไม่ที่จะขอกลับไปพิจารณาโครงการวิจัยนี้!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
        },
        function(){
          $stage = $.post('../controller/refresh-comment.php', {id_rs: id}, function(){});
          $stage.always(function(res){
            // console.log(res);
            setTimeout(function(){
              window.location = './';
            }, 3000);
          });
        });
      }

      $(function(){

        // $('#noCommentBtn').click(function(){
        //   $('#val-id').val()
        // });

        $("input[name=radio-reason]").click(function(){
          if($("input[name=radio-reason]:checked").val()=='99'){
            $('#option_other').show();
          }else{
            $('#option_other').hide();
            $('#val-otherreason').val('');
          }
        });

        $('.js-validation-bootstrap').submit(function(){
          $check = 0;
          $('#option_other').removeClass('has-error');

          if(($("input[name=radio-reason]:checked").val()=='99') && ($('#val-otherreason').val()=='')){
            $('#option_other').addClass('has-error');
            $check++;
          }

          if($check == 0){
            // swal({
            //   title: "Ajax request example",
            //   text: "Submit to run ajax request",
            //   type: "info",
            //   showCancelButton: true,
            //   closeOnConfirm: false,
            //   showLoaderOnConfirm: true,
            // },
            // function(){
            //   setTimeout(function(){
            //     swal("Ajax request finished!");
            //   }, 2000);
            // });

            swal({
              title: "คุณแน่ใจหรือไม่?",
              text: "คุณยืนยันหรือไม่ที่จะไม่พิจารณาโครงการวิจัยดังกล่าว!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ยืนยัน",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
            },
            function(){
              $stage = $.post('../controller/not-comment.php', {id_rs: $('#val-id').val(), cvalue: $("input[name=radio-reason]:checked").val(), ccause: $('#val-otherreason').val() }, function(){});
              $stage.always(function(res){
                console.log(res);
                setTimeout(function(){
                  location.reload();
                }, 4000);
              });
            });
            return false;
          }else{
            swal("เกิดข้อผิดพลาด!", "กรุณากรอกเหตุผลอื่นๆที่ไม่ขอทำการพิจารณาโครงการวิจัย!", "warning");
            return false;
          }
        });
      });
    </script>

</body>
</html>
