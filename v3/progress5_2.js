var editData = '';
var editData1 = '';
var editData2 = '';
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
  height: '250px'
});

editData2 = CKEDITOR.replace( 'bf2', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '250px'
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
        checkProgress(6)
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
      $('.subform_i').addClass('dn')
      $('#checkbox02').prop('checked', '')
      $('#q2_1').val('')
      $('#q2_2').val('')
      $('#q2_3').val('')
      $('#q2_4').val('')
      $('#q2_5').val('')
      $('#q2_6').val('')

      $('#q3_1,#q3_2,#q3_3').val('')

      $('#checkbox4_1').prop('checked', '')
      $('#checkbox4_2').prop('checked', '')
      $('#q4_1').val('')
      $('#q4_2').val('')

      $('#checkbox5_1').prop('checked', '')
      $('#checkbox5_2').prop('checked', '')
      $('#q5_1').val('')
      $('#q5_2').val('')

    }else{
      $('#q2_info').val('')
      $('.subform_i').removeClass('dn')
      $('#checkbox02').prop('checked', 'checked')
    }
  })

  $('#checkbox02').click(function(){
    if($("#checkbox02").is(':checked')){
      $('#checkbox01').prop('checked', '')
    }else{
      $('.subform_i').removeClass('dn')
      $('#checkbox01').prop('checked', 'checked')
    }
  })


})

function save_Report_5(){

  var check = 0;
  var req_item = [];
  $('.req').removeClass('txt-danger')
  $('.req').addClass('txt-dark')
  $('.form-group').removeClass('has-error')
  $('#q1').removeClass('txt-danger')
  $('#q1').addClass('txt-dark')
  $('#q2').addClass('txt-dark')

  var q1 = editData.getData();
  if(q1 == ''){
    check++;
    req_item.push(0)
    $('#q1').removeClass('txt-dark')
    $('#q1').addClass('txt-danger')
  }

  var q2 = null;
  var q2_1 = 0;
  var q2_2 = 0;
  var q2_3 = 0;
  var q2_4 = 0;
  var q2_5 = 0;
  var q2_6 = 0;
  var q3_1 = 0;
  var q3_2 = 0;
  var q3_3 = 0;

  var q4 = null;
  var q4_1 = ''
  var q4_2 = ''

  var q5 = null;
  var q5_1 = ''
  var q5_2 = ''

  // var a = 0;
  // if($("#checkbox02").is(':checked')){
  //
  // }else{
  //   a++;
  // }
  //
  // if($("#checkbox03").is(':checked')){
  //
  // }

  if((!$("#checkbox01").is(':checked')) && (!$("#checkbox02").is(':checked'))){
    check++;
    $('#q2').addClass('txt-danger')
    req_item.push(1)
  }

  if($("#checkbox01").is(':checked')){
    q2 = 0
    if($('#q2_info').val()==''){
      check++
      req_item.push(2)
      $('#q2_info').parent().addClass('has-error')
    }
  }

  if($("#checkbox02").is(':checked')){
    q2 = 1
    if($('#q2_1').val()==''){
      check++;
      req_item.push(3)
      $('#q2_1').parent().addClass('has-error')
    }
    if($('#q2_2').val()==''){
      check++;
      req_item.push(4)
      $('#q2_2').parent().addClass('has-error')
    }
    if($('#q2_3').val()==''){
      check++;
      req_item.push(5)
      $('#q2_3').parent().addClass('has-error')
    }
    if($('#q2_4').val()==''){
      check++;
      req_item.push(6)
      $('#q2_4').parent().addClass('has-error')
    }
    if($('#q2_5').val()==''){
      check++;
      req_item.push(7)
      $('#q2_5').parent().addClass('has-error')
    }
    if($('#q2_6').val()==''){
      check++;
      req_item.push(8)
      $('#q2_6').parent().addClass('has-error')
    }
    if($('#q3_1').val()==''){
      check++;
      req_item.push(9)
      $('#q3_1').parent().addClass('has-error')
    }
    if($('#q3_2').val()==''){
      check++;
      req_item.push(10)
      $('#q3_2').parent().addClass('has-error')
    }
    if($('#q3_3').val()==''){
      check++;
      req_item.push(11)
      $('#q3_3').parent().addClass('has-error')
    }

    if($("#checkbox4_1").is(':checked')){
      q4 = 0
      q4_1 = $('#q4_1').val()
    }else if($("#checkbox4_2").is(':checked')){
      q4 = 1
      q4_2 = $('#q4_2').val()
    }

    if(q4 == null){
      check++;
      req_item.push(12)
      $('#q4').addClass('txt-danger')
    }


    if($("#checkbox5_1").is(':checked')){
      q5 = 0
      q5_1 = $('#q5_1').val()
    }else if($("#checkbox5_2").is(':checked')){
      q5 = 1
      q5_2 = $('#q5_2').val()
    }

    if(q5 == null){
      check++;
      req_item.push(13)
      $('#q5').addClass('txt-danger')
    }
  }






  var q6 = null;
  if($("#checkbox6_1").is(':checked')){
    q6 = 0
  }else if($("#checkbox6_2").is(':checked')){
    q6 = 1
  }

  if(q6 == null){
    check++;
    req_item.push(14)
    $('#q6').addClass('txt-danger')
  }

  var q7 = editData1.getData();
  if(q7 == ''){
    check++;
    $('#q7').addClass('txt-danger')
    req_item.push(15)
  }

  var q8 = null;
  var q8_info = ''
  if($("#checkbox8_1").is(':checked')){
    q8 = 0
    $('#q8_1').val('')
  }else if($("#checkbox8_2").is(':checked')){
    q8 = 1
    q8_info = $('#q8_1').val()
  }

  if(q8 == null){
    check++;
    req_item.push(16)
    $('#q8').addClass('txt-danger')
  }

  var q9 = editData2.getData()
  if(q9 == ''){
    check++;
    req_item.push(17)
    $('#q9').addClass('txt-danger')
  }

  if(check != 0){
    console.log(req_item);
    swal("คำเตือน!", "กรุณากรอกข้อมูลให้ครบถ้วนก่อนดำเนินการ!", "warning")
    return ;
  }



  var param = {
    qs1: editData.getData(),
    qs2: q2,
    qs2_info: $('#q2_info').val(),
    qs2_1: $('#q2_1').val(),
    qs2_2: $('#q2_2').val(),
    qs2_3: $('#q2_3').val(),
    qs2_4: $('#q2_4').val(),
    qs2_5: $('#q2_5').val(),
    qs2_6: $('#q2_6').val(),
    qs3_1: $('#q3_1').val(),
    qs3_2: $('#q3_2').val(),
    qs3_3: $('#q3_3').val(),
    qs4: q4,
    qs4_info_1: q4_1,
    qs4_info_2: q4_2,
    qs5: q5,
    qs5_info_1: q5_1,
    qs5_info_2: q5_2,
    qs6: q6,
    qs7: editData1.getData(),
    qs8: q8,
    qs8_info: q8_info,
    qs9: editData2.getData(),
    session_id: tem_session,
    id: current_id_pm,
    progress_id: '6',
    id_rs: current_id_rs,
    code_apdu: current_code_apdu,
    id_year: current_id_year
  }

  if((current_code_apdu != null) && (current_id_rs != null) && (current_id_pm!=null) && (current_id_year!=null)){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/pm/insert_progress_6.php', param, function(){})
                .always(function(resp){
                  if(resp != 'N'){
                    if(resp.length < 10){
                      window.localStorage.setItem('current_progress_id', resp)
                      window.location = 'progress_5_2_info.html'
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
    alert('Error')
  }


}

function update_Report_6(){
  var check = 0;
  var req_item = [];
  $('.req').removeClass('txt-danger')
  $('.req').addClass('txt-dark')
  $('.form-group').removeClass('has-error')
  $('#q1').removeClass('txt-danger')
  $('#q1').addClass('txt-dark')
  $('#q2').addClass('txt-dark')

  var q1 = editData.getData();
  if(q1 == ''){
    check++;
    req_item.push(0)
    $('#q1').removeClass('txt-dark')
    $('#q1').addClass('txt-danger')
  }

  var q2 = null;
  var q2_1 = 0;
  var q2_2 = 0;
  var q2_3 = 0;
  var q2_4 = 0;
  var q2_5 = 0;
  var q2_6 = 0;
  var q3_1 = 0;
  var q3_2 = 0;
  var q3_3 = 0;

  var q4 = null;
  var q4_1 = ''
  var q4_2 = ''

  var q5 = null;
  var q5_1 = ''
  var q5_2 = ''

  // var a = 0;
  // if($("#checkbox02").is(':checked')){
  //
  // }else{
  //   a++;
  // }
  //
  // if($("#checkbox03").is(':checked')){
  //
  // }

  if((!$("#checkbox01").is(':checked')) && (!$("#checkbox02").is(':checked'))){
    check++;
    $('#q2').addClass('txt-danger')
    req_item.push(1)
  }

  if($("#checkbox01").is(':checked')){
    q2 = 0
    if($('#q2_info').val()==''){
      check++
      req_item.push(2)
      $('#q2_info').parent().addClass('has-error')
    }
  }

  if($("#checkbox02").is(':checked')){
    q2 = 1
    if($('#q2_1').val()==''){
      check++;
      req_item.push(3)
      $('#q2_1').parent().addClass('has-error')
    }
    if($('#q2_2').val()==''){
      check++;
      req_item.push(4)
      $('#q2_2').parent().addClass('has-error')
    }
    if($('#q2_3').val()==''){
      check++;
      req_item.push(5)
      $('#q2_3').parent().addClass('has-error')
    }
    if($('#q2_4').val()==''){
      check++;
      req_item.push(6)
      $('#q2_4').parent().addClass('has-error')
    }
    if($('#q2_5').val()==''){
      check++;
      req_item.push(7)
      $('#q2_5').parent().addClass('has-error')
    }
    if($('#q2_6').val()==''){
      check++;
      req_item.push(8)
      $('#q2_6').parent().addClass('has-error')
    }
    if($('#q3_1').val()==''){
      check++;
      req_item.push(9)
      $('#q3_1').parent().addClass('has-error')
    }
    if($('#q3_2').val()==''){
      check++;
      req_item.push(10)
      $('#q3_2').parent().addClass('has-error')
    }
    if($('#q3_3').val()==''){
      check++;
      req_item.push(11)
      $('#q3_3').parent().addClass('has-error')
    }

    if($("#checkbox4_1").is(':checked')){
      q4 = 0
      q4_1 = $('#q4_1').val()
    }else if($("#checkbox4_2").is(':checked')){
      q4 = 1
      q4_2 = $('#q4_2').val()
    }

    if(q4 == null){
      check++;
      req_item.push(12)
      $('#q4').addClass('txt-danger')
    }


    if($("#checkbox5_1").is(':checked')){
      q5 = 0
      q5_1 = $('#q5_1').val()
    }else if($("#checkbox5_2").is(':checked')){
      q5 = 1
      q5_2 = $('#q5_2').val()
    }

    if(q5 == null){
      check++;
      req_item.push(13)
      $('#q5').addClass('txt-danger')
    }
  }






  var q6 = null;
  if($("#checkbox6_1").is(':checked')){
    q6 = 0
  }else if($("#checkbox6_2").is(':checked')){
    q6 = 1
  }

  if(q6 == null){
    check++;
    req_item.push(14)
    $('#q6').addClass('txt-danger')
  }

  var q7 = editData1.getData();
  if(q7 == ''){
    check++;
    $('#q7').addClass('txt-danger')
    req_item.push(15)
  }

  var q8 = null;
  var q8_info = ''
  if($("#checkbox8_1").is(':checked')){
    q8 = 0
    $('#q8_1').val('')
  }else if($("#checkbox8_2").is(':checked')){
    q8 = 1
    q8_info = $('#q8_1').val()
  }

  if(q8 == null){
    check++;
    req_item.push(16)
    $('#q8').addClass('txt-danger')
  }

  var q9 = editData2.getData()
  if(q9 == ''){
    check++;
    req_item.push(17)
    $('#q9').addClass('txt-danger')
  }

  if(check != 0){
    console.log(req_item);
    swal("คำเตือน!", "กรุณากรอกข้อมูลให้ครบถ้วนก่อนดำเนินการ!", "warning")
    return ;
  }

  var param = {
    qs1: editData.getData(),
    qs2: q2,
    qs2_info: $('#q2_info').val(),
    qs2_1: $('#q2_1').val(),
    qs2_2: $('#q2_2').val(),
    qs2_3: $('#q2_3').val(),
    qs2_4: $('#q2_4').val(),
    qs2_5: $('#q2_5').val(),
    qs2_6: $('#q2_6').val(),
    qs3_1: $('#q3_1').val(),
    qs3_2: $('#q3_2').val(),
    qs3_3: $('#q3_3').val(),
    qs4: q4,
    qs4_info_1: q4_1,
    qs4_info_2: q4_2,
    qs5: q5,
    qs5_info_1: q5_1,
    qs5_info_2: q5_2,
    qs6: q6,
    qs7: editData1.getData(),
    qs8: q8,
    qs8_info: q8_info,
    qs9: editData2.getData(),
    session_id: tem_session,
    id: current_id_pm,
    progress_id: '6',
    id_rs: current_id_rs,
    code_apdu: current_code_apdu,
    id_year: current_id_year
  }

  if((current_code_apdu != null) && (current_id_rs != null) && (current_id_pm!=null) && (current_id_year!=null)){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/pm/update_progress_6.php', param, function(){})
                .always(function(resp){
                  console.log(resp);
                  if(resp != 'N'){
                    if(resp.length < 10){
                      window.localStorage.setItem('current_progress_id', current_pid)
                      window.location = 'progress_5_2_info.html'
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
    alert('Error')
  }


}

function checkProgressDocument(pid, session){
  var param = {
    session_id: session,
    progress_id: pid
  }

  var jxhr = $.post(ws_url + 'controller/staff/check_upload_file_progress.php', param, function(){}, 'json')
              .always(function(snap){

                console.log(snap);
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
    progress: '6'
  }

  console.log(param);
  var jxhr = $.post(ws_url + 'controller/get_progress_info.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
                var tmp_session_id = null
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){

                    var rpid = i.rp_id
                    // if(i.rp_id < 10){
                    //   rpid = '0' + i.rp_id
                    // }

                    var pid = i.rp_progress_id
                    // if(i.rp_progress_id < 10){
                    //   pid = '0' + i.rp_progress_id
                    // }

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
                    $('#txt-found-name').text(i.source_funds)

                    $('#txt-q1').html(i.rp6_qs1)
                    $('#txt-q1').addClass('txt-info')


                    if(i.rp6_qs2 == 0){
                      $('#checkbox01').trigger('click')
                      $('.subform_i').addClass('dn')
                      $('#q1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q1_info').text(i.rp6_qs2_info)
                    }else{
                      $('#q2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q1_1').text(i.rp6_qs2_1)
                      $('#q1_2').text(i.rp6_qs2_2)
                      $('#q1_3').text(i.rp6_qs2_3)
                      $('#q1_4').text(i.rp6_qs2_4)
                      $('#q1_5').text(i.rp6_qs2_5)
                      $('#q1_6').text(i.rp6_qs2_6)
                      $('#q3_1').text(i.rp6_qs3_1)
                      $('#q3_2').text(i.rp6_qs3_2)
                      $('#q3_3').text(i.rp6_qs3_3)

                      if(i.rp6_qs4 == 0){
                        $('#q4_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                        $('#q4_1_i').text(i.rp6_qs4_info_1)
                      }else if(i.rp6_qs4 == 1){
                        $('#q4_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                        $('#q4_2_i').text(i.rp6_qs4_info_1)
                      }

                      if(i.rp6_qs5 == 0){
                        $('#q5_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                        $('#q5_1_i').text(i.rp6_qs5_info_1)
                      }else if(i.rp6_qs5 == 1){
                        $('#q5_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                        $('#q5_2_i').text(i.rp6_qs5_info_2)
                      }
                    }

                    if(i.rp6_qs6 == 0){
                      $('#q6_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                    }else if(i.rp6_qs6 == 1){
                      $('#q6_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                    }

                    $('#q7').html(i.rp6_qs7)

                    if(i.rp6_qs8 == 0){
                      $('#q8_1').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                    }else if(i.rp6_qs8 == 1){
                      $('#q8_2').html('<i class="fa fa-check-square-o" aria-hidden="true"></i>')
                      $('#q8_2_info').text(i.rp6_qs8_info)
                    }

                    $('#q9').html(i.rp6_qs9)

                    if(i.rp_sending_status == 1){
                      $('#btnPrint').prop('disabled', '')
                      $('#btnSending').addClass('dn')
                      $('#btnEdit').addClass('dn')

                      $('#txt-progress-status').text(i.status_name)
                      $('#txt-progress-rep-date').text(main_app.convertThaidate(i.rp_submit_date))
                    }

                    $('#todaydate').text(main_app.convertThaidate(get_today_date()))

                    tmp_session_id = i.rp_session
                    tmp_progress_status = i.rp_progress_status

                  })

                  checkProgressDocument(6, tmp_session_id)

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
    progress: '6'
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
                    var data1 = i.rp6_qs1;
                    console.log(data1);
                    setTimeout(function(){
                      editData.setData(data1)
                    }, 1999)

                    if(i.rp6_qs2 == 0){
                      $('#checkbox01').prop('checked', 'checked')
                      $('#q2_info').val(i.rp6_qs2_info)
                      $('.subform_i').addClass('dn')
                    }else{
                      $('#checkbox02').prop('checked', 'checked')
                      $('.subform_i').removeClass('dn')
                      $('#q2_1').val(i.rp6_qs2_1)
                      $('#q2_2').val(i.rp6_qs2_2)
                      $('#q2_3').val(i.rp6_qs2_3)
                      $('#q2_4').val(i.rp6_qs2_4)
                      $('#q2_5').val(i.rp6_qs2_5)
                      $('#q2_6').val(i.rp6_qs2_6)
                      $('#q3_1').val(i.rp6_qs3_1)
                      $('#q3_2').val(i.rp6_qs3_2)
                      $('#q3_3').val(i.rp6_qs3_3)

                      if(i.rp6_qs4 == 0){
                        $('#checkbox4_1').prop('checked', 'checked')
                        $('#q4_1').val(i.rp6_qs4_info_1)
                      }else if(i.rp6_qs4 == 1){
                        $('#checkbox4_2').prop('checked', 'checked')
                        $('#q4_2').val(i.rp6_qs4_info_2)
                      }

                      if(i.rp6_qs5 == 0){
                        $('#checkbox5_1').prop('checked', 'checked')
                        $('#q5_1').val(i.rp6_qs5_info_1)
                      }else if(i.rp6_qs5 == 1){
                        $('#checkbox5_2').prop('checked', 'checked')
                        $('#q5_2').val(i.rp6_qs5Pinfo_2)
                      }
                    }

                    if(i.rp6_qs6 == 0){
                      $('#checkbox6_1').prop('checked', 'checked')
                    }else if(i.rp6_qs6 == 1){
                      $('#checkbox6_2').prop('checked', 'checked')
                    }

                    editData1.setData(i.rp6_qs7)

                    if(i.rp6_qs8 == 0){
                      $('#checkbox8_1').prop('checked', 'checked')
                    }else if(i.rp6_qs8 == 1){
                      $('#checkbox8_2').prop('checked', 'checked')
                      $('#q8_1').val(i.rp6_qs8_info)
                    }

                    editData2.setData(i.rp6_qs9)

                    $('#todaydate').text(main_app.convertThaidate(get_today_date()))

                    tem_session = i.rp_session
                    current_id_rs = i.id_rs
                    current_id_pm = i.id_pm
                    $('#docSession').val(tem_session)
                    $('#docIdrs').val(current_id_rs)
                    $('#docCodeapdu').val(i.code_apdu)

                  })
                  checkProgress(6)

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

    console.log(param);

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
