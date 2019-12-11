<div class="modal fade" id="MySponser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;">เพิ่ม/แก้ไขข้อมูล Protocol number</h5>
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false;">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="" class="fz08">Protocol Number <span class="text-danger">**</span> </label>
                <input type="text" class="form-control" placeholder="กรอก Protocol number ..." id="txtProtocolNumber">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cp" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success cp" onclick="saveprotocolNumber()">บันทึก</button>
      </div>
    </div>
  </div>
</div>
