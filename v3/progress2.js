var tx1 = ''
var tx2 = ''
var tx3 = ''
var tx4 = ''
var tx5 = ''
var tx6 = ''
var tx7 = ''
var tx8 = ''
var tx9 = ''
var tx10 = ''
var revise_record_num = 0
var checkStage = 0

var pg2 = {
  getTitle: function(i){

    var title = 'ไม่สามารถระบุได้'

    if(i == 1){
      title = 'โครงการวิจัย (Protocol modification or amendment)'
    }else if(i == 2){
      title = 'เอกสารชี้แจงและขอความยินยอม (Information sheet/consent form)'
    }else if(i == 3){
      title = 'เปลี่ยนชื่อโครงการ (Change in title)'
    }else if(i == 4){
      title = 'Change in investigator'
    }else if(i == 5){
      title = 'Change in sponsor'
    }else if(i == 7){
      title = 'Investigator’s Brochure'
    }else if(i == 8){
      title = 'ข้อมูลใหม่หรือเอกสารที่ต้องการใช้กับอาสาสมัคร เช่น CRF, Patient Card, Diary'
    }else if(i == 6){
      title = 'Legal document'
    }else if(i == 9){
      title = 'ใบประชาสัมพันธ์'
    }else if(i == 10){
      title = 'เอกสารอื่น ๆ ที่ต้องการแจ้ง EC เพื่อรับทราบ'
    }

    return title
  },
  getStatus: function(i){
    status = 'ไม่สามารถระบุได้'

    if(i == 'draft'){
      status = 'แบบบันทึกฉบับร่าง (Draft)'
    }else if(i == 'withdraw'){
      status = 'นักวิจัยถอนแบบเสนอ'
    }

    return status
  }
}

$('#txtType').change(function(){

  $('#sub1').addClass('dn')
  $('#sub2').addClass('dn')
  $('#sub3').addClass('dn')
  $('#sub4').addClass('dn')
  $('#sub5').addClass('dn')
  $('#sub6').addClass('dn')

  $('.docAmendGroup').val($('#txtType').val())


  if($('#txtType').val() == '1'){
    $('#sub1').removeClass('dn')
  }

  if(($('#txtType').val() == '2') || ($('#txtType').val() == '4') ||
    ($('#txtType').val() == '5') || ($('#txtType').val() == '6') ||
    ($('#txtType').val() == '7') || ($('#txtType').val() == '8') ||
    ($('#txtType').val() == '9') || ($('#txtType').val() == '10'))
  {
    $('#sub2').removeClass('dn')
  }

  // if(($('#txtType').val() == '3') || ($('#txtType').val() == '7') || ($('#txtType').val() == '8') || ($('#txtType').val() == '9')) {
  //   $('#sub3').removeClass('dn')
  // }
  //
  // if($('#txtType').val() == '10'){
  //   $('#sub5').removeClass('dn')
  // }

  if(($('#txtType').val() == '3')) {
    $('#sub3').removeClass('dn')
  }

})

$('#checkbox11').click(function(){
  if($('#checkbox11').is(':checked')){
    $('#sub60').removeClass('dn')
  }else{
    $('#sub60').addClass('dn')
    tx3.setData('')
  }
})

$('#checkbox08').click(function(){
  if($('#checkbox08').is(':checked')){
    $('#sub3').removeClass('dn')
  }else{
    $('#sub3').addClass('dn')
  }
})

$('#checkbox09').click(function(){
  if($('#checkbox09').is(':checked')){
    $('#sub4').removeClass('dn')
  }else{
    $('#sub4').addClass('dn')
  }
})

$('#checkbox10').click(function(){
  if($('#checkbox10').is(':checked')){
    $('#sub5').removeClass('dn')
  }else{
    $('#sub5').addClass('dn')
  }
})

$('#checkbox12').click(function(){
  if($('#checkbox12').is(':checked')){
    $('#sub6').removeClass('dn')
  }else{
    $('#sub6').addClass('dn')
  }
})

tx1 = CKEDITOR.replace( 'info01_6_1', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '100px'
});

tx2 = CKEDITOR.replace( 'info06_1_1', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '100px'
});

tx3 = CKEDITOR.replace( 'info11_1_1', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '100px'
});

tx4= CKEDITOR.replace( 'info3_1', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '100px'
});

tx5 = CKEDITOR.replace( 'info3_2', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '100px'
});





function saveReviseinfo(){
  $check = 0;

  if($('#info3_0').val() == ''){
    $check++
  }

  if(tx4.getData() == ''){
    $check++
  }

  if(tx5.getData() == ''){
    $check++
  }

  if($('#info3_3').val() == ''){
    $check++
  }

  if($('#info3_4').val() == ''){
    $check++
  }

  if($check!=0){
    swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วน", "error")
    return ;
  }

  var param = {
    id_rs: current_id_rs,
    user: current_user,
    amd_line: $('#info3_0').val(),
    amd_before: tx4.getData(),
    amd_after: tx5.getData(),
    amd_reason: $('#info3_3').val(),
    amd_effect: $('#info3_4').val(),
    progess_session_id: progress_sess_id
  }

  var jxr = $.post(ws_url + 'controller/pm/save-revise-amendment.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 loadRevisedInfo()
                 $('.btnCloseModal').trigger('click')
               }else{
                 swal("ขออภัย!", "ไม่สามารถเพิ่มข้อมูลได้้", "error")
                 $('.btnCloseModal').trigger('click')
               }

               $('#info3_0').val('')
               $('#info3_3').val('')
               $('#info3_4').val('')
               tx4.setData('')
               tx5.setData('')
             })
             .fail(function(){
               swal("ขออภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้้", "error")
               loadRevisedInfo()
             })
}

function loadRevisedInfo(){
  revise_record_num = 0

  var param = {
    id_rs: current_id_rs,
    sess: progress_sess_id
  }

  var jxr = $.post(ws_url + 'controller/pm/get-revise-amendment.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 $('#reviseSpan').empty()
                 $c = 1;
                 snap.forEach(function(i){
                   var data = '<tr>' +
                                '<td>' + $c + '</td>' +
                                '<td>' + i.p2r_line +
                                  '<div class="fs08">' +
                                    // '<a href="#" class="mr-20 text-muted"><i class="zmdi zmdi-edit"></i> แก้ไข</a>' +
                                    '<a href="#" class="mr-20 text-muted" onclick="deleteReviseInfo(\'' + i.p2r_id + '\')"><i class="zmdi zmdi-delete"></i> ลบ</a>' +
                                  '</div>' +
                                '</td>' +
                                '<td>' + i.p2r_before + '</td>' +
                                '<td>' + i.p2r_after + '</td>' +
                                '<td>' + i.p2r_reason + '</td>' +
                                '<td>' + i.p2r_effect + '</td>' +
                              '</tr>'
                   $('#reviseSpan').append(data)
                   $c++
                   revise_record_num++
                 })
                 var data = '<tr>' +
                              '<td colspan="6">' +
                                '<div class="text-center">' +
                                  '<button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add-rv"><i class="zmdi zmdi-edit"></i> เพิ่มข้อมูล</button>' +
                                '</div>' +
                              '</td>' +
                            '</tr>'
                 $('#reviseSpan').append(data)
                 checkBeforeSave(0)

               }else{
                 $('#reviseSpan').empty()
                 var data = '<tr>' +
                              '<td colspan="6">' +
                                '<div class="text-center">' +
                                  '<button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add-rv"><i class="zmdi zmdi-edit"></i> เพิ่มข้อมูล</button>' +
                                '</div>' +
                              '</td>' +
                            '</tr>'
                 $('#reviseSpan').append(data)
                 checkBeforeSave(0)
               }
             }, 'json')
             .fail(function(){
               $('#reviseSpan').empty()
               var data = '<tr>' +
                            '<td colspan="6">' +
                              '<div class="text-center">' +
                                '<button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg-add-rv"><i class="zmdi zmdi-edit"></i> เพิ่มข้อมูล</button>' +
                              '</div>' +
                            '</td>' +
                          '</tr>'
               $('#reviseSpan').append(data)
               checkBeforeSave(0)
             })
}

function deleteReviseInfo(id){
  swal({    title: "ยืนยันดำเนินการ",
              text: "ท่านยืนยันการลบรายการนี้หรือไม่?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ยืนยันการลบ",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: true
            },
            function(){
              var param = {
                id_rs: id
              }

              var jxr = $.post(ws_url + 'controller/pm/delete-revise-amendment.php', param, function(){})
                         .always(function(resp){
                           if(resp == 'Y'){
                             loadRevisedInfo()
                           }else{
                             swal("ขออภัย!", "ไม่สามารถลบข้อมูลได้", "error")
                             loadRevisedInfo()
                           }
                         }, 'json')
                         .fail(function(){
                           swal("ขออภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้้", "error")
                           loadRevisedInfo()
                         })
            });
}

function checkBeforeSave(iden){
  var check = 0
  $('#btnSave3').addClass('dn')
  $('.form-group').removeClass('has-error')
  $('.bdtxt').removeClass('bd-error')

  if(revise_record_num == 0){
    check++
  }

  if($('#txtType').val() == ''){
    $('#txtType').parent().addClass('has-error')
    check++
  }

  if($('#checkbox01').is(':checked')){
    if($('#checkbox01_4').is(':checked')){
      if($('#info01_4_1').val() == ''){
        $('#info01_4_1').parent().addClass('has-error')
        check++
      }

      if($('#info01_4_2').val() == ''){
        $('#info01_4_2').parent().addClass('has-error')
        check++
      }

      if($('#info01_4_3').val() == ''){
        $('#info01_4_2').parent().addClass('has-error')
        check++
      }
    }

    if($('#checkbox01_5').is(':checked')){
      if($('#info01_5_1').val() == ''){
        $('#info01_5_1').parent().addClass('has-error')
        check++
      }

      if($('#info01_5_2').val() == ''){
        $('#info01_5_2').parent().addClass('has-error')
        check++
      }

      if($('#info01_5_3').val() == ''){
        $('#info01_5_2').parent().addClass('has-error')
        check++
      }
    }

    if($('#checkbox01_6').is(':checked')){
      if(tx1.getData() == ''){
        $('#txt1').addClass('bd-error')
        check++
      }
    }
  }

  if($('#checkbox12').is(':checked')){
    if($('#q12_a').val() == ''){
      $('#q12_a').parent().addClass('has-error')
      check++
    }

    if($('#q12_b').val() == ''){
      $('#q12_b').parent().addClass('has-error')
      check++
    }

    if($('#q12_c').val() == ''){
      $('#q12_c').parent().addClass('has-error')
      check++
    }

    if($('#q12_d').val() == ''){
      $('#q12_d').parent().addClass('has-error')
      check++
    }

    if($('#q12_e').val() == ''){
      $('#q12_e').parent().addClass('has-error')
      check++
    }

    if($('#q12_f').val() == ''){
      $('#q12_f').parent().addClass('has-error')
      check++
    }

    if($('#q12_g').val() == ''){
      $('#q12_g').parent().addClass('has-error')
      check++
    }

    var summ = parseInt($('#q12_b').val());
    var c = parseInt($('#q12_c').val());
    var d = parseInt($('#q12_d').val());
    var e = parseInt($('#q12_e').val());
    var f = parseInt($('#q12_f').val());
    var g = parseInt($('#q12_g').val());

    $('#req_a').addClass('dn')

    var summ_a = c + d + e + f + g

    if(summ != summ_a){
      $('#q12_b').parent().addClass('has-error')
      $('#req_a').removeClass('dn')
    }

    console.log(summ);
    console.log(summ_a);

  }

  if(check!=0){
    if(iden == '1'){
      swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วนและเพิ่มรายละเอียดการเปลี่ยนแปลงที่ขอรับการพิจารณา ", "error")
    }
    $('#btnSave3').addClass('dn')
  }else{

    if(iden == '1'){
      swal("ตรวจสอบสำเร็จ!", "ท่านสามารถกดปุ่ม 'บันทึกและส่ง' เพื่อดำเนินการส่งแบบเสนอนี้ต่อสำนักงานจริยธรรมต่อไป ", "success")
    }


    checkStage = 1
    $('#btnSave3').removeClass('dn')
  }
}

function saveStage(){
  if(checkStage == 0){
    swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วนและเพิ่มรายละเอียดการเปลี่ยนแปลงที่ขอรับการพิจารณา ", "error")
    return ;
  }

  if(checkStage == 1){

  }
}

function saveDraft1(){
  var type = $('#txtType').val()

  if(type == ''){
    swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วนและเพิ่มรายละเอียดการเปลี่ยนแปลงที่ขอรับการพิจารณา ", "error")
    return ;
  }

  if(type == 1){

    console.log('1');

    var t1t1_1 = 0, t1t1_2 = 0, t1t1_3 = 0, t1t1_4 = 0, t1t1_5 = 0, t1t1_6 = 0;
    var t2 = 0, t3 = 0, t4 = 0, t5 = 0, t6 = 0;

    if($('#checkbox01_1').is(':checked')){
      t1t1_1 = 1
    }

    if($('#checkbox01_2').is(':checked')){
      t1t1_2 = 1
    }

    if($('#checkbox01_3').is(':checked')){
      t1t1_3 = 1
    }

    if($('#checkbox01_4').is(':checked')){
      t1t1_4 = 1
    }

    if($('#checkbox01_5').is(':checked')){
      t1t1_5 = 1
    }

    if($('#checkbox01_6').is(':checked')){
      t1t1_6 = 1
    }

    if($('#checkbox11').is(':checked')){
      t2 = 1
    }

    if($('#checkbox12').is(':checked')){
      t3 = 1
    }

    if($('#checkbox14').is(':checked')){
      t4 = 1
    }

    if($('#checkbox15').is(':checked')){
      t5 = 1
    }

    if($('#checkbox16').is(':checked')){
      t6 = 1
    }

    var param = {
      stype: type,
      id_rs: current_id_rs,
      user: current_user,
      rp2_t1t1_1: t1t1_1,
      rp2_t1t1_2: t1t1_2,
      rp2_t1t1_3: t1t1_3,
      rp2_t1t1_4: t1t1_4,
      rp2_t1t1_4_1: $('#info01_4_1').val(),
      rp2_t1t1_4_2: $('#info01_4_2').val(),
      rp2_t1t1_4_3: $('#info01_4_3').val(),
      rp2_t1t1_5: t1t1_5,
      rp2_t1t1_5_1: $('#info01_5_1').val(),
      rp2_t1t1_5_2: $('#info01_5_2').val(),
      rp2_t1t1_5_3: $('#info01_5_3').val(),
      rp2_t1t1_6: t1t1_6 ,
      rp2_t1t1_6_1: tx1.getData(),
      rp2_t2: t2,
      rp2_t2info: tx6.getData(),
      rp2_t3: t3,
      rp2_t3a: $('#q12_a').val(),
      rp2_t3b: $('#q12_b').val(),
      rp2_t3c: $('#q12_c').val(),
      rp2_t3d: $('#q12_d').val(),
      rp2_t3e: $('#q12_e').val(),
      rp2_t3f: $('#q12_f').val(),
      rp2_t3g: $('#q12_g').val(),
      rp2_t4: t4,
      rp2_t5: t5,
      rp2_t6: t6,
      status: 'draft'
    }

    console.log(param);

    var jxr = $.post(ws_url + 'controller/pm/save-progress-2-1.php', param, function(){})
              .always(function(resp){
                console.log(resp);
                if(resp == 'Y'){
                  swal({    title: "บันทึกแบบร่างสำเร็จ",
                  text: "กด 'ตกลง' เพื่อกลับสู่หน้ารายการ หรือกด 'ดำเนินการต่อ' เพื่ออยู่หน้าเดิม",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "ดำเนินการต่อ",
                  cancelButtonText: "ตกลง",
                  closeOnConfirm: true,
                  closeOnCancel: true },
                  function(isConfirm){
                     if (isConfirm) {

                    }
                     else {
                         window.location = 'progress2_main.html'
                     }
                  });
                }else{
                  swal("ขออภัย!", "เกิดข้อผิดพลาด กรุณาติดต่อเจ้าหน้าที่ ", "error")
                  return ;
                }
              })
              .fail(function(){
                swal("ขออภัย!", "ไสามารถเชื่อมต่อฐานข้อมูลได้ ", "error")
                return ;
              })
  }
}

function saveProgressDraft_2(){

  saveProgressDraft()

  var amendtype = $('#txtType').val();

  if(amendtype == ''){
    return ;
  }

  if(amendtype == 3){ // Change title

    if(($('#info08_en').val() != '') || ($('#info08_th').val() != '')){

      var c21 = 0
      var c22 = 0
      var c31 = 0
      var c32 = 0
      var c33 = 0

      if($('#checkbox11').is(':checked')){
        c21 = 1
      }

      if($('#checkbox12').is(':checked')){
        c22 = 1
      }

      if($('#checkbox14').is(':checked')){
        c31 = 1
      }

      if($('#checkbox15').is(':checked')){
        c32 = 1
      }

      if($('#checkbox16').is(':checked')){
        c33 = 1
      }

      var param = {
        id_rs: current_id_rs,
        user: current_user,
        rp2_key: progress_sess_id,
        rp2_t1type: amendtype,
        status: 'sent by pi'
      }

      var jxr = $.post(ws_url + 'controller/pm/save-progress-2-3-send.php', param, function(){})
                .always(function(resp){
                  if(resp == 'Y'){
                    // window.location = 'progress_send_success.html'
                    swal({    title: "ดำเนินการสำเร็จ",
                    text: "แบบเสนอขอปรับปรุงโครงการของท่านได้ถูกส่งไปยังเจ้าหน้าที่เรียบร้อยแล้ว กด 'รับทราบ' เพื่อกลับสู่หน้าแรก",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "รับทราบ",
                    closeOnConfirm: false },
                    function(){
                      window.location = 'index.html'
                    });
                  }else{
                    console.log(resp);
                    swal("ขออภัย!", "ไม่สามารถส่งแบบเสนอได้ กรุณาติดต่อเจ้าหน้าที่", "error")
                    return ;
                  }
                })
    }

  }else{ //Other

  }

}

function saveProgressDraft(){
  var amendtype = $('#txtType').val();

  if(amendtype == ''){
    return ;
  }

  if(amendtype == 3){ // Change title

    if(($('#info08_en').val() != '') || ($('#info08_th').val() != '')){

      var c21 = 0
      var c22 = 0
      var c31 = 0
      var c32 = 0
      var c33 = 0

      if($('#checkbox11').is(':checked')){
        c21 = 1
      }

      if($('#checkbox12').is(':checked')){
        c22 = 1
      }

      if($('#checkbox14').is(':checked')){
        c31 = 1
      }

      if($('#checkbox15').is(':checked')){
        c32 = 1
      }

      if($('#checkbox16').is(':checked')){
        c33 = 1
      }

      var param = {
        id_rs: current_id_rs,
        user: current_user,
        rp2_key: progress_sess_id,
        rp2_t1type: amendtype,
        rp2_title_th: $('#info08_th').val(),
        rp2_title_en: $('#info08_en').val(),
        rp2_t2: c21,
        rp2_t2info: tx3.getData(),
        rp2_t3: c22,
        rp2_t3a: $('#q12_a').val(),
        rp2_t3b: $('#q12_b').val(),
        rp2_t3c: $('#q12_c').val(),
        rp2_t3d: $('#q12_d').val(),
        rp2_t3e: $('#q12_e').val(),
        rp2_t3f: $('#q12_f').val(),
        rp2_t3g: $('#q12_g').val(),
        rp2_t4: c31,
        rp2_t5: c32,
        rp2_t6: c33,
        status: 'draft'
      }

      var jxr = $.post(ws_url + 'controller/pm/save-progress-2-3-1.php', param, function(){})
                .always(function(resp){
                  if(resp == 'Y'){
                    console.log('Draft saved');
                  }else{
                    // console.log(resp);
                    console.log('Can not save draft');
                  }
                })
    }

  }else{ //Other

  }
}
