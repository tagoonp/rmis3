<?php
include "../config.class.php";
?>
<form onsubmit="return false;" class="myForm">
  <div class="form-group">
    <label for="" class="f500 txt-dark">ผลการตรวจสอบเอกสาร <span class="txt-danger">**</span></label>
    <select class="form-control" name="txtResult" id="txtResult" required>
      <option value="">-- กรุณาเลือกผลการตรวจสอบเอกสาร --</option>
      <option value="2">เอกสารไม่ถูกต้อง/ไม่ครบถ้วน</option>
      <option value="3">เอกสารเบื้องต้นถูกต้อง เสนอเลขา EC ตรวจสอบ</option>
    </select>
  </div>

  <div class="passPanal dn">
    <div class="form-group">
      <label for="" class="f500 txt-dark">ส่งต่อเลขา ฯ <span class="txt-danger">**</span></label>
      <select class="form-control" name="txtEC" id="txtEC">
        <option value="">-- กรุณาเลือกเลขา EC --</option>
      </select>
    </div>

    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="" class="f500 txt-dark">รหัสปี <span class="txt-danger">**</span></label>
          <!-- <input type="number" name="txtYear" id="txtYear" value="" min="1" max="99" class="form-control"> -->
          <select class="form-control" name="txtYear" id="txtYear">
            <option value="">-- เลือกปี --</option>
          </select>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="" class="f500 txt-dark">รหัสลำดับ <span class="txt-danger">**</span></label>
          <input type="text" name="txtOrd" id="txtOrd" value="Auto" class="form-control" readonly>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="" class="f500 txt-dark">รหัสภาควิชา/หน่วยงาน <span class="txt-danger">**</span></label>
          <input type="number" name="txtDept" id="txtDept" value="" min="1" max="99" class="form-control">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="" class="f500 txt-dark">รหัสประเภทบุคลากร <span class="txt-danger">**</span></label>
          <input type="number" name="txtPertype" id="txtPertype" value="" min="1" max="99" class="form-control">
        </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputuname_3" class="control-label"><span class="f500">ข้อความตอบกลับหัวหน้าโครงการ หรือ Note ถึงเลขา EC <span class="txt-danger">** บังคับกรอกเมื่อเอกสารไม่ถูกต้อง</label>
    <textarea name="brief_reports" id="brief_reports" rows="8" cols="80" class="form-control" placeholder=""></textarea>
  </div>

  <div class="form-group text-right">
    <button class="btn btn-primary" type="submit">บันทึกและส่ง</button>
  </div>

</form>


<script type="text/javascript">

  $(function(){
    $('#txtResult').change(function(){
      if($('#txtResult').val() == '3'){
        $('.passPanal').removeClass('dn')
      }
    })
  })
</script>
