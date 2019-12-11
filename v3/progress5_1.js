var editData = '';
var editData1 = '';
var tmp_progress_status = '1';

editData = CKEDITOR.replace( 'q1_info', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData1 = CKEDITOR.replace( 'bf1', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '350px'
});

Dropzone.options.myFile1 = {
  // acceptedFiles: 'application/pdf, .docx, .doc',
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      console.log(file.xhr.responseText);
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkProgress(5)
      }
    });
  }
};


$(function(){

  $('#checkbox4_1').click(function(){ if($("#checkbox4_1").is(':checked')){ $("#checkbox4_2").prop('checked', '')}})
  $('#checkbox4_2').click(function(){ if($("#checkbox4_2").is(':checked')){ $("#checkbox4_1").prop('checked', '')}})

  $('#checkbox5_1').click(function(){ if($("#checkbox5_1").is(':checked')){ $("#checkbox5_2").prop('checked', '')}})
  $('#checkbox5_2').click(function(){ if($("#checkbox5_2").is(':checked')){ $("#checkbox5_1").prop('checked', '')}})

  $('#checkbox6_1').click(function(){ if($("#checkbox6_1").is(':checked')){ $("#checkbox6_2, #checkbox6_3").prop('checked', ''); $('#q6_4').val(''); }})
  $('#checkbox6_2').click(function(){ if($("#checkbox6_2").is(':checked')){ $("#checkbox6_1, #checkbox6_3").prop('checked', ''); $('#q6_4').val(''); }})
  $('#checkbox6_3').click(function(){ if($("#checkbox6_3").is(':checked')){ $("#checkbox6_2, #checkbox6_1").prop('checked', '')}})

  $('#checkbox7_1').click(function(){ if($("#checkbox7_1").is(':checked')){ $("#checkbox7_2, #checkbox7_3").prop('checked', ''); $('#q7_1').val(''); $('#q7_4').val(''); }})
  $('#checkbox7_2').click(function(){ if($("#checkbox7_2").is(':checked')){ $("#checkbox7_1, #checkbox7_3").prop('checked', ''); $('#q7_4').val(''); }})
  $('#checkbox7_3').click(function(){ if($("#checkbox7_3").is(':checked')){ $("#checkbox7_2, #checkbox7_1").prop('checked', ''); $('#q7_1').val(''); }})

  $('#checkbox8_1').click(function(){ if($("#checkbox8_1").is(':checked')){ $("#checkbox8_2").prop('checked', ''); $('#q8_3').val(''); }})
  $('#checkbox8_2').click(function(){ if($("#checkbox8_2").is(':checked')){ $("#checkbox8_1").prop('checked', ''); }})

  $('#checkbox01').click(function(){
    if($("#checkbox01").is(':checked')){
      $('.subform_1').addClass('dn')
      $('#checkbox02').trigger('click')

      $('#q1_1').val('')
      $('#q1_2').val('')
      $('#q1_3').val('')
      $('#q1_4').val('')
      $('#q1_5').val('')
      $('#q1_6').val('')

      $('#q3_1').val('')
      $('#q3_2').val('')
      $('#q3_3').val('')

    }else{
      $('.subform_1').removeClass('dn')
      $('#checkbox02').trigger('click')
    }
  })
})

function save_Report_5(){
  var check = 0;
  $('.req').removeClass('txt-danger')
  $('.req').addClass('txt-dark')
  $('.form-group').removeClass('has-error')

  var q1 = 0;
  var q2 = 0;

  if($("#checkbox01").is(':checked')){
    q1 = 1;
  }

  if($("#checkbox02").is(':checked')){
    q2 = 1;

    if($('#q1_1').val()==''){
      check++;
      $('#q1_1').parent().addClass('has-error')
    }

    if($('#q1_2').val()==''){
      check++;
      $('#q1_2').parent().addClass('has-error')
    }

    if($('#q1_3').val()==''){
      check++;
      $('#q1_3').parent().addClass('has-error')
    }

    if($('#q1_4').val()==''){
      check++;
      $('#q1_4').parent().addClass('has-error')
    }

    if($('#q1_5').val()==''){
      check++;
      $('#q1_5').parent().addClass('has-error')
    }

    if($('#q1_6').val()==''){
      check++;
      $('#q1_6').parent().addClass('has-error')
    }

    if($('#q3_1').val()==''){
      check++;
      $('#q3_1').parent().addClass('has-error')
    }

    if($('#q3_2').val()==''){
      check++;
      $('#q3_2').parent().addClass('has-error')
    }

    if($('#q3_3').val()==''){
      check++;
      $('#q3_3').parent().addClass('has-error')
    }
  }

  var q4 = null;
  if($("#checkbox4_1").is(':checked')){
    q4 = 0
  }else if($("#checkbox4_2").is(':checked')){
    q4 = 1
  }

  if(q4 == null){
    check++;
    $('#q4').addClass('txt-danger')
  }

  var q5 = null;
  if($("#checkbox5_1").is(':checked')){
    q5 = 0
  }else if($("#checkbox5_2").is(':checked')){
    q5 = 1
  }

  if(q5 == null){
    check++;
    $('#q5').addClass('txt-danger')
  }

  var q6 = null;
  if($("#checkbox6_1").is(':checked')){
    q6 = 0
    $('#q6_4').val('')
  }else if($("#checkbox6_2").is(':checked')){
    q6 = 1
    $('#q6_4').val('')
  }else if($("#checkbox6_3").is(':checked')){
    q6 = 2
  }

  if(q6 == null){
    check++;
    $('#q6').addClass('txt-danger')
  }

  var q7 = null;
  if($("#checkbox7_1").is(':checked')){
    q7 = 0
    $('#q7_1').val('')
    $('#q7_4').val('')
  }else if($("#checkbox7_2").is(':checked')){
    q7 = 1
    $('#q7_4').val('')
  }else if($("#checkbox7_3").is(':checked')){
    q7 = 2
    $('#q7_1').val('')
  }

  if(q7 == null){
    check++;
    $('#q7').addClass('txt-danger')
  }

  var q8 = null;
  if($("#checkbox8_1").is(':checked')){
    q8 = 0
    $('#q8_3').val('')
  }else if($("#checkbox8_2").is(':checked')){
    q8 = 1
  }

  if(q8 == null){
    check++;
    $('#q8').addClass('txt-danger')
  }

  if(check != 0){
    swal("คำเตือน!", "กรุณากรอกข้อมูลให้ครบถ้วนก่อนดำเนินการ!", "warning")
    return ;
  }

  var param = {
    qs1: q1,
    qs1_remark: editData.getData(),
    qs2: q2,
    qs2_1: $('#q1_1').val(),
    qs2_2: $('#q1_2').val(),
    qs2_3: $('#q1_3').val(),
    qs2_4: $('#q1_4').val(),
    qs2_5: $('#q1_5').val(),
    qs2_6: $('#q1_6').val(),
    qs3_1: $('#q3_1').val(),
    qs3_2: $('#q3_2').val(),
    qs3_3: $('#q3_3').val(),
    qs4: q4,
    qs5: q5,
    qs6: q6,
    qs6_info: $('#q6_4').val(),
    qs7: q7,
    qs7_info_1: $('#q7_1').val(),
    qs7_info_2: $('#q7_4').val(),
    qs8: q8,
    qs8_info: $('#q8_3').val(),
    qs9: editData1.getData(),
    session_id: tem_session,
    id: current_id_pm,
    progress_id: '5',
    id_rs: current_id_rs,
    code_apdu: current_code_apdu,
    id_year: current_id_year
  }

  // console.log(param);
  // return ;

  if((current_code_apdu != null) && (current_id_rs != null) && (current_id_pm!=null) && (current_id_year!=null)){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/pm/insert_progress_5.php', param, function(){})
                .always(function(resp){
                  if(resp != 'N'){
                    if(resp.length < 10){
                      window.localStorage.setItem('current_progress_id', resp)
                      window.location = 'progress_5_1_info.html'
                    }
                    else{
                      console.log(resp);
                    }
                  }else{
                    console.log(resp);
                    swal("ขออภัย", "ไม่สามารถบันทึกข้อมูลได้้!", "error")
                    lp.hl()
                  }
                })
                .fail(function(){
                  swal("ขออภัย", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้!", "error")
                  lp.hl()
                })
  }else{

  }


}

function update_Report_5(){
  var check = 0;
  $('.req').removeClass('txt-danger')
  $('.req').addClass('txt-dark')
  $('.form-group').removeClass('has-error')



  var q1 = 0;
  var q2 = 0;

  if($("#checkbox01").is(':checked')){
    q1 = 1;
  }

  if($("#checkbox02").is(':checked')){
    q2 = 1;

    if($('#q1_1').val()==''){
      check++;
      $('#q1_1').parent().addClass('has-error')
    }

    if($('#q1_2').val()==''){
      check++;
      $('#q1_2').parent().addClass('has-error')
    }

    if($('#q1_3').val()==''){
      check++;
      $('#q1_3').parent().addClass('has-error')
    }

    if($('#q1_4').val()==''){
      check++;
      $('#q1_4').parent().addClass('has-error')
    }

    if($('#q1_5').val()==''){
      check++;
      $('#q1_5').parent().addClass('has-error')
    }

    if($('#q1_6').val()==''){
      check++;
      $('#q1_6').parent().addClass('has-error')
    }

    if($('#q3_1').val()==''){
      check++;
      $('#q3_1').parent().addClass('has-error')
    }

    if($('#q3_2').val()==''){
      check++;
      $('#q3_2').parent().addClass('has-error')
    }

    if($('#q3_3').val()==''){
      check++;
      $('#q3_3').parent().addClass('has-error')
    }
  }

  var q4 = null;
  if($("#checkbox4_1").is(':checked')){
    q4 = 0
  }else if($("#checkbox4_2").is(':checked')){
    q4 = 1
  }

  if(q4 == null){
    check++;
    $('#q4').addClass('txt-danger')
  }

  var q5 = null;
  if($("#checkbox5_1").is(':checked')){
    q5 = 0
  }else if($("#checkbox5_2").is(':checked')){
    q5 = 1
  }

  if(q5 == null){
    check++;
    $('#q5').addClass('txt-danger')
  }

  var q6 = null;
  if($("#checkbox6_1").is(':checked')){
    q6 = 0
    $('#q6_4').val('')
  }else if($("#checkbox6_2").is(':checked')){
    q6 = 1
    $('#q6_4').val('')
  }else if($("#checkbox6_3").is(':checked')){
    q6 = 2
  }

  if(q6 == null){
    check++;
    $('#q6').addClass('txt-danger')
  }

  var q7 = null;
  if($("#checkbox7_1").is(':checked')){
    q7 = 0
    $('#q7_1').val('')
    $('#q7_4').val('')
  }else if($("#checkbox7_2").is(':checked')){
    q7 = 1
    $('#q7_4').val('')
  }else if($("#checkbox7_3").is(':checked')){
    q7 = 2
    $('#q7_1').val('')
  }

  if(q7 == null){
    check++;
    $('#q7').addClass('txt-danger')
  }

  var q8 = null;
  if($("#checkbox8_1").is(':checked')){
    q8 = 0
    $('#q8_3').val('')
  }else if($("#checkbox8_2").is(':checked')){
    q8 = 1
  }

  if(q8 == null){
    check++;
    $('#q8').addClass('txt-danger')
  }

  if(check != 0){
    swal("คำเตือน!", "กรุณากรอกข้อมูลให้ครบถ้วนก่อนดำเนินการ!", "warning")
    return ;
  }

  var param = {
    qs1: q1,
    qs1_remark: editData.getData(),
    qs2: q2,
    qs2_1: $('#q1_1').val(),
    qs2_2: $('#q1_2').val(),
    qs2_3: $('#q1_3').val(),
    qs2_4: $('#q1_4').val(),
    qs2_5: $('#q1_5').val(),
    qs2_6: $('#q1_6').val(),
    qs3_1: $('#q3_1').val(),
    qs3_2: $('#q3_2').val(),
    qs3_3: $('#q3_3').val(),
    qs4: q4,
    qs5: q5,
    qs6: q6,
    qs6_info: $('#q6_4').val(),
    qs7: q7,
    qs7_info_1: $('#q7_1').val(),
    qs7_info_2: $('#q7_4').val(),
    qs8: q8,
    qs8_info: $('#q8_3').val(),
    qs9: editData1.getData(),
    session_id: tem_session,
    id: current_id_pm,
    progress_id: '5',
    id_rs: current_id_rs,
    code_apdu: current_code_apdu,
    id_year: current_id_year
  }

  // console.log(param);
  // return ;

  if((current_code_apdu != null) && (current_id_rs != null) && (current_id_pm!=null) && (current_id_year!=null)){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/pm/update_progress_5.php', param, function(){})
                .always(function(resp){
                  console.log(resp);
                  if(resp != 'N'){
                    if(resp.length < 10){
                      window.localStorage.setItem('current_progress_id', current_pid)
                      window.location = 'progress_5_1_info.html'
                    }
                    else{
                      console.log(resp);
                    }
                  }else{
                    console.log(resp);
                    swal("ขออภัย", "ไม่สามารถบันทึกข้อมูลได้้!", "error")
                    lp.hl()
                  }
                })
                .fail(function(){
                  swal("ขออภัย", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้!", "error")
                  lp.hl()
                })
  }else{

  }


}

function checkProgressDocument(pid, session){
  var param = {
    session_id: session,
    progress_id: pid
  }

  var jxhr = $.post(ws_url + 'controller/staff/check_upload_file_progress.php', param, function(){}, 'json')
              .always(function(snap){
                $('#file_attached_' + pid).empty();

                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(childSnap){
                    var data = '<li class="mb-5" style=""><a href="' + childSnap.f_fullpart +'" target="_blank" > <i class="fa fa-angle-double-right txt-primary" aria-hidden="true"></i> ' + childSnap.f_name + '</a></li>';
                    $('#file_attached_' + pid).append(data);
                  })
                }

              }, 'json')
}


function checkProgress(pid){
  if(current_id_rs != null){
    var param = {
      session_id: tem_session,
      progress_id: pid
    }

    var jxhr = $.post(ws_url + 'controller/staff/check_upload_file_progress.php', param, function(){}, 'json')
                .always(function(snap){
                  $('#file_attached_' + pid).empty();

                  if((snap != '') && (snap.length > 0)){
                    snap.forEach(function(childSnap){
                      var data = '<li class="mb-5" style=""><a href="' + childSnap.f_fullpart +'" target="_blank" class="btn btn-success btn-square pt-10"><i class="fa fa-download txt-light"></i></a> <a href="Javascript:void(0)" onclick="delete_file_progress(' + childSnap.fid +', \'' + pid + '\')" class="btn btn-info btn-square pt-10"><i class="fa fa-close txt-light"></i></a> &nbsp; ' + childSnap.f_name + '</li>';
                      $('#file_attached_' + pid).append(data);
                    })
                  }

                }, 'json')
  }
}

function delete_file_progress(fid, pid){
  var param = {
    file_id: fid,
    progress_id: pid
  }

  var jxhr = $.post(ws_url + 'controller/delete_file_progress.php', param, function(){})
              .always(function(resp){
                if(resp != 'Y'){
                    swal("เกิดข้อผิดพลาด", "ไม่สามารถลบไฟล์ได้!", "error")
                }
                checkProgress(pid)
              })
}

function load_progress_info(){
  var param = {
    pid: current_pid,
    progress: '5'
  }

  console.log(param);
  var jxhr = $.post(ws_url + 'controller/get_progress_info.php', param, function(){}, 'json')
              .always(function(snap){
                console.log(snap);
                var tmp_session_id = null
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){

                    var rpid = i.rp_id
                    if(i.rp_id < 10){
                      rpid = '0' + i.rp_id
                    }

                    var pid = i.rp_progress_id
                    if(i.rp_progress_id < 10){
                      pid = '0' + i.rp_progress_id
                    }

                    var ref_id = (parseInt(i.id_year) + 41) + '-' + i.id_rs + '-' + rpid + '-' + pid;

                    $('#txt-ref').text(ref_id)

                    $('#txt-thTitle').text(i.title_th)
                    $('#txtThTitle').val(i.title_th)
                    $('#txt-enTitle').text(i.title_en)
                    $('#txtEnTitle').val(i.title_en)
                    $('#txt-rec').text(i.code_apdu)
                    $('#txtCode').val(i.code_apdu)
                    $('#txt-pm-name').text(i.fname + ' ' + i.lname)
                    $('.piname').text(i.fname + ' ' + i.lname)
                    $('#txt-phone').text(i.phone)
                    $('#txt-email').text(i.email)
                    $('#txt-protocol-no').text(i.protocol_no)
                    $('#txtProtocal').val(i.protocol_no)
                    if(i.dept != ''){
                      $('#txt-dept-name').text(i.dept)
                    }else{
                      $('#txt-dept-name').text(i.dept_name)
                    }

                    $('#txt-rec-app-date').text(main_app.convertThaidate(i.approve_date))
                    $('#txt-progress-rep-date').text(main_app.convertThaidate(get_today_date()))

                    if(i.rp5_qs1 == 1){
                      $('#checkbox01').trigger('click')
                      $('.subform_1').addClass('dn')
                    }else{
                      $('#q1_1').val(i.rp5_qs2_1)
                      $('#q1_2').val(i.rp5_qs2_2)
                      $('#q1_3').val(i.rp5_qs2_3)
                      $('#q1_4').val(i.rp5_qs2_4)
                      $('#q1_5').val(i.rp5_qs2_5)
                      $('#q1_6').val(i.rp5_qs2_6)

                      $('#q3_1').val(i.rp5_qs3_1)
                      $('#q3_2').val(i.rp5_qs3_2)
                      $('#q3_3').val(i.rp5_qs3_3)
                    }

                    if(i.rp5_qs1 == 1){
                      $('#q1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                    }

                    if(i.rp5_qs2 == 1){
                      $('#q2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q1_1').text(i.rp5_qs2_1)
                      $('#q1_2').text(i.rp5_qs2_2)
                      $('#q1_3').text(i.rp5_qs2_3)
                      $('#q1_4').text(i.rp5_qs2_4)
                      $('#q1_5').text(i.rp5_qs2_5)
                      $('#q1_6').text(i.rp5_qs2_6)

                      $('#q3_1').text(i.rp5_qs3_1)
                      $('#q3_2').text(i.rp5_qs3_2)
                      $('#q3_3').text(i.rp5_qs3_3)

                      $('.rs').addClass('txt-info')
                    }

                    if(i.rp5_qs4 == 0){
                      $('#q4_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox4_1').prop('checked', 'checked')
                    }else if(i.rp5_qs4 == 1){
                      $('#q4_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox4_2').prop('checked', 'checked')
                    }

                    if(i.rp5_qs5 == 0){
                      $('#q5_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox5_1').prop('checked', 'checked')
                    }else if(i.rp5_qs5 == 1){
                      $('#q5_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox5_2').prop('checked', 'checked')
                    }

                    if(i.rp5_qs6 == 0){
                      $('#q6_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox6_1').prop('checked', 'checked')
                    }else if(i.rp5_qs6 == 1){
                      $('#q6_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox6_2').prop('checked', 'checked')
                    }else if(i.rp5_qs6 == 2){
                      $('#q6_3').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q6_3_info').text(i.rp5_qs6_info)
                      $('#q6_4').val(i.rp5_qs6_info)
                      $('#checkbox6_3').prop('checked', 'checked')
                    }

                    if(i.rp5_qs7 == 0){
                      $('#q7_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_1').prop('checked', 'checked')
                    }else if(i.rp5_qs7 == 1){
                      $('#q7_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_2').prop('checked', 'checked')
                      $('#q7_2_info').text(i.rp5_qs7_info_1)
                      $('#q7_1').val(i.rp5_qs7_info_1)
                    }else if(i.rp5_qs7 == 2){
                      $('#q7_3').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_3').prop('checked', 'checked')
                      $('#q7_3_info').text(i.rp5_qs7_info_2)
                      $('#q7_4').val(i.rp5_qs7_info_2)
                    }

                    if(i.rp5_qs8 == 0){
                      $('#q8_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox8_1').prop('checked', 'checked')
                    }else if(i.rp5_qs8 == 1){
                      $('#q8_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox8_2').prop('checked', 'checked')
                      $('#q8_2_info').text(i.rp5_qs8_info)
                      $('#q8_3').val(i.rp5_qs8_info)
                    }

                    $('#q9').html(i.rp5_qs9)

                    $('#todaydate').text(main_app.convertThaidate(get_today_date()))

                    tmp_session_id = i.rp_session
                    tmp_progress_status = i.rp_progress_status

                    if(i.rp_sending_status == 1){
                      $('#btnPrint').prop('disabled', '')
                      $('#btnSending').addClass('dn')
                      $('#btnEdit').addClass('dn')

                      $('#txt-progress-status').text(i.status_name)
                      $('#txt-progress-rep-date').text(main_app.convertThaidate(i.rp_submit_date))

                      if(i.rp_progress_status == 2){
                        $('#btnEdit').removeClass('dn')
                        $('#btnSending').removeClass('dn')
                      }

                      if(i.rp_progress_status == 19){
                        $('#btnEdit').removeClass('dn')
                        $('#btnSending').removeClass('dn')
                      }
                    }

                  })

                  checkProgressDocument(5, tmp_session_id)

                  lp.hl()
                }else{
                  swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่พบข้อมูลการรายงานที่ต้องการ!",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "รับทราบ",
                    closeOnConfirm: false },
                  function(){
                    window.location = './'
                  });
                }
              }, 'json')
              .fail(function(){
                swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่พบข้อมูลการรายงานที่ต้องการ!",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "รับทราบ",
                  closeOnConfirm: false },
                function(){
                  window.location = './'
                });
              })
}

function load_progress_info_update(){
  var param = {
    pid: current_pid,
    progress: '5'
  }
  var jxhr = $.post(ws_url + 'controller/get_progress_info.php', param, function(){}, 'json')
              .always(function(snap){
                console.log(snap);
                var tmp_session_id = null
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){

                    var rpid = i.rp_id
                    if(i.rp_id < 10){
                      rpid = '0' + i.rp_id
                    }

                    var pid = i.rp_progress_id
                    if(i.rp_progress_id < 10){
                      pid = '0' + i.rp_progress_id
                    }

                    var ref_id = (parseInt(i.id_year) + 41) + '-' + i.id_rs + '-' + rpid + '-' + pid;

                    $('#txt-ref').text(ref_id)

                    $('#txt-thTitle').text(i.title_th)
                    $('#txtThTitle').val(i.title_th)
                    $('#txt-enTitle').text(i.title_en)
                    $('#txtEnTitle').val(i.title_en)
                    $('#txt-rec').text(i.code_apdu)
                    current_code_apdu = i.code_apdu
                    current_id_year = i.id_year
                    current_id_pm = i.id_pm
                    $('#txtCode').val(i.code_apdu)
                    $('#txt-pm-name').text(i.fname + ' ' + i.lname)
                    $('.piname').text(i.fname + ' ' + i.lname)
                    $('#txt-phone').text(i.phone)
                    $('#txt-email').text(i.email)
                    $('#txt-protocol-no').text(i.protocol_no)
                    $('#txtProtocal').val(i.protocol_no)
                    if(i.dept != ''){
                      $('#txt-dept-name').text(i.dept)
                    }else{
                      $('#txt-dept-name').text(i.dept_name)
                    }

                    if(i.rp5_qs1 == 1){
                      $('#checkbox01').trigger('click')
                      $('.subform_1').addClass('dn')

                      editData.setData(i.rp5_qs1_remak)
                    }else{
                      $('#q1_1').val(i.rp5_qs2_1)
                      $('#q1_2').val(i.rp5_qs2_2)
                      $('#q1_3').val(i.rp5_qs2_3)
                      $('#q1_4').val(i.rp5_qs2_4)
                      $('#q1_5').val(i.rp5_qs2_5)
                      $('#q1_6').val(i.rp5_qs2_6)

                      $('#q3_1').val(i.rp5_qs3_1)
                      $('#q3_2').val(i.rp5_qs3_2)
                      $('#q3_3').val(i.rp5_qs3_3)
                    }

                    if(i.rp5_qs1 == 1){
                      $('#q1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                    }

                    if(i.rp5_qs2 == 1){
                      $('#q2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q1_1').text(i.rp5_qs2_1)
                      $('#q1_2').text(i.rp5_qs2_2)
                      $('#q1_3').text(i.rp5_qs2_3)
                      $('#q1_4').text(i.rp5_qs2_4)
                      $('#q1_5').text(i.rp5_qs2_5)
                      $('#q1_6').text(i.rp5_qs2_6)

                      $('#q3_1').text(i.rp5_qs3_1)
                      $('#q3_2').text(i.rp5_qs3_2)
                      $('#q3_3').text(i.rp5_qs3_3)

                      $('.rs').addClass('txt-info')
                    }

                    if(i.rp5_qs4 == 0){
                      $('#q4_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox4_1').prop('checked', 'checked')
                    }else if(i.rp5_qs4 == 1){
                      $('#q4_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox4_2').prop('checked', 'checked')
                    }

                    if(i.rp5_qs5 == 0){
                      $('#q5_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox5_1').prop('checked', 'checked')
                    }else if(i.rp5_qs5 == 1){
                      $('#q5_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox5_2').prop('checked', 'checked')
                    }

                    if(i.rp5_qs6 == 0){
                      $('#q6_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox6_1').prop('checked', 'checked')
                    }else if(i.rp5_qs6 == 1){
                      $('#q6_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox6_2').prop('checked', 'checked')
                    }else if(i.rp5_qs6 == 2){
                      $('#q6_3').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q6_3_info').text(i.rp5_qs6_info)
                      $('#q6_4').val(i.rp5_qs6_info)
                      $('#checkbox6_3').prop('checked', 'checked')
                    }

                    if(i.rp5_qs7 == 0){
                      $('#q7_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_1').prop('checked', 'checked')
                    }else if(i.rp5_qs7 == 1){
                      $('#q7_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_2').prop('checked', 'checked')
                      $('#q7_2_info').text(i.rp5_qs7_info_1)
                      $('#q7_1').val(i.rp5_qs7_info_1)
                    }else if(i.rp5_qs7 == 2){
                      $('#q7_3').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox7_3').prop('checked', 'checked')
                      $('#q7_3_info').text(i.rp5_qs7_info_2)
                      $('#q7_4').val(i.rp5_qs7_info_2)
                    }

                    if(i.rp5_qs8 == 0){
                      $('#q8_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox8_1').prop('checked', 'checked')
                    }else if(i.rp5_qs8 == 1){
                      $('#q8_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#checkbox8_2').prop('checked', 'checked')
                      $('#q8_2_info').text(i.rp5_qs8_info)
                      $('#q8_3').val(i.rp5_qs8_info)
                    }

                    $('#q9').html(i.rp5_qs9)
                    editData1.setData(i.rp5_qs9)

                    $('#todaydate').text(main_app.convertThaidate(get_today_date()))

                    tem_session = i.rp_session
                    current_id_rs = i.id_rs
                    current_id_pm = i.id_pm
                    $('#docSession').val(tem_session)
                    $('#docIdrs').val(current_id_rs)
                    $('#docCodeapdu').val(i.code_apdu)

                  })
                  checkProgress(5)

                  lp.hl()
                }else{
                  swal({
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่พบข้อมูลการรายงานที่ต้องการ!",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "รับทราบ",
                    closeOnConfirm: false },
                  function(){
                    window.location = './'
                  });
                }
              }, 'json')
              .fail(function(){
                swal({
                  title: "เกิดข้อผิดพลาด",
                  text: "ไม่พบข้อมูลการรายงานที่ต้องการ!",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "รับทราบ",
                  closeOnConfirm: false },
                function(){
                  window.location = './'
                });
              })
}

function sendProgressData(){
  var param = {
    pid: current_pid,
    id: current_user
  }

  // console.log(tmp_progress_status);
  // return ;

  swal({
    title: "คุณแน่ใจหรือไม่",
    text: "เมื่อคุณยืนยันส่งรายงานแล้ว คุณจะไม่สามารถแก้ไขได้อีกจนกว่าจะได้รับการตอบกลับให้แก้ไขจากเจ้าหน้าที่!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){

    lp.sl()

    // console.log(param);

    if(tmp_progress_status == '19'){
      var jxhr = $.post(ws_url + 'controller/confirm-sending-report-19.php', param, function(){})
                  .always(function(resp){
                    console.log(resp);
                    if(resp == 'Y'){
                      setTimeout(function(){
                        swal({
                          title: "ดำเนินการสำเร็จ",
                          text: "รายงานของท่านได้ถูกส่งไปยังเจ้าหน้าที่แล้ว กด 'ตกลง' เพื่อไปสู่หน้ารายการรายงานทั้งหมด",
                          type: "warning",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "ตกลง",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location = 'all-progress-record.html'
                        });
                      }, 1000)
                    }else{
                      swal("เกิดข้อผิดพลาด", "ไม่สามารถทำการส่งรายงานได้ กรุณาติดต่อเจ้าหน้าที่!", "error")
                      lp.hl()
                    }
                  })
                  .fail(function(){
                    onFail()
                  })
    }else{
      var jxhr = $.post(ws_url + 'controller/confirm-sending-report.php', param, function(){})
                  .always(function(resp){
                    console.log(resp);
                    if(resp == 'Y'){
                      setTimeout(function(){
                        swal({
                          title: "ดำเนินการสำเร็จ",
                          text: "รายงานของท่านได้ถูกส่งไปยังเจ้าหน้าที่แล้ว กด 'ตกลง' เพื่อไปสู่หน้ารายการรายงานทั้งหมด",
                          type: "warning",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "ตกลง",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location = 'all-progress-record.html'
                        });
                      }, 1000)
                    }else{
                      swal("เกิดข้อผิดพลาด", "ไม่สามารถทำการส่งรายงานได้ กรุณาติดต่อเจ้าหน้าที่!", "error")
                      lp.hl()
                    }
                  })
                  .fail(function(){
                    onFail()
                  })
    }



  });
}

function onFail(){
  swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้!", "error")
  lp.hl()
}
