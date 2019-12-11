<?php
session_start();

if(isset($_SESSION['id'])){
  if ($_SESSION['id'] == "")
  {
      header("location:../index.php");
      exit();
  }
}else{
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

$pminfo = $result[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>:: สำหรับหัวหน้าโครงการ ::</title>
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
        <link rel="stylesheet" href="../lib/assets/js/plugins/datatables/jquery.dataTables.min.css" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="../lib/assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="../lib/assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="../lib/assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="../lib/assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="../lib/assets/css/app-custom.css" />


    </head>
    <body>

      <?php
      include "header.php";
      ?>

      <div class="container-fluid" style="padding-top: 20px;">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
							<div class="card-header card-sucess" style="padding-bottom: 0px; margin-borrom: 0px;">
								<h2 class="thfont text-left fw500" >แก้ไขข้อมูลส่วนตัว</h2>
							</div>
              <div class="card-block text-left">
								<div class="row">
                  <div class="col-sm-12 thfont">
                    <a href="#"><i class="fa fa-home"></i></a>
                    &nbsp;&nbsp;/&nbsp;&nbsp;
										แก้ไขข้อมูลส่วนตัว
                  </div>
                </div>
								<div class="row" style="padding-top: 0px;">
									<div class="col-sm-12">
										<!-- <hr class="custom-hr"> -->
                    <h4 class="thfont"  style="background: rgb(13, 138, 108); padding: 10px; color: rgb(255, 255, 255);">ขั้นตอนที่ 1 - กรอกข้อมูลส่วนตัวผู้ลงทะเบียน</h4>
                    <form class="js-validation-bootstrap form-horizontal" action="../controller/update-reviewerinfo.php" method="post">
                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="val-username">คำนำหน้าชื่อ (Prefix) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                          <select class="form-control" id="id_prefix" name="id_prefix">
                            <option value="">--- กรุณาเลือกคำนำหน้าชื่อ ---</option>
                            <?php
                            $strSQL = "SELECT * FROM prefix order by prefix_name asc";
                            $result = $db->select($strSQL,false,true);
                            if($result){
                              foreach ($result as $value) {
                                ?>
                                <option value="<?php echo $value['id_prefix'];?>" <?php if($pminfo['id_prefix']==$value['id_prefix']){ echo "selected";} ?>><?php echo $value['prefix_name'];?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-4 f14 thfont">
                          <a href="#" id="addmoreprefix" class="btn btn-app-cyan btn-custom thfont fw300" data-toggle="modal" data-target="#modal-addprefix"><i class="fa fa-plus"></i> เพิ่มคำนำหน้าชื่อ</a>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="name">ชื่อ (Name) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="name" name="name" placeholder="กรอกชื่อจริง ..." value="<?php echo $pminfo['name']; ?>" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="surname">นามสกุล (Surname) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="surname" name="surname" placeholder="กรอกนามสกุล ..." value="<?php echo $pminfo['surname']; ?>" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="val-username">ตำแหน่ง (Position) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                          <select class="form-control" id="id_personnel" name="id_personnel">
                            <option value="" selected="">--- กรุณาเลือกตำแหน่ง ---</option>
                            <?php
                            $strSQL = "SELECT * FROM types_personnel order by  id_personnel asc";
                            $result = $db->select($strSQL,false,true);
                            if($result){
                              foreach ($result as $value) {
                                ?>
                                <option value="<?php echo $value['id_personnel'];?>" <?php if($pminfo['id_personnel']==$value['id_personnel']){ echo "selected";} ?>  ><?php echo $value['personnel_name']; ?></option>
                                <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group" style="display:<?php if($pminfo['id_personnel']!='9'){ echo "none"; }?>;" id="otherposition">
                        <label class="col-md-3 control-label-left" for="val-username">ตำแหน่งประเภทอื่นๆ </label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="person_other" name="person_other" placeholder="กรุณาระบุชื่อตำแหน่ง ..." />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="val-username">สาขาที่เชี่ยวชาญ (Expertise) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                            <textarea class="form-control" id="expertise" name="expertise" rows="3" placeholder='กรอกสาขาเชี่ยวชาญ และคั่นด้วย comma ","'><?php echo $pminfo['expertise']; ?></textarea>
                        </div>
                        <div class="col-sm-4 f14 thfont" style="padding-top: 7px;">
                          <u><b>ตัวอย่าง</b></u> ระบาดวิทยา, จิตเวชเด็กและวัยรุ่น
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="tel_mobile">โทรศัพท์มือถือ (Mobile) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="tel_mobile" name="tel_mobile" placeholder="กรอกเฉพาะตัวเลข กรณีไม่มีข้อมูลให้ใส่ศูนย์ (0)" value="<?php echo $pminfo['tel']; ?>" />
                        </div>
                        <div class="col-sm-4 f14 thfont" style="padding-top: 7px;">
                          <u><b>ตัวอย่าง</b></u> 0854398543
                        </div>
                      </div>



                      <div class="form-group">
                        <label class="col-md-3 control-label-left" for="email">อีเมล์ (E-mail) <span class="text-red">**</span></label>
                        <div class="col-md-5">
                            <input class="form-control" type="text" id="email" name="email" placeholder="กรอก E-mail address ..." value="<?php echo $pminfo['email']; ?>" />
                        </div>
                      </div>




                      <div class="form-group">
                        <div class="col-md-12 text-center" style="padding-top: 30px;">
                          <input name="login" type="submit" value="บันทึก" class="btn btn-app-green btn-custom thfont">
                          <input name="reset" type="reset"  value="รีเซ็ต" class="btn btn-app-light btn-custom thfont">
                          <input type="hidden" name="hidAction" value="">
                        </div>
                      </div>

                    </form>
									</div>
									<!-- End col-sm-12 -->
								</div>
                <!-- End row -->
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
    <script src="../lib/assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../lib/assets/js/plugins/dropzonejs/dropzone.min.js"></script>

    <!-- Page JS Code -->
    <script src="../lib/assets/js/pages/updateinfo/base_forms_validation.js"></script>
		<script src="../lib/assets/js/pages/updateinfo/index.js"></script>

    <script type="text/javascript">
    $(function(){
      // jQuery
      // $("div#myFile").dropzone({ url: "controller/upload_picture.php" });
      // var myDropzone = new Dropzone("#a1", { url: "controller/upload_picture.php"});

      Dropzone.options.myFile = {
        acceptedFiles: 'application/pdf, .docx, .doc',
        maxFilesize: 10,
        init: function(){
          this.on("success", function(file) {
              var response = $.post('../controller/check_upload_file.php');
              response.always(function(res){
                $('#upload_response').html(res);
              });

              var response2 = $.post('../controller/check_upload_file2.php');
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
    });
    </script>

</body>
</html>

<!-- Top Modal -->
<div class="modal fade text-left" id="modal-adduniversity" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-top">
				<div class="modal-content">
						<div class="card-header bg-green bg-inverse">
								<h3 class="thfont fw300">เพิ่มข้อมูลมหาวิทยาลัย/สถาบัน</h3>
								<ul class="card-actions">
										<li>
												<button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
										</li>
								</ul>
						</div>
						<form class="js-validation-bootstrap-mini1 form-horizontal" method="post" onsubmit="return false;">
							<div class="card-block">
									<div class="form-group">
										<label class="col-md-3 control-label-left" for="val-uname1" style="padding-top: 0px;">ชื่อมหาวิทยาลัย/สถาบัน: <span class="text-red">**</span></label>
										<div class="col-md-8">
											<input class="form-control" type="text" id="val-uname1" name="val-uname1" placeholder="กรอกชื่อมหาวิทยาลัย/สถาบัน" />
										</div>
									</div>
							</div>
							<div class="modal-footer">
									<button class="btn btn-sm btn-default" type="button" id="closeBtnMedal1" data-dismiss="modal">Close</button>
									<button class="btn btn-sm btn-app" type="submit" ><i class="fa fa-floppy-o"></i> Save</button>
							</div>
						</form>

				</div>
		</div>
</div>
<!-- End Top Modal -->

<!-- Top Modal -->
<div class="modal fade text-left" id="modal-addfaculty" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top">
			<div class="modal-content">
					<div class="card-header bg-green bg-inverse">
							<h3 class="thfont fw300">เพิ่มข้อมูลคณะ</h3>
							<ul class="card-actions">
									<li>
											<button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
									</li>
							</ul>
					</div>
					<form class="js-validation-bootstrap-mini2 form-horizontal" method="post" onsubmit="return false;">
						<div class="card-block">
								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-uname2" style="padding-top: 0px;">ชื่อมหาวิทยาลัย/สถาบัน: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<select class="form-control" id="val-uname2" name="val-uname2">
											<option value="">--- กรุณาเลือกมหาวิทยาลัย ---</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-fname2" style="padding-top: 0px;">ชื่อคณะ: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" id="val-fname2" name="val-fname2" placeholder="กรอกชื่อคณะ" />
									</div>
								</div>
						</div>
						<div class="modal-footer">
								<button class="btn btn-sm btn-default" type="button" id="closeBtnMedal2" data-dismiss="modal">Close</button>
								<button class="btn btn-sm btn-app" type="submit" ><i class="fa fa-floppy-o"></i> Save</button>
						</div>
					</form>

			</div>
	</div>
</div>
<!-- End Top Modal -->

<!-- Top Modal -->
<div class="modal fade text-left" id="modal-adddepartment" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top">
			<div class="modal-content">
					<div class="card-header bg-green bg-inverse">
							<h3 class="thfont fw300">เพิ่มข้อมูลภาควิชา/หน่วยงาน</h3>
							<ul class="card-actions">
									<li>
											<button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
									</li>
							</ul>
					</div>
					<form class="js-validation-bootstrap-mini3 form-horizontal" method="post" onsubmit="return false;">
						<div class="card-block">
								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-uname3" style="padding-top: 0px;">ชื่อมหาวิทยาลัย/สถาบัน: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<select class="form-control" id="val-uname3" name="val-uname3">
											<option value="">--- กรุณาเลือกมหาวิทยาลัย ---</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-fname3" style="padding-top: 0px;">ชื่อคณะ: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<select class="form-control" id="val-fname3" name="val-fname3">
											<option value="">--- กรุณาเลือกคณะ ---</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-dname3" style="padding-top: 0px;">ชื่อภาควิชา/หน่วยงาน: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" id="val-dname3" name="val-dname3" placeholder="กรอกชื่อภาควิชา/หน่วยงาน" />
									</div>
								</div>

						</div>
						<div class="modal-footer">
								<button class="btn btn-sm btn-default" type="button" id="closeBtnMedal3" data-dismiss="modal">Close</button>
								<button class="btn btn-sm btn-app" type="submit" ><i class="fa fa-floppy-o"></i> Save</button>
						</div>
					</form>

			</div>
	</div>
</div>
<!-- End Top Modal -->

<div class="modal fade text-left" id="modal-adddepartment" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top">
			<div class="modal-content">
					<div class="card-header bg-green bg-inverse">
							<h3 class="thfont fw300">เพิ่มข้อมูลภาควิชา/หน่วยงาน</h3>
							<ul class="card-actions">
									<li>
											<button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
									</li>
							</ul>
					</div>
					<form class="js-validation-bootstrap-mini3 form-horizontal" method="post" onsubmit="return false;">
						<div class="card-block">
								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-uname3" style="padding-top: 0px;">ชื่อมหาวิทยาลัย/สถาบัน: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<select class="form-control" id="val-uname3" name="val-uname3">
											<option value="">--- กรุณาเลือกมหาวิทยาลัย ---</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-fname3" style="padding-top: 0px;">ชื่อคณะ: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<select class="form-control" id="val-fname3" name="val-fname3">
											<option value="">--- กรุณาเลือกคณะ ---</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-dname3" style="padding-top: 0px;">ชื่อภาควิชา/หน่วยงาน: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" id="val-dname3" name="val-dname3" placeholder="กรอกชื่อภาควิชา/หน่วยงาน" />
									</div>
								</div>

						</div>
						<div class="modal-footer">
								<button class="btn btn-sm btn-default" type="button" id="closeBtnMedal3" data-dismiss="modal">Close</button>
								<button class="btn btn-sm btn-app" type="submit" ><i class="fa fa-floppy-o"></i> Save</button>
						</div>
					</form>

			</div>
	</div>
</div>
<!-- End Top Modal -->

<div class="modal fade text-left" id="modal-addprefix" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top">
			<div class="modal-content">
					<div class="card-header bg-green bg-inverse">
							<h3 class="thfont fw300" >เพิ่มคำนำหน้าชื่อ</h3>
							<ul class="card-actions">
									<li>
											<button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
									</li>
							</ul>
					</div>
					<form class="js-validation-bootstrap-mini4 form-horizontal" method="post" onsubmit="return false;">
						<div class="card-block">

								<div class="form-group">
									<label class="col-md-3 control-label-left" for="val-prefix4" style="padding-top: 7px;">คำนำหน้าชื่อ: <span class="text-red">**</span></label>
									<div class="col-md-8">
										<input class="form-control" type="text" id="val-prefix4" name="val-prefix4" placeholder="กรอกคำนำหน้าชื่อ" />
									</div>
								</div>

						</div>
						<div class="modal-footer">
								<button class="btn btn-sm btn-default" type="button" id="closeBtnMedal4" data-dismiss="modal">Close</button>
								<button class="btn btn-sm btn-app" type="submit" ><i class="fa fa-floppy-o"></i> Save</button>
						</div>
					</form>

			</div>
	</div>
</div>
<!-- End Top Modal -->
