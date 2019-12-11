function load_progress_info_5(){
  var param = {
    pid: current_pid,
    progress: current_prpgress
  }

  var jxhr = $.post(ws_url + 'controller/get_progress_info.php', param, function(){}, 'json')
              .always(function(snap){
                console.log(snap);
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
                    $('#txtPiname').val(i.fname + ' ' + i.lname)
                    $('#txtPiemail').val(i.email)
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

                    if(i.rp_sending_status == 1){
                      $('#btnPrint').prop('disabled', '')
                      $('#btnSending').addClass('dn')
                      $('#btnEdit').addClass('dn')

                      $('#txt-progress-status').text(i.status_name)
                      $('#txt-progress-rep-date').text(main_app.convertThaidate(i.rp_submit_date))
                    }

                  })

                  checkProgressDocument(current_prpgress, tmp_session_id)

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

function load_progress_info_6(){
  var param = {
    pid: current_pid,
    progress: current_prpgress
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
                    $('#txtPiname').val(i.fname + ' ' + i.lname)
                    $('#txtPiemail').val(i.email)
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

                  })

                  checkProgressDocument(current_prpgress, tmp_session_id)

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


function delete_report(ukey, pid){
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
                key: ukey,
                progress_id: pid,
                user: current_user
              }

              // console.log(param);
              // return ;

              var jxr = $.post(ws_url + 'controller/pm/delete-report.php', param, function(){})
                         .always(function(resp){
                           // console.log(resp);
                           if(resp == 'Y'){
                             window.location.reload()
                           }else{
                             swal("ขอภัย!", "ไม่สามารถลบข้อมูลได้", "error")
                           }
                         }, 'json')
                         .fail(function(){
                           swal("ขอภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้้", "error")
                           // window.location.reload()
                         })
            });
}

function withdraw_report(ukey, pid){
  swal({    title: "ยืนยันดำเนินการ",
              text: "ท่านยืนยันการถอนรายการนี้จากการพิจารณาหรือไม่?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ยืนยันการลบ",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: true
            },
            function(){
              var param = {
                key: ukey,
                progress_id: pid,
                user: current_user
              }

              var jxr = $.post(ws_url + 'controller/pm/withdraw-report.php', param, function(){})
                         .always(function(resp){
                           if(resp == 'Y'){
                             window.location.reload()
                           }else{
                             swal("ขอภัย!", "ไม่สามารถลบข้อมูลได้", "error")
                             // window.location.reload()
                           }
                         }, 'json')
                         .fail(function(){
                           swal("ขอภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้้", "error")
                           // window.location.reload()
                         })
            });
}

function update_report(ukey, progress_id, id_rs, id_type){

  window.localStorage.setItem('current_progress_session', ukey)
  window.localStorage.setItem('current_progress_id_rs', id_rs)
  window.localStorage.setItem('current_progress_type', id_type)

  window.location = 'progress' + progress_id + '.html'
  // console.log(ukey);
}

function update_report_2(ukey, progress_id, id_rs, id_type){

  window.localStorage.setItem('current_progress_session', ukey)
  window.localStorage.setItem('current_progress_id_rs', id_rs)
  window.localStorage.setItem('current_progress_type', id_type)

  window.location = 'progress_update_' + progress_id + '.html'
  // console.log(ukey);
}
