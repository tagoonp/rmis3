var rr_form = {
  part1: function(){
    $check = 0;
    $('.st1').empty()

    if($('#txtCodeapdu').val()==''){
      rr_notify.push('รหัส REC (ส่วนที่ 1)')
      $check++;
    }

    if($('#txt-rsStatus').val()==''){
      rr_notify.push('สถานะโครงการวิจัย (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtTitleTH').val()==''){
      rr_notify.push('ชื่อโครงการภาษาไทย (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtTitleEN').val()==''){
      rr_notify.push('ชื่อโครงการภาษาอังกฤษ (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtKeywordTH').val()==''){
      rr_notify.push('คำสำคัญ (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtKeywordEN').val()==''){
      rr_notify.push('Keyword (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtRtype').val()==''){
      rr_notify.push('ลักษณะการมีส่วนร่วม (ส่วนที่ 1)')
      $check++;
    }

    if($('#txtResearchType').val()==''){
      rr_notify.push('ประเภทของการวิจัย (ส่วนที่ 1)')
      $check++;
    }

    if($('#start_date').val()==''){
      rr_notify.push('วันที่คาดว่าจะเริ่มโครงการ (ส่วนที่ 1)')
      $check++;
    }

    if($('#finish_date').val()==''){
      rr_notify.push('วันที่คาดว่าโครงการสิ้นสุด (ส่วนที่ 1)')
      $check++;
    }

    if($check!=0){
      return ;
    }else{
      $('.st1').html('<i class="fa fa-check-circle"></i> ')
    }

    // console.log($check);
  },
  part2: function(){
    $check = 0;
    $('.st2').empty()

    if($('#num_copi').val()==''){
      rr_notify.push('ไม่ได้ระบุจำนวนผู้ร่วมวิจัย (ส่วนที่ 2)')
      $check++;
    }

    if($('#num_copi').val()!=co_pi.length){
      rr_notify.push('จำนวนผู้ร่วมวิจัยไม่เท่ากับรายชื่อผู้ร่วมวิจัย (ส่วนที่ 2)')
      $check++;
    }

    if($('#pi_cpt_job').val() == ''){
      rr_notify.push('ความรับผิดชอบต่อโครงการของ PI (ส่วนที่ 2)')
      $check++;
    }

    if($check == 0){
      $('.st2').html('<i class="fa fa-check-circle"></i> ')
    }
  },
  part3: function(){
    $('.st3').empty()
    $check = 0;
    if($('#txtBudget').val()==''){
      $check++;
      rr_notify.push('งบประมาณทั้งโครงการ (ส่วนที่ 3)')
    }else{

    }

    if($('#txtFund').val()==1){
      // console.log($('#txtFundsname').val());
      if($('#txtFundsname').val()==''){
        $check++;
        rr_notify.push('ชื่อแหล่งทุนวิจัย (ส่วนที่ 3 - 2)')
      }

      if((!$("#cb1").is(':checked')) && (!$("#cb2").is(':checked')) && (!$("#cb3").is(':checked')) && (!$("#cb4").is(':checked')) && (!$("#cb5").is(':checked')) && (!$("#cb7").is(':checked'))){
        $check++;
        rr_notify.push('แหล่งทุนวิจัย (ส่วนที่ 3 - 1)')
      }
    }

    if($check==0){
      $('.st3').html('<i class="fa fa-check-circle"></i> ')
    }
  },
  part4: function(){
    $('.st4').empty()
    if(editData.getData() != ''){
      $('.st4').html('<i class="fa fa-check-circle"></i> ')
    }else{
      rr_notify.push('Synopsis (สรุปย่อโครงการวิจัย) (ส่วนที่ 4)')
    }
  },
  part5: function(){
    $('.st5').empty()
    $check = 0;
    if($('#ftn1').val() == 0){
      $check++;
      rr_notify.push('Submission form (ส่วนที่ 5)')
    }

    if($('#ftn2').val() == 0){
      $check++;
      rr_notify.push('Protocol (ส่วนที่ 5)')
    }

    if($('#ftn8').val() == 0){
      $check++;
      rr_notify.push('Updated CV, หลักฐานการอบรมจริยธรรมวิจัย (ส่วนที่ 5)')
    }

    if($check==0){
      $('.st5').html('<i class="fa fa-check-circle"></i> ')
    }

  },
  part6: function(){
    $('.st6').empty()
    $check = 0;


    if($('#ftn10').val() == 0){
      $check++;
      rr_notify.push('ใบรับรอง/รับทราบ (ส่วนที่ 6)')
    }

    if($('#txtDateapprove').val() == 0){
      $check++;
      $('#txtDateapprove').parent().addClass('has-error')
      rr_notify.push('วันที่อนุมัติ (ส่วนที่ 6)')
    }else{
      $('#txtDateapprove').parent().removeClass('has-error')
    }

    if($('#txtVara').val() == 0){
      $check++;
      $('#txtVara').parent().addClass('has-error')
      rr_notify.push('ครั้งที่การประชุม (ส่วนที่ 6)')
    }else{
      $('#txtVara').parent().removeClass('has-error')
    }

    if($('#txtMeetingDate').val() == 0){
      $check++;
      $('#txtMeetingDate').parent().addClass('has-error')
      rr_notify.push('วันที่ประชุม (ส่วนที่ 6)')
    }else{
      $('#txtMeetingDate').parent().removeClass('has-error')
    }

    if($('#txtReportrange').val() == 0){
      $check++;
      $('#txtReportrange').parent().addClass('has-error')
      rr_notify.push('ช่วงการรายงานความก้าวหน้าทุก (ส่วนที่ 6)')
    }else{
      $('#txtReportrange').parent().removeClass('has-error')
    }

    if($('#txt-rsStatus').val() == 'closed'){
      if($('#ftn15').val() == 0){
        $check++;
        rr_notify.push('ใบรับรองการยุติโครงการวิจัย (ส่วนที่ 6)')
      }
    }
    if($check==0){
      $('.st6').html('<i class="fa fa-check-circle"></i> ')
    }

    var param = {
      app_date: $('#txtDateapprove').val(),
      app_reound: $('#txtVara').val() ,
      app_meeting: $('#txtMeetingDate').val() ,
      app_report_period: $('#txtReportrange').val() ,
      cont_app_date: $('#cont_date_approve').val() ,
      cont_date_meeting: $('#cont_date_meeting').val() ,
      rri_cont_acknowledge_closing: $('#rri_cont_acknowledge_closing').val() ,
      cuurent_session_id: current_session_id,
      id: current_user
    }

    var jxhr = $.post(ws_url + 'controller/pm/insert_app_retroact_info.php', param, function(){})
                .always(function(resp){
                  console.log(resp);
                  if(resp != 'Y'){
                    // alert('ไม่สามารถบันทึกข้อมูลใบรับรองได้')
                  }
                })

  },
  fn_summary: function(){
    $('.notify-info').empty();
    if(rr_notify.length > 0){
      rr_notify.forEach(function(i){
        $('.notify-info').append('- ' + i + '<br>');
      })
      $('#saveAllBtn').addClass('disabled')
      $('#saveAllBtn').addClass('dn')
    }else{
      $('#saveAllBtn').removeClass('disabled')
      $('#saveAllBtn').removeClass('dn')
    }

  }
}

Dropzone.options.myFile1 = {
  // acceptedFiles: 'application/pdf, .docx, .doc',
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(1)
      }
    });
  }
};

Dropzone.options.myFile2 = {
  acceptedFiles: 'application/pdf, .docx, .doc',
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
  acceptedFiles: 'application/pdf, .docx, .doc',
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
  acceptedFiles: 'application/pdf, .docx, .doc',
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
  acceptedFiles: 'application/pdf, .docx, .doc',
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
  acceptedFiles: 'application/pdf, .docx, .doc',
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
  acceptedFiles: 'application/pdf, .docx, .doc',
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

Dropzone.options.myFiler1 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      console.log(file);
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(10)
      }
    });
  }
};

Dropzone.options.myFiler2 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      // console.log(file);
      this.removeFile(file);
      // console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        checkData(11)
      }
    });
  }
};

Dropzone.options.myFiler3 = {
  acceptedFiles: 'application/pdf',
  maxFilesize: 100,
  init: function(){
    this.on("complete", function(file) {
      console.log(file);
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(15)
      }
    });
  }
};

$(function(){
  $('#txtResearchType').change(function(){
    console.log($(this).val());
  })

  $('#cb7').click(function(){
    if($("#cb7").is(':checked')){
      $cb7 = 1;
      $('#txtBf7').prop('readonly','')
      $('#txtBf7_protocol_no').prop('readonly', '')
    }else{
      $('#txtBf7').prop('readonly','readonly')
      $('#txtBf7_protocol_no').prop('readonly', 'readonly')
      $('#txtBf7').val('0')
      $('#txtBf7_protocol_no').val('')
    }
    saveDraftCheck()
  })

  $('#cb5').click(function(){
    if($("#cb5").is(':checked')){
      $cb5 = 1;
      $('#txtBf5').prop('readonly','')
    }else{
      $('#txtBf5').prop('readonly','readonly')
      $('#txtBf5').val('0')
    }
    saveDraftCheck()
  })

  $('#cb4').click(function(){
    if($("#cb4").is(':checked')){
      $cb4 = 1;
      $('#txtBf4').prop('readonly','')
    }else{
      $('#txtBf4').prop('readonly','readonly')
      $('#txtBf4').val('0')
    }
    saveDraftCheck()
  })

  $('#cb3').click(function(){
    if($("#cb3").is(':checked')){
      $cb3 = 1;
      $('#txtBf3').prop('readonly','')
    }else{
      $('#txtBf3').prop('readonly','readonly')
      $('#txtBf3').val('0')
    }
    saveDraftCheck()
  })

  $('#cb2').click(function(){
    if($("#cb2").is(':checked')){
      $cb2 = 1;
      $('#txtBf2').prop('readonly','')
    }else{
      $('#txtBf2').prop('readonly','readonly')
      $('#txtBf2').val('0')
    }
    saveDraftCheck()
  })

  $('#cb1').click(function(){
    if($("#cb1").is(':checked')){
      $cb1 = 1;
      $('#txtBf1').prop('readonly','')
    }else{
      $('#txtBf1').prop('readonly','readonly')
      $('#txtBf1').val('0')
    }
    saveDraftCheck()
  })
})

function loadPrevCopiData(sess_id){
  var jxhr = $.post(ws_url + 'controller/pm/pm-co-pi-info.php', {sess: sess_id, id: current_user}, function(){}, 'json')
              .always(function(snap){
                co_pi = [];
                // console.log(snap);
                if((snap.length > 0) && (snap != '')){
                  snap.forEach(function(i){
                    var copi_recordr = {
                      rid: i.copi_id,
                      prefix: i.co_prefix,
                      prefix_name: i.prefix_name,
                      fname: i.co_fname,
                      lname: i.co_lname,
                      email: i.co_email,
                      pct: i.co_ratio,
                      repot: i.co_job,
                      session_id: i.co_sess_id,
                      id: i.co_user_id
                    }

                    co_pi.push(copi_recordr)
                    pi_pct = pi_pct - parseInt(i.co_ratio);
                    setTimeout(function(){
                      $('#pi_cpt').val(pi_pct)
                    }, 1000)
                  })

                  listCopi()
                }else{
                  listCopi()
                }
              },'json')
}

function loadPrevData(sess_id){
  // console.log(sess_id);
  var jxhr = $.post(ws_url + 'controller/pm/pm-rs-info-prev.php', {sess: sess_id, id: current_user}, function(){}, 'json')
              .always(function(snap){
                console.log(snap);
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    $('#txtTitleTH').val(i.title_th)
                    $('#txtTitleEN').val(i.title_en)
                    $('#txtKeywordTH').val(i.keywords_th)
                    $('#txtKeywordEN').val(i.keywords_en)

                    $('#txt-rsStatus').val(i.research_retroact_status)

                    setTimeout(function(){
                      $('#txtResearchType').val(i.id_type)
                      $('#txtResearchType').selectpicker('refresh');
                    }, 1000)
                    $('#start_date').val(i.start_date)
                    $('#finish_date').val(i.finish_date)

                    $('#txtRtype').val(i.cotype)
                    $('#txtRtype').selectpicker('refresh');

                    $('#txtFund').val(i.ts0)
                    $('#txtFund').selectpicker('refresh');

                    if(i.ts0 == 0){
                      $('.fundDiv').addClass('dn');
                    }else{
                      if(i.ts1 == 1){
                        $("#cb1").attr('checked', 'checked')
                        $('#txtBf1').prop('readonly', '')
                        $('#txtBf1').val(i.ts1_budget)
                      }

                      if(i.ts2 == 1){
                        $("#cb2").attr('checked', 'checked')
                        $('#txtBf2').prop('readonly', '')
                        $('#txtBf2').val(i.ts2_budget)
                      }

                      if(i.ts3 == 1){
                        $("#cb3").attr('checked', 'checked')
                        $('#txtBf3').prop('readonly', '')
                        $('#txtBf3').val(i.ts3_budget)
                      }

                      if(i.ts4 == 1){
                        $("#cb4").attr('checked', 'checked')
                        $('#txtBf4').prop('readonly', '')
                        $('#txtBf4').val(i.ts4_budget)
                      }

                      if(i.ts5 == 1){
                        $("#cb5").attr('checked', 'checked')
                        $('#txtBf5').prop('readonly', '')
                        $('#txtBf5').val(i.ts5_budget)
                      }

                      if(i.ts6 == 1){
                        $("#cb6").attr('checked', 'checked')
                      }

                      if(i.ts7 == 1){
                        $("#cb7").attr('checked', 'checked')
                        $('#txtBf7').prop('readonly', '')
                        $('#txtBf7_protocol_no').prop('readonly', '')
                        $('#txtBf7_protocol_no').val(i.protocol_no)
                        $('#txtBf7').val(i.ts7_budget)
                      }
                    }

                    $('#num_copi').val(i.number_rs)
                    $('#pi_cpt').val(i.rate_pm)
                    $('#pi_cpt_job').val(i.pm_job)
                    // console.log(i.pm_job);
                    $('#txtBudget').val(i.budget)
                    $('#txtFundsname').val(i.source_funds)

                    editData.setData(i.brief_reports)
                  })

                  setTimeout(function(){ reloadD() }, 2000)

                }
              }, 'json')
}

function checkFileAttached(){
  for(var i = 1; i <=15 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft' + i).empty()

  if((i >= 10) && (i <= 15)){

    var vc = i
    vc = i-10


    var response = $.post(ws_url + 'controller/check_upload_file_research_retroact_registration.php', {doctype: vc, session_id: current_session_id, id: current_user}, function(){}, 'json')
                    .always(function(snap){
                      if((snap != '') && (snap.length > 0)){
                        $('#ft' + i).empty();
                        snap.forEach(function(childSnap){
                          var data = '<li class="mb-5"><a href="Javascript:void(0)" onclick="delete_file_research_retroact(' + childSnap.fid +', ' + i + ')"><i class="fa fa-close text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';

                          $('#ft' + i).append(data);

                        })
                        $('#ftn' + i).val(snap.length)
                      }else{
                        $('#ftn' + i).val(0)
                      }
                    },'json');

    setTimeout(function(){ reloadD() }, 1000)
  }else{
    var response = $.post(ws_url + 'controller/check_upload_file_research_registration.php', {doctype: i, session_id: current_session_id, id: current_user}, function(){}, 'json')
                    .always(function(snap){
                      if((snap != '') && (snap.length > 0)){
                        $('#ft' + i).empty();
                        snap.forEach(function(childSnap){
                          var data = '<li class="mb-5"><a href="Javascript:void(0)" onclick="delete_file_research(' + childSnap.fid +', ' + i + ')"><i class="fa fa-close text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';
                          $('#ft' + i).append(data);
                        })

                        $('#ftn' + i).val(snap.length)
                      }else{
                        $('#ftn' + i).val(0)
                      }
                    },'json');

    setTimeout(function(){ reloadD() }, 1000)
  }


}

function delete_file_research_retroact(id, part){
  var param = {
    fid: id,
    p: part
  }

  var param = $.post(ws_url + 'controller/delete_file_research_registration_retroact.php', param , function(){})
               .always(function(){
                  checkData(part);
               })
}

function delete_file_research(id, part){
  var param = {
    fid: id
  }
  var param = $.post(ws_url + 'controller/delete_file_research_registration.php', param , function(){})
               .always(function(){
                  checkData(part);
               })
}

function updateBudgetDocument(){
  var radioValue = $("input[name='radioBudget']:checked").val();
  if(radioValue == 0){
    swal("ขออภัย!", "กรุณาเลือกคำตอบก่อน", "error")
    return ;
  }else{
    var param = {
      id: current_user,
      session_id: current_session_id,
      stage: 'init',
      choice: radioValue,
      phase: 'update'
    }

    var jxhr = $.post(ws_url + 'controller/pm/update_budget_form.php', param, function(){})
                .always(function(resp){
                  // console.log(resp);
                  if(resp == 'Y'){
                    $('#btnBudPrint').prop('disabled', '')
                  }
                })
  }
}

function checkBudgetDocument(){
  var param = {
    id: current_user,
    session_id: current_session_id,
    stage: 'init',
    choice: '',
    phase: 'check'
  }

  var jxhr = $.post(ws_url + 'controller/pm/update_budget_form.php', param, function(){})
              .always(function(resp){
                console.log(resp);
                if(resp == 'Y'){
                  $('#btnBudPrint').prop('disabled', '')
                }
              })
}

function saveDraftCheck(){

  sumBudget()

  if(($('#txtTitleTH').val() != '') || ($('#txtTitleEN').val() != '')){

    $titleCheck = 0;
    var param_check = {
      th_title: $('#txtTitleTH').val(),
      en_title: $('#txtTitleEN').val(),
      session_id: current_session_id
    }

    var jxhr_check = $.post(ws_url + 'controller/check_title.php', param_check, function(){}, 'json')
                      .always(function(resp){

                        $('.titleCheckInfo').empty();
                        $('#titleNotify').addClass('dn');

                        if((resp != '') && (resp.length > 0)){

                          $info = '<br><strong>พบชื่อโครงการที่มีความคล้ายคลีงกัน (Similarlity > 90%) ดังนี้</strong><br>';
                          resp.forEach(function(i){
                            $info += 'ID : ' + i.value + ' ชื่อโครงการ : ' + i.name + ' (' + i.pct + '%) <br>';
                          })

                          $('.titleCheckInfo').html($info)
                          $('#titleNotify').removeClass('dn');

                        }

                      }, 'json')
                      .fail(function(){
                        // swal("ขออภัย", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ - ErrCode: 2", "error")
                        // return ;
                      })
  }



  if(($('#txtTitleTH').val()!='') || ($('#txtTitleEN').val()!='')){
    $cb1 = 0; $cb2 = 0; $cb3 = 0; $cb4 = 0; $cb5 = 0; $cb6 = 0; $cb7 = 0;
    if($("#cb1").is(':checked')){ $cb1 = 1; }
    if($("#cb2").is(':checked')){ $cb2 = 1; }
    if($("#cb3").is(':checked')){ $cb3 = 1; }
    if($("#cb4").is(':checked')){ $cb4 = 1; }
    if($("#cb5").is(':checked')){ $cb5 = 1; }
    if($("#cb6").is(':checked')){ $cb6 = 1; }
    if($("#cb7").is(':checked')){ $cb7 = 1; }

    var param = {
      sess_id: current_session_id,
      th_title: $('#txtTitleTH').val(),
      en_title: $('#txtTitleEN').val(),
      keywords_th: $('#txtKeywordTH').val(),
      keywords_en: $('#txtKeywordEN').val(),
      id_type: $('#txtResearchType').val(),
      start_date: $('#start_date').val(),
      finish_date: $('#finish_date').val(),
      cotype: $('#txtRtype').val(),
      number_rs: $('#num_copi').val(),
      rate_pm: $('#pi_cpt').val(),
      pm_job: $('#pi_cpt_job').val(),
      budget: $('#txtBudget').val(),
      ts0: $('#txtFund').val(),
      ts1: $cb1,
      ts1f: $('#txtBf1').val(),
      ts2: $cb2,
      ts2f: $('#txtBf2').val(),
      ts3: $cb3,
      ts3f: $('#txtBf3').val(),
      ts4: $cb4,
      ts4f: $('#txtBf4').val(),
      ts5: $cb5,
      ts5f: $('#txtBf5').val(),
      ts6: $cb6,
      ts6f: '0',
      ts7: $cb7,
      ts7f: $('#txtBf7').val(),
      protocol_no: $('#txtBf7_protocol_no').val(),
      other_funds: $('#txtOtherFundSource').val(),
      source_funds: $('#txtFundsname').val(),
      brief_reports: editData.getData(),
      draft_status: '1',
      id: current_user,
      rstatus: $('#txt-rsStatus').val(),
      id_rec: $('#txtCodeapdu').val()
    }
    var jxhr = $.post(ws_url + 'controller/pm/save_rs_draft_retroact.php', param, function(resp){
      // console.log(param);
      if(resp == 'Y'){
        console.log('Darft saved');
        window.localStorage.setItem('current_selected_project_session', current_session_id)
      }else{
        console.log(resp);
      }
    });
  }
}

function removeCopi(index){

  pi_pct = 100

  var param = {
    record_id: co_pi[index].rid,
    id: current_user
  }

  // console.log(param);

  var jxhr = $.post(ws_url + 'controller/pm/delete_co_pi.php', param, function(){})
              .always(function(resp){
                console.log(resp);
                if(resp == 'Y'){
                  // delete co_pi[index];
                  loadPrevCopiData(current_session_id);
                }else{
                  alert('ไม่สามารถลบข้อมูลได้ ให้ทำการบันทึกแบบร่างและทำการรีโหลดหน้าเว็บและลองลบใหม่')
                }
              })



}

function listCopi(){
  // console.log(co_pi.length);
  if(co_pi.length != 0){
    $('#copi_list').empty();
    $c = 1;
    var totalPec = 0;
    co_pi.forEach(function(i){
      $buffer = '<tr>' +
                  '<td>' + $c + '</td>' +
                  '<td>' + i.prefix_name + i.fname + ' ' + i.lname + '</td>' +
                  '<td>' + i.email + '</td>' +
                  '<td>' + i.pct + '</td>' +
                  '<td class="text-center"><div class="btn-group btn-group-xs" role="group">' +
                    // '<button class="btn btn-default btn-xs btn-icon-anim btn-square"><i class="zmdi zmdi-edit"></i></button>' +
                    '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" onclick="removeCopi(' + ($c - 1) +')"><i class="icon-trash"></i></button>' +
                  '</div></td>' +
                '</tr>';
      $('#copi_list').append($buffer);
      totalPec += parseInt(i.pct);
      $c++;
    })

    var copiTotal = 100 - totalPec;
    $('#pi_cpt').val(copiTotal)

    console.log(totalPec);
    console.log(copiTotal);

  }else{
    $('#copi_list').empty();
    $buffer = '<tr>' +
                '<td colspan="5">ไม่พบข้อมูลผู้ร่วมวิจัย</td>' +
              '</tr>';
    $('#copi_list').append($buffer);
    $('#pi_cpt').val('100')
  }

  $('#num_copi').val(co_pi.length)

}
