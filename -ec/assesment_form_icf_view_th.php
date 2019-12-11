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
                    <h3 class="fw500 text-center">แบบประเมินกระบวนการขอความยินยอมจากอาสาสมัคร<br><small>(สำหรับ ICF Reviewer)</small></h3>
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
                            <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 1</span> :: กรุณาพิมพ์ความเห็นเกี่ยวกับกระบวนการขอความยินยอม
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
                              <td colspan="5" class="txt-light">กระบวนการเชิญชวนอาสาสมัคร (process)</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td id="e1">ไม่ทำให้รู้สึกถูกบังคับหรือเข้าร่วมเพราะเกรงใจ</td>
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
                              <td id="e2">การเชิญชวนไม่ละเมิดความเป็นส่วนตัว หรือก่อความรำคาญ </td>
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
                              <td id="e3">ไม่โฆษณา/อ้างประโยชน์/ให้สิ่งจูงใจเกินควร</td>
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
                              <td id="e4">กระทำในสถานที่และจังหวะที่เหมาะสม</td>
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
                              <td id="e5">ให้เวลาเพียงพอในการตัดสินใจ</td>
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
                              <td id="e6">การใช้ตัวแทนโดยชอบธรรมเหมาะสม (ถ้าเกี่ยวข้อง)</td>
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
                            <tr style="background: rgb(128, 128, 128);">
                              <td colspan="5" class="txt-light">คุณภาพโดยรวมของเอกสาร </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td id="e7">มีข้อมูลที่เพียงพอต่อการตัดสินใจ</td>
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
                              <td id="e8">เข้าใจง่าย กระชับ ภาษาเหมาะระดับความเข้าใจ</td>
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
                              <td id="e9">ไม่มีข้อความเชิงบังคับ อาสาสมัครตัดสินใจได้โดยอิสระ</td>
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
                            <tr style="background: rgb(128, 128, 128);">
                              <td colspan="5" class="txt-light">องค์ประกอบในเอกสารชี้แจงและขอความยินยอม </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td id="e10">แจ้งวัตถุประสงค์ของการวิจัย</td>
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
                              <td id="e11">ระบุแหล่งทุนสนับสนุน</td>
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
                              <td id="e12">ขั้นตอนการปฏิบัติตัวของอาสาสมัคร อ่านเข้าใจว่าต้องทำอะไร หรือห้ามทำอะไร ใช้เวลาแต่ละขั้นตอนนานเท่าใด ต้องมากี่ครั้ง เครื่องมือหรือหัตถการต่างๆ มีลักษณะอย่างไร ตรวจในท่าใด</td>
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
                              <td id="e13">ระบุความเสี่ยง (ทั้งกาย/ใจ/สังคม/เศรษฐกิจ/ความไม่สุขสบาย/ผลแทรกซ้อน) โดยไม่ปิดบัง แม้โอกาสเสี่ยงน้อยแต่หากรุนแรงต้องแจ้งความเสี่ยงนี้ต่ออาสาสมัคร</td>
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
                              <td id="e14">อธิบายประโยชน์ที่ได้รับ<u>โดยตรง</u>จากการเข้าร่วม ไม่อวดอ้าง</td>
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
                              <td id="e15">อธิบายว่าการเข้าร่วมโครงการเป็นโดยสมัครใจ</td>
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
                              <td id="e16">บอกทางเลือกอื่นๆ หากอาสาสมัครไม่ต้องการเข้าร่วมโครงการ</td>
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
                              <td id="e17">มีสิทธิในการถอนตัวจากโครงการ และขั้นตอนถอนตัวที่สะดวก </td>
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
                              <td id="e18">ค่าตอบแทน/ค่าเดินทาง/ค่าเสียเวลา (เหมาะกับความเสี่ยง/ความไม่สะดวก และไม่มากจนจูงใจ) ถ้านัดหลายครั้งควรจ่ายเป็นงวด</td>
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
                              <td>19</td>
                              <td id="e19">ระบุว่าใครรับผิดชอบค่าใช้จ่ายในส่วนใดบ้าง</td>
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
                              <td>20</td>
                              <td id="e20">การจ่ายค่าชดเชยการบาดเจ็บหรือค่าเสียหาย ใครจ่าย มีการทำประกันไว้หรือไม่ มีข้อแม้ในการจ่ายอย่างไร</td>
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
                              <td>21</td>
                              <td id="e21">อธิบายวิธีการเก็บรักษาความลับของอาสาสมัคร</td>
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
                              <td>22</td>
                              <td id="e22">ชื่อ ที่อยู่และเบอร์โทรศัพท์ที่ติดต่อได้ของผู้วิจัย</td>
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
                              <td>23</td>
                              <td id="e23">ที่อยู่ เบอร์โทรและ e-mail (medpsu) ติดต่อสำนักงานจริยธรรมการวิจัยในมนุษย์ คณะแพทยศาสตร์ม.สงขลานครินทร์ </td>
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
                          </tbody>
                        </table>
                      </div>

                      <label class="txt-dark f500"><span class="text-success-2">ส่วนที่ 3</span> :: โดยสรุป ท่านเห็นชอบกับกระบวนการขอความยินยอมจากอาสาสมัครหรือไม่ <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="text-center">
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
                            <td>เห็นชอบ หากแก้ไขตามข้อเสนอแนะ/หากมีคำชี้แจงที่สมเหตุสมผล</td>
                          </tr>
                          <tr>
                            <td class="text-center">
                              <span class="radio042-3">

                              </span>
                            </td>
                            <td>ไม่เห็นชอบ โปรดระบุเหตุผลหลักที่ไม่เห็นชอบ
                              <div class="pt-5 dn" id="notFitInfo" style="margin-top: 10px; padding: 20px; border: dashed; border-color: rgb(130, 130, 130); color: #000; border-width: 1px;" ></div>
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

        loadIcfInfo()

        setTimeout(function(){
          preload.hide()
        }, 1000)
      })

      $(function(){

      })

      function loadIcfInfo(){
        var param = {
          id_rs: <?php echo $_GET['id_rs']; ?>,
          user: <?php echo $_GET['id_reviewer']; ?>
        }

        var jxr = $.post(ws_url + 'controller/reviewer/loadCommentDraft_icf.php', param, function(){}, 'json')
                   .always(function(snap){
                     if((snap != '') && (snap.length > 0)){
                       $c = 0
                       snap.forEach(function(i){
                         console.log(i);
                         $('.general_comment').html(i.efi_gc)
                         $('.radio01-' + i.efi_1).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio02-' + i.efi_2).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio03-' + i.efi_3).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio04-' + i.efi_4).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio05-' + i.efi_5).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio06-' + i.efi_6).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio07-' + i.efi_7).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio08-' + i.efi_8).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio09-' + i.efi_9).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio010-' + i.efi_10).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio011-' + i.efi_11).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio012-' + i.efi_12).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio013-' + i.efi_13).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio014-' + i.efi_14).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio015-' + i.efi_15).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio016-' + i.efi_16).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio017-' + i.efi_17).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio018-' + i.efi_18).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio019-' + i.efi_19).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio020-' + i.efi_20).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio021-' + i.efi_21).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio022-' + i.efi_22).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio023-' + i.efi_23).html('<i class="far fa-check-circle text-danger"></i>')
                         $('.radio042-' + i.efi_42).html('<i class="far fa-check-circle text-danger"></i>')
                         if(i.efi_42 == 3){
                           $('#notFitInfo').removeClass('dn')
                           $('#notFitInfo').html(i.efi_42_comment)
                         }
                       })
                     }
                   })
                   setTimeout(function(){
                     // checkIcfStatus()
                     preload.hide()
                   }, 3000)

          for (var i = 1; i <= 42; i++) {
            checkUncomment_icf_not_fit(i, true)
          }
      }

    </script>

  </body>
</html>
