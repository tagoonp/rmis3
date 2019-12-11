<?php
include "../config.class.php";
$strSQL = "SELECT * FROM file_assesment WHERE fid_status = '1'";
$result = mysqli_query($conn, $strSQL);
?>
<div class="modal fade" id="MyFileAssesmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 400;">เลือกไฟล์แบบประเมินเพื่อส่งผู้เชี่ยวชาญอิสระ</h5>
        <button type="button" class="close btnClosemodal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false;">
          <div class="form-group dn">
            <input type="text" class="form-control" id="txtRID">
          </div>
          <?php
          if($result){
            while($row = mysqli_fetch_array($result)){
              ?>
              <div class="row">
                <div class="col-1 text-right">
                  <div class="checkbox checkbox-success">
                      <input type="checkbox" id="cb<?php echo $row['fid']; ?>" value="<?php echo $row['fid']; ?>">
                  </div>
                </div>
                <div class="col-11">
                    <label for="cb<?php echo $row['fid']; ?>"> <?php echo $row['fid_name']; ?> </label>
                </div>
              </div>

              <?php
            }

          }else{
            echo "ไม่สามารถเชื่อมต่อฐานข้อมลได้";
          }
          ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cp" data-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-success cp" onclick="saveAssessmentFile()">บันทึก</button>
      </div>
    </div>
  </div>
</div>
