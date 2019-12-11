$('title').text(':: RMIS :: สำหรับประธานสำนักงานจริยธรรมการวิจัยในมนุษย์ ::')

var path = window.location.pathname;
var page = path.split("/").pop();

var tmp_pm_email = null;
var tmp_pm_fullname = null;
var tmp_code_apdu = null;

var chairman = {
  init: function(){
    if((current_user == null) || (current_role == null) || (current_role != 'chairman')){
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
                  console.log(snap);
                  if((snap != '') && (snap.length > 0)){
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
                      id_ec = childSnap.id

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

                    return ;

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
  },
  checkNewWaitApprove: function(){
    lp.sl()
    var jxhr = $.post(ws_url + 'controller/chairman/check-status-25.php', function(){}, 'json')
                .always(function(snap){
                  if((snap != '') && (snap.length > 0)){
                    $('.N1').text('( ' + snap.length + ' โครงการ )')
                    $('#btnN1').removeClass('btn-outline')
                    lp.hl()
                  }
                }, 'json')
                .fail(function(){
                  onFail()
                  lp.hl()
                })
  },
  checkNewWaitDisApprove: function(){
    lp.sl()
    var jxhr = $.post(ws_url + 'controller/chairman/check-status-25-dis.php', function(){}, 'json')
                .always(function(snap){
                  if((snap != '') && (snap.length > 0)){
                    $('.N4').text('( ' + snap.length + ' โครงการ )')
                    $('#btnN4').removeClass('btn-outline')
                    lp.hl()
                  }
                }, 'json')
                .fail(function(){
                  onFail()
                  lp.hl()
                })
  },
  load_rs_info: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info.php', param, function(){}, 'json')
                .always(function(snap){
                  // console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)
                      $('#txtCode').text(i.code_apdu)

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
                        $('#btnPrint').removeClass('disabled')
                        $('#btnSending').addClass('disabled')
                        $('#btnEdit').addClass('disabled')
                        $('#btnSending').addClass('dn')
                      }


                      lp.hl()
                    })
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
  loadAppInit: function(){
    var param = $.post(ws_url + 'controller/chairman/check-status-25.php', function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){
                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';

                       if((i.id_status_research != 1) && (i.id_status_research != 2) && (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }


                       dt.row.add([
                         $c,
                         i.code_apdu,
                         '<a href="#" onclick="view_info(\'' + i.id_rs +'\')" class="f500">' + i.title_th + '</a>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                         '<span class="txt-danger">' + i.rct_type + '</span>',
                         '<div class="text-center">' +
                            '<button class="btn btn-success btn-sm pr-10 pl-10" onclick="view_info(\'' + i.id_rs +'\')"><i class="fa fa-search"></i> ดูข้อมูล</button>' +
                          '</div>'
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  loadDisAppInit: function(){
    var param = $.post(ws_url + 'controller/chairman/check-status-25-dis.php', function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){
                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';

                       if((i.id_status_research != 1) && (i.id_status_research != 2) && (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }


                       dt.row.add([
                         $c,
                         i.code_apdu,
                         '<a href="#" onclick="view_info(\'' + i.id_rs +'\')" class="f500">' + i.title_th + '</a>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                         '<span class="txt-danger">' + i.rct_type + '</span>',
                         '<div class="text-center">' +
                            '<button class="btn btn-success btn-sm pr-10 pl-10" onclick="view_info(\'' + i.id_rs +'\', \'dis-app\')"><i class="fa fa-search"></i> ดูข้อมูล</button>' +
                          '</div>'
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  load_rs_info_2: function(){


    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }

    // console.log(param);
    var jxhr = $.post(ws_url + 'controller/chairman/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      // console.log(i);
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )

                      $('#txtThtitle').text(i.title_th)
                      $('.txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('.txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('.piFullname').text(i.fname + ' ' + i.lname)

                      tmp_pm_fullname = i.prefix_name + i.fname + ' ' + i.lname
                      tmp_pm_email = i.email
                      tmp_code_apdu = i.code_apdu

                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      $('#txtRTypess').text(i.rct_type)
                      checkrtype = i.rct_type;
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)
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

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)
                        $('.txtCode').text(i.code_apdu)
                        $('#txtCodeBCAPCU').val(i.code_apdu)
                        $('.docSessCodeAPDU').val(i.code_apdu)
                        $('#COAAPDU').val(i.code_apdu)

                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])

                        $('.rafa_panal').html(i.rafa_panal)
                        $('.rafa_agn').html(i.rafa_agn)
                        $('.rafa_set').html(i.rafa_set)
                        $('.rafa_date').html(main_app.convertThaidate(i.rafa_date))

                      }

                      $('#txtRduration').html('<div>เริ่มต้นโครงการ : ' + $startdate + ' วันที่สิ้นสุด : ' + $enddate + '</div>' + '<div>รวมจำนวน : ' + $durr + ' วัน </div>')
                      var budg = i.budget;
                      $('#txtRBudget').text(budg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท')

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
                        $('#btnPrint').removeClass('disabled')
                        $('#btnSending').addClass('disabled')
                        $('#btnEdit').addClass('disabled')
                        $('#btnSending').addClass('dn')
                      }

                      $('#doc_info').html(i.rai_full_content)


                      $('#orgNumber').val(main_app.randomNumber())

                      setTimeout(function(){
                        if(i.rai_sign_status == '1'){

                          if(i.rai_lang == 'th'){
                            $('.sign_panal').html('<div class="row">' +
                              '<div class="col-xs-5 text-right" style="padding-top: 20px;">&nbsp;</div>' +
                              '<div class="col-xs-4 text-left" style="margin-left: -10px;">' +
                                '<span class="signature"><img src="../images/signate/sig2-th.png" width="120"></span>' +
                              '</div>' +
                            '</div>')

                            $('.approveDate_1').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))
                            $('.approveDate_2').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))

                            $('.approveDate_2').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))

                            // console.log(i.rafa_docnumber_full);
                            $('#noDoc').text(i.rafa_docnumber_full)

                            $('#appDate1').text(main_app.convertThaidate(i.rai_sign_date))
                            $('#expDate1').text(main_app.convertThaidate(i.rai_expired_date))

                          }else{
                            $('.sign_panal').html('<div class="row">' +
                              '<div class="col-xs-5 text-right" style="padding-top: 20px;">&nbsp;</div>' +
                              '<div class="col-xs-4 text-left" style="margin-left: -10px;">' +
                                '<span class="signature"><img src="../images/signate/sig2-eng.png" width="150"></span>' +
                              '</div>' +
                            '</div>')

                            $('.approveDate_1').text(main_app.convertEndate(i.rai_sign_date))
                            $('.approveDate_2').text(main_app.convertEndate(i.rai_sign_date))

                            $('#noDoc').text(i.rafa_docnumber_full)

                            $('#appDate1').text(main_app.convertThaidate(i.rai_sign_date))
                            $('#expDate1').text(main_app.convertThaidate(i.rai_expired_date))
                          }

                          $('#profile_tab_8').hide()

                        }
                      }, 500)


                      lp.hl()
                    })
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
  }
}

function checkFileAttached(){
  for(var i = 1; i <=8 ; i++){
    checkData(i);
  }
}


function view_info(idrs, stage){
  var param = {
    id_rs: idrs,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    if(stage == 'dis-app'){
                      window.location = 'research_disapproval_info.html'
                    }else{
                      window.location = 'research_approval_info.html'
                    }

                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
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

function confirmApprove(){
  if($('#secretNumber').val() == ''){
    swal("ขออภัย!", "กรุณากรอกรหัสยืนยัน!", "warning")
    return ;
  }

  if($('#secretNumber').val() != $('#orgNumber').val()){
    swal("ขออภัย!", "กรุณากรอกรหัสยืนยันให้ถูกต้อง!", "warning")
    return ;
  }



  var param = {
    id_rs: current_rs_id,
    user: current_user
  }

  swal({
    title: "ยืนยันดำเนินการ",
    text: "ท่านยืนยันการดำเนินการรับรอง/รับทราบโครงการวิจัยนี้หรือไม่?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/chairman/confirm-approve.php', param, function(){})
                .always(function(r){
                  console.log(r);
                  if(r == 'Y'){

                    var dataContent = '<h3>ผลการพิจารณาข้อเสนอโครงการเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์ REC.' + tmp_code_apdu + '</h3>' +
                                      '<p>เรียน นักวิจจัยหลัก (' + tmp_pm_fullname + ') ที่นับถือ</p>' +
                                      '<p>สำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการรับรองโครงการวิจัยของท่านเรียบร้อยแล้ว ทั้งนี้ ท่านสามารถตรวจสอบข้อมูลอื่น ๆ เพิ่มเติมได้ที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                      '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                    var param = {
                      title: "{ No-reply } REC." + tmp_code_apdu + " : ผลการพิจารณาข้อเสนอโครงการเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์",
                      content: dataContent,
                      user: 'tagoon.p@gmail.com',
                      key: 'idj&skeoXf2**r123X',
                      toemail: tmp_pm_email,
                      toname: tmp_pm_fullname
                    }
                    main.send_email(param, 'index.html', 'ท่านได้ลงนามและส่งใบรับรอง/รับทราบและแจ้งทางผู้วิจัยเรียบร้อยแล้ว', '่านได้ลงนามและส่งใบรับทราบ แต่เกิดข้อผิดพลาดในการส่งอีเมล์แจ้งผู้วิจัย กรุณาแจ้งเจ้าหน้าที่')
                    return ;

                    var emailParam = {
                      email: emailConfig.user,
                      api_key: emailConfig.key,
                      title: "{ No-reply } REC." + tmp_code_apdu + " : ผลการพิจารณาข้อเสนอโครงการเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์",
                      to_email: tmp_pm_email ,
                      content: dataContent
                    }

                    var jxhr2 = $.post(emailProvider, emailParam, function(){})
                                .always(function(res2){
                                  if(res2!='Y'){
                                    swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ท่านได้ลงนามและส่งใบรับทราบ แต่เกิดข้อผิดพลาดในการส่งอีเมล์แจ้งผู้วิจัย กรุณาแจ้งเจ้าหน้าที่!",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ต่อไป",
                                        closeOnConfirm: true
                                    },
                                    function(){
                                        window.location.reload()
                                    });
                                  }else{
                                    swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ท่านได้ลงนามและส่งใบรับรอง/รับทราบและแจ้งทางผู้วิจัยเรียบร้อยแล้ว กด 'ต่อไป' เพื่อทำการตรวจสอบ!",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ต่อไป",
                                        closeOnConfirm: true
                                    },
                                    function(){
                                        window.location.reload()
                                    });
                                  }
                                })
                                .fail(function(){
                                  onFail()
                                })
                  }else{
                    swal("ขออภัย!", "เกิดข้อผิดพลาดในการดำเนินการ กรุณาแจ้งเจ้าหน้าที่!", "warning")
                    lp.hl()
                    return ;
                  }
                })
                .fail(function(){ onFail() })

  });
}

function confirmDisApprove(){
  if($('#secretNumber').val() == ''){
    swal("ขออภัย!", "กรุณากรอกรหัสยืนยัน!", "warning")
    return ;
  }

  if($('#secretNumber').val() != $('#orgNumber').val()){
    swal("ขออภัย!", "กรุณากรอกรหัสยืนยันให้ถูกต้อง!", "warning")
    return ;
  }



  var param = {
    id_rs: current_rs_id,
    user: current_user,
    disapp_msg: $('#doc_info_dis').html()
  }

  swal({
    title: "ยืนยันดำเนินการ",
    text: "ท่านยืนยันการดำเนินการรับทราบการไม่รับรองโครงการวิจัยนี้หรือไม่?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/chairman/confirm-dis-approve.php', param, function(){})
                .always(function(r){
                  console.log(r);
                  if(r == 'Y'){

                    var dataContent = $('#doc_info_dis').html()

                    var emailParam = {
                      email: emailConfig.user,
                      api_key: emailConfig.key,
                      title: "{ No-reply } REC." + tmp_code_apdu + " : ผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์",
                      to_email: tmp_pm_email ,
                      content: dataContent
                    }

                    dataContent = dataContent.replace(/\n/g, '');
                    dataContent = dataContent.replace(/\n\n/g, '');

                    var param = {
                      title: "{ No-reply } REC." + tmp_code_apdu + " : ผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์",
                      content: dataContent,
                      user: 'tagoon.p@gmail.com',
                      key: 'idj&skeoXf2**r123X',
                      toemail: tmp_pm_email,
                      toname: $('.piFullname').text()
                    }

                    main.send_email(param, 'index.html', 'ท่านได้ส่งผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์เรียบร้อยแล้ว กด ต่อไป เพื่อกลับสู่หน้าหลัก!', 'ท่านได้ส่งผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์เรียบร้อยแล้ว แต่เกิดข้อผิดพลาดในการส่งอีเมล์แจ้งผู้วิจัย กรุณาแจ้งเจ้าหน้าที่!')
                    return ;



                    var jxhr2 = $.post(emailProvider, emailParam, function(){})
                                .always(function(res2){
                                  if(res2!='Y'){
                                    swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ท่านได้ส่งผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์เรียบร้อยแล้ว แต่เกิดข้อผิดพลาดในการส่งอีเมล์แจ้งผู้วิจัย กรุณาแจ้งเจ้าหน้าที่!",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ต่อไป",
                                        closeOnConfirm: true
                                    },
                                    function(){
                                        window.location = './'
                                    });
                                  }else{
                                    swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "ท่านได้ส่งผลการประเมินด้านจริยธรรมการวิจัยในมนุษย์เรียบร้อยแล้ว กด 'ต่อไป' เพื่อทำการตรวจสอบ!",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ต่อไป",
                                        closeOnConfirm: true
                                    },
                                    function(){
                                        window.location = './'
                                    });
                                  }
                                })
                                .fail(function(){
                                  // onFail()
                                })
                  }else{
                    swal("ขออภัย!", "เกิดข้อผิดพลาดในการดำเนินการ กรุณาแจ้งเจ้าหน้าที่!", "warning")
                    lp.hl()
                    return ;
                  }
                })
                .fail(function(){ onFail() })

  });
}

function loadCHeckfile(ririd, ord){

  var param2 = {
    rir_id: ririd
  }

  // console.log(param2);

  var jxhr2 = $.post(ws_url + 'controller/staff/check_reviewer_file_list.php', param2, function(){}, 'json')
               .always(function(snap2){
                 // console.log(snap2);
                 if((snap2 != '') && (snap2.length > 0)){
                   $('#ft' + ord).empty()
                    snap2.forEach(function(j){
                      var data = '<li class="mb-5"><a href="Javascript:void(0)" onclick="delete_file_assesment(' + j.rif_id +')"><i class="fa fa-close text-info mr-5"></i></a> ' + j.fid_name + '</li>';
                      $('#ft' + ord).append(data);
                    })
                    $i++;
                 }
               })
}

function loadCHeckProcess(ririd, ord, send_status, send_datetime, notify_date, expire_date, reply_status, reply_datetime, id_rw){
  if(send_status == 1){
    $('#st' + ord).removeClass('dn')
    $('#sd' + ord).text(main_app.convertThaidatetime(send_datetime))
    $('#nd' + ord).text(main_app.convertThaidate(notify_date))
    $('#ed' + ord).text(main_app.convertThaidate(expire_date))

    if(reply_status == 0){
      $('#reply_status' + ord).text('ยังไม่มีการตอบรับ')
      $('#reply_status' + ord).addClass('')
    }else if(reply_status == 3){
      $('#reply_status' + ord).text('ไม่ขอพิจารณาโครงการ')
      $('#reply_status' + ord).addClass('txt-danger')
    }else if(reply_status == 1){
      $('#reply_status' + ord).text('ตอบรับการพิจารณา')
      $('#reply_status' + ord).addClass('text-success')
      $('#reply_date' + ord).text(main_app.convertThaidatetime(reply_datetime))
    }else if(reply_status == 2){
      $('#reply_status' + ord).text('ตอบรับการพิจารณาโดยขอเอกสาร (Hard copy)')
      $('#reply_status' + ord).addClass('')
    }else if(reply_status == 4){
      $('#reply_status' + ord).text('ส่งผลแบบประเมินเรียบร้อยแล้ว')
      $('#reply_status' + ord).addClass('text-success')

      $('#reply_date' + ord).text(main_app.convertThaidatetime(reply_datetime))
      loadFileAssesment(ord, 'ass_status', id_rw)

      nextStatusCheck++;
    }
  }
}
