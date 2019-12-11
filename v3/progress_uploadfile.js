Dropzone.options.myFile2 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(2)
      }
    });
  }
};

Dropzone.options.myFile3 = {
  acceptedFiles: 'application/pdf, .docx, .doc',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(3)
      }

    });
  }
};

Dropzone.options.myFile4 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(4)
      }

    });
  }
};

Dropzone.options.myFile5 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(5)
      }
    });
  }
};

Dropzone.options.myFile6 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(6)
      }

    });
  }
};

Dropzone.options.myFile7 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(7)
      }

    });
  }
};

Dropzone.options.myFile8 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(8)
      }

    });
  }
};

Dropzone.options.myFile9 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(9)
      }
    });
  }
};

function checkFileAttached(){
  for(var i = 2; i <=10 ; i++){
    checkData(i);
  }
}

function checkData(i){
  $('#ft' + i).empty()
  var param = {
    sess_id: progress_sess_id,
    fgroup: i,
    id_rs: $('#txtResearch').val()
  }

  console.log(param);

  var response = $.post(ws_url + 'controller/check_upload_file_progress_report.php', param, function(){}, 'json')
                  .always(function(snap){
                    console.log(snap);
                    if((snap != '') && (snap.length > 0)){
                      $('#ft' + i).empty();
                      snap.forEach(function(childSnap){
                        var data = '<li class="mb-5"><a href="Javascript:void(0)" onclick="delete_file_research(' + childSnap.rpfa_id +', ' + i + ')"><i class="fa fa-close text-info mr-5"></i></a> ' + childSnap.rpfa_file_name + '</li>';

                        $('#ft' + i).append(data);

                      })

                      $('#ftn' + i).val(snap.length)
                    }else{
                      $('#ft' + i).empty();
                      $('#ftn' + i).val(0)
                    }
                  },'json');

  // setTimeout(function(){ reloadD() }, 1000)

}
