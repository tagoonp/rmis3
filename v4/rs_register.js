var rr_form = {
  part1: function(){
    $check = 0;
    $('.st1').empty()

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

    // if($('#ftn9').val() == 0){
    //   $check++;
    //   rr_notify.push('ใบนำส่งเงินค่าธรรมเนียม (ส่วนที่ 5)')
    // }

    if($check==0){
      $('.st5').html('<i class="fa fa-check-circle"></i> ')
    }

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

    // this.on("totaluploadprogress", function (progress) {
    //   // $("#the-progress-div").width(progress + '%');
    //   // $(".the-progress-text").text(progress + '%');
    //   console.log(progress + '%');
    // });

    this.on("complete", function(file) {
      this.removeFile(file);
      console.log(file.xhr.responseText);
      if(file.xhr.responseText == 'Y'){
        checkData(1)
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
      }

    });
  }
};

Dropzone.options.myFile7 = {
  acceptedFiles: 'application/pdf, .docx, .doc, .xls, .xlsx',
  maxFilesize: 100,
  init: function(){

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(7)
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
      }

    });
  }
};

Dropzone.options.myFile8 = {
  acceptedFiles: 'application/pdf, .docx, .doc',
  maxFilesize: 100,
  init: function(){
    this.on("totaluploadprogress", function (progress) {
      // $("#the-progress-div").width(progress + '%');
      // $(".the-progress-text").text(progress + '%');
      console.log(progress + '%');
    });

    this.on("complete", function(file) {
      this.removeFile(file);
      if(file.xhr.responseText == 'Y'){
        checkData(8)
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
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
      }else{
        swal("เกิดข้อผิดพลาด!", "มีไฟล์ที่ไม่สามารถอัพโหลดได้ กรุณาตรวจสอบการตั้งชื่อไฟล์หรือประเภทไฟล์และลองใหม่อีกครั้งโดยการอัพโหลดทีละไฟล์!", "Error")
      }
    });
  }
};

$(function(){
  $('#txtResearchType').change(function(){
    console.log($(this).val());
  })

  // $('#cb1,#cb2,#cb3,#cb4,#cb5,#cb7').click(function(){
  //   saveDraftCheck()
  // })

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
      $('#txtFundsname').val('ทุนวิจัยคณะแพทยศาสตร์')
    }else{
      $('#txtBf1').prop('readonly','readonly')
      $('#txtBf1').val('0')
      $('#txtFundsname').val('')
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
                      dept: i.co_dept,
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
  for(var i = 1; i <=10 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft' + i).empty()
  var response = $.post(ws_url + 'controller/check_upload_file_research_registration.php', {doctype: i, session_id: current_session_id, id: current_user}, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      $('#ft' + i).empty();
                      snap.forEach(function(childSnap){

                        var data = '<li class="mb-5"><a href="Javascript:void(0)" onclick="delete_file_research(' + childSnap.fid +', ' + i + ')"><i class="fa fa-close text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';

                        if(childSnap.f_allow_delete == '0'){
                          data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank" class="text-primary">- ' + childSnap.f_name + '</a></li>';
                        }

                        $('#ft' + i).append(data);


                      })

                      $('#ftn' + i).val(snap.length)
                    }else{
                      $('#ftn' + i).val(0)
                    }
                  },'json');

  setTimeout(function(){ reloadD() }, 1000)

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

    // console.log(param);
    // return ;

    var jxhr = $.post(ws_url + 'controller/pm/update_budget_form.php', param, function(){})
                .always(function(resp){
                  if(resp == 'Y'){
                    // $('#btnBudPrint').prop('disabled', '')
                    loadBudgetFormList()
                  }else if(resp == 'NR'){
                    swal("ขออภัย!", "กรุณาเพิ่มข้อมูลทั่วไปของโครงการวิจัยก่อน!", "error")
                  }else{
                    swal("ขออภัย!", "ไม่สามารถสร้างใบนำส่งเงินค่าธรรมเนียมได้!", "error")
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
      id: current_user
    }
    var jxhr = $.post(ws_url + 'controller/pm/save_rs_draft.php', param, function(resp){
      // console.log(param);
      if(resp == 'Y'){
        console.log('Darft saved');
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
                  '<td>' + i.prefix_name + i.fname + ' ' + i.lname + '<div class="fs08">สังกัด : ' + i.dept + '</div></td>' +
                  '<td>' + i.email + '</td>' +
                  '<td>' + i.pct + '</td>' +
                  '<td class="text-center"><div class="btn-group btn-group-xs" role="group">' +
                    '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" onclick="removeCopi(' + ($c - 1) +')"><i class="icon-trash"></i></button>' +
                  '</div></td>' +
                '</tr>';
      $('#copi_list').append($buffer);
      totalPec += parseInt(i.pct);
      $c++;
    })

    var copiTotal = 100 - totalPec;
    $('#pi_cpt').val(copiTotal)

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

function loadBudgetFormList(){
  var param = {
    id: current_user,
    session_id: current_session_id,
    stage: 'init'
  }

  var jxr = $.post(ws_url + 'controller/pm/load_budget_form_list.php', param, function(){}, 'json')
             .always(function(snap){
               console.log(snap);
               if((snap!='') && (snap.length > 0)){
                $('#bgfList').empty()
                snap.forEach(function(i){
                  $data = '<tr>' +
                            '<td>ใบนำส่งเงินค่าธรรมเนียมรหัส_' + i.ribd_id + '<br>สร้างเมื่อ : ' + main_app.convertThaidatetime(i.ribd_udate) + '</td>' +
                            '<td><button class="btn btn-success btn-square" id="btnBudPrint" onclick="openPrintBudget()" ><i class="zmdi zmdi-print"></i></button></td>' +
                          '</tr>'
                  $('#bgfList').append($data)
                })
               }else{
                 $('#bgfList').empty()
                 $('#bgfList').append('<tr><td colspan="2">ยังไม่มีใบนำส่งค่าธรรมเนียม<br><span class="fs08">หากนักวิจัยหลักเป็นบุคคลภายนอกหรือโครงการทุนภาคเอกชน กดปุ่ม "สร้างใบนำส่งเงินค่าธรรมเนียม" และดำเนินตามขั้นตอน</span></td></tr>')
               }
             })
}
