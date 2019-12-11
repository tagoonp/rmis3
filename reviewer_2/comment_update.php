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

$strSQL = sprintf("SELECT * FROM comment WHERE id_rs = '%s' AND id_reviewer = '%s'", mysql_real_escape_string($_GET['id_rs']), mysql_real_escape_string($_SESSION['id']));
$resultComment = $db->select($strSQL,false,true);

if(!$resultComment){
    $db->disconnect();
    header('Location: ./');
    die();
}

$strSQL = sprintf("SELECT * FROM temp_file_comment_response WHERE tf_confirm_id = '%s' ORDER BY tf_id DESC", mysql_real_escape_string($_GET['id_rs']));
$resultFileupload = $db->select($strSQL,false,true);
// echo $strSQL;

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
								<h2 class="thfont text-left fw500">แบบประเมินโครงการวิจัย</h2>
							</div>
              <div class="card-block text-left">
                <div class="row">
                  <div class="col-sm-6">
                    <a href="Javascript:location = './'" class="btn btn-app-green thfont f16"><i class="fa fa-home"></i></a>

                    <a href="print_rs.php?id_rs=<?php print $_GET['id_rs']; ?>" target="_blank" class="btn btn-app-blue thfont f16"><i class="fa fa-print"></i> พิมพ์ข้อมูลโครงการ</a>
                  </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-12">
                    <h3>1. ข้อมูลโครงการวิจัย</h3>
                    <hr>
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

                        <tr style="display:none;">
                          <td class="fw500">
                            รหัสโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <div class="form-group">
                              <input type="text" name="id_session" id="id_session" readonly value="<?php if($resultFileupload){ echo $resultFileupload[0]['tf_session_id']; }else{ echo session_id();} ?>">
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500">
                            รหัสโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <?php
                            if($result[0]['code_apdu']==''){
                              echo $result[0]["year_name"]."-".$result[0]["ord_id"]."-".$result[0]["id_dept"]."-".$result[0]["id_personnel"]. " <br>[Generate by system]";
                            }else{
                              echo $result[0]['code_apdu']. " <br>[Generate by APDU]";
                            }
                            ?>

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

                        <tr>
                          <td class="fw500">
                            หัวหน้าโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <?php   echo $result[0]["prefix_name"];?>
                            <?php   echo $result[0]["name"];?>
                            &nbsp;<?php   echo $result[0]["surname"];?>
                            <br>
                            <?php
                              if ($result[0]["dept_name"]=="19"){
                                echo"";
                              }
                            ?>
                            <?php   if ($result[0]["status"]=="3"){
                            echo"คณะแพทยศาสตร์&nbsp;มหาวิทยาลัยสงขลานครินทร์";
                            }
                            else if ($result[0]["status"]=="2")
                            { echo $dept; }
                            else{ echo""; }
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="30%">
                            คำสำคัญ
                          </td>
                          <td style="padding-left: 10px;">
                            <?php  print $result[0]["keywords_th"];?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="30%">
                            Keywords
                          </td>
                          <td style="padding-left: 10px;">
                            <?php  print $result[0]["keywords_en"];?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            ประเภทของการวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php  print $result[0]["type_name"];?>
                          </td>
                        </tr>
                        <tr>
                          <td class="fw500" width="20%">
                            ระยะเวลาโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            วันที่เริ่มต้น:&nbsp;<?php   echo $result[0]["start_date"];?>&nbsp;
                            วันที่สิ้นสุด:&nbsp;
                            <?php  print $result[0]["finish_date"];?>
                            <?php
                            ####### รูปแบบของวันที่ ที่อาจจะเก็บลงในฐานข้อมูลแบบนี้ ######
                            $start_date=$result[0]["start_date"]; // วันที่เริ่มใช้บริการ
                            $expire_date=$result[0]["finish_date"];//วันสิ้นสุดการใช้บริการ
                            $today_date=date("d-m-Y ");//วันที่ของวันนี้

                            $start_explode = explode("-", $start_date);
                            $start_day = $start_explode[0];
                            $start_month = $start_explode[1];
                            $start_year = $start_explode[2];

                            $expire_explode = explode("-", $expire_date);
                            $expire_day = $expire_explode[0];
                            $expire_month = $expire_explode[1];
                            $expire_year = $expire_explode[2];

                            $today_explode = explode("-", $today_date);
                            $today_day = $today_explode[0];
                            $today_month = $today_explode[1];
                            $today_year = $today_explode[2];

                            $start = GregorianToJD($start_month,$start_day,$start_year);
                            $expire = GregorianToJD($expire_month,$expire_day,$expire_year);


                            $period_of_time  = $expire-$start; //หาระยะเวลาการใช้งาน
                            $date_current= $expire-date('Y-m-d');//หาวันที่เหลืออยู่
                            echo "&nbsp;จำนวนวัน:&nbsp;$period_of_time&nbsp;วัน";
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            งบประมาณทั้งโครงการ
                          </td>
                          <td style="padding-left: 10px;">
                            <?php   $num = $result[0]["budget"]; echo number_format($num,0,".",",");?> บาท
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500">ทุนวิจัย</td>
                          <td style="padding-left: 10px;">
                            <?php
                            if($result[0]['ts0']==1){
                              echo "มีทุนวิจัยจากแหล่งทุน";
                            }else{
                              echo "เป็นโครงการที่ไม่ได้ขอทุนวิจัยจากแหล่งทุนใดๆ";
                            }
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            กลุ่มแหล่งทุนวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php   if($result[0]["ts1"]=='1'){echo "กองทุนคณะแพทยศาสตร์ ";}?>
                            <?php   if($result[0]["ts6"]=='1'){ echo "เงินรายได้มหาวิทยาลัย";}?>
                            <?php   if($result[0]["ts2"]=='1'){ echo "ทุนงบประมาณแผ่นดิน";}?>
                            <?php   if($result[0]["ts3"]=='1'){ echo "แหล่งทุนภายในประเทศ";}?>
                            <?php   if($result[0]["ts4"]=='1'){ echo "แหล่งทุนภายนอกประเทศ";}?>
                            <?php   if($result[0]["ts5"]=='1'){ echo $result[0]["other_funds"];}?>
                            <?php if(($result[0]["ts1"]=='0') && ($result[0]["ts2"]=='0') && ($result[0]["ts3"]=='0') && ($result[0]["ts4"]=='0') && ($result[0]["ts5"]=='0') && ($result[0]["ts6"]=='0')){
                              echo "-";
                            } ?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            ชื่อแหล่งทุนวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php  print $result[0]["source_funds"];?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            ผู้ร่วมวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php
                            $strSQL = "SELECT * FROM temp_team_research a INNER JOIN prefix b on a.id_prefix=b.id_prefix WHERE a.tmp_id_rs = '".$_GET['id_rs']."' AND a.tmp_id_pm = '".$result[0]['id_pm']."'";
                            $resultCopi = $db->select($strSQL,false,true);
                            if($resultCopi){
                              foreach($resultCopi as $v){
                                print $v['prefix_name']." ".$v['name']." ".$v['surname']."<br>";
                              }
                            }else{
                              print "-";
                            }
                            ?>
                          </td>
                        </tr>

                        <tr>
                          <td class="fw500" width="20%">
                            ไฟล์แบบเสนอโครงการวิจัย
                          </td>
                          <td style="padding-left: 10px;">
                            <?php
                            $strSQL = "SELECT * FROM temp_file_research_add WHERE tf_confirm_id = '".$_GET['id_rs']."'";
                            $resultFile = $db->select($strSQL,false,true);
                            if($resultFile){
                              foreach($resultFile as $v) {
                                ?>
                                <li><a href="../tmp_file/<?php print $v['tf_name'];?>"><?php print $v['tf_name'];?></a></li>
                                <?php
                              }
                            }else{
                              echo "ไม่พบไฟล์แนบ";
                            }
                            ?>
                          </td>
                        </tr>



                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-12">

                        <h3>2. แบบฟอร์มสำหรับผู้ทรงคุณวุฒิใช้ประเมิน</h3>
                        <hr>
                        <div class="row">
                          <div class="col-sm-12 text-left">
                            <?php
                            $strSQL = "SELECT * FROM submit_feedback WHERE id_reviewer = '".$_SESSION['id']."' AND id_rs = '".$_GET['id_rs']."'";
                            $result = $db->select($strSQL,false,true);

                            if($result[0]['form_download']==''){
                              echo "ไม่มีแบบฟอร์มประเมิน กรุณาลบรายการนี้แล้วเลือกผู้ทรงคุณวุฒิใหม่";
                            }else{
                              $arr = explode(',', $result[0]['form_download']);
                              // $cd = 1;
                              foreach ($arr as $v) {
                                $strSQL = "SELECT * FROM reviwer_form WHERE form_id = '".$v."'";
                                $resultForm = $db->select($strSQL,false,true);
                                if($resultForm){
                                  ?>
                                  <a href="../file_apdu/template/<?php echo $resultForm[0]['form_name'];?>" class="btn btn-app-blue" style="margin-bottom: 10px;" target="_blank" ><i class="fa fa-download"></i> <?php echo $resultForm[0]['form_desc'];?></a><br>
                                  <?php
                                }
                                // $cd++;
                              }
                            }
                            ?>
                          </div>
                        </div>
                  </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                  <div class="col-sm-12">

                        <h3>3. อัพโหลดผลการประเมินของท่าน นามสกุล .doc .docx</h3>
                        <hr>

                        <form class="dropzone" action="../controller/upload_file_comment_response_by_id.php?id_rs=<?php echo $_GET['id_rs'];?>&ssid=<?php if($resultFileupload){ echo $resultFileupload[0]['tf_session_id']; }else{ echo session_id();} ?>" id="myFile"></form>

                        <form class="js-validation-bootstrap form-horizontal" action="../controller/update_comment.php?id_rs=<?php echo $_GET['id_rs'];?>" method="post" style="padding-top: 20px;">

                          <div class="row">


                            <div class="col-sm-9">
                              <div class="form-group">
                                <label class="col-md-12 thfont" for="val-username">ไฟล์ที่อัพโหลดแล้ว :</label>

                                <div class="col-md-12">
                                  <div class="thfont">
                                    <span id="upload_response">ไม่มีไฟล์อัพโหลด</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-3">

                              <div class="form-group">
                                <label class="col-md-12 thfont" for="val-username">จำนวนไฟล์ที่อัพโหลดแล้ว : </label>

                                <div class="col-md-12">
                                  <input type="text" class="form-control" name="numFile" id="numFile" value="0" readonly="">
                                </div>
                              </div>
                            </div>

                          </div>
                          <div class="form-group">
                            <label class="col-md-12 thfont" for="val-username">ความคิดเห็นเพิ่มเติม :</label>

                            <div class="col-md-12">
                              <textarea name="brief_reports" id="brief_reports" ><?php echo $resultComment[0]['detail']; ?></textarea>
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

    $(document).ready(function(){
      loadAttechfile();
    });

    function loadAttechfile(){
      var response = $.post('../controller/check_file_comment_response_by_id.php', {id: $('#id_rs').val(), session_id: $('#id_session').val() }, function(){});
      response.always(function(res){
        $('#upload_response').html(res);
        console.log(res);
      });

      var response2 = $.post('../controller/check_file_comment_response2_by_id.php', {id: $('#id_rs').val(), session_id: $('#id_session').val() }, function(){});
      response2.always(function(res){
        $('#numFile').val(res);

        if(res!=0){
          $('.dropzone').css('border-color', '#ccc');
        }
      });
    }

    function delete_tempfile_response(fid){
      // alert(fid);
      $.post('../controller/delete_file_comment_response.php', {file_id: fid});
      loadAttechfile();
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
                        loadAttechfile();
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
