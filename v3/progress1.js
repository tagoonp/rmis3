var editData = '';
var editData1 = '';
var editData2 = '';
var editData3 = '';
var editData4 = '';
var editData5 = '';
var editData6 = '';
var editData7 = '';
var editData8 = '';
var editData9 = '';
var editData10 = '';
var editData11 = '';
var editData12 = '';
var editData13 = '';
var editData14 = '';
var editData15 = '';
var editData16 = '';
var editData17 = '';
var editData18 = '';

var pro_id = 1
var valid_status = 0

editData = CKEDITOR.replace( 'q1_info', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

// editData1 = CKEDITOR.replace( 'bf1', {
//   wordcount : {
//     showCharCount : false,
//     showWordCount : true
//   },
//   height: '150px'
// });

editData2 = CKEDITOR.replace( 'bf2', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData3 = CKEDITOR.replace( 'bf3', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData4 = CKEDITOR.replace( 'bf4', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData5 = CKEDITOR.replace( 'bf5', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData6 = CKEDITOR.replace( 'bf6', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData7 = CKEDITOR.replace( 'bf7', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData8 = CKEDITOR.replace( 'bf8', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData9 = CKEDITOR.replace( 'bf9', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData10 = CKEDITOR.replace( 'bf10', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData11 = CKEDITOR.replace( 'bf11', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData12 = CKEDITOR.replace( 'bf12', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData13 = CKEDITOR.replace( 'bf13', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData14 = CKEDITOR.replace( 'bf14', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData15 = CKEDITOR.replace( 'bf15', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData16 = CKEDITOR.replace( 'bf16', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData17 = CKEDITOR.replace( 'bf17', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

editData18 = CKEDITOR.replace( 'bf18', {
  wordcount : {
    showCharCount : false,
    showWordCount : true
  },
  height: '150px'
});

$(function(){
  $('#checkbox01').click(function(){
    if($('#checkbox01').is(':checked')){
      // $('#hidden0').removeClass('dn')
      // $('#hidden1').removeClass('dn')

      $('#hidden1').addClass('dn')
      $('#hidden0').addClass('dn')
      $('#q1_1').val('')
      $('#q1_2').val('')
      $('#q1_3').val('')
      $('#q1_4').val('')
      $('#q1_5').val('')
      $('#q1_6').val('')
      $('#q1_7').val('')
      $("input[name=radio02]").val(['99'])
      editData2.setData()
      editData.setData('')
      
    }else{

      $('#hidden0').removeClass('dn')
      $('#hidden1').removeClass('dn')


    }
  })

  $("input[name=radio02]").click(function(){
    var radio2 = $(this).val()
    if(radio2 == 1){
      $('#hidden2').removeClass('dn')
    }else{
      $('#hidden2').addClass('dn')
      editData2.setData()
    }
  })

  $("input[name=radio03]").click(function(){
    var radio3 = $(this).val()
    if(radio3 == 1){
      $('#hidden3').removeClass('dn')
    }else{
      $('#hidden3').addClass('dn')
      editData3.setData()
    }
  })

  $("input[name=radio04]").click(function(){
    var radio4 = $(this).val()
    if(radio4 == 1){
      $('#hidden4').removeClass('dn')
    }else{
      $('#hidden4').addClass('dn')
      editData4.setData()
    }
  })

  $("input[name=radio05]").click(function(){
    var radio5 = $(this).val()
    if(radio5 == 1){
      $('#hidden5').removeClass('dn')
    }else{
      $('#hidden5').addClass('dn')
      editData5.setData()
    }
  })

  $("input[name=radio06]").click(function(){
    var radio6 = $(this).val()
    if(radio6 == 1){
      $('#hidden6').removeClass('dn')
    }else{
      $('#hidden6').addClass('dn')
      editData6.setData()
    }
  })

  $("input[name=radio07]").click(function(){
    var radio7 = $(this).val()
    if(radio7 == 1){
      $('#hidden7').removeClass('dn')
    }else{
      $('#hidden7').addClass('dn')
      editData7.setData()
    }
  })

  $("input[name=radio08]").click(function(){
    var radio8 = $(this).val()
    if(radio8 == 1){
      $('#hidden8').removeClass('dn')
    }else{
      $('#hidden8').addClass('dn')
      editData8.setData()
    }
  })

  $("input[name=radio09]").click(function(){
    var radio9 = $(this).val()
    if(radio9 == 1){
      $('#hidden9').removeClass('dn')
    }else{
      $('#hidden9').addClass('dn')
      editData9.setData()
    }
  })

  $("input[name=radio010]").click(function(){
    var radio10 = $(this).val()
    if(radio10 == 1){
      $('#hidden10').removeClass('dn')
    }else{
      $('#hidden10').addClass('dn')
      editData10.setData()
    }
  })

  $("input[name=radio011]").click(function(){
    var radio11 = $(this).val()
    if(radio11 == 1){
      $('#hidden11').removeClass('dn')
    }else{
      $('#hidden11').addClass('dn')
      editData11.setData()
    }
  })

  $("input[name=radio012]").click(function(){
    var radio12 = $(this).val()
    if(radio12 == 1){
      $('#hidden12').removeClass('dn')
    }else{
      $('#hidden12').addClass('dn')
      editData12.setData()
    }
  })

  $("input[name=radio013]").click(function(){
    var radio13 = $(this).val()
    if(radio13 == 1){
      $('#hidden13').removeClass('dn')
    }else{
      $('#hidden13').addClass('dn')
      editData13.setData()
    }
  })

  $("input[name=radio014]").click(function(){
    var radio14 = $(this).val()
    if(radio14 == 1){
      $('#hidden14').removeClass('dn')
    }else{
      $('#hidden14').addClass('dn')
      editData14.setData()
    }
  })

  $("input[name=radio015]").click(function(){
    var radio15 = $(this).val()
    if(radio15 == 1){
      $('#hidden15').removeClass('dn')
    }else{
      $('#hidden15').addClass('dn')
      editData15.setData()
    }
  })
})

function save_pg_draft(pg_id){

  check_validate()

  if(($('#txtResearch').val() == '') || ($('#txtProcessType').val() == '') || ($('#txtRound').val() == '')){
    return ;
  }

  var q0 = 0
  if($('#checkbox01').is(':checked')){
    q0 = 1
  }

  var param = {
    user: current_user,
    id_rs: $('#txtResearch').val(),
    progress_id: pro_id,
    session_id: current_session_id,
    report_round: $('#txtRound').val(),
    th_title: $('#txtThTitle').val(),
    en_title: $('#txtEnTitle').val(),
    start_progress_date: $('#txtDateStart').val(),
    end_progress_date: $('#txtDateStart').val(),
    report_type: $('#txtProcessType').val(),
    q_0: q0,
    q_0_info: editData.getData(),
    q_1_a: $('#q1_1').val(),
    q_1_b: $('#q1_2').val(),
    q_1_c: $('#q1_3').val(),
    q_1_d: $('#q1_4').val(),
    q_1_e: $('#q1_5').val(),
    q_1_f: $('#q1_6').val(),
    q_1_g: $('#q1_7').val(),
    q_2: $("input[name=radio02]:checked").val(),
    q_2_info: editData2.getData(),
    q_3: $("input[name=radio03]:checked").val(),
    q_3_info: editData3.getData(),
    q_4: $("input[name=radio04]:checked").val(),
    q_4_info: editData4.getData(),
    q_5: $("input[name=radio05]:checked").val(),
    q_5_info: editData5.getData(),
    q_6: $("input[name=radio06]:checked").val(),
    q_6_info: editData6.getData(),
    q_7: $("input[name=radio07]:checked").val(),
    q_7_info: editData7.getData(),
    q_8: $("input[name=radio08]:checked").val(),
    q_8_info: editData8.getData(),
    q_9: $("input[name=radio09]:checked").val(),
    q_9_info: editData9.getData(),
    q_10: $("input[name=radio010]:checked").val(),
    q_10_info: editData10.getData(),
    q_11: $("input[name=radio011]:checked").val(),
    q_11_info: editData11.getData(),
    q_12: $("input[name=radio012]:checked").val(),
    q_12_info: editData12.getData(),
    q_13: $("input[name=radio013]:checked").val(),
    q_13_info: editData13.getData(),
    q_14: $("input[name=radio014]:checked").val(),
    q_14_info: editData14.getData(),
    q_15: $("input[name=radio015]:checked").val(),
    q_15_info: editData15.getData(),
    q_16: editData16.getData(),
    q_17: editData17.getData(),
    q_18: editData18.getData()
  }

  // console.log(param);
  // return ;

  // var jxr = $.post(ws_url + 'controller/pm/continuing/save_progress_1_draft.php', param, function(){})
  var jxr = $.post(ws_url + 'controller/pm/continuing/save_progress_1_draft.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 console.log('Save draft success');
               }else{
                 console.log('Save draft fail');
               }
             })
             .fail(function(){
               console.log('Fail');
             })
}

function check_validate(){

  valid_status = 0
  var valid_msg = '';

  if($('#checkbox01').is(':checked')){
    var summ = parseInt($('#q1_2').val());
    var c = parseInt($('#q1_3').val());
    var d = parseInt($('#q1_4').val());
    var e = parseInt($('#q1_5').val());
    var f = parseInt($('#q1_6').val());
    var g = parseInt($('#q1_7').val());

    var summ_a = c + d + e + f + g

    if(summ != summ_a){
      $('#q1_2').parent().addClass('has-error')
      valid_status++
      valid_msg += '- จำนวนอาสาสมัคร <br>'
    }

    if($("input[name=radio02]:checked").val() == '99'){
      valid_status++
      valid_msg += '- ข้อ 2 <br>'
    }
  }



  if($("input[name=radio03]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 3 <br>'
  }

  if($("input[name=radio04]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 4 <br>'
  }

  if($("input[name=radio05]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 5 <br>'
  }

  if($("input[name=radio06]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 6 <br>'
  }

  if($("input[name=radio07]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 7 <br>'
  }

  if($("input[name=radio08]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 8 <br>'
  }

  if($("input[name=radio09]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 9 <br>'
  }

  if($("input[name=radio010]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 10 <br>'
  }

  if($("input[name=radio011]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 11 <br>'
  }

  if($("input[name=radio012]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 12 <br>'
  }

  if($("input[name=radio013]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 13 <br>'
  }

  if($("input[name=radio014]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 14 <br>'
  }

  if($("input[name=radio015]:checked").val() == '99'){
    valid_status++
    valid_msg += '- ข้อ 15 <br>'
  }

  if(valid_status == 0){
    $('#btnSendReport').removeClass('dn')
  }else{
    $('.req-span').html(valid_msg)
  }


}


setInterval(function(){
  save_pg_draft(pro_id)
}, 5000);
