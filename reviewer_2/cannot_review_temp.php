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
      include "header.php";

      $strSQL = "SELECT * from research as r
      inner join year            as  y on r.id_year  = y.id_year
      inner join pm              as  m on r.id_pm    = m.id_pm
      inner join prefix          as  x on m.id_prefix   = x.id_prefix
      inner join dept            as  d on m.id_dept  = d.id_dept
      inner join type_research   as  t on r.id_type     = t.id_type
      inner join status_research as  s on r.id_status_research = s.id_status_research
      WHERE id_rs = '".$_GET["id_rs"]."'";
      $result = $db->select($strSQL,false,true);

      if(!$result){
      	header("location:../index.php");
      	exit();
      }
      require "datethai.php";
      $dept = $result[0]["dept"];
      $strDate = $result[0]["date_submit"];
      ?>

      <div class="container-fluid" style="padding-top: 20px;">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
							<div class="card-header card-sucess">
								<h2 class="thfont text-left fw500">แบบฟอร์มขอไม่ประเมินโครงการวิจัยประเมินโครงการวิจัย</h2>
							</div>
              <div class="card-block text-left">
                <div class="row">
                  <div class="col-sm-6">
                    <a href="Javascript:location = './'" class="btn btn-app-green thfont f16"><i class="fa fa-home"></i></a>
                  </div>
                  <div class="col-sm-6 text-right">
                    <a href="Javascript:location = './comment_add.php?id_rs=<?php echo $_GET['id_rs'];?>'" class="btn btn-app-blue thfont f16">เลือกพิจารณาโครงการนี้</a>
                  </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-12">
                    <h3>1. ข้อมูลโครงการวิจัย</h3>
                    <table class="table table-condensed table-bordered thfont f14">
                      <tbody>
                        <tr style="display:none;">
                          <td class="fw500">
                            รหัสโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <div class="form-group">
                              <input type="text" name="id_rs" id="id_rs" readonly value="<?php echo $_GET['id_rs'];?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw500">
                            รหัสโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <strong style="color: rgb(6, 205, 163);"><?php
                            echo $result[0]['code_apdu'];
                            ?></strong>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            วันที่ลงทะเบียนงานวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php echo DateThai($strDate);?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500">
                            ชื่อโครงการ (ภาษาไทย)
                          </td>
                          <td style="padding-left: 10px;">
                            <?php echo $result[0]["title_th"];?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500">
                            ชื่อโครงการ (ภาษาอังกฤษ)
                          </td>
                          <td style="padding-left: 10px;">
                            <?php echo $result[0] ["title_en"];?>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>


                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-12">

                        <h3>2. เหตุผลการขอไม่พิจารณา</h3>
                        <form class="js-validation-bootstrap form-horizontal" action="../controller/add_comment.php?id_rs=<?php echo $_GET['id_rs'];?>" method="post" style="padding-top: 20px;">

                          <div class="row">
                            <div class="col-sm-3 thfont">
                              <strong>เหตุผลการไม่ขอพิจารณา : <span class="text-red">**</span></strong>
                              <div class="" style="font-size: 0.8em;">
                                กรุณาเลือกเหตุผลในการที่ท่านไม่พิจารณาโครงการวิจัยนี้
                              </div>
                            </div>
                            <div class="col-sm-9 thfont">
                              <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                								<input type="radio" name="radio-group12" /><span></span> ไม่มีเวลา
                							</label><br>
                              <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                								<input type="radio" name="radio-group12" /><span></span> ไม่ตรงกับความเชี่ยวชาญ
                							</label><br>
                              <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                								<input type="radio" name="radio-group12" /><span></span> ผลประโยชน์ทับซ้อน
                							</label><br>
                              <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                								<input type="radio" name="radio-group12" /><span></span> อื่น ๆ
                							</label><br>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 thfont" for="val-username">ความคิดเห็นเพิ่มเติม :</label>

                            <div class="col-md-12">
                              <textarea name="brief_reports" id="brief_reports" ></textarea>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-md-12 text-center">
                              <button type="submit" name="button" class="btn btn-app thfont"><i class="fa fa-save"></i> บันทึกและส่ง</button>

                            </div>
                          </div>

                        </form>
                  </div>
                </div>





              </div>
            </div>
          </div>
        </div>
      </div>

    <!--container-->
    <div class="thfont text-center">
      <?php include ("footer.php"); ?>
    </div>


    <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
    <script src="../lib/assets/js/core/jquery.min.js"></script>
    <script src="../lib/assets/js/core/bootstrap.min.js"></script>
    <script src="../lib/assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="../lib/assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="../lib/assets/js/core/jquery.placeholder.min.js"></script>
    <script src="../lib/assets/js/app.js"></script>
    <script src="../lib/assets/js/app-custom.js"></script>

		<!-- Page JS Plugins -->

    <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
    <!-- <script src="../lib/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script> -->
    <!-- Page JS Code -->
    <!-- <script src="../lib/assets/js/pages/base_tables_datatables.js"></script> -->
    <script src="../lib/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../lib/assets/js/plugins/dropzonejs/dropzone.min.js"></script>

		<script src="../lib/sweetalert/dist/sweetalert.min.js"></script>

    <script>

    function delete_tempfile_response(fid){
      $.post('../controller/delete_file_comment_response.php', {file_id: fid});
      var response = $.post('../controller/check_file_comment_response.php');
      response.always(function(res){
        $('#upload_response').html(res);
        console.log(res);
      });

      var response2 = $.post('../controller/check_file_comment_response2.php');
      response2.always(function(res){
        $('#numFile').val(res);

        if(res!=0){
          $('.dropzone').css('border-color', '#ccc');
        }
      });
    }

            $(function()
            {
                // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
                // App.initHelpers( ['select2']);
                Dropzone.options.myFile = {
                  acceptedFiles: '.docx, .doc',
                  maxFilesize: 100,
                  init: function(){
                    this.on("success", function(file) {
                        var response = $.post('../controller/check_file_comment_response.php');
                        response.always(function(res){
                          $('#upload_response').html(res);
                          console.log(res);
                        });

                        var response2 = $.post('../controller/check_file_comment_response2.php');
                        response2.always(function(res){
                          $('#numFile').val(res);

                          if(res!=0){
                            $('.dropzone').css('border-color', '#ccc');
                          }
                        });
                    });

                    this.on("complete", function(file) {
                      this.removeFile(file);
                    });
                  }
                };

                CKEDITOR.replace( 'brief_reports', {
          			    // on: {
          			    //     instanceReady: function() {
          			    //         // alert( this.name ); // 'editor1'
          			    //     },
                    //
                    //     contentDom: function(e){
                    //       e.editor.document.on('keyup', function(evt) {
                    //           // keyup event in ckeditor
                    //           // console.log(e.editor.getData());
                    //           // console.log(CKEDITOR.brief_reports.getData());
                    //           if(e.editor.getData()!=''){
                    //             dolog('1');
                    //           }else{
                    //             dolog('');
                    //           }
                    //       });
                    //     }
                    //
          			    // }
          			} );
            });
        </script>
</body>
</html>
