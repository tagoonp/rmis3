var id_reviewer = '';
var path = window.location.pathname;
var page = path.split("/").pop();
var reviewer = {
  init: function(){
    console.log(current_user);
    console.log(current_role);

    if((current_user == null) || (current_role == null) || (current_role != 'reviewer')){
      swal({    title: "ขออภัย",
             text: "สิทธิ์การเข้าใช้งานของคุณไม่ถูกต้อง",
             type: "warning",
             showCancelButton: false,
             confirmButtonColor: "#139a45",
             confirmButtonText: "เข้าสู่ระบบอีกครั้ง",
             closeOnConfirm: false },
             function(){
              window.location = '../'
             });

      return ;
    }

    var param = {
      id: current_user,
      role: current_role
    }

    var jxhr = $.post(ws_url + 'controller/check_user.php', param, function(){}, 'json')
                .always(function(snap){

                  if(snap != ''){

                    snap.forEach(function(childSnap){
                      $('.userFullname').text(childSnap.prefix_name + childSnap.fname + ' ' + childSnap.lname)
                      window.localStorage.setItem('rmis_current_user_fullname', childSnap.prefix_name + childSnap.fname + ' ' + childSnap.lname)
                      window.localStorage.setItem('rmis_current_user_email', childSnap.email)


                      if(childSnap.profile == ''){
                        profile = '../v3/dist/img/user1.png'
                      }else{
                        profile = '../images/profile/' + childSnap.profile;
                      }

                      window.localStorage.setItem('rmis_current_user_profile', profile);
                      id_pm = childSnap.id_pm

                      $( "#profileImg" ).html('<img src="'+ profile +'" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status">' );
                      $('.profileImg').html('<img class="inline-block mb-10" id="profileImg" src="'+ profile +'" alt="user" />')

                      $('.userEmail').text(window.localStorage.getItem('rmis_current_user_email'))
                      $('#txtEmail').val(childSnap.email)

                      $('#txtPrefix').val(childSnap.id_prefix)
                      $('#txtFname').val(childSnap.fname)
                      $('#txtLname').val(childSnap.lname)


                      $('.userTel').text(childSnap.tel_office)
                      $('#txtOffice').val(childSnap.tel_office)
                      $('.userMobile').text(childSnap.tel_mobile)
                      $('#txtMobile').val(childSnap.tel_mobile)
                      $('.userFax').text(childSnap.tel_fax)
                      $('#txtFax').val(childSnap.tel_fax)
                      $('.userExp').text(childSnap.expertise)
                      $('#txtExp').val(childSnap.expertise)
                      $('.userRI').text(childSnap.rs_interest)
                      $('#txtRI').val(childSnap.rs_interest)
                      $('.userAddress').text(childSnap.address)
                      $('#txtAddress').val(childSnap.address)
                      $('.userPosition').text(childSnap.personnel_name)
                      $('#txtPosition').val(childSnap.id_personnel)

                      $('#uid').val(childSnap.id)

                      // pi.count_rs()

                    })
                  }else{

                    swal({    title: "ขออภัย",
                           text: "ไม่พบข้อมูลผู้ใช้งาน!",
                           type: "error",
                           showCancelButton: false,
                           confirmButtonColor: "#139a45",
                           confirmButtonText: "เข้าสู่ระบบอีกครั้ง",
                           closeOnConfirm: false },
                           function(){
                            window.location = '../'
                           });

                  }
                }, 'json')
                .fail(function(){
                  swal({    title: "ขออภัย",
                         text: "ไม่สามารถเชื่อมต่อฐานข้อมูลได้",
                         type: "error",
                         showCancelButton: false,
                         confirmButtonColor: "#139a45",
                         confirmButtonText: "เข้าสู่ระบบอีกครั้ง",
                         closeOnConfirm: false },
                         function(){
                          window.location = '../'
                         });

                  return ;
                }, 'json')
    console.log('Checking role success ....');

  }, // End init
  load_rs_info_2: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }
    //
    console.log(param);
    // return ;
    var jxhr = $.post(ws_url + 'controller/reviewer/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){

                  console.log(snap);

                  if((snap!='') && (snap.length > 0)){

                    // if(snap[0].rw_reply_status != 0){
                        reply_status = snap[0].rw_reply_status
                    // }


                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.code_apdu)
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)
                      $('.ecMsg').html(i.rw_sendding_msg)
                      $('#txtIdCodaAPCU').val(i.code_apdu)

                      // console.log(i.rw_sendding_msg);
                      if(i.rw_reply_status == 0){
                        console.log(i.rw_reply_status);
                        $('#profile_tab_7').hide()
                        $('#profile_tab_9').hide()
                        $('#profile_tab_10').hide()
                      }

                      $startdate = '0000-00-00';
                      $enddate = '0000-00-00';
                      $b1 = '0000-00-00'; $b2 = '0000-00-00';
                      $startdate = main_app.check_dateformat(i.start_date);
                      $b1 = $startdate;
                      $startdate = main_app.convertThaidate($startdate);

                      $enddate = main_app.check_dateformat(i.finish_date);
                      $b2 = $enddate;
                      $enddate = main_app.convertThaidate($enddate);

                      $durr = main_app.calDateDiff($b1, $b2)
                      // console.log($durr);

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)
                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])
                      }

                      $('#txtRduration').html('<div>เริ่มต้นโครงการ : ' + $startdate + ' วันที่สิ้นสุด : ' + $enddate + '</div>' + '<div>รวมจำนวน : ' + $durr + ' วัน </div>')
                      var budg = i.budget;
                      $('#txtRBudget').text(budg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท')



                      // $('#txtRduration').text(main_app.)

                      $rtype = 'เป็นโครงการวิจัยที่ไม่ได้ขอทุนจากแหล่งทุนใด ๆ'
                      if(i.ts0 != 0){
                        $rtype = 'มีทุนวิจัยจากแหล่งทุน'
                      }
                      $('#txtFundingtype').text($rtype)

                      $rgroup = [];

                      if(i.ts1 == 1){
                        $rgroup.push('<div>- ทุนวิจัยคณะแพทยศาสตร์</div>')
                      }

                      if(i.ts7 == 1){
                        $rgroup.push('<div>- ทุนภาคเอกชน (Industry Sponsored Trial)</div>')
                      }

                      if(i.ts2 == 1){
                        $rgroup.push('<div>- ทุนงบประมาณแผ่นดิน</div>')
                      }

                      if(i.ts3 == 1){
                        $rgroup.push('<div>- เงินรายได้มหาวิทยาลัย</div>')
                      }

                      if(i.ts4 == 1){
                        $rgroup.push('<div>- ทุนอื่นภายในประเทศ</div>')
                      }

                      if(i.ts5 == 1){
                        $rgroup.push('<div>- ทุนอื่นภายนอกประเทศ</div>')
                      }

                      if(i.ts6 == 1){
                        $rgroup.push('<div>- ทุนอื่น ๆ </div>')
                      }

                      var fs = 'ไม่มี';
                      if($rgroup.length > 0){
                        fs = $rgroup.join("");
                      }

                      $('#txtFundinggroup').html(fs)
                      $('#txtFundingname').text(i.source_funds)

                      $('.txtSessid').text(i.session_id)

                      if(i.sendding_status == 'Y'){
                        // $('#btnPrint').removeClass('disabled')
                        // $('#btnSending').addClass('disabled')
                        // $('#btnEdit').addClass('disabled')
                        // $('#btnSending').addClass('dn')
                      }


                      lp.hl()


                    })

                    checkReplyStatus()
                  }else{
                    lp.hl()
                  }
                })
                .fail(function(){
                  lp.hl()
                })

                var jxhr2 = $.post(ws_url + 'controller/staff/pm-co-pi-info.php', {sess: current_rs, id: current_user}, function(){}, 'json')
                            .always(function(snap){

                              var co_piname = [];

                              if((snap.length > 0) && (snap != '')){
                                $n = 1;
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

                                  co_piname.push('<div>' + $n + '. ' + i.prefix_name + i.co_fname + ' ' + i.co_lname + ' (สัดส่วน : ' + i.co_ratio + '%)</div>');
                                  $n++;
                                })

                                var cn = 'เกิดข้อผิดพลาดในการดึงข้อมูล';

                                if(co_piname.length > 0){
                                  cn = co_piname.join("");
                                }

                                $('#txtCopi').html(cn)

                              }else{
                                $('#txtCopi').text('ไม่มีผู้ร่วมวิจัย')
                              }
                            },'json')
                            .fail(function(){
                              $('#txtCopi').text('ไม่พบข้อมูล')
                            })
  },
  load_rs_info: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }
    var jxhr = $.post(ws_url + 'controller/reviewer/get-rs-info.php', param, function(){}, 'json')
                .always(function(snap){

                  console.log(snap);

                  if((snap!='') && (snap.length > 0)){

                    // if(snap[0].rw_reply_status != 0){
                        reply_status = snap[0].rw_reply_status
                    // }

                    console.log(snap[0].rw_reply_status);

                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.code_apdu)
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)
                      $('.ecMsg').html(i.rw_sendding_msg)

                      $startdate = '0000-00-00';
                      $enddate = '0000-00-00';
                      $b1 = '0000-00-00'; $b2 = '0000-00-00';
                      $startdate = main_app.check_dateformat(i.start_date);
                      $b1 = $startdate;
                      $startdate = main_app.convertThaidate($startdate);

                      $enddate = main_app.check_dateformat(i.finish_date);
                      $b2 = $enddate;
                      $enddate = main_app.convertThaidate($enddate);

                      $durr = main_app.calDateDiff($b1, $b2)
                      // console.log($durr);

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)
                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])
                      }

                      $('#txtRduration').html('<div>เริ่มต้นโครงการ : ' + $startdate + ' วันที่สิ้นสุด : ' + $enddate + '</div>' + '<div>รวมจำนวน : ' + $durr + ' วัน </div>')
                      var budg = i.budget;
                      $('#txtRBudget').text(budg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท')



                      // $('#txtRduration').text(main_app.)

                      $rtype = 'เป็นโครงการวิจัยที่ไม่ได้ขอทุนจากแหล่งทุนใด ๆ'
                      if(i.ts0 != 0){
                        $rtype = 'มีทุนวิจัยจากแหล่งทุน'
                      }
                      $('#txtFundingtype').text($rtype)

                      $rgroup = [];

                      if(i.ts1 == 1){
                        $rgroup.push('<div>- ทุนวิจัยคณะแพทยศาสตร์</div>')
                      }

                      if(i.ts7 == 1){
                        $rgroup.push('<div>- ทุนภาคเอกชน (Industry Sponsored Trial)</div>')
                      }

                      if(i.ts2 == 1){
                        $rgroup.push('<div>- ทุนงบประมาณแผ่นดิน</div>')
                      }

                      if(i.ts3 == 1){
                        $rgroup.push('<div>- เงินรายได้มหาวิทยาลัย</div>')
                      }

                      if(i.ts4 == 1){
                        $rgroup.push('<div>- ทุนอื่นภายในประเทศ</div>')
                      }

                      if(i.ts5 == 1){
                        $rgroup.push('<div>- ทุนอื่นภายนอกประเทศ</div>')
                      }

                      if(i.ts6 == 1){
                        $rgroup.push('<div>- ทุนอื่น ๆ </div>')
                      }

                      var fs = 'ไม่มี';
                      if($rgroup.length > 0){
                        fs = $rgroup.join("");
                      }

                      $('#txtFundinggroup').html(fs)
                      $('#txtFundingname').text(i.source_funds)

                      $('.txtSessid').text(i.session_id)

                      if(i.sendding_status == 'Y'){
                        // $('#btnPrint').removeClass('disabled')
                        // $('#btnSending').addClass('disabled')
                        // $('#btnEdit').addClass('disabled')
                        // $('#btnSending').addClass('dn')
                      }


                      lp.hl()


                    })

                    checkReplyStatus()
                  }else{
                    lp.hl()
                  }
                })
                .fail(function(){
                  lp.hl()
                })

                var jxhr2 = $.post(ws_url + 'controller/staff/pm-co-pi-info.php', {sess: current_rs, id: current_user}, function(){}, 'json')
                            .always(function(snap){

                              var co_piname = [];

                              if((snap.length > 0) && (snap != '')){
                                $n = 1;
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

                                  co_piname.push('<div>' + $n + '. ' + i.prefix_name + i.co_fname + ' ' + i.co_lname + ' (สัดส่วน : ' + i.co_ratio + '%)</div>');
                                  $n++;
                                })

                                var cn = 'เกิดข้อผิดพลาดในการดึงข้อมูล';

                                if(co_piname.length > 0){
                                  cn = co_piname.join("");
                                }

                                $('#txtCopi').html(cn)

                              }else{
                                $('#txtCopi').text('ไม่มีผู้ร่วมวิจัย')
                              }
                            },'json')
                            .fail(function(){
                              $('#txtCopi').text('ไม่พบข้อมูล')
                            })
  }, // End load_rs_info


}

function checkReplyStatus(){

  if(reply_status != 0){
    $('#btnAc1').addClass('dn')
    $('#btnAc2').addClass('dn')
    $('#btnAc3').addClass('dn_')
  }

  if(reply_status == 0){
    console.log(cstay);
    if(cstay == 'aknowledge'){
      $('#btnAc1').trigger('click')
    }else if(cstay == 'aknowledgehardcopy'){
      $('#btnAc2').trigger('click')
    }else if(cstay == 'notconside'){
      $('#btnAc3').trigger('click')
    }
  }
}

function checkDataReplyFile(){

  numreplyfile = 0;

  var param = {
    id: current_user,
    id_rs: current_rs_id
  }
  var response = $.post(ws_url + 'controller/reviewer/check_file_reply_assesment.php', param, function(){}, 'json')
                  .always(function(snap){
                    console.log(snap);
                    if((snap != '') && (snap.length > 0)){

                      $('#ft_assesment_reply_table').empty()
                      $('#ft_assesment_reply').empty()
                      $c = 1;
                      snap.forEach(function(childSnap){
                        var data = '<li class="mb-5">' +
                                    '<div class="row" style="border: solid; border-width: 0px 0px 0px 0px; border-color: rgb(136, 136, 136); padding: 10px 0px; background: rgb(245, 244, 244);">' +
                                      '<div class="col-sm-8">' +
                                        '<a class="f500 txt-dark" href="' + childSnap.rfa_filefullpart + '" target="_blank" style="font-size: 1.2em;">' + childSnap.rfa_filename + '</a>' +
                                      '</div>' +
                                      '<div class="col-sm-2">' +
                                        '<a class="btn btn-block btn-success" href="' + childSnap.rfa_filefullpart + '" target="_blank"><i class="fa fa-download text-light mr-5"></i> <span class="hidden-sm">ดาวน์โหลด</span></a>' +
                                      '</div>' +
                                      '<div class="col-sm-2">' +
                                        '<a class="btn btn-block btn-danger btnDeleteReply" id="btnDeleteReply" href="Javascript:deleteAssesmentReply(' + childSnap.rfa_id + ')" target="_blank"><i class="fa fa-trash text-light mr-5"></i> <span class="hidden-sm">ลบ</span></a>' +
                                      '</div>' +
                                    '</div>' +
                                    '</li>';
                        $('#ft_assesment_reply').append(data);

                        var data2 = '<tr>' +
                                      '<td class=text-center>' + $c + '</td>' +
                                      '<td>' + childSnap.rfa_filename + '</td>' +
                                      '<td>' +
                                        '<a class="btn btn-block btn-danger btn-sm" id="btnDeleteReply" href="Javascript:deleteAssesmentReply(' + childSnap.rfa_id + ')" target="_blank"><i class="fa fa-trash text-light mr-5"></i> <span class="hidden-sm">ลบไฟล์</span></a>' +
                                      '</td>' +
                                    '</tr>'

                        $('#ft_assesment_reply_table').append(data2)
                        numreplyfile++;
                        $c++;
                      })

                      console.log(numreplyfile);

                      if(numreplyfile != 0){
                        if(reply_status != 4){
                          $('#btnSendAsessment').prop('disabled', '')
                        }
                      }
                    }else{
                      $('#ft_assesment_reply').empty()
                      $('#ft_assesment_reply_table').empty()

                      var data2 = '<tr>' +
                                    '<td colspan="3">ยังไม่มีไฟล์ที่ท่านอัพโหลด</td>' +
                                  '</tr>'

                      $('#ft_assesment_reply_table').append(data2)
                    }
                  }, 'json')
                  .fail(function(){
                    $('#ft_assesment_reply').append('ยังไม่เชื่อมต่อฐานข้อมูลได้')
                  })
}

function deleteAssesmentReply(did){

  var param = {
    id: current_user,
    id_rs: current_rs_id,
    fid: did
  }

  var jxhr = $.post(ws_url + 'controller/reviewer/delete_file_assesment_reply.php', param, function(){})
              .always(function(resp){

                console.log(resp);
                if(resp != 'Y'){
                  alert(resp)
                }
                checkDataReplyFile()
              })


}

function checkFileAssesment(){

  if((reply_status == 0) && (reply_status == 3)){
    return ;
  }

  $('#replayBack1').addClass('dn')
  $('#replayBack2').removeClass('dn')
  var param = {
    id: current_user,
    id_rs: current_rs_id
  }
  var response = $.post(ws_url + 'controller/reviewer/check_file_assesment.php', param, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      $('#ft_assesment').empty()
                      snap.forEach(function(childSnap){
                        var data = '<li class="mb-5"><a href="../form_download/' + childSnap.fid_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.fid_name + '</li>';
                        $('#ft_assesment').append(data);
                      })
                    }
                  }, 'json')
                  .fail(function(){
                    $('#ft_assesment').append('ยังไม่เชื่อมต่อฐานข้อมูลได้')
                  })
}

function checkFileAttached(){
  for(var i = 1; i <=8 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft' + i).empty()
  var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i, session_id: current_rs}, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      $('#ft' + i).empty();
                      snap.forEach(function(childSnap){
                        var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';
                        $('#ft' + i).append(data);
                      })
                    }else{
                      $('#ft' + i).append('ไม่พบไฟล์แนบ');
                    }
                  },'json');
}
