<div class="header text-left">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4">
        <img src="images/logo_header.png" alt="logo_header.png" class="img-responsive">
      </div>
      <div class="col-sm-8">
        <div class="thfont text-right" style="padding-top: 7px;">
          <span class="f18"><strong>ชื่อผู้ใช้</strong> <?php echo $result[0]["prefix_name"];?><?php echo $result[0]["name"]." ".$result[0]['surname'];?> <strong>สถานะ</strong> ผู้ทรงคุณวุฒิ<br></span>
          <a href="reviewer_edit.php?id=<?php print $_SESSION['id']; ?>" class="link-custom thfont f16">แก้ไขข้อมูลส่วนตัว</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
          <a href="changepassword.php?id=<?php print $_SESSION['id']; ?>" class="link-custom thfont f16">เปลี่ยนรหัสผ่าน</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
          <a href="logout.php" class="link-custom thfont f16">ออกจากระบบ</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="menu">
  <div class="container-fluid">
    <div class="row" style="background: rgb(5, 156, 97);">
      <div class="col-sm-8 text-left">
        <a href="index.php" class="btn btn-menu-custom">หน้าหลัก</a>
        <a href="http://rmis.medicine.psu.ac.th/file_uploads/Manual/RMIS-Manual-REVIEWER.pdf" target="_blank" class="btn btn-menu-custom">คู่มือการใช้งาน</a>
      </div>
      <div class="col-sm-4 text-right">
        <a href="ra_list.php" class="btn btn-menu-custom5"><i class="ion-chatbox-working"></i> แจ้งข้อผิดพลาดระบบ</a>
      </div>
    </div>
  </div>
</div>
