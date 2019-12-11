<div class="modal fade" id="MyCopiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;">เพิ่ม/แก้ไขข้อมูลผู้ร่วมวิจัย</h5>
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false;">
          <div class="form-group">
            <label for="" class="fz08">Co-PI ID <span class="text-danger">**</span></label>
            <input type="text" class="form-control" id="txtCopiId" placeholder="Enter name title ..." readonly value="Auto genetate ...">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">คำนำหน้าชื่อที่ต้องการให้ระบบแสดงในใบรับรอง (ไทย)</label>
                <input type="text" class="form-control" placeholder="กรอกคำนำหน้าชื่อ ..." id="txtPrefixTh">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">Name title for certificate of approval (If any)</label>
                <input type="text" class="form-control" placeholder="Enter name title ..." id="txtPrefixEn">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">ชื่อ (ภาษาไทย) <span class="text-danger">**</span></label>
                <input type="text" class="form-control" placeholder="กรอกชื่อ ..." id="txtFnameTh">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">นามสกุล (ภาษาไทย) <span class="text-danger">**</span></label>
                <input type="text" class="form-control" placeholder="กรอกนามสกุล ..." id="txtLnameTh">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">Name (English) <span class="text-danger">**</span></label>
                <input type="text" class="form-control" placeholder="Enter name ..." id="txtFnameEn">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="" class="fz08">Surname (English) <span class="text-danger">**</span></label>
                <input type="text" class="form-control" placeholder="Enter surname ..." id="txtLnameEn">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="fz08">ชื่อหน่วยงาน (ภาษาไทย) <span class="text-danger">**</span></label>
            <input type="text" class="form-control" placeholder="Enter name ..." id="txtDeptTh">
          </div>

          <div class="form-group">
            <label for="" class="fz08">Institution's name  (English) <span class="text-danger">**</span></label>
            <input type="text" class="form-control" placeholder="Enter name ..." id="txtDeptEn">
          </div>

          <div class="form-group">
            <label for="" class="fz08">E-mail address <span class="text-danger">**</span></label>
            <input type="text" class="form-control" placeholder="Enter e-mail address ..." id="txtEmail">
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="" class="fz08">สัดส่วน (%) <span class="text-danger">**</span></label>
                <input type="number" class="form-control" placeholder="กรอกสัดส่วน % การมีส่วนร่วม ..." id="txtRatio" min="0" max="99">
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label for="" class="fz08">ความรับผิดชอบในโครงการ <span class="text-danger">**</span></label>
                <input type="text" class="form-control" placeholder="กรอกหน้าที่ควมรับผิดชอบในโครงการ ..." id="txtResponse">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cp" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success cp" onclick="savenewCopi()">บันทึก</button>
      </div>
    </div>
  </div>
</div>
