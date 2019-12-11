<div class="modal fade" id="MyMailtoReviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;">ส่งอีเมล์ถึงผู้เชี่ยวชาญอิสระ</h5>
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="sendMailForm" onsubmit="return false;">
          <div class="form-group">
            <input type="text" class="form-control dn" id="txtRID2">
          </div>
          <div class="form-group">
            <input type="text" class="form-control dn" id="txtEM">
          </div>
          <div class="form-group">
            <input type="text" class="form-control dn" id="txtRType">
          </div>
          <div class="form-group">
            <input type="text" class="form-control dn" id="txtRwtype">
          </div>
          <div class="form-group">
            <input type="text" class="form-control dn" id="txtCodeBC">
          </div>
          <div class="form-group">
            <label for="" class="f500 txt-dark">หัวข้ออีเมล์ <span class="txt-danger">**</span></label>
            <input type="text" class="form-control" id="txtEmailTitle">
          </div>
          <div class="form-group">
            <label for="" class="f500 txt-dark">ข้อความถึงผู้เชี่ยวชาญอิสระ <span class="txt-danger">**</span></label>
            <textarea name="operation-reviewer-email" id="operation-reviewer-email" rows="8" cols="80" class="form-control" placeholder="กรอกชื่อแหล่งทุนวิจัย หรือ ใส่เครื่องหมายลบ (-) ..."></textarea>
          </div>

          <div class="form-group pt-20">
            <button class="btn btn-success btn-block" onclick="sendEmailToReviewer()">บันทึกและส่งผู้เชี่ยวชาญอิสระ</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="myModal_upfile" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background: #469408;">
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-hidden="true" id="btnCloseExempt">×</button>
        <h5 class="modal-title txt-light f500" id="myModalLabel">อัพโหลดไฟล์แบบประเมิน</h5>
      </div>
      <div class="modal-body">


        <form method="POST" enctype="multipart/form-data" id="uploadForm" onsubmit="return false;" >

          <div class="form-group">
            <input type="text" value="" id="txtIdRS" name="txtIdRS" readonly class="dn">
            <input type="text" value="" id="txtIdCodaAPCU" name="txtIdCodaAPCU" readonly class="dn">
            <input type="text" value="" id="txtIdReviewer" name="txtIdReviewer" class="docSess dn" readonly>
            <input type="text" value="" id="txtIdStaff" name="txtIdStaff" class="docSess dn" readonly>
          </div>

          <div class="form-group">
            <label for="" class="f500 txt-dark">เลือกไฟล์ <span class="txt-danger">**</span></label>
            <input id="media" name="media" type="file" class="file_upload">
          </div>

          <div class="row dn" id="progressbar" style="padding: 0px 18px 0px 18px;">
            <div class="col-sm-12">
              <div class="progress" style="height: 20px;">
                <div id="progressUploadBar" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 pb-20">
              <button class="btn btn-success btn-block" id="btnSendAsessment_"  type="submit">อัพโหลดไฟล์</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
