<?php
include "../config.class.php";

if(!isset($_GET['id_reviewer'])){
  mysqli_close($conn);
  die();
}

if(!isset($_GET['id_rs'])){
  mysqli_close($conn);
  die();
}

$id_rs = mysqli_real_escape_string($conn, $_GET['id_rs']);
$id_reviewer = mysqli_real_escape_string($conn, $_GET['id_reviewer']);

$strSQL = "SELECT * FROM research WHERE id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);
if(!$result){
  mysqli_close($conn);
  die();
}

$data_1 = mysqli_fetch_assoc($result);


$strSQL = "SELECT * FROM eform_icf WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs = '$id_rs'";
$result = mysqli_query($conn, $strSQL);
if(!$result){
  mysqli_close($conn);
  die();
}

$data_2 = mysqli_fetch_assoc($result);

// $strSQL = "SELECT * FROM eform_icf_comment WHERE efi_reviewer_id = '$id_reviewer' AND efi_id_rs = '$id_rs'";
// $result = mysqli_query($conn, $strSQL);


?>
<div class="row" id="printArea">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-12">
        <h4 class="text-center pl-20 pr-20 f500">แบบประเมินกระบวนการขอความยินยอมจากอาสาสมัคร<br>(สำหรับ ICF reviewer)</h4>
        <hr class="mb-20">
        <div class="row">
          <div class="col-sm-12">
            <div class="pl-20 txt-dark pr-20">
              <div class="row">
                <div class="col-sm-3 f500">รหัสโครงการ</div>
                <div class="col-sm-9"><span id="txtCode" class="txt-danger"><?php echo $data_1['code_apdu']; ?></span></div>
              </div>
              <div class="row">
                <div class="col-sm-3 f500">ชื่อโครงการ (ภาษาไทย)</div>
                <div class="col-sm-9"><span id="txtThtitle"><?php echo $data_1['title_th']; ?></span></div>
              </div>
              <div class="row">
                <div class="col-sm-3 f500">ชื่อโครงการ (ภาษาอังกฤษ)</div>
                <div class="col-sm-9"><span id="txtEntitle"><?php echo $data_1['title_en']; ?></span></div>
              </div>
            </div>
          </div>

          <div class="col-sm-12">
            <div class="pl-10 txt-dark pr-10">
              <div class="row">
                <div class="col-sm-12 pl-20 pr-20 pt-20">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="txt-dark f500"><span class="text-success">ส่วนที่ 1</span> :: ความเห็นในภาพรวมเกี่ยวกับโครงการ (General comment) </label>
                            <div class="text-dark">
                              <?php echo $data_2['efi_gc']; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive_">
                        <label class="txt-dark f500"><span class="text-success">ส่วนที่ 2</span> :: ข้อคำถามการประเมิน</label>
                        <table class="table table-bordered">
                          <thead>
                            <tr style="background: rgb(19, 161, 114);">
                              <th class="txt-light">ข้อ</th>
                              <th class="txt-light">หัวข้อการประเมินที่เกี่ยวกับโครงการวิจัย</th>
                              <th class="txt-light">เหมาะสม</th>
                              <th class="txt-light">ไม่เหมาะสม</th>
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
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_1'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_1'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_1'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td id="e2">การเชิญชวนไม่ละเมิดความเป็นส่วนตัว หรือก่อความรำคาญ </td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_2'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_2'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_2'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td id="e3">ไม่โฆษณา/อ้างประโยชน์/ให้สิ่งจูงใจเกินควร</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_3'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_3'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_3'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td id="e4">กระทำในสถานที่และจังหวะที่เหมาะสม</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_4'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_4'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_4'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td id="e5">ให้เวลาเพียงพอในการตัดสินใจ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_5'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_5'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_5'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td id="e6">การใช้ตัวแทนโดยชอบธรรมเหมาะสม (ถ้าเกี่ยวข้อง)</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_6'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_6'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_6'], 99); ?>
                              </td>
                            </tr>
                            <tr style="background: rgb(128, 128, 128);">
                              <td colspan="5" class="txt-light">คุณภาพโดยรวมของเอกสาร </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td id="e7">มีข้อมูลที่เพียงพอต่อการตัดสินใจ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_7'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_7'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_7'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td id="e8">เข้าใจง่าย กระชับ ภาษาเหมาะระดับความเข้าใจ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_8'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_8'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_8'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td id="e9">ไม่มีข้อความเชิงบังคับ อาสาสมัครตัดสินใจได้โดยอิสระ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_9'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_9'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_9'], 99); ?>
                              </td>
                            </tr>
                            <tr style="background: rgb(128, 128, 128);">
                              <td colspan="5" class="txt-light">องค์ประกอบในเอกสารชี้แจงและขอความยินยอม </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td id="e10">แจ้งวัตถุประสงค์ของการวิจัย</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_10'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_10'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_10'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>11</td>
                              <td id="e11">ระบุแหล่งทุนสนับสนุน</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_11'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_11'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_11'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td id="e12">ขั้นตอนการปฏิบัติตัวของอาสาสมัคร อ่านเข้าใจว่าต้องทำอะไร หรือห้ามทำอะไร ใช้เวลาแต่ละขั้นตอนนานเท่าใด ต้องมากี่ครั้ง เครื่องมือหรือหัตถการต่างๆ มีลักษณะอย่างไร ตรวจในท่าใด</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_12'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_12'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_12'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td id="e13">ระบุความเสี่ยง (ทั้งกาย/ใจ/สังคม/เศรษฐกิจ/ความไม่สุขสบาย/ผลแทรกซ้อน) โดยไม่ปิดบัง แม้โอกาสเสี่ยงน้อยแต่หากรุนแรงต้องแจ้งความเสี่ยงนี้ต่ออาสาสมัคร</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_13'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_13'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_13'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td id="e14">อธิบายประโยชน์ที่ได้รับ<u>โดยตรง</u>จากการเข้าร่วม ไม่อวดอ้าง</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_14'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_14'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_14'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>15</td>
                              <td id="e15">อธิบายว่าการเข้าร่วมโครงการเป็นโดยสมัครใจ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_15'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_15'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_15'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>16</td>
                              <td id="e16">บอกทางเลือกอื่นๆ หากอาสาสมัครไม่ต้องการเข้าร่วมโครงการ</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_16'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_16'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_16'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>17</td>
                              <td id="e17">มีสิทธิในการถอนตัวจากโครงการ และขั้นตอนถอนตัวที่สะดวก </td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_17'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_17'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_17'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>18</td>
                              <td id="e18">ค่าตอบแทน/ค่าเดินทาง/ค่าเสียเวลา (เหมาะกับความเสี่ยง/ความไม่สะดวก และไม่มากจนจูงใจ) ถ้านัดหลายครั้งควรจ่ายเป็นงวด</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_18'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_18'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_18'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>19</td>
                              <td id="e19">ระบุว่าใครรับผิดชอบค่าใช้จ่ายในส่วนใดบ้าง</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_19'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_19'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_19'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>20</td>
                              <td id="e20">การจ่ายค่าชดเชยการบาดเจ็บหรือค่าเสียหาย ใครจ่าย มีการทำประกันไว้หรือไม่ มีข้อแม้ในการจ่ายอย่างไร</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_20'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_20'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_20'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>21</td>
                              <td id="e21">อธิบายวิธีการเก็บรักษาความลับของอาสาสมัคร</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_21'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_21'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_21'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>22</td>
                              <td id="e22">ชื่อ ที่อยู่และเบอร์โทรศัพท์ที่ติดต่อได้ของผู้วิจัย</td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_22'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_22'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_22'], 99); ?>
                              </td>
                            </tr>
                            <tr>
                              <td>23</td>
                              <td id="e23">ที่อยู่ เบอร์โทรและ e-mail (medpsu) ติดต่อสำนักงานจริยธรรมการวิจัยในมนุษย์ คณะแพทยศาสตร์ม.สงขลานครินทร์ </td>
                              <td class="text-center" style="width: 9%;">
                                <?php echo checkValue($data_2['efi_23'], 1); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_23'], 0); ?>
                              </td>
                              <td class="text-center"  style="width: 7%;">
                                <?php echo checkValue($data_2['efi_23'], 99); ?>
                              </td>
                            </tr>


                          </tbody>
                        </table>
                      </div>

                      <label class="txt-dark f500"><span class="text-success">ส่วนที่ 3</span> :: โดยสรุป ท่านเห็นชอบกับกระบวนการขอความยินยอมจากอาสาสมัครหรือไม่ <span class="text-danger">** </span></label>
                      <table class="table table-bordered">
                        <tbody>
                          <tr class="dn">
                            <td>
                              <div class="radio radio-lg radio-success dn">
                                <input type="radio"  id="checkbox042-99" name="radio042" value="na" checked/>
                                <label for="checkbox042-99"></label>
                              </div>
                            </td>
                            <td> </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="radio radio-lg radio-success">
                                <input type="radio" class="radio_btn"  id="checkbox042-1" name="radio042" value="1"  />
                                <label for="checkbox042-1"></label>
                              </div>
                            </td>
                            <td>เห็นชอบ</td>
                          </tr>
                          <tr>
                            <td>
                              <div class="radio radio-lg radio-success">
                                <input type="radio" class="radio_btn"  id="checkbox042-2" name="radio042" value="2" />
                                <label for="checkbox042-2"></label>
                              </div>
                            </td>
                            <td>เห็นชอบ หากแก้ไขตามข้อเสนอแนะ/หากมีคำชี้แจงที่สมเหตุสมผล</td>
                          </tr>
                          <tr>
                            <td>
                              <div class="radio radio-lg radio-success">
                                <input type="radio" class="radio_btn" id="checkbox042-3" name="radio042" value="3" />
                                <label for="checkbox042-3"></label>
                              </div>
                            </td>
                            <td>ไม่เห็นชอบ โปรดระบุเหตุผลหลักที่ไม่เห็นชอบ</td>
                          </tr>

                        </tbody>
                      </table>
                </div>
              </div>
              <!-- BioForm -->
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>

</div>

<?php
function checkValue($data, $match){
  if($data == $match){
    echo '<i class="zmdi zmdi-check-circle zmdi-hc-2x text-success"></i>';
  }else{
    // echo '<i class="zmdi zmdi-circle-o zmdi-hc-2x"></i>';
  }
}
?>
