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
    .commentPane{
      padding: 10px;
      background: rgb(244, 244, 244);
      margin-top: 5px;
      color: rgb(60, 60, 60);
      font-size: 0.8em;
      border: dashed;
      border-width: 1px;
      border-color: rgb(3, 120, 116);
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
            <button class="btn btn-success"  onclick="printForm('printArea')"><i class="fas fa-print mr-10"></i>พิมพ์ผลการประเมิน</button>
          </div>
          <div class="col-sm-12 mb-10">
            <div class="card mb-10">
              <div class="card-body" id="printArea">

                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="fw500 text-center">แบบประเมินโครงการวิจัยทางสังคมศาสตร์/พฤติกรรมศาสตร์<br><small>Assessment Form For Social/Behavioral Protocol (Initial Review)</small></h3>
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
                              <div class="general_comment"style="margin-top: 10px; padding: 20px; border: dashed; border-color: rgb(130, 130, 130); color: #000; border-width: 1px;">-</div>
                          </div>
                        </div>
                      </div>

                      <div class="table-responsive_">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" class="form-control dn" name="q_assesment_id_bio" id="q_assesment_id_bio">
                          </div>
                        </div>
                        <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 2</span> :: กรุณาคลิกเพื่อทำเครื่องหมายในแต่ละข้อคำถามให้ครบถ้วน <span class="text-danger">** </span></label>
                        <table class="table table-bordered">
                          <thead>
                            <tr style="background: rgb(19, 161, 114);">
                              <th class="txt-light">ข้อ</th>
                              <th class="txt-light">หัวข้อการประเมินที่เกี่ยวกับโครงการวิจัย</th>
                              <th class="txt-light">เหมาะสม</th>
                              <th class="txt-light">ควรปรับปรุง</th>
                              <th class="txt-light">ไม่เกี่ยวข้อง</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td id="e1">วัตถุประสงค์และเหตุผลในการทำวิจัย </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio01-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio01-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td id="e2">ระเบียบวิธีวิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio02-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio02-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td id="e3">ขนาดของตัวอย่างและการแบ่งกลุ่มตัวอย่าง</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio03-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio03-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td id="e4">ขั้นตอนการปฏิบัติตัวของอาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio04-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio04-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td id="e5">การวัดผลการวิจัยสอดคล้องกับวัตถุประสงค์</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio05-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio05-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td id="e6">อาสาสมัครได้รับประโยชน์จากการเข้าร่วมการวิจัยโดยตรง </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio06-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio06-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td id="e7">ชุมชนที่อาสาสมัครเข้าร่วมการวิจัยได้รับประโยชน์จากการวิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio07-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio07-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio07-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td id="e8">อาสาสมัครมีความเสี่ยงต่อจิตใจ ชื่อเสียง สังคม เศรษฐกิจ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio08-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio08-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio08-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td id="e9">ผลกระทบต่อชุมชนที่อาสาสมัครเข้าร่วมการวิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio09-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio09-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio09-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td colspan="4">อาสาสมัครเป็นกลุ่มเปราะบาง/อ่อนแอ (vulnerable group)</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e10">10.1 กลุ่มที่มีความเสี่ยงสูง เช่น หญิงตั้งครรภ์ ผู้ป่วยวิกฤตหรือระยะสุดท้าย ทารก</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio010-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio010-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio010-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e11">10.2 กลุ่มที่ไม่สามารถให้การยินยอมด้วยตนเอง เช่น ผู้ป่วยหลงลืมหรือจิตฟั่นเฟือน ผู้ป่วยหมดสติ ผู้เยาว์</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio011-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio011-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio011-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e12">10.3 กลุ่มที่อาจไม่มีอิสระเพียงพอในการตัดสินใจ เช่น ผู้ต้องโทษ ทหารเกณฑ์ นักเรียน นักศึกษา พนักงานขององค์กรที่ทำวิจัย ฯลฯ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio012-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio012-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio012-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e13">10.4 กลุ่มที่ไม่ประสงค์จะเปิดเผยตัว เช่น หญิงบริการ ผู้ติดสุราหรือสารเสพติด ผู้ป่วยโรคติดต่อร้ายแรง</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio013-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio013-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio013-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>11</td>
                              <td id="e14">มีมาตรการเพียงพอที่จะป้องกันไม่ให้เกิดความเสี่ยงต่ออาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio014-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio014-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio014-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td id="e15">มีมาตรการเพียงพอที่จะปกป้องความลับของอาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio015-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio015-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio015-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td id="e16">มีกระบวนการขอคำยินยอมที่ถูกต้องและเหมาะสม </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio016-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio016-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio016-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td id="e17">ความเป็นอิสระในการตัดสินใจของกลุ่มตัวอย่าง</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio017-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio017-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio017-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>15</td>
                              <td id="e18">เอกสารคำชี้แจงใช้ภาษาที่เหมาะสมกับระดับความเข้าใจอาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio018-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio018-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio018-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>16</td>
                              <td colspan="4">เอกสารคำชี้แจงมีรายละเอียดเพียงพอแก่การตัดสินใจของอาสาสมัคร</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e19">16.1 วัตถุประสงค์</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio019-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio019-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio019-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e20">16.2 ขั้นตอนการปฏิบัติตัว</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio020-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio020-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio020-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e21">16.3 ประโยชน์ที่อาสาสมัครจะได้รับ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio021-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio021-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio021-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e22">16.4 ความเสี่ยงต่อชื่อเสียง หน้าที่การงาน ความไม่สะดวก</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio022-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio022-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio022-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e23">16.5 การป้องกันความลับ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio023-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio023-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio023-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e24">16.6 ค่าใช้จ่ายในการเดินทางและค่าตอบแทนเสียเวลา</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio024-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio024-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio024-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e25">16.7  ความเป็นอิสระในการตัดสินใจ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio025-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio025-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio025-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e26">16.8  ชื่อที่อยู่และเบอร์โทรศัพท์ติดต่อผู้วิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio026-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio026-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio026-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td id="e27">16.9  ที่อยู่ โทรศัพท์ e-mail ติดต่อคณะกรรมการจริยธรรมการวิจัยฯ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio027-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio027-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio027-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>17</td>
                              <td id="e28">เอกสารคำยินยอมมีเนื้อหาเหมาะสม (หากให้อาสาสมัครลงนาม)</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio028-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio028-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio028-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>18</td>
                              <td id="e29">ประวัติการอบรมจริยธรรมการวิจัยของผู้วิจัยและผู้ร่วมโครงการวิจัย </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio029-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio029-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio029-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>19</td>
                              <td id="e30">Conflict of interest</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio030-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio030-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio030-99">

                                </span>
                              </td>
                            </tr>

                          </tbody>
                        </table>
                      </div>

                      <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 3</span> :: โดยสรุป ท่านเห็นชอบกับกระบวนการขอความยินยอมจากอาสาสมัครหรือไม่ <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>
                              <span class="radio042-1">

                              </span>
                            </td>
                            <td>มีความเสี่ยงไม่เกินความเสี่ยงเล็กน้อย (minimal risk) </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="radio042-2">

                              </span>
                            </td>
                            <td>มีความเสี่ยงเกินกว่าความเสี่ยงเล็กน้อย แต่มีประโยชน์ต่อตัวอาสาสมัครโดยตรง  </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="radio042-3">

                              </span>
                            </td>
                            <td>มีความเสี่ยงเกินกว่าความเสี่ยงเล็กน้อย และไม่มีประโยชน์ต่อตัวอาสาสมัครโดยตรง แต่มีความเป็นไปได้ที่จะได้รับความรู้เกี่ยวกับโรคหรือสภาวะที่อาสาสมัครเป็น </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="radio042-4">

                              </span>
                            </td>
                            <td>มีความเสี่ยงและประโยชน์ไม่ตรงกับที่กล่าวมาแล้วทั้งสามข้อ แต่อาจมีโอกาสที่จะเข้าใจ หรือป้องกันหรือบรรเทาปัญหาร้ายแรงที่กระทบสุขภาพและความเป็นอยู่ที่ดีของอาสาสมัคร</td>
                          </tr>
                          <tr>
                            <td>
                              <span class="radio042-5">

                              </span>
                            </td>
                            <td>ข้อมูลยังไม่เพียงพอที่จะประเมินประเภทความเสี่ยง</td>
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
    <script src="../v4/ec.js"></script>

    <script type="text/javascript" src="../v4/node_modules/preload.js/dist/js/preload.js"></script>
    <script type="text/javascript" src="../v3/vendors/bower_components/ckeditor_lite/ckeditor.js"></script>

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
      var reviewer_uid = <?php echo $_GET['id_reviewer']; ?>

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

        ec.init()
        ec.load_rs_info_2();

        loadSocialInfo()

        setTimeout(function(){
          preload.hide()
        }, 1000)

      })

      $(function(){

      })

      function loadSocialInfo(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }
        var jxr = $.post(ws_url + 'controller/reviewer/loadCommentDraft_social.php', param, function(){}, 'json')
                   .always(function(snap){
                     if((snap != '') && (snap.length > 0)){
                       $c = 0
                       snap.forEach(function(i){
                         $('.general_comment').html(i.efs_gc)
                         $('.radio01-' + i.efb_1).html('<i class="far fa-check-circle text-danger"></i>')

                        $('.radio01-' + i.efs_1).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio02-' + i.efs_2).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio03-' + i.efs_3).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio04-' + i.efs_4).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio05-' + i.efs_5).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio06-' + i.efs_6).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio07-' + i.efs_7).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio08-' + i.efs_8).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio09-' + i.efs_9).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio010-' + i.efs_10).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio011-' + i.efs_11).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio012-' + i.efs_12).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio013-' + i.efs_13).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio014-' + i.efs_14).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio015-' + i.efs_15).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio016-' + i.efs_16).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio017-' + i.efs_17).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio018-' + i.efs_18).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio019-' + i.efs_19).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio020-' + i.efs_20).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio021-' + i.efs_21).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio022-' + i.efs_22).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio023-' + i.efs_23).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio024-' + i.efs_24).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio025-' + i.efs_25).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio026-' + i.efs_26).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio027-' + i.efs_27).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio028-' + i.efs_28).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio029-' + i.efs_29).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio030-' + i.efs_30).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio042-' + i.efs_42).html('<i class="far fa-check-circle text-danger"></i>')
                       })
                       preload.hide()
                     }else{
                       preload.hide()
                       console.log('No social draft info ...');
                     }
                   })
                   .fail(function(){ preload.hide() })

                   for (var i = 1; i <= 42; i++) {
                     checkUncomment_social_not_fit(i, true)
                   }
      }

    </script>

  </body>
</html>
