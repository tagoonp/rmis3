<div class="modal fade" id="MyMoreReviewer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;">เพิ่มข้อมูลเพื่อส่งเลขาพิจารณาผู้เชี่ยวชาญเพิ่มเติม</h5>
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false;">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="f500 txt-dark">ข้อความถึงเลขา ฯ <span class="txt-danger">**</span></label>
                <textarea name="txtCommentToECmoreReviewer" id="txtCommentToECmoreReviewer" rows="8" cols="80" class="form-control" placeholder="กรอกชื่อแหล่งทุนวิจัย หรือ ใส่เครื่องหมายลบ (-) ..."></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cp" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success cp" onclick="FbtoECReviewer()">ส่ง</button>
      </div>
    </div>
  </div>
</div>
