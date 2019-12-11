var rs_comment = {
  get_prev_comment: function(){
    var param = {
      id_rs: current_rs_id
    }

    var jxr = $.post(ws_url + 'controller/get_prev_comment.php', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);

                 if((snap != '') && (snap.length > 0)){

                   sortJson(snap , "q_ele", "int", true);

                   $('.prev1').addClass('dn')
                   $('.prev2').removeClass('dn')

                   snap.forEach(function(i){
                     if(i.riwc_part == '1'){
                       $data = '<div class="row">' +
                                  '<div class="col-sm-12"><b>Comment เมื่อวันที่ ' + main_app.convertThaidatetime(i.riwc_staff_add_date) + ' : </b><br><span class="txt-dark">' + i.riwc_q + '</span><hr style="border-color: rgb(236, 236, 236);"></div>' +
                                '</div>'
                       $('#p1_prev').append($data)
                     }else if(i.riwc_part == '2'){
                       $data = '<div class="row">' +
                                  '<div class="col-md-3"><b>คำถามหรือข้อเสนอแนะ : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_q + '</span></div>' +
                                  '<div class="col-md-3"><b>คำตอบหรือคำชี้แจง : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a1 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความเดิม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a2 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความที่แก้ไข/เพิ่มเติม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a3 + '</span></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + main_app.convertThaidatetime(i.riwc_staff_add_date) + '</span></div>' +
                                  '<div class="col-md-12"><hr style="border-color: rgb(236, 236, 236);"></div>' +
                                '</div>'
                       $('#p2_prev').append($data)
                     }else if(i.riwc_part == '3'){
                       $data = '<div class="row">' +
                                  '<div class="col-md-3"><b>คำถามหรือข้อเสนอแนะ : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_q + '</span></div>' +
                                  '<div class="col-md-3"><b>คำตอบหรือคำชี้แจง : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a1 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความเดิม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a2 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความที่แก้ไข/เพิ่มเติม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a3 + '</span></div>' +
                                  '<div class="col-md-3"><b>เมื่อวันที่ : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + main_app.convertThaidatetime(i.riwc_staff_add_date) + '</span></div>' +
                                  '<div class="col-md-12"><hr style="border-color: rgb(236, 236, 236);"></div>' +
                                '</div>'
                       $('#p3_prev').append($data)
                     }else if(i.riwc_part == '4'){
                       $data = '<div class="row">' +
                                  '<div class="col-md-3"><b>คำถามหรือข้อเสนอแนะ : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_q + '</span></div>' +
                                  '<div class="col-md-3"><b>คำตอบหรือคำชี้แจง : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a1 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความเดิม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a2 + '</span></div>' +
                                  '<div class="col-md-3"><b>ข้อความที่แก้ไข/เพิ่มเติม : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + i.riwc_a3 + '</span></div>' +
                                  '<div class="col-md-3"><b>เมื่อวันที่ : </b></div>' +
                                  '<div class="col-md-9"><span class="txt-dark">' + main_app.convertThaidatetime(i.riwc_staff_add_date) + '</span></div>' +
                                  '<div class="col-md-12"><hr style="border-color: rgb(236, 236, 236);"></div>' +
                                '</div>'
                       $('#p4_prev').append($data)
                     }
                   })
                 }
               })
  }
}

// View form for staff / ec and
function vieweform(reviewer, research){
  var param = {
    id: reviewer,
    id_rs: research
  }
  var response = $.post(ws_url + 'controller/reviewer/check_file_assesment.php', param, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      $('.e-form-list').empty()

                      $data_assesment = ''
                      snap.forEach(function(childSnap){

                        console.log(childSnap);

                        if((childSnap.fid == '2') || (childSnap.fid == '3') || (childSnap.fid == '4') || (childSnap.fid == '8') || (childSnap.fid == '9') || (childSnap.fid == '10') || (childSnap.fid == '11') || (childSnap.fid == '12')){

                          $data_assesment = '<tr>' +
                                    '<td><span class="txt-dark f500" style="font-size: 1.2em;">' + childSnap.fid_name + '</span></td>' +
                                    '<td class="text-center"><span class="" style="" id="response_form_' + childSnap.fid + '">ยังไม่ดำเนินการ</span></td>' +
                                    '<td class="text-center">' +
                                      '<button class="btn btn-success btn-block btn-sm mr-5" onclick="doEform(' + childSnap.fid + ')"><i class="zmdi zmdi-edit"></i> ทำแบบประเมิน</button>' +
                                    '</td>' +
                                  '</tr>'

                          $form = ''

                          $doBtn = ' disabled '

                          console.log(childSnap.rw_reply_status);

                          if(childSnap.rw_reply_status == '4'){
                            $doBtn = '  '
                          }

                          if(childSnap.fid == '2'){
                            $form = '<button class="btn btn-success btn-square btn-sm mr-5" ' + $doBtn + ' onclick="view_answer_form(\'' + childSnap.fid + '\', \'' + childSnap.rir_id_reviewer + '\')"><i class="zmdi zmdi-eye"></i></button>'
                          }else if(childSnap.fid == '3'){
                            $form = '<button class="btn btn-success btn-square btn-sm mr-5" ' + $doBtn + ' onclick="view_answer_form(\'' + childSnap.fid + '\', \'' + childSnap.rir_id_reviewer + '\')"><i class="zmdi zmdi-eye"></i></button>'
                          }else if(childSnap.fid == '4'){
                            $form = '<button class="btn btn-success btn-square btn-sm mr-5" ' + $doBtn + ' onclick="view_answer_form(\'' + childSnap.fid + '\', \'' + childSnap.rir_id_reviewer + '\')"><i class="zmdi zmdi-eye"></i></button>'
                          }else if(childSnap.fid == '8'){
                            $form = '<button class="btn btn-success btn-square btn-sm mr-5" ' + $doBtn + ' onclick="view_answer_form(\'' + childSnap.fid + '\', \'' + childSnap.rir_id_reviewer + '\')"><i class="zmdi zmdi-eye"></i></button>'
                          }

                          // var data = '<li class="mb-5"><a href="../form_download/' + childSnap.fid_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.fid_name + '</li>';
                          // $('#ft_assesment').append(data);

                          data = '<div class="" style="border: solid; border-width: 0px; border-color: rgb(221, 221, 221); border-radius: 5px; padding-bottom: 10px;">' +
                                    '<div class="row">' +
                                      '<div class="col-sm-1 text-center">' +
                                        $form +
                                      '</div>' +
                                      '<div class="col-sm-9" style="padding-top: 10px;">' + childSnap.fid_name + '</div>' +

                                    '</div>' +
                                 '</div>'
                          $('.e-form-list').append(data);

                          // checkAssesmentStatus(childSnap.fid)

                        }

                        // $('#assesmentList').append($data_assesment)

                      })
                    }
                  }, 'json')
}

function view_answer_form(fid, reviewer){

  if(fid == '4'){ // AO-016_Assessment_form_ICF.doc
    var jxr = $.post(ws_url + 'controller/form/view_icf.php?id_rs=' + current_rs_id + '&id_reviewer=' + reviewer, function(){})
               .always(function(resp){
                 if(resp != ''){
                   $('.btnClosemodal').trigger('click')
                   $('#btnViewform').trigger('click')
                   $('.e-form-info').html(resp)
                 }
               })
  }


}

function sortJson(element, prop, propType, asc) {
  switch (propType) {
    case "int":
      element = element.sort(function (a, b) {
        if (asc) {
          return (parseInt(a[prop]) > parseInt(b[prop])) ? 1 : ((parseInt(a[prop]) < parseInt(b[prop])) ? -1 : 0);
        } else {
          return (parseInt(b[prop]) > parseInt(a[prop])) ? 1 : ((parseInt(b[prop]) < parseInt(a[prop])) ? -1 : 0);
        }
      });
      break;
    default:
      element = element.sort(function (a, b) {
        if (asc) {
          return (a[prop].toLowerCase() > b[prop].toLowerCase()) ? 1 : ((a[prop].toLowerCase() < b[prop].toLowerCase()) ? -1 : 0);
        } else {
          return (b[prop].toLowerCase() > a[prop].toLowerCase()) ? 1 : ((b[prop].toLowerCase() < a[prop].toLowerCase()) ? -1 : 0);
        }
      });
  }
}
