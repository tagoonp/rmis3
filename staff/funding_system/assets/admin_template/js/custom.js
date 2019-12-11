var dropzone = new Dropzone("#mydropzone", {
  url: '../controller/upload_media.php',
  acceptedFiles: 'application/pdf, .docx, .doc, image/*, .xls, .xlsx',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      console.log(file);
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        admin.loadMediaList()
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
      }
    });
  }
});
