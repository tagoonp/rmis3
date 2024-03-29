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
            <button class="btn btn-success" onclick="printForm('printArea')"><i class="fas fa-print mr-10"></i>พิมพ์ผลการประเมิน</button>
          </div>
          <div class="col-sm-12 mb-10">
            <div class="card mb-10">
              <div class="card-body" id="printArea">

                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="fw500 text-center">แบบประเมินโครงการวิจัยทางชีวการแพทย์ (ทบทวนครั้งแรก)<br><small>Assessment Form For Biomedical Protocol (Initial Review)</small></h3>
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
                            <tr style="background: rgb(128, 128, 128);">
                              <td class="txt-light">A</td>
                              <td colspan="4" class="txt-light">Scientific value</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td id="e1">หลักการและเหตุผล (Rationale) </td>

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
                              <td id="e2">การทบทวนวรรณกรรมที่เกี่ยวข้อง (Literature review)</td>
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
                              <td id="e3">วัตถุประสงค์ (Objective)  </td>
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
                              <td id="e4">รูปแบบการวิจัย (Study design) </td>
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
                              <td id="e5">กลุ่มประชากรที่ศึกษา (Study population)</td>
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
                              <td id="e6">ขนาดตัวอย่าง (Sample size) </td>
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
                              <td id="e7">การคัดเลือกอาสาสมัครที่เข้าโครงการ (Inclusion criteria)</td>
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
                              <td id="e8">การคัดอาสาสมัครออกจากโครงการวิจัย (Exclusion criteria) </td>
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
                              <td id="e9">การถอนอาสาสมัครออกจากโครงการ (Withdrawal criteria)</td>
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
                              <td id="e10">การใช้อาสาสมัครกลุ่มเปราะบาง (Vulnerable subject)</td>
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
                              <td>11</td>
                              <td id="e11">การแบ่งกลุ่มอาสาสมัคร (Randomization)</td>
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
                              <td>12</td>
                              <td id="e12">เครื่องมือหรือวิธีทดสอบที่ใช้ในการวิจัย (Study tool)</td>
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
                              <td>13</td>
                              <td id="e13">การใช้กลุ่มควบคุมหรือยาหลอก (Control/placebo)</td>
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
                              <td>14</td>
                              <td id="e14">วิธีการวัดผลการวิจัย (Outcome measure)</td>
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
                              <td>15</td>
                              <td id="e15">มาตรการเฝ้าระวังผลแทรกซ้อนและการแก้ไข (Adequate safety monitoring and rescue plan) </td>
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
                              <td>16</td>
                              <td id="e16">จำนวนและปริมาณของเลือดหรือสิ่งส่งตรวจ (Biological samples amount)</td>
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
                              <td>17</td>
                              <td id="e17">ระยะเวลา/จำนวนครั้งของการติดตาม (Number of visits)</td>
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
                              <td>18</td>
                              <td id="e18">สถิติที่ใช้ในการวิเคราะห์ (Statistical analysis)</td>
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
                            <tr style="background: rgb(128, 128, 128);">
                              <td class="txt-light">B</td>
                              <td colspan="4" class="txt-light">Risk/Benefit assessment</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td id="e19">ความเสี่ยงโดยตรงต่อสุขภาพร่างกายของอาสาสมัคร</td>
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
                              <td>2</td>
                              <td id="e20">ความเสี่ยงต่อสุขภาพของตัวอ่อนหรือบุตรในครรภ์หรือคู่สมรส</td>
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
                              <td>3</td>
                              <td id="e21">ผลกระทบโดยตรง ต่อจิตใจ สังคม เศรษฐกิจของอาสาสมัคร</td>
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
                              <td>4</td>
                              <td id="e22">ผลกระทบต่อชุมชนที่เข้าร่วมการวิจัย</td>
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
                              <td>5</td>
                              <td id="e23">ประโยชน์โดยตรงต่ออาสาสมัคร</td>
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
                              <td>6</td>
                              <td id="e24">ประโยชน์ต่อชุมชนที่เข้าร่วมการวิจัย</td>
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
                              <td>7</td>
                              <td id="e25">ประโยชน์ต่อสังคม</td>
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
                            <tr style="background: rgb(128, 128, 128);">
                              <td class="txt-light">C</td>
                              <td colspan="4" class="txt-light">Informed consent</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td id="e26">วิธีการเชิญชวนอาสาสมัครเข้าโครงการ การประชาสัมพันธ์</td>
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
                              <td>2</td>
                              <td id="e27">การแจ้งวัตถุประสงค์ของการวิจัย</td>
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
                              <td>3</td>
                              <td id="e28">ระบุแหล่งทุนสนับสนุนชัดเจน</td>
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
                              <td>4</td>
                              <td id="e29">อธิบายขั้นตอนการปฏิบัติตัวของอาสาสมัคร </td>
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
                              <td>5</td>
                              <td id="e30">ระบุความเสี่ยง ความไม่สะดวก และผลแทรกซ้อน</td>
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
                            <tr>
                              <td>6</td>
                              <td id="e31">ประโยชน์โดยตรงที่ได้รับจากการเข้าร่วมวิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio031-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio031-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio031-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td id="e32">การเข้าร่วมโครงการเป็นโดยสมัครใจ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio032-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio032-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio032-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td id="e33">ทางเลือกอื่น หากไม่เข้าร่วมโครงการ</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio033-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio033-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio033-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td id="e34">สิทธิในการถอนตัวจากโครงการวิจัย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio034-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio034-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio034-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td id="e35">การจ่ายค่าตอบแทน/ค่าเดินทาง/ค่าใช้จ่าย/ค่าชดเชย</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio035-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio035-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio035-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>11</td>
                              <td id="e36">วิธีการเก็บรักษาความลับของอาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio036-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio036-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio036-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td id="e37">ชื่อ ที่อยู่และเบอร์โทรศัพท์ติดต่อผู้วิจัย (หากมีความเสี่ยง > minimal risk ต้องติดต่อได้ 24 ชม.)</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio037-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio037-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio037-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td id="e38">ที่อยู่ เบอร์โทรศัพท์ และ e-mail คณะกรรมการจริยธรรม</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio038-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio038-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio038-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td id="e39">กระบวนการขอความยินยอมจากอาสาสมัคร</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio039-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio039-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio039-99">

                                </span>
                              </td>
                            </tr>
                            <tr style="background: rgb(128, 128, 128);">
                              <td class="txt-light">D</td>
                              <td colspan="4" class="txt-light">Investigators</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td id="e40">พื้นฐานอาชีพและประสบการณ์ของผู้วิจัย (Investigator(s) qualification)</td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio040-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio040-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio040-99">

                                </span>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td id="e41">Conflict of interest </td>
                              <td class="dn"></td>
                              <td class="text-center" style="width: 9%;">
                                <span class="radio041-1">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio041-0">

                                </span>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <span class="radio041-99">

                                </span>
                              </td>
                            </tr>

                          </tbody>
                        </table>
                      </div>

                      <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 3</span> :: ประเมินความเสี่ยงของโครงการ <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>
                              <span class="radio042-1">

                              </span>
                            </td>
                            <td>มีความเสี่ยงไม่เกินความเสี่ยงเล็กน้อย (not greater than minimal risk)</td>
                          </tr>
                          <tr>
                            <td>
                              <span class="radio042-2">

                              </span>
                            </td>
                            <td>มีความเสี่ยงเกินกว่าความเสี่ยงเล็กน้อย แต่มีประโยชน์ต่อตัวอาสาสมัครโดยตรง </td>
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
      var selected_choice = null
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

        loadBioInfo()

        setTimeout(function(){
          preload.hide()
        }, 1000)



      })

      $(function(){

      })

      function loadBioInfo(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }

        var jxr = $.post(ws_url + 'controller/reviewer/load-bio-info.php', param, function(){}, 'json')
                   .always(function(snap){
                     if((snap != '') && (snap.length > 0)){
                      snap.forEach(function(i){
                        $('.general_comment').html(i.efb_gc)
                        $('.radio01-' + i.efb_1).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio02-' + i.efb_2).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio03-' + i.efb_3).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio04-' + i.efb_4).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio05-' + i.efb_5).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio06-' + i.efb_6).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio07-' + i.efb_7).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio08-' + i.efb_8).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio09-' + i.efb_9).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio010-' + i.efb_10).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio011-' + i.efb_11).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio012-' + i.efb_12).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio013-' + i.efb_13).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio014-' + i.efb_14).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio015-' + i.efb_15).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio016-' + i.efb_16).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio017-' + i.efb_17).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio018-' + i.efb_18).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio019-' + i.efb_19).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio020-' + i.efb_20).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio021-' + i.efb_21).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio022-' + i.efb_22).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio023-' + i.efb_23).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio024-' + i.efb_24).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio025-' + i.efb_25).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio026-' + i.efb_26).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio027-' + i.efb_27).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio028-' + i.efb_28).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio029-' + i.efb_29).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio030-' + i.efb_30).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio031-' + i.efb_31).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio032-' + i.efb_32).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio033-' + i.efb_33).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio034-' + i.efb_34).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio035-' + i.efb_35).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio036-' + i.efb_36).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio037-' + i.efb_37).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio038-' + i.efb_38).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio039-' + i.efb_39).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio040-' + i.efb_40).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio041-' + i.efb_41).html('<i class="far fa-check-circle text-danger"></i>')
                        $('.radio042-' + i.efb_42).html('<i class="far fa-check-circle text-danger"></i>')

                        $('input[name=radio01][value=' + i.efb_1 + ']').attr('checked', 'checked');
                        $('input[name=radio02][value=' + i.efb_2 + ']').attr('checked', 'checked');
                        $('input[name=radio03][value=' + i.efb_3 + ']').attr('checked', 'checked');
                        $('input[name=radio04][value=' + i.efb_4 + ']').attr('checked', 'checked');
                        $('input[name=radio05][value=' + i.efb_5 + ']').attr('checked', 'checked');
                        $('input[name=radio06][value=' + i.efb_6 + ']').attr('checked', 'checked');
                        $('input[name=radio07][value=' + i.efb_7 + ']').attr('checked', 'checked');
                        $('input[name=radio08][value=' + i.efb_8 + ']').attr('checked', 'checked');
                        $('input[name=radio09][value=' + i.efb_9 + ']').attr('checked', 'checked');
                        $('input[name=radio010][value=' + i.efb_10 + ']').attr('checked', 'checked');
                        $('input[name=radio011][value=' + i.efb_11 + ']').attr('checked', 'checked');
                        $('input[name=radio012][value=' + i.efb_12 + ']').attr('checked', 'checked');
                        $('input[name=radio013][value=' + i.efb_13 + ']').attr('checked', 'checked');
                        $('input[name=radio014][value=' + i.efb_14 + ']').attr('checked', 'checked');
                        $('input[name=radio015][value=' + i.efb_15 + ']').attr('checked', 'checked');
                        $('input[name=radio016][value=' + i.efb_16 + ']').attr('checked', 'checked');
                        $('input[name=radio017][value=' + i.efb_17 + ']').attr('checked', 'checked');
                        $('input[name=radio018][value=' + i.efb_18 + ']').attr('checked', 'checked');
                        $('input[name=radio019][value=' + i.efb_19 + ']').attr('checked', 'checked');
                        $('input[name=radio020][value=' + i.efb_20 + ']').attr('checked', 'checked');
                        $('input[name=radio021][value=' + i.efb_21 + ']').attr('checked', 'checked');
                        $('input[name=radio022][value=' + i.efb_22 + ']').attr('checked', 'checked');
                        $('input[name=radio023][value=' + i.efb_23 + ']').attr('checked', 'checked');
                        $('input[name=radio024][value=' + i.efb_24 + ']').attr('checked', 'checked');
                        $('input[name=radio025][value=' + i.efb_25 + ']').attr('checked', 'checked');
                        $('input[name=radio026][value=' + i.efb_26 + ']').attr('checked', 'checked');
                        $('input[name=radio027][value=' + i.efb_27 + ']').attr('checked', 'checked');
                        $('input[name=radio028][value=' + i.efb_28 + ']').attr('checked', 'checked');
                        $('input[name=radio029][value=' + i.efb_29 + ']').attr('checked', 'checked');
                        $('input[name=radio030][value=' + i.efb_30 + ']').attr('checked', 'checked');
                        $('input[name=radio031][value=' + i.efb_31 + ']').attr('checked', 'checked');
                        $('input[name=radio032][value=' + i.efb_32 + ']').attr('checked', 'checked');
                        $('input[name=radio033][value=' + i.efb_33 + ']').attr('checked', 'checked');
                        $('input[name=radio034][value=' + i.efb_34 + ']').attr('checked', 'checked');
                        $('input[name=radio035][value=' + i.efb_35 + ']').attr('checked', 'checked');
                        $('input[name=radio036][value=' + i.efb_36 + ']').attr('checked', 'checked');
                        $('input[name=radio037][value=' + i.efb_37 + ']').attr('checked', 'checked');
                        $('input[name=radio038][value=' + i.efb_38 + ']').attr('checked', 'checked');
                        $('input[name=radio039][value=' + i.efb_39 + ']').attr('checked', 'checked');
                        $('input[name=radio040][value=' + i.efb_40 + ']').attr('checked', 'checked');
                        $('input[name=radio041][value=' + i.efb_41 + ']').attr('checked', 'checked');
                        $('input[name=radio042][value=' + i.efb_42 + ']').attr('checked', 'checked');
                      })

                      // setTimeout(function(){
                        for (var i = 1; i <= 42; i++) {
                          checkUncomment_bio_not_fit(i, true)
                        }
                      //   checkBioStatus()
                      // }, 2000)
                    }
                   })
      }

      function deleteComment(ele_id){

        selected_choice = ele_id

        $prev_msg = $('#e' + ele_id).html()
        $p = $prev_msg.split('<div class="commentPane"')
        if($p.length > 0){
          $('#e' + ele_id).html($p[0])
        }

        var param = {
          q: ele_id,
          id_rs: current_rs_id,
          user: current_user,
          form_id: '2'
        }

        var jxr = $.post(ws_url + 'controller/reviewer/unCommentDraft_bio_notfit.php', param, function(){})
                   .always(function(resp){ })
      }

      function saveAssesmentComment(){

        var comment_msg = notfin_info.getData()
        var msg = comment_msg

        if(msg == ''){
          swal("ขออภัย", "กรุณาเพิ่มความเห็นและข้อเสนอแนะเพื่อปรับปรุงก่อน", "error")
          return ;
        }

        var param = {
          q: current_ele_id,
          com_msg: comment_msg,
          com_title: $('#question_topic').text(),
          id_rs: current_rs_id,
          user: current_user,
          form_id: '2'
        }

        var jxr = $.post(ws_url + 'controller/reviewer/saveCommentDraft_bio_notfit.php', param, function(){})
                   .always(function(resp){
                      // $btn = '<div class="pt-0"><button class="btn btn-sm btn-success btn-square" style="box-shadow: none;"><i class="fas fa-pencil-alt"></i></button></div>'
                      $btn = '<div class="pt-0"><button class="btn btn-sm btn-success btn-square" style="box-shadow: none;" onclick="clickNotfitBtn(2, ' + current_ele_id + ')"><i class="fas fa-pencil-alt"></i></button></div>'
                      if(resp == 'Y'){
                        $( "#comment_div_id_" +  current_ele_id).remove();
                        $('#e' + selected_choice).append('<div class="commentPane" id="comment_div_id_' + current_ele_id + '"><div id="comment_id_' + current_ele_id + '">' + comment_msg + '</div>' + $btn + '</div>')
                        $('.btnCloseModal').trigger('click')
                        notfin_info.setData('')
                      }
                   })
      }

    </script>

  </body>
</html>
