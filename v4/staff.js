var nextStatusCheck = null;
var info_page = window.localStorage.getItem('current_selected_info_page')
var advisor = false
var lang = 'th'
var current_user = window.localStorage.getItem('rmis_current_user')
var current_role = window.localStorage.getItem('rmis_current_role')
var current_rs_status = window.localStorage.getItem('rmis_current_rs_status')
var staff_rs_status = ['1', '4', '5', '19', '21'];
var assesment_e_form_id = ['2', '3', '4', '7', '13'];

function gotoInfoPage(){
  if(info_page == null){
    window.location = 'rs-status-' + window.localStorage.getItem('rmis_current_rs_status') + '.html'
  }else{
    window.location = info_page
  }
}

var load_modal_fnc = {
  sponser_modal: function(){
    var jxr = $.post(ws_url + 'controller/components/v4_modal_protocol_number.php', function(){})
               .always(function(resp){
                 $('body').append(resp)
               })
  },
  copi_modal: function(){
    var jxr = $.post(ws_url + 'controller/components/v4_modal_co_pi.php', function(){})
               .always(function(resp){
                 $('body').append(resp)
               })
  },
  assessment_file_modal: function(){
    var jxr = $.post(ws_url + 'controller/components/v4_modal_assesment_file.php', function(){})
               .always(function(resp){
                 $('body').append(resp)
               })
  },
  maintoreviewer_modal: function(){
    var jxr = $.post(ws_url + 'controller/components/v4_modal_email_to_reviewer.php', function(){})
               .always(function(resp){
                 $('body').append(resp)
               })
  },
  more_reviewer_modal: function(){
    var jxr = $.post(ws_url + 'controller/components/v4_modal_more_reviewer.php', function(){})
               .always(function(resp){
                 $('body').append(resp)
               })
  }
}

load_modal_fnc.sponser_modal()
load_modal_fnc.copi_modal()
load_modal_fnc.assessment_file_modal()
load_modal_fnc.maintoreviewer_modal()
load_modal_fnc.more_reviewer_modal()

var staff = {
  init: function(){
    console.log('Checking user role ....');
    if((current_user == null) || (current_role == null) || (current_role != 'staff')){
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
                  if(snap != ''){
                    snap.forEach(function(childSnap){
                      $('.userFullname').text(childSnap.fname + ' ' + childSnap.lname)
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
  },
  checkNewContALl: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-cont-all.php', function(){},'json')
                  .always(function(snap){
                    // console.log(snap);
                    if((snap!='') && (snap.length > 0)){
                      $('#cont_n_1').text('(' + snap.length + ')')
                      $('#cont_n_1_btn').addClass('btn-danger')
                      $('#cont_n_1_btn').removeClass('btn-custom-1')
                      $('#cont_n_1_btn').addClass('btn-custom-orange')
                    }
                  })
  },
  checkNewRetro: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-retro.php', function(){},'json')
                 .always(function(snap){
                   if((snap!='') && (snap.length > 0)){
                     $('.retro1').text('(' + snap.length + ')')
                     // $('#btnRetro1').addClass('btn-danger')
                     $('#btnRetro1').removeClass('btn-custom-1')
                     $('#btnRetro1').addClass('btn-custom-orange')
                   }
                 })
  },
  checkNewWaitProgess: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-wait-process.php', function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   if((snap!='') && (snap.length > 0)){
                     $('.NewWaitAllProcess').text('(' + snap.length + ')')
                     $('#btnN3').removeClass('btn-custom-1')
                     $('#btnN3').addClass('btn-custom-orange')
                   }
                 })
  },
  checkNewWaitProgess_fb: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-wait-process-fb.php', function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   if((snap!='') && (snap.length > 0)){
                     $('.NewWaitAllProcess7').text('(' + snap.length + ')')
                     $('#btnN7').removeClass('btn-custom-1')
                     $('#btnN7').addClass('btn-custom-orange')
                   }
                 })
  },
  checkNewWaitEdit: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-edit.php', function(){},'json')
                 .always(function(snap){
                   if((snap!='') && (snap.length > 0)){
                     $('.NewWaitEdit').text('(' + snap.length + ')')
                     // $('#btnN3').removeClass('btn-green')
                     // $('#btnN3').addClass('btn-orange')
                   }
                 })
  },
  checkNewInit: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-init.php', function(){},'json')
                 .always(function(snap){
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){


                     $('.NewRegister').text('(' + snap.length +')')
                     // $('#btnN1').addClass('btn-danger')
                     $('#btnN1').removeClass('btn-custom-1')
                     $('#btnN1').addClass('btn-custom-orange')

                     swal({
                      title: "คำเตือน!",
                      text: "มีโครงการวิจัยใหม่ รอการตรวจสอบความถูกต้องของเอกสาร",
                      type: "warning",
                      showCancelButton: false,
                      confirmButtonColor: "#b02308",
                      confirmButtonText: "รับทราบ",
                      closeOnConfirm: true
                     },function(){});

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

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick="add_report(\''  + i.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         // '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = i.year_name + '-' + i.ord_id + '-' + i.id_dept + '-' + i.id_personnel + '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }


                       dt.row.add([
                         $c,
                         i.id_rs,
                         i.title_th + '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                         i.ep,
                         '<span class="txt-danger">ยันไม่ยืนยันการส่ง</span>',
                         command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  loadNewRetro: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-retro.php', function(){},'json')
                 .always(function(snap){
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

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfoRetro("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         // '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = i.year_name + '-' + i.ord_id + '-' + i.id_dept + '-' + i.id_personnel + '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }


                       dt.row.add([
                         $c,
                         i.id_rs,
                         '<a href="#" onclick=viewRsInfo("' + i.id_rs +'")>' + i.title_th + '</a>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                         i.ep,
                         '<span class="txt-danger">' + i.status_name +'</span>',
                         command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  loadNewInit: function(){

  },
  search_project: function(sk){

    var dt = $('#datable_1').dataTable().api();

    // if(sk == ''){
    //   dt.clear().draw();
    //   return ;
    // }

    var param = {
      year: $('#txtYear').val(),
      searchkey: sk
    }

    var jxhr = $.post(ws_url + 'controller/staff/search_all_research.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if(snap != ''){
                    dt.clear().draw();
                    $c = 1;
                    snap.forEach(function(childSnap){

                      dt.row.add([
                                '<div class="text-center">' + $c + '</div>',
                                '<div class="text-left">' + childSnap.code_apdu + '</div>',
                                '<div class="text-green">' + childSnap.title_th + '</div>' +
                                '<div style="font-size: 0.8em;"><span class="fw500">ชื่อโครงการภาษาอังกฤษ</span> : ' + childSnap.title_en + '</div>' +
                                '<div style="font-size: 0.8em;"><span class="fw500">หัวหน้าโครงการ</span> : ' + childSnap.prefix_name + childSnap.name + ' ' + childSnap.surname + '</div>',
                                childSnap.status_name,
                                '<div class="text-center"><div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">' +
                                  '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick="viewRsInfo2(\'' + childSnap.id_rs +'\')"><i class="fa fa-search"></i></button>&nbsp; ' +
                                  '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick="staff.setDataUpdate(\'' + childSnap.id_rs +'\')"><i class="fa fa-wrench"></i></button>&nbsp; ' +
                                  '<button class="btn btn-danger btn-sm btn-icon-anim btn-square" onclick="setDataWithdraw(\'' + childSnap.id_rs +'\')"><i class="fa fa-close"></i></button>' +
                                '</div></div>'
                              ]);

                      $c++;
                    })

                    dt.draw();
                  }else{
                    dt.clear().draw();
                  }
                }, 'json')
  },
  setDataUpdate: function(id){
    window.localStorage.setItem('rmis_selected_id_rs', id);
    window.location = 'update_rs_status.html'
  },
  load_ec_list: function(){
    var jxhr = $.post(ws_url + 'controller/staff/get-ec-list.php', function(){}, 'json')
                .always(function(snap){
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $buffer = '<option value="' + i.id + '">' + i.prefix_name + i.fname + ' ' + i.lname + '</option>';
                      $('#txtEC').append($buffer)
                    })
                  }
                }, 'json')
  },
  load_rs_info_retro: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }

    console.log(param);
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info-retro.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)


                      if(i.research_retroact_status == 'in progress'){
                        $('#rsStatus').text('อยู่ระหว่างการดำเนินการ')
                      }else if(i.research_retroact_status == 'closed'){
                        $('#rsStatus').text('ปิดโครงการ')
                      }else{
                        $('#rsStatus').text('ไม่สามารถระบุได้')
                      }

                      $('#txtDatemeeting1').val(i.rri_dmeeting)
                      $('#txtDateapprove1').val(i.rri_date_approve)
                      $('#txtTapprove').val(i.rri_tmeeting)
                      $('#txtReportrange1').val(i.rri_reportrange)

                      $('#txtDatemeeting2').val(i.rri_cont_repor_dmeeting)
                      $('#txtDateapprove2').val(i.rri_cont_report_app_date)
                      $('#txtReportrange2').val(i.rri_reportrange)

                      $('#txtRsStatus').val(i.research_retroact_status)

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
                      // console.log($durr);

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)

                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])

                        console.log(i.code_apdu);

                        $('#txtYear').val(s[0] - 42)
                        $('#txtDept').val(s[2])
                        $('#txtPertype').val(s[3])
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
  load_rs_info: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }

    console.log(param);
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      // console.log(i.rct_type);
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
  load_rs_info_2: function(){

    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }

    console.log(param);

    console.log(param);
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){

                  console.log(snap);
                  console.log('aaa');

                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      // console.log(i);
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle, .txtThtitle').text(i.title_th)
                      $('#txtEntitle, .txtEntitle').text(i.title_en)

                      $('#txtTitle_th').val(i.title_th)
                      $('#txtTitle_en').val(i.title_en)

                      $en_name = ''
                      if(i.fname_en != null){
                        $en_name = ' (' + i.fname_en + ' ' + i.lname_en + ')'
                      }

                      owner_uid = i.id;

                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtPi2').text(i.fname + ' ' + i.lname + $en_name)

                      $('#txtPiFnameTh').val(i.fname)
                      $('#txtPiLnameTh').val(i.lname)
                      $('#txtPiFnameEn').val(i.fname_en)
                      $('#txtPiLnameEn').val(i.lname_en)

                      $('#txtPiDeptTh').val(i.dept)
                      $('#txtPiDeptEn').val(i.dept_en)

                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)

                      $('#txtRtype').text(i.type_name)
                      $('#txtRTypess').text(i.rct_type)

                      $('#txtEC_response').text(i.rct_ec_name)

                      if((i.rct_type == 'Fullboard (Bio)') || (i.rct_type == 'Fullboard (Social)') || (i.rct_type == 'Expedited')){
                        $('#txtEC_board').text(i.rct_fb_name)
                      }

                      if((i.rct_type == 'Fullboard (Bio)') || (i.rct_type == 'Fullboard (Social)')){
                        $('.btnSendBoardAgender').removeClass('dn')
                      }

                      checkrtype = i.rct_type;
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)

                      // console.log(i.dept);
                      if(i.id_dept == '19'){

                        $('.PiExternalDept').removeClass('dn')
                        personnal_status = 'external'

                        if(lang  == 'en'){
                          $('#txtPi2').text(i.fname_en + ' ' + i.lname_en)
                          $('#txtPiDept').text(i.dept_en)
                        }else{
                          $('#txtPiDept').text(i.dept)
                        }

                      }else{
                        if(lang  == 'en'){
                          $('#txtPi2').text(i.fname_en + ' ' + i.lname_en)
                          $('#txtPiDept').html(i.dept_name_en + ' Faculty of Medicine<br>Prince of Songkla University')
                        }else{
                          $('#txtPiDept').html(i.dept_name + ' คณะแพทยศาสตร์<br>มหาวิทยาลัยสงขลานครินทร์')
                        }
                      }

                      $('#txtpiEmail').val(i.email)


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

                      $('#synopsys_info').html(i.brief_reports)

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)
                        $('.txtCodes').text('REC.' + i.code_apdu)
                        console.log(i.code_apdu);
                        $('#txtCodeBCAPCU').val(i.code_apdu)
                        $('.docSessCodeAPDU').val(i.code_apdu)
                        $('#COAAPDU').val(i.code_apdu)

                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])
                      }

                      $('#txtRduration').html('<div>เริ่มต้นโครงการ : ' + $startdate + ' วันที่สิ้นสุด : ' + $enddate + '</div>' + '<div>รวมจำนวน : ' + $durr + ' วัน </div>')
                      var budg = i.budget;

                      if(budg != null){
                        $('#txtRBudget').text(budg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท')
                        $('#txtBudget1').val(budg)
                        $('#txtBudget').text(budg.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
                      }

                      var budg2 = i.final_budget;
                      if(budg2 != null){
                        $('#txtBudget2').val(budg2)
                        $('#txtRBudget2').text(budg2.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' บาท')
                      }



                      rs_status = i.id_status_research

                      $('#operation-' + i.id_status_research  + '-tools').removeClass('dn')

                      if(staff_rs_status.indexOf(i.id_status_research) >= 0){
                        $('#operation-0-tools').addClass('dn')
                      }

                      if(i.id_status_research == '19'){
                        load_replay_status_19_content()
                      }
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

                      $('#txtPirate').text(i.rate_pm + '%')
                      $('#txtPiratio').val(i.rate_pm)

                      current_pi_ratio = i.rate_pm

                      if(i.faculty_project_status == '0'){
                        $('#btnFacultyStatus').html('<button class="btn btn-sm btn-warning cp" onclick="setToMedfacProject(1)">ตั้งค่าให้เป็นโครงการ แพทยศาสตร์ศึกษา</button>')
                      }else{
                        $('#btnFacultyStatus').html('<div class="text-success pb-10">โครงการนี้เป็นโครงการแพทยศาสตร์ศึกษา</div><button class="btn btn-sm btn-danger cp" onclick="setToMedfacProject(0)">ยกเลิกสถานะเป็นโครงการ แพทยศาสตร์ศึกษา</button>')
                      }

                      if((i.protocol_no != null) && (i.protocol_no != '')){
                        $('#btnSponserID_span').html('Protocol Number <span style="float:right;" class="text-warning cp" onclick="showModal(\'MySponser\')"><i class="fas fa-pencil-alt"></i></span>')
                        $('#btnSponserID').html(i.protocol_no)
                        $('#txtProtocolNumber').val(i.protocol_no)
                      }

                      lp.hl()
                      preload.hide()
                    })
                  }else{
                    lp.hl()
                    preload.hide()
                  }
                })
                .fail(function(){
                  lp.hl()
                })

                var jxhr2 = $.post(ws_url + 'controller/staff/pm-co-pi-info.php', {sess: current_rs, id: current_user}, function(){}, 'json')
                            .always(function(snap){

                              console.log(snap);

                              var co_piname = [];

                              if((snap.length > 0) && (snap != '')){
                                $n = 1;
                                $('#copi_table').empty()
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

                                  if(advisor == true){

                                    if(lang == 'en'){
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-3 f500">Consultant : </div>' +
                                        '<div class="col-4">' + i.co_fname_en + ' ' + i.co_lname_en + '</div>' +
                                        '<div class="col-5"><span class="f500">Affiliation :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept_en + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }else{
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-3 f500">ที่ปรึกษา : </div>' +
                                        '<div class="col-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-5"><span class="f500">สังกัด :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }

                                  }else{

                                    console.log(lang);

                                    if(lang == 'en'){
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-3 f500">Co-investigator : </div>' +
                                        '<div class="col-4">' + i.co_fname_en + ' ' + i.co_lname_en + '</div>' +
                                        '<div class="col-5"><span class="f500">Affiliation :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept_en + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }else{
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-3 f500">ผู้ร่วมวิจัย : </div>' +
                                        '<div class="col-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-5"><span class="f500">สังกัด :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }

                                  }



                                  co_piname.push('<div>' + $n + '. ' + i.prefix_name + i.co_fname + ' ' + i.co_lname + ' (สัดส่วน : ' + i.co_ratio + '%)</div>');

                                  $co_en_name = ''
                                  if(i.co_fname_en != ''){
                                    $co_en_name = ' (' + i.co_fname_en + ' ' + i.co_lname_en + ') '
                                  }

                                  var new_copi_list = '<tr>' +
                                                        '<td>' +
                                                          '<div class="row">' +
                                                            '<div class="col-sm-1">' + $n + '</div>' +
                                                            '<div class="col-sm-4">' + i.co_fname + ' ' + i.co_lname + $co_en_name + '</div>' +
                                                            '<div class="col-sm-1">' + i.co_ratio + '</div>' +
                                                            '<div class="col-sm-3">' + i.co_job + '</div>' +
                                                            '<div class="col-sm-3 text-right">' +
                                                              '<button class="btn btn-sm btn-square btn-success cp mr-5" onclick="showModal(\'MyCopiModal\'); setPrevCopi(\'' + i.copi_id + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                                                              '<button class="btn btn-sm btn-square btn-danger cp" onclick="deleteCopi(\'' + i.copi_id + '\', \'' + i.co_ratio + '\')"><i class="fas fa-trash"></i></button>' +
                                                            '</div>' +
                                                          '</div>'
                                                        '</td>' +
                                                      '</tr>'
                                  $('#copi_table').append(new_copi_list)
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

function setPrevCopi(cipi_id){
  $('#txtCopiId').val(cipi_id)
  preload.show()
  var param = {
    copi_id: cipi_id
  }

  var jxr = $.post(ws_url + 'controller/get_copi_info.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 snap.forEach(function(i){
                   $('#txtPrefixTh').val(i.co_prefix_approval)
                   $('#txtPrefixEn').val(i.co_prefix_approval_en)
                   $('#txtFnameTh').val(i.co_fname)
                   $('#txtLnameTh').val(i.co_lname)
                   $('#txtFnameEn').val(i.co_fname_en)
                   $('#txtLnameEn').val(i.co_lname_en)
                   $('#txtDeptTh').val(i.co_dept)
                   $('#txtDeptEn').val(i.co_dept_en)
                   $('#txtEmail').val(i.co_email)
                   $('#txtRatio').val(i.co_ratio)
                   $('#txtResponse').val(i.co_job)
                 })
                 preload.hide()
               }else{
                 swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลผู้ร่วมวิจัย", "error")
                 preload.hide()
               }
             })
}

function viewRsInfoOnly(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_only.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfoFinalWithdraw(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }

  console.log(param);

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session-wd.php', param, function(){}, 'json')
              .always(function(snap){

                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_final.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfoFinal(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }

  console.log(param);

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){

                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_final.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfoRetro(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_retro.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}
function viewRsInfo(rid){


  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfo2(rid){


  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_update_status.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfo3(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_3.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfo21(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_21.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfo4(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_to_10.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function viewRsInfo28(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/staff/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_to_28.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function checkFileAttached(){


  for(var i = 1; i <=15 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft_att_' + i).empty()

  if((i > 9) && (i <= 15)){

    var vc = i
    vc = i-10


    var response = $.post(ws_url + 'controller/check_upload_file_research_retroact_registration_2.php', {doctype: vc, session_id: current_rs}, function(){}, 'json')
                    .always(function(snap){

                      console.log(snap);

                      if((snap != '') && (snap.length > 0)){
                        $('#ft_att_' + i).empty();
                        snap.forEach(function(childSnap){
                          var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.f_name  + '</li>';

                          console.log(data);
                          $('#ft_att_' + i).append(data);
                        })
                      }else{
                        $('#ft_att_' + i).append('ไม่พบไฟล์แนบ');
                      }
                    },'json');

  }else{

    // console.log(i);

    var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i, session_id: current_rs}, function(){}, 'json')
                    .always(function(snap){
                      console.log(snap);
                      if((snap != '') && (snap.length > 0)){
                        $('#ft_att_' + i).empty();
                        snap.forEach(function(childSnap){

                          $app_status = ''

                          console.log(childSnap.f_approval_status);
                          if(childSnap.f_approval_status == '1'){
                            $app_status = ' <span class="text-danger">(Approved)</span>'
                          }

                          var data = '<li class="mb-5">' +
                                      '<a href="../tmp_file/' + childSnap.f_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' +
                                      '<a href="Javascript:deleteAttachedResearchFile(\'' + childSnap.fid + '\')"><i class="fas fa-trash text-danger mr-10"></i></a>' +
                                      childSnap.f_name + $app_status +
                                     '</li>';
                          $('#ft_att_' + i).append(data);
                        })
                      }else{
                        $('#ft_att_' + i).append('ไม่พบไฟล์แนบ');
                      }
                    },'json');
  }

}

function staffDoProgress(pstatus, pid, progress){

  window.localStorage.setItem('current_progress_id', pid)
  window.localStorage.setItem('current_progress', progress)
  window.localStorage.setItem('current_progress_status', pstatus)

  window.location = 'progress_info.html'
}


function checkReviewer(){
  var param = {
    id_rs: current_rs_id
  }
  var jxhr = $.post(ws_url + 'controller/staff/get_reviewer_review_list.php', param, function(){}, 'json')
              .always(function(snap){
                $('.rw_table').empty()

                if((snap!='') && (snap.length > 0)){
                  $order = 1;
                  snap.forEach(function(i){
                    var pname = i.prefix_name + i.fname + ' ' + i.lname;
                    $buffer = '<tr>' +
                                 '<td style="width: 250px;">' + pname + '<br><div style="font-size: 0.8em;">E-mail : ' + i.email +'</div><div style="font-size: 0.8em;">' + i.rir_status +'</div></td>' +
                                 '<td>' +
                                    '<div class="ft' + $order + ' pb-10">' +
                                      '<ul class="pl-0" id="ft_file' + $order + '">ยังไม่เลือกไฟล์</ul>' +
                                    '</div>' +
                                 '<div style="padding: 10px;  background: rgb(244, 244, 244);" id="st' + $order + '" class="dn">' +
                                  '<span class="f500 txt-dark">สถานะการส่งผู้เชี่ยวชาญอิสระ </span> : <span class="text-success f500">ส่งแล้ว</span><br>' +
                                  '<span class="f500 txt-dark">ส่งเมื่อ </span> : <span class="text-muted" id="sd' + $order + '">NA</span><br>' +
                                  '<span class="f500 txt-dark">เตือนเจ้าหน้าที่เมื่อ </span> : <span class="text-muted" id="nd' + $order + '">NA</span><br>' +
                                  '<span class="f500 txt-dark">หมดเขตช่วงการพิจารณา </span> : <span class="text-danger" id="ed' + $order + '">NA</span><br>' +
                                  '<span class="f500 txt-dark">การตอบรับการพิจารณา </span> : <span class="text-muted f500" id="reply_status' + $order + '">NA</span><br>' +
                                  '<span class="f500 txt-dark">ตอบรับเมื่อ </span> : <span class="text-muted" id="reply_date' + $order + '">-</span><br>' +
                                  '<span class="f500 txt-dark">ไฟล์แนบกลับ </span> : <span class="text-muted" id="ass_status' + $order + '">-</span><br>' +
                                  '<div class="pt-10">' +
                                    '<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal_upfile" onclick="setContentFileupload(\'' + i.rir_id_reviewer + '\', \'' + i.code_apdu +'\')">อัพโหลดไฟล์แบบประเมิน</button>' +
                                    // '<button class="btn btn-success btn-sm ml-5" data-toggle="modal" data-target="#myModal_upfile_attach_form" onclick="vieweform(\'' + i.rir_id_reviewer+'\', \'' + i.id_rs +'\')">ดูผลการประเมิน e-form</button>' +
                                  '</div>' +
                                 '</div>' +
                                 '</td>' +
                                 '<td style="width: 130px;" class="text-center"><div class="btn-group"><button class="btn btn-success btn-square" onclick="setRID(' + i.rir_id +'); showModal(\'MyFileAssesmentModal\');" ><i class="fas fa-plus"></i></button>' +
                                 '<button class="btn btn-danger btn-square" onclick="setSenddingReviewerContent(\'' + i.rir_id +'\', \'' + i.rir_status +'\', \'' + pname + '\', \'' + i.email +'\', \'' + i.password +'\', \'' + i.code_apdu +'\', \'' + i.rct_type +'\'); showModal(\'MyMailtoReviewer\')"><i class="fas fa-paper-plane"></i></button></div></td>' +
                              '<tr>';
                    $('.rw_table').append($buffer)

                    loadCHeckfile(i.rir_id, $order, i.id, pname)
                    loadCHeckProcess(i.rir_id, $order, i.rw_sending_status, i.rw_sending_datetime, i.rw_sending_notify_date, i.rw_sending_expire_date, i.rw_reply_status, i.rw_reply_datetime, i.rir_id_reviewer, i.rw_reply_doc_mark, i.rw_reply_suspenc_mark)


                    $('#txtRID3').val(i.rir_id)
                    $('#txtEM3').val(i.email)
                    $('#txtRwtype3').val(i.rir_status)
                    $('#txtRType3').val(i.rct_type)
                    $('#txtCodeBC3').val(i.code_apdu)

                    $order++;
                  })

                  setTimeout(function(){
                    checkNextStatus();
                  }, 2000)

                }
              },'json')
}

function loadCHeckProcess(ririd, ord, send_status, send_datetime, notify_date, expire_date, reply_status, reply_datetime, id_rw){
  console.log(send_status);
  if(send_status == 1){
    $('div#st' + ord).removeClass('dn')
    $('span#sd' + ord).text(main_app.convertThaidatetime(send_datetime))
    $('span#nd' + ord).text(main_app.convertThaidate(notify_date))
    $('span#ed' + ord).text(main_app.convertThaidate(expire_date))

    if(reply_status == 0){
      $('span#reply_status' + ord).text('ยังไม่มีการตอบรับ')
      $('span#reply_status' + ord).addClass('')
    }else if(reply_status == 3){
      $('span#reply_status' + ord).html('<span class="text-danger">ไม่ขอพิจารณาโครงการ</span>')
      $('span#reply_status' + ord).addClass('txt-danger')
    }else if(reply_status == 1){
      $('span#reply_status' + ord).html('<span class="text-primary">ตอบรับการพิจารณาแล้ว</span>')
      $('span#reply_date' + ord).text(main_app.convertThaidatetime(reply_datetime))
    }else if(reply_status == 2){
      $('span#reply_status' + ord).html('<span class="text-primary">ตอบรับการพิจารณาโดยขอเอกสาร (Hard copy)</span>')
      $('span#reply_status' + ord).addClass('')
    }else if(reply_status == 4){
      $('span#reply_status' + ord).html('<span class="text-success">ส่งผลแบบประเมินเรียบร้อยแล้ว</span>')
      $('span#reply_status' + ord).addClass('text-success')

      $('span#reply_date' + ord).text(main_app.convertThaidatetime(reply_datetime))
      loadFileAssesment(ord, 'ass_status', id_rw)

      nextStatusCheck++;
    }
  }
}

function checkReviewer_summary(){
  var param = {
    id_rs: current_rs_id
  }

  var jxhr = $.post(ws_url + 'controller/ec/load_summary_file.php', param, function(){}, 'json')
              .always(function(snap){

                if((snap != '') && (snap.length > 0)){
                  $('#sr3').empty();
                  snap.forEach(function(i){
                    if(i.rirs_status == 'Have recommendation'){
                      $('#sr1').text('มีข้อเสนอแนะ')
                    }

                    $('#sr2').html(i.rirs_note)
                    editData.setData(i.rirs_note)

                    $buffer = '<a href="../tmp_file/' + i.rirsf_filename + '" target="_blank"> - ' + i.rirsf_filename + '</a><br>';
                    $('#sr3').append($buffer)
                  })
                }
              }, 'json')
}

function loadCHeckfile(ririd, ord, id_reviewer, reviewer_name){

  var param2 = {
    rir_id: ririd
  }

  var jxhr2 = $.post(ws_url + 'controller/staff/check_reviewer_file_list.php', param2, function(){}, 'json')
               .always(function(snap2){
                 if((snap2 != '') && (snap2.length > 0)){
                   $('ul#ft_file' + ord).empty()
                    snap2.forEach(function(j){
                      var data = '<li class="mb-5 fz08" style="list-style-type: none; "><a href="Javascript:void(0)" onclick="delete_file_assesment(' + j.rif_id +')"><i class="fas fa-times text-info mr-5"></i></a> ' + j.fid_name + ' <span id="eform_result_span"></span></li>';
                      if(assesment_e_form_id.indexOf(j.rif_fileid) >= 0){
                        data = '<li class="mb-5 fz08" style="list-style-type: none; "><a href="Javascript:void(0)" onclick="delete_file_assesment(' + j.rif_id +')"><i class="fas fa-times text-info mr-5"></i></a> ' + j.fid_name + ' <span id="eform_result_span" class="text-success cp" onclick="viewEform(\'' + j.fid + '\', \'' + id_reviewer + '\', \'' + reviewer_name + '\')">[<i class="fas fa-search"></i> ดูผลการประเมิน]</span></li>';
                      }
                      $('ul#ft_file' + ord).append(data);
                    })
                 }
               })
}

function loadFileAssesment(ord_id, div_id, id_rw){
  var param = {
    id: id_rw,
    id_rs: current_rs_id
  }
  var response = $.post(ws_url + 'controller/reviewer/check_file_reply_assesment.php', param, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      // numreplyfile = 0;
                      $('#' + div_id + ord_id).empty()
                      snap.forEach(function(childSnap){
                        var data = '<div class="row" >' +
                                    '<div class="col-sm-12">' +
                                      // '<a class=" txt-success" href="../tmp_file/' + childSnap.rfa_filename + '" target="_blank" "> - ' + childSnap.rfa_filename + '</a>' +
                                      '<a class=" txt-success" href="' + childSnap.rfa_filefullpart + '" target="_blank" "> - ' + childSnap.rfa_filename + '</a>' +
                                    '</div>' +
                                  '</div>' ;
                        $('#' + div_id + ord_id).append(data);
                      })

                    }
                  }, 'json')
                  .fail(function(){
                    $('#' + div_id + ord_id).append('ยังไม่เชื่อมต่อฐานข้อมูลได้')
                  })
}

function setCopiInfo(copi_id){

  console.log(copi_id);

  $('#txtCopiid').val(copi_id)

  var param = {
    copid: copi_id
  }

  var jxr = $.post(ws_url + 'controller/get-copid-info.php', param, function(){}, 'json')
             .always(function(snap){
               console.log(snap);
               if((snap != '') && (snap.length > 0)){
                 snap.forEach(function(i){
                   $('#txtCopifname').val(i.co_fname)
                   $('#txtCopilname').val(i.co_lname)
                   $('#txtCopidept').val(i.co_dept)
                 })
               }
             })
}

function setNewCopiDept(){
  $check = 0
  $('.form-group').removeClass('has-error')
  if($('#txtCopidept').val() == ''){
    $check++;
    $('#txtCopidept').parent().addClass('has-error')
  }

  if($('#txtCopiid').val() == ''){
    $check++;
    $('#txtCopiid').parent().addClass('has-error')
  }

  if($('#txtCopifname').val() == ''){
    $check++;
    $('#txtCopifname').parent().addClass('has-error')
  }

  if($('#txtCopilname').val() == ''){
    $check++;
    $('#txtCopilname').parent().addClass('has-error')
  }

  if($check!=0){
    return ;
  }

  var param = {
    copid: $('#txtCopiid').val(),
    codept: $('#txtCopidept').val(),
    cofname: $('#txtCopifname').val(),
    colname: $('#txtCopilname').val()
  }

  var jxr = $.post(ws_url + 'controller/set-copid-info.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถปรับปรุงข้อมูลได้!", "error")
                 return ;
               }
             })
             .fail(function(){
               swal("เกิดข้อผิดพลาด!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้!", "error")
               return ;
             })
}

function loadTimeline(){
  var param = {
    id_rs: current_rs_id
  }

  var jxr = $.post(ws_url + 'controller/report/timeline.php', param, function(){})
}

function savenewCopi(){
  var check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtFnameTh').val() == ''){
    check++
    $('#txtFnameTh').addClass('is-invalid')
  }

  if($('#txtLnameTh').val() == ''){
    check++
    $('#txtLnameTh').addClass('is-invalid')
  }

  if($('#txtFnameEn').val() == ''){
    check++
    $('#txtFnameEn').addClass('is-invalid')
  }

  if($('#txtLnameEn').val() == ''){
    check++
    $('#txtLnameEn').addClass('is-invalid')
  }

  if($('#txtDeptTh').val() == ''){
    check++
    $('#txtDeptTh').addClass('is-invalid')
  }

  if($('#txtDeptEn').val() == ''){
    check++
    $('#txtDeptEn').addClass('is-invalid')
  }

  if($('#txtEmail').val() == ''){
    check++
    $('#txtEmail').addClass('is-invalid')
  }

  if($('#txtRatio').val() == ''){
    check++
    $('#txtRatio').addClass('is-invalid')
  }

  if($('#txtResponse').val() == ''){
    check++
    $('#txtResponse').addClass('is-invalid')
  }

  // if((parseInt($('#txtRatio').val()) < 1) || (parseInt($('#txtRatio').val()) > posible_co_pi_ratio) ){
  //   check++
  //   $('#txtRatio').addClass('is-invalid')
  // }

  if(check != 0){
    swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วน", "error")
    return ;
  }

  $('.btnClosemodal').trigger('click')
  preload.show()

  var param = {
    id_rs: current_rs_id,
    sess_id: current_rs,
    prefix_th: $('#txtPrefixTh').val(),
    prefix_en: $('#txtPrefixEn').val(),
    fname_th: $('#txtFnameTh').val(),
    fname_en: $('#txtFnameEn').val(),
    lname_th: $('#txtLnameTh').val(),
    lname_en: $('#txtLnameEn').val(),
    dept_th: $('#txtDeptTh').val(),
    dept_en: $('#txtDeptEn').val(),
    email: $('#txtEmail').val(),
    ratio: $('#txtRatio').val(),
    job: $('#txtResponse').val(),
    last_rate_pm: current_pi_ratio,
    id: current_user,
    prev_copi_id: $('#txtCopiId').val()
  }

  // console.log(param);
  // return ;

  var jxr = $.post(ws_url + 'controller/set_new_co_pi.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 window.location.reload()
               }else if(resp == 'Over'){
                 preload.hide()
                 swal("ขออภัย!", "สัดส่วนของผู้ร่วมวิจัยผิดพลาด!", "error")
               }else{
                 preload.hide()
                 console.log(resp);
                 alert('error')
               }
             })
}

function loadBoardResult(){
  console.log('aaaa');
  var param = {
          id_rs: current_rs_id
        }

        var jxr = $.post(ws_url + 'controller/get-board-info.php', param, function(){}, 'json')
                   .always(function(snap){
                     if((snap != '') && (snap.length > 0)){
                        $('#boardNote').css('display', '')
                        $('.resultSpan').empty()
                        $('.resultSpan-2').empty()
                        $c = 1;
                        snap.forEach(function(i){
                          $result = 'รอผลจากห้องประชุม'
                          if(i.rafa_result == '1'){
                            $result = 'Approve'
                          }if(i.rafa_result == '2'){
                            $result = 'Minor'
                          }if(i.rafa_result == '3'){
                            $result = 'Major'
                          }if(i.rafa_result == '4'){
                            $result = 'Dis-approve'
                          }

                          $data = '<tr>' +
                                    '<td>' + i.rafa_agn + '</td>' +
                                    '<td>' +
                                      '<div>วันที่ : ' + main_app.convertThaidate(i.rafa_date) + '</div>' +
                                      '<div>เลขาการประชุม : ' + i.fname + ' ' + i.lname + '</div>' +
                                    '</td>' +
                                    '<td><div>' + $result + '</div></td>' +
                                  '</tr>'
                          $('.resultSpan').append($data)



                          $data2 = '<tr>' +
                                      '<td>' +
                                        '<div class="row">' +
                                          '<div class="col-sm-3">ครั้งที่ ' + i.rafa_agn + '</div>' +
                                          '<div class="col-sm-6">' +
                                            '<div>วันที่ : ' + main_app.convertThaidate(i.rafa_date) + '</div>' +
                                            '<div>เลขาการประชุม : ' + i.fname + ' ' + i.lname + '</div>' +
                                          '</div>' +
                                          '<div class="col-sm-3">มติ <span class="text-danger">' + $result + '</span></div>' +
                                        '</div>' +
                                      '</td>' +
                                   '</tr>'
                          console.log($data2);
                          $('.resultSpan-2').append($data2)


                          $c++
                        })
                     }
                   })
}

function checkRemainRatio(){

  var param = {
    sess_id: current_rs
  }

  var jxr = $.post(ws_url + 'controller/get_current_ratio.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 var sumRatio = 0
                 snap.forEach(function(i){
                   sumRatio += parseInt(i.co_ratio)
                 })

                 posible_co_pi_ratio = 99 - (parseInt(sumRatio))
                 $('.remainRatio').text(99 - (parseInt(sumRatio)))
               }else{
                 $('.remainRatio').text(parseInt(current_pi_ratio) - 1)
               }
             })

}

function deleteCopi(id, rt){
  swal({   title: "ยืนยันดำเนินการ",
           text: "หากลบรายการแล้วจะไม่สามารถนำข้อมูลกลับมาได้อีก",
           type: "warning",
           showCancelButton: true,
           confirmButtonColor: "#DD6B55",
           confirmButtonText: "ลบ",
           cancelButtonText: "ยกเลิก",
           closeOnConfirm: true,
           closeOnCancel: true },
             function(isConfirm){
              if (isConfirm) {
                preload.show()
                var param = {
                  copi_id: id,
                  sess_id: current_rs,
                  id_rs: current_rs_id,
                  ratio: rt,
                  pm_ratio: current_pi_ratio
                }

                var jxr = $.post(ws_url + 'controller/delete_copi.php', param, function(){})
                           .always(function(){
                             window.location.reload()
                           })
              }
            });

}

function updatePiratio(){
  $check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtPiratio').val() == ''){
    $check++
    $('#txtPiratio').addClass('is-invalid')
  }

  if($check != 0){
    return ;
  }

  preload.show()
  var param = {
    id_rs: current_rs_id,
    budget1: $('#txtPiratio').val(),
    id: current_user
  }

  var jxr = $.post(ws_url + 'controller/update_pi_ratio.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถแก้ไขข้อมูลได้!", "error")
               }
             })
}

function updateBudget1(){
  $check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtBudget1').val() == ''){
    $check++
    $('#txtBudget1').addClass('is-invalid')
  }

  if($check != 0){
    return ;
  }

  preload.show()
  var param = {
    id_rs: current_rs_id,
    budget1: $('#txtBudget1').val(),
    id: current_user
  }

  var jxr = $.post(ws_url + 'controller/update_budget_1.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถแก้ไขข้อมูลได้!", "error")
               }
             })
}

function updateBudget2(){
  $check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtBudget2').val() == ''){
    $check++
    $('#txtBudget2').addClass('is-invalid')
  }

  if($check != 0){
    return ;
  }

  preload.show()
  var param = {
    id_rs: current_rs_id,
    budget1: $('#txtBudget2').val(),
    id: current_user
  }

  var jxr = $.post(ws_url + 'controller/update_budget_2.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถแก้ไขข้อมูลได้!", "error")
               }
             })
}

function updateTitle(){

  $check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtTitle_en').val() == ''){
    $check++
    $('#txtTitle_en').addClass('is-invalid')
  }

  if($('#txtTitle_th').val() == ''){
    $check++
    $('#txtTitle_th').addClass('is-invalid')
  }

  if($check != 0){
    return ;
  }

  preload.show()
  var param = {
    id_rs: current_rs_id,
    th: $('#txtTitle_th').val(),
    en: $('#txtTitle_en').val(),
    id: current_user
  }

  var jxr = $.post(ws_url + 'controller/update_project_title.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถแก้ไขข้อมูลได้!", "error")
               }
             })
}

function updatePiInfo(){

  $check = 0
  $('.form-control').removeClass('is-invalid')

  if($('#txtPiFnameTh').val() == ''){
    $check++
    $('#txtPiFnameTh').addClass('is-invalid')
  }

  if($('#txtPiLnameTh').val() == ''){
    $check++
    $('#txtPiLnameTh').addClass('is-invalid')
  }

  if(personnal_status == 'external'){
    if($('#txtPiDeptTh').val() == ''){
      $check++
      $('#txtPiDeptTh').addClass('is-invalid')
    }
  }

  if($check != 0){
    return ;
  }

  preload.show()

  var param = {
    ptype: personnal_status,
    prefix_th: $('#txtPiPrefixTh').val(),
    prefix_en: $('#txtPiPrefixEn').val(),
    fname_th: $('#txtPiFnameTh').val(),
    lname_th: $('#txtPiLnameTh').val(),
    fname_en: $('#txtPiFnameEn').val(),
    lname_en: $('#txtPiLnameEn').val(),
    dept_th: $('#txtPiDeptTh').val(),
    dept_en: $('#txtPiDeptEn').val(),
    id_rs: current_rs_id,
    id: current_user
  }

  var jxr = $.post(ws_url + 'controller/update_pi_info.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถแก้ไขข้อมูลได้!", "error")
               }
             })
}

function loadApproveDoc_in(){
  console.log('in');

  var param = {
    id_rs: current_rs_id
  }

  preload.show()

  // setTimeout(function(){})
  var jxrx = $.post(ws_url + 'controller/list_approv_doc.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 $('#docList_content').empty()
                 var prev_seq = ''
                 var next_seq = ''
                 var c = 0
                 var maxlength = snap.length
                 snap.forEach(function(i){

                   if(c == 0){
                     $data = '<tr>' +
                              '<td>' + i.init_doc_name + '</td>' +
                              '<td style="width: 100px; padding-left: 7px; padding-right: 7px;" class="text-center">' +
                                '<span class="cp mr-10" onclick="editAppdoc(\'' + i.init_doc_id + '\', \'' + i.init_doc_name + '\', \'' + i.init_doc_level + '\')"><i class="fas fa-pencil-alt"></i></span>' +
                                // '<span class="cp mr-10"><i class="fas fa-chevron-up"></i></span>' +
                                '<span class="cp mr-10"><i class="fas fa-chevron-down"></i></span>' +
                                '<span class="cp" onclick="deleteAppdoc(\'' + i.init_doc_id + '\')"><i class="fas fa-times"></i></span>' +
                              '</td>' +
                             '</tr>'
                   }else if(c == (maxlength - 1)){
                     $data = '<tr>' +
                              '<td>' + i.init_doc_name + '</td>' +
                              '<td style="width: 100px; padding-left: 7px; padding-right: 7px;" class="text-center">' +
                                '<span class="cp mr-10" onclick="editAppdoc(\'' + i.init_doc_id + '\', \'' + i.init_doc_name + '\', \'' + i.init_doc_level + '\')"><i class="fas fa-pencil-alt"></i></span>' +
                                '<span class="cp mr-10"><i class="fas fa-chevron-up"></i></span>' +
                                // '<span class="cp mr-10"><i class="fas fa-chevron-down"></i></span>' +
                                '<span class="cp" onclick="deleteAppdoc(\'' + i.init_doc_id + '\')"><i class="fas fa-times"></i></span>' +
                              '</td>' +
                             '</tr>'
                   }else{
                     $data = '<tr>' +
                              '<td>' + i.init_doc_name + '</td>' +
                              '<td style="width: 100px; padding-left: 7px; padding-right: 7px;" class="text-center">' +
                                '<span class="cp mr-10" onclick="editAppdoc(\'' + i.init_doc_id + '\', \'' + i.init_doc_name + '\', \'' + i.init_doc_level + '\')"><i class="fas fa-pencil-alt"></i></span>' +
                                '<span class="cp mr-10"><i class="fas fa-chevron-up"></i></span>' +
                                '<span class="cp mr-10"><i class="fas fa-chevron-down"></i></span>' +
                                '<span class="cp" onclick="deleteAppdoc(\'' + i.init_doc_id + '\')"><i class="fas fa-times"></i></span>' +
                              '</td>' +
                             '</tr>'
                   }

                   c++
                   $('#docList_content').append($data)
                 })
                 preload.hide()
               }else{
                 console.log('b');
                 $('#docList_content').empty()
                 $('#docList_content').append('<tr><td><span class="text-danger">ยังไม่มีรายชื่อเอกสารที่รับรอง</span></td></tr>')
                 preload.hide()
               }
             })

}

function loadApproveDoc(){

  var param = {
    id_rs: current_rs_id
  }

  preload.show()

  // setTimeout(function(){})
  var jxr = $.post(ws_url + 'controller/list_approv_doc.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 $('.app_doc_list').empty()
                 snap.forEach(function(i){
                   $data = '<div>' + i.init_doc_name + '</div>'
                   $('.app_doc_list').append($data)
                 })
                 preload.hide()
               }else{
                 $('#docList_content').empty()
                 $('#docList_content').append('<tr><td><span class="text-danger">ยังไม่มีรายชื่อเอกสารที่รับรอง</span></td></tr>')
                 preload.hide()
               }
             })
}

function editAppdoc(id, name, level){
  $('#txtDocid').val(id)
  $('#txtDocname').val(name)
  $('#docLevel').val(level)
}

function deleteAppdoc(id){

  swal({   title: "ยืนยันดำเนินการ",
             text: "หากทำการลบแล้วจะไม่สามารกู้คืนรายการได้",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยัน",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: true,
             closeOnCancel: true },
             function(isConfirm){
              if (isConfirm) {
                preload.show()
                var param = {
                  doc_id: id
                }

                var jxr = $.post(ws_url + 'controller/delete_approv_doc.php', param, function(){})
                           .always(function(resp){
                             if(resp == 'Y'){
                               // setTimeout(function(){
                                 loadApproveDoc_in()
                               // }, 1000)
                             }else{
                               preload.hide()
                               swal("เกิดข้อผิดพลาด!", "ไม่สามารถลบรายการได้", "error")
                             }
                           })
              }
            });


}

function addApproveDoc(){
  $('#txtDocname').removeClass('is-invalid')
  if($('#txtDocname').val() == ''){
    swal("เกิดข้อผิดพลาด!", "กรุณากรอกชื่อเอกสารที่รับรองก่อน", "error")
    $('#txtDocname').addClass('is-invalid')
    return ;
  }

  preload.show()

  var param = {
    id_rs: current_rs_id,
    id: current_user,
    doc_name: $('#txtDocname').val(),
    doc_lv: $('#docLevel').val(),
    doc_id: $('#txtDocid').val(),
    doc_session: session_id
  }

  var jxr = $.post(ws_url + 'controller/add_approv_doc.php', param, function(){})
             .always(function(resp){
               console.log(resp);
               if(resp == 'Y'){
                 $('#txtDocid').val('')
                 $('#txtDocname').val('')
                 $('#docLevel').val('1')

                 loadApproveDoc_in()

               }else{
                 preload.hide()
                 swal("เกิดข้อผิดพลาด!", "ไม่สามารถบันทึกชื่อเอกสารได้", "error")
               }
             })
}

function setFirstDoclist(){
  var str = $('#docTable').html()

  var replaceString = str.replace(/fas fa-pencil-alt/g, '')
  replaceString = replaceString.replace(/fas fa-chevron-left/g, '')
  replaceString = replaceString.replace(/fas fa-chevron-right/g, '')
  replaceString = replaceString.replace(/fas fa-chevron-up/g, '')
  replaceString = replaceString.replace(/fas fa-chevron-down/g, '')
  replaceString = replaceString.replace(/fas fa-times/g, '')
  replaceString = replaceString.replace(/width: 200px/g, 'width: 0px')
  $('.app_doc_list').html(replaceString)
}

function loadMeetinginfo(){
  var param = {
    id_rs: current_rs_id
  }
  var jsr = $.post(ws_url + 'controller/get_board_info.php', param, function(){}, 'json')
             .always(function(snap){
               console.log(snap);
               if((snap != '') && (snap.length > 0)){
                 snap.forEach(function(i){
                   $('#docround').html(i.rafa_agn)
                   $('#txtTimeMeeting').val(i.rafa_agn)
                   $('#txtDatemeeting').val(i.rafa_date)
                   $('#txtSet').val(i.rafa_set)
                 })
               }else{

               }
             })
}

function sendEcForCheck(){
  if($('#docround').text() == '........./..........'){
    swal("คำเตือน!", "กรุณาระบุครั้งที่ประชุมก่อน!", "warning")
    return ;
  }

  if(($('#docreportround').text() == 'every ......... months') || ($('#docreportround').text() == 'ทุก ......... เดือน')) {
    swal("คำเตือน!", "กรุณาระบุระยะเวลาการรายงานความก้าวหน้าก่อน!", "warning")
    return ;
  }

  swal({
    title: "ยืนยันการดำเนินการ",
    text: "ท่านยืนยันส่งข้อมูลนี้ไปยังเลขา EC เพื่อตรวจสอบก่อนลงนามหรือไม่",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยันส่ง",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){

    $refnp = $('#refNo').text()

    var param = {
      id: current_user,
      id_rs: current_rs_id,
      refNumber: $refnp,
      main_content: $('.app_doc_list').html(),
      full_content: $('#printArea').html(),
      panal: '3.4',
      mround: $('#txtTimeMeeting').val(),
      doc_round: $('#txtReportRange').val(),
      lang: lang,
      doc_sesion: session_id
    }

    lp.sl()

    var jxhr = $.post(ws_url + 'controller/staff/send_expedited_to_ec_2.php', param, function(){})
                .always(function(resp){
                    if(resp == 'Y'){
                      setTimeout(function(){
                        swal({
                          title: "ดำเนินการสำเร็จ",
                          text: "โครงการและใบรับทราบถูกส่งไปยังเลขาเรียบร้อยแล้ว!",
                          type: "warning",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "กลับสู่หน้าหลัก",
                          closeOnConfirm: false },
                        function(){
                          window.location = './index.html'
                        });
                      }, 1000)
                    }else{
                      swal("คำเตือน!", "ไม่สามารถดำเนินการได้ กรุณาติดต่อผู้ดูแลระบบ!", "warning")
                      lp.hl()
                      return ;
                    }
                })
                .fail(function(){
                  onFail()
                })

  });
}

staff.init()

function setMessaging(message, role){
  var param = {
    id_rs: current_rs_id,
    content: message,
    id: current_user,
    role: role
  }

  var jsr = $.post(ws_url + 'controller/set_messaging.php', param, function(res){
              // console.log(res);
            })
}

function  setMessageContent(id){
  preload.show()
  var param = {
    id_rs: id,
    role: current_role
  }
  $('#txtId_rs').val(id)
  var jxr = $.post(ws_url + 'controller/get_messaging.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 $('#messagePanal').empty()
                 snap.forEach(function(i){
                   if(i.msg_role != 'นักวิจัย'){
                     $r = ''
                     if(i.msg_read_status == '1'){
                       $r = '(Read)'
                     }
                     $data = '<div class="row">' +
                                '<div class="col-2 col-sm-2 col-md-1 pr-0 pt-5"><img src="../images/avatar-pi.png" style="width: 100%;" class="align-bottom"></div>' +
                                '<div class="col-10 col-sm-10 col-md-11"><div class="pd-10" style="background: rgb(205, 242, 228);">' + i.msg_content + '</div></div>' +
                              '</div>' +
                              '<div class="row mb-5">' +
                                '<div class="col-2 col-sm-2 col-md-1 pl-0">' + '</div>' +
                                '<div class="col-10 col-sm-10 col-md-11 text-left text-muted fz08 pt-5">' + main_app.convertThaidatetime(i.msg_datetime) + ' (' + i.msg_role + ') ' + $r + '</div>' +
                               '</div>'
                   }else{
                     $r = ''
                     if(i.msg_read_status == '1'){
                       $r = '(Read)'
                     }
                     $data = '<div class="row">' +
                                '<div class="col-10 col-sm-10 col-md-11"><div class="pd-10" style="background: rgb(238, 238, 238);">' + i.msg_content + '</div></div>' +
                                '<div class="col-2 col-sm-2 col-md-1 pl-0 pt-5"><img src="../images/avatar-pi.png" style="width: 100%;" class="align-bottom"></div>' +
                              '</div>' +
                              '<div class="row mb-5">' +
                                '<div class="col-10 col-sm-10 col-md-11 text-right text-muted fz08 pt-5">' + main_app.convertThaidatetime(i.msg_datetime) + ' (' + i.msg_role + ') ' + $r + '</div>' +
                                '<div class="col-2 col-sm-2 col-md-1 pl-0">' + '</div>' +
                               '</div>'
                   }
                   $('#messagePanal').append($data)

                   // set
                 })
               }else{
                 $('#messagePanal').empty()
                 $data = '<div class="row"><div class="col-sm-12">ไม่พบรายการข้อความในระบบ</div></div>'
                 $('#messagePanal').html($data)
               }
               setTimeout(function(){
                  setTimeout(function(){
                    $("#messagePanal").animate({
                       scrollTop: $('#messagePanal')[0].scrollHeight - $('#messagePanal')[0].clientHeight
                     }, 500);
                    preload.hide()
                  }, 1000)
               }, 1000)
             })
}

function set_blind_status(id){
  swal({   title: "Are you sure?",
             text: "You will not be able to recover this research stage!",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes!",
             cancelButtonText: "Cancel",
             closeOnConfirm: false,
             closeOnCancel: true },
             function(isConfirm){
                 if (isConfirm) {
                    loading.show()

                    var param = {
                      id_rs: id
                    }

                    var jxr = $.post(ws_url + 'controller/unset-new-process.php', param, function(){})
                               .always(function(resp){
                                 if(resp == 'Y'){
                                   window.location.reload()
                                 }else{
                                   swal("เกิดข้อผิดพลาด", "ไม่สามารถดำเนินการได้", "error")
                                 }
                               })

                 }
            });
}

function load_replay_status_19_content(){
  var param = {
    id: current_user,
    id_rs: current_rs_id
  }

  var jxhr = $.post(ws_url + 'controller/get-lastmsg.php', param, function(){}, 'json')
              .always(function(resp){
                resp.forEach(function(i){

                  $('.main_content_19').html(i.rwp_info)

                  // $data = '<strong>เรื่อง</strong> ขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณาจริยธรรมการวิจัยในมนุษย์<br>' +
                  //         '<strong>รหัสการโครงการ</strong> ' + $('#txtCode').text() + '<br>' +
                  //         '<strong>เรียน</strong> ' + $('#txtPi').text() +
                  //         '<p>เนื่องจากทางสำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการตรวจสอบข้อมูลโครงการวิจัยเรื่อง <u>' + $('#txtThtitle').text() + '</u> (English) <u>' + $('#txtEntitle').text() + '</u>' +
                  //         ' และมีความเห็นจากเลขานุการเพื่อขอรายละเอียด/เอกสารเพิ่มเติม ดังนี้ </p>' +
                  //         '<div style="background: rgb(242, 242, 242); padding: 10px 20px;">' + i.rwp_info + '</div>' +
                  //         '<p>จึงเรียนมาเพื่อทราบและดำเนินการต่อไป</p>' +
                  //         '<p>หมายเหตุ: <br>* <strong>ท่านสามารถตรวจสอบสถานะโครงการของท่านด้วยตนเองได้ที่ ' + root_domain + '</strong><br>' +
                  //         '** กรุณาอย่าตอบกลับทางอีเมล์ฉบับนี้ หากมีข้อสงสัย กรุณาติดต่อเจ้าหน้าที่สำนักงาน คุณณัฎฐา ศิริรักษ์ โทร 1149, 1157 </p>';
                  $data = '<strong>เรื่อง</strong> การขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณาข้อเสนอโครงการเพื่อขอพิจารณาจริยธรรมการวิจัยในมนุษย์<br>' +
                          '<strong>รหัสการโครงการ</strong> ' + $('#txtCode').text() + '<br>' +
                          '<strong>เรียน</strong> ' + $('#txtPi2').text() +
                          '<p>เนื่องจากทางสำนักงานจริยธรรมการวิจัยในมนุษย์ได้ทำการตรวจสอบข้อมูลโครงการวิจัยเรื่อง <u>' + $('#txtThtitle').text() + '</u> (English) <u>' + $('#txtEntitle').text() + '</u>' +
                          ' และมีความเห็นจากเลขานุการเพื่อขอรายละเอียด/เอกสารเพิ่มเติม ดังนี้ </p>' +
                          '<div style="background: rgb(242, 242, 242); padding: 10px 20px;">---------------------------------<br>' + i.rwp_info + '---------------------------------</div>' +
                          '<p>จึงเรียนมาเพื่อทราบและดำเนินการต่อ<br>' +
                          'ทางสำนักงานจริยธรรมการวิจัยในมนุษย์</p>' +
                          '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้<br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS http://rmis2.medicine.psu.ac.th/rmis/  หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157</p>'

                  editdata_19.setData($data)
                })
              }, 'json')
}

function gotoCreatepproval(lid){
  preload.show()
  var param = {
    id_rs: current_rs_id
  }

  var jxr = $.post(ws_url + 'controller/check_consider_type.php', param, function(){}, 'json')
             .always(function(snap){
               if((snap != '') && (snap.length > 0)){
                 snap.forEach(function(i){
                   if(i.rct_type == 'Exempt'){
                     if(lid == 'th'){
                      window.location = 'generate_exempt_form.html'
                     }else{
                      window.location = 'generate_exempt_form_en.html'
                     }
                   }else if(i.rct_type == 'Expedited'){
                     if(lid == 'th'){
                      window.location = 'rs2-generate-expedited-form.html'
                     }else{
                      window.location = 'rs2-generate-expedited-form-en.html'
                     }
                   }else if(i.rct_type == 'Fullboard (Bio)'){
                     if(lid == 'th'){
                      window.location = 'rs2-generate-fullboard-form-th.html'
                     }else{
                      window.location = 'rs2-generate-fullboard-form-en.html'
                     }
                   }else if(i.rct_type == 'Fullboard (Social)'){
                     if(lid == 'th'){
                      window.location = 'rs2-generate-fullboard-form-th.html'
                     }else{
                      window.location = 'rs2-generate-fullboard-form-en.html'
                     }
                   }else{
                    swal("ขออภัย!", "ไม่สามารถตรวจสอบประเภทการพิจารณาได้ กรุณาติดต่อผู้ดูแลระบบ!", "error")
                   }
                 })
               }else{
                swal("ขออภัย!", "ไม่สามารถตรวจสอบประเภทการพิจารณาได้ กรุณาติดต่อผู้ดูแลระบบ!", "error")
               }
             })

}


function getNext14Days(){
  var today = new Date(+new Date + 12096e5);
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10){
      dd='0'+dd;
  }

  if(mm<10){
      mm='0'+mm;
  }

  var today = yyyy + '-' + mm + '-' + dd;


  return main_app.convertThaidate(today);
}

function checkUncomment_social_not_fit(i, hide_no_edit){
  var param = {
    id_rs: current_rs_id,
    user: reviewer_uid,
    ele: i
  }
  var jxr = $.post(ws_url + 'controller/reviewer/getUncommentDraft_social_notfit.php', param, function(){})
             .always(function(resp){
               if(resp != ''){
                 console.log(i);
                 $('input:radio[name=radio0' + i.toString() + '][value=0]').attr('checked', true);


                 if(hide_no_edit){
                   $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + '</span></div>')
                 }else{
                   $btn = '<div class="pt-0"><button class="btn btn-sm btn-success btn-square" style="box-shadow: none;" onclick="clickNotfitBtn(3, ' + i + ')"><i class="fas fa-pencil-alt"></i></button></div>'
                   $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + $btn + '</span></div>')
                 }

               }
             })
}

function checkUncomment_icf_not_fit(i, hide_no_edit){
  var param = {
    id_rs: current_rs_id,
    user: reviewer_uid,
    ele: i
  }

  console.log(param);

  var jxr = $.post(ws_url + 'controller/reviewer/getUncommentDraft_icf_notfit.php', param, function(){})
             .always(function(resp){
               if(resp != ''){
                 $('input:radio[name=radio0' + i.toString() + '][value=0]').attr('checked', true);

                 if(hide_no_edit){
                   $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + '</span></div>')
                 }else{
                   $btn = '<div class="pt-0"><button class="btn btn-sm btn-success btn-square" style="box-shadow: none;" onclick="clickNotfitBtn(2, ' + i + ')"><i class="fas fa-pencil-alt"></i></button></div>'
                   $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + $btn + '</span></div>')
                 }

               }
             })
}

function checkUncomment_bio_not_fit(i, hide_no_edit){
  var param = {
    id_rs: current_rs_id,
    user: reviewer_uid,
    ele: i
  }

  var jxr = $.post(ws_url + 'controller/reviewer/getUncommentDraft_bio_notfit.php', param, function(){})
             .always(function(resp){
               if(resp != ''){
                  $('input:radio[name=radio0' + i.toString() + '][value=0]').attr('checked', true);

                  if(hide_no_edit){
                    $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + '</span></div>')
                  }else{
                    $btn = '<div class="pt-0"><button class="btn btn-sm btn-success btn-square" style="box-shadow: none;" onclick="clickNotfitBtn(2, ' + i + ')"><i class="fas fa-pencil-alt"></i></button></div>'
                    $('#e' + i).append('<div class="commentPane" id="comment_div_id_' + i + '"><span class="commentMsg"><div id="comment_id_' + i + '">' + resp + '</div>' + $btn + '</span></div>')
                  }

               }

             })
}

function setToMedfacProject(st){
  if(st == 1){
    swal({   title: "คำเตือน",
               text: "ท่านยืนยันการกำหนดโครงการให้เป็นโครงการแพทยศาสตร์ศึกษาหรือไม่!",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "ยืนยัน",
               cancelButtonText: "ยกเลิก",
               closeOnConfirm: false,
               closeOnCancel: true },
               function(isConfirm){
                   if (isConfirm) {
                      preload.show()
                      var param = {
                        id: current_user,
                        id_rs: current_rs_id,
                        to: '1'
                      }

                      var jxr = $.post(ws_url + 'controller/staff_set_facmed_project.php', param, function(){})
                                 .always(function(resp){
                                   console.log(resp);
                                   if(resp == 'Y'){
                                     setTimeout(function(){
                                       preload.hide()
                                       swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "กด ตกลง เพื่อรีโหลดหน้าเว็บ",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ตกลง",
                                        closeOnConfirm: false },
                                       function(){
                                        window.location.reload()
                                       });
                                     }, 1000)
                                   }else{
                                     preload.hide()
                                     swal("ขออภัย!", "ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง!", "error")
                                   }
                                 })
                   }
              });
  }
  else{
    swal({   title: "คำเตือน",
               text: "ท่านยืนยันการยกเลิกสถานะโครงการแพทยศาสตร์ศึกษาหรือไม่!",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "ยืนยัน",
               cancelButtonText: "ยกเลิก",
               closeOnConfirm: false,
               closeOnCancel: true },
               function(isConfirm){
                   if (isConfirm) {
                      preload.show()
                      var param = {
                        id: current_user,
                        id_rs: current_rs_id,
                        to: '0'
                      }

                      var jxr = $.post(ws_url + 'controller/staff_set_facmed_project.php', param, function(){})
                                 .always(function(resp){
                                   console.log(resp);
                                   if(resp == 'Y'){
                                     setTimeout(function(){
                                       preload.hide()
                                       swal({
                                        title: "ดำเนินการสำเร็จ",
                                        text: "กด ตกลง เพื่อรีโหลดหน้าเว็บ",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#DD6B55",
                                        confirmButtonText: "ตกลง",
                                        closeOnConfirm: false },
                                       function(){
                                        window.location.reload()
                                       });
                                     }, 1000)
                                   }else{
                                     preload.hide()
                                     swal("ขออภัย!", "ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง!", "error")
                                   }
                                 })
                   }
              });
  }

}

function deleteAttachedResearchFile(file_id){
  swal({   title: "คำเตือน",
             text: "หากลบไฟล์แล้วจะไม่สามารถกู้คืนได้อีก!",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยันการลบ",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: false,
             closeOnCancel: true },
             function(isConfirm){
                 if (isConfirm) {
                    preload.show()
                    var param = {
                      id: current_user,
                      fid: file_id,
                      id_rs: current_rs_id
                    }

                    // console.log(param);
                    // return ;

                    var jxr = $.post(ws_url + 'controller/staff_delete_atteched_file.php', param, function(){})
                               .always(function(resp){
                                 // console.log(resp);
                                 // return ;
                                 if(resp == 'Y'){
                                   setTimeout(function(){
                                     preload.hide()
                                     swal({
                                      title: "ดำเนินการสำเร็จ",
                                      text: "กด ตกลง เพื่อรีโหลดหน้าเว็บ",
                                      type: "success",
                                      showCancelButton: false,
                                      confirmButtonColor: "#DD6B55",
                                      confirmButtonText: "ตกลง",
                                      closeOnConfirm: false },
                                     function(){
                                      window.location.reload()
                                     });
                                   }, 1000)
                                 }else{
                                   preload.hide()
                                   swal("ขออภัย!", "ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง!", "error")
                                 }
                               })
                 }
            });
}

function saveprotocolNumber(){

  var protocol_no = $('#txtProtocolNumber').val()
  $('#txtProtocolNumber').removeClass('is-invalid')

  if(protocol_no == ''){
    $('#txtProtocolNumber').addClass('is-invalid')
    swal("คำเตือน", "กรุณากรอกข้อมูล Protocol number ก่อน", "error")
    return ;
  }

  swal({   title: "ยืนยันดำเนินการ",
             text: "คุณยืนยันการแก้ไข/เพิ่มข้อมูลนี้หรือไม่?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยัน",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: false,
             closeOnCancel: true },
             function(isConfirm){
                if (isConfirm) {

                  preload.show()

                  var param = {
                    id_rs: current_rs_id,
                    id: current_user,
                    protocol_number: protocol_no
                  }

                  var jxr = $.post(ws_url + 'controller/update_project_protocol_number.php', param, function(){})
                             .always(function(resp){
                               if(resp == 'Y'){
                                 setTimeout(function(){
                                   preload.hide()
                                   swal({
                                    title: "ดำเนินการสำเร็จ",
                                    text: "กด ตกลง เพื่อรีโหลดหน้าเว็บ",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "ตกลง",
                                    closeOnConfirm: false },
                                   function(){
                                    window.location.reload()
                                   });
                                 }, 1000)
                               }else{
                                 preload.hide()
                                 swal("ขออภัย!", "ไม่สามารถลบไฟล์ได้ กรุณาลองใหม่อีกครั้ง!", "error")
                                 return ;
                               }
                             })
                }
            });
}

function showModal(id){
  console.log(id);
  if(id == 'MyCopiModal'){
    $('#txtPrefixTh').val('')
    $('#txtPrefixEn').val('')
    $('#txtFnameTh').val('')
    $('#txtFnameEn').val('')
    $('#txtLnameTh').val('')
    $('#txtLnameEn').val('')
    $('#txtDeptTh').val('')
    $('#txtDeptEn').val('')
    $('#txtEmail').val('')
    $('#txtRatio').val('')
    $('#txtResponse').val('')
    $('#txtCopiId').val('')
  }

  if(id == 'MyMoreReviewer'){
    if(editdata_more_reviewer == ''){
      editdata_more_reviewer = CKEDITOR.replace( 'txtCommentToECmoreReviewer', {
        height: '250px'
      });
    }else{
      editdata_more_reviewer.setData()
    }
  }

  $("#" + id).modal();
}

function setRID(id){
  $('#txtRID').val(id)

  if($("#cb1").is(':checked')){
    $("#cb1").trigger('click')
  }

  if($("#cb2").is(':checked')){
    $("#cb2").trigger('click')
  }

  if($("#cb3").is(':checked')){
    $("#cb3").trigger('click')
  }

  if($("#cb4").is(':checked')){
    $("#cb4").trigger('click')
  }

  if($("#cb5").is(':checked')){
    $("#cb5").trigger('click')
  }
}

function saveAssessmentFile(){
  var assesment_file_id = []
  for(var i = 0; i <= 30; i++){
    if($("#cb" + i).is(':checked')){
      assesment_file_id.push(i)
    }
  }

  if(assesment_file_id.length == 0){
    swal("คำเตือน", "กรุณาเลือกไฟล์แนบ", "error")
    return ;
  }

  var param = {
    id: current_user,
    file_attached: assesment_file_id,
    ririd: $('#txtRID').val()
  }

  preload.show()

  var jxhr = $.post(ws_url + 'controller/staff/set_reviewer_file_v2.php', param, function(){})
              .always(function(resp){
                if(resp == 'Y'){
                  window.location.reload()
                }else{
                  swal("เกิดข้อผิิดพลาด", "กรุณาลองใหม่อีกครั้ง", "error")
                  preload.hide()
                }
              })
}

function setSenddingReviewerContent(id, type, fname, em, pwd, code, rtype){

  if(editdata_reviewer_email == ''){
    editdata_reviewer_email = CKEDITOR.replace( 'operation-reviewer-email', {
      wordcount : {
        showCharCount : false,
        showWordCount : true
      },
      height: '250px'
    });
  }
  $('#txtRID2').val(id)
  $('#txtEM').val(em)
  $('#txtRwtype').val(type)
  $('#txtRType').val(rtype)
  $('#txtCodeBC').val(code)
  var content = "<p><strong>ขอเชิญเป็นผู้เชี่ยวชาญอิสระ</strong></p>" + "<p><strong>เรียน</strong> " + fname + " ที่นับถือ </p>" +
               "<p>สำนักงานจริยธรรมฯ คณะแพทยศาสตร์ ม.สงขลานครินทร์ ขอทาบทามท่านเป็น<u><b>ผู้เชี่ยวชาญอิสระ </b></u> เนื่องจาก ได้พิจารณาแล้วว่าท่านเป็นผู้มีความเชี่ยวชาญ และคุณวุฒิเหมาะสมในการพิจารณาโครงการที่แสดงข้างล่างนี้ " +
                 "<p>ชื่อโครงการ (ไทย) : " + $('#txtThtitle').text() + "<br>ชื่อโครงการ (อังกฤษ) : " + $('#txtEntitle').text() + "</p>" +
                 "เพื่อให้งานวิจัยของคณะแพทยศาสตร์มีคุณภาพ เกิดประโยชน์สูงสุด และเป็นไปตามหลักจริยธรรมการวิจัยในมนุษย์" +
               "" +
               "<p><strong>ขอความอนุเคราะห์จากท่าน</strong></p>" +
                 "<ol>" +
                    "<li>ประเมินโครงการวิจัย โดยกรอกความคิดเห็นและข้อแนะนำของท่านในแบบประเมิน ซึ่งอยู่ในระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS) (คลิกลิ้งค์ด้านล่าง หากยินดีประเมินโครงการ)</li>" +
                 "</ol>" +
               "กำหนดส่งผลการประเมินโครงการ ภายในวันที่  " + getNext14Days() + " เพื่อให้เจ้าหน้าที่สำนักงานฯ ดำเนินการต่อไปได้ตามกรอบเวลา" +
               "<p>โปรดคลิกที่ลิ้งค์ เพื่อเลือกการตัดสินใจของท่าน</p>" +
                 "<ol>" +
                    "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics </b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=aknowledge</a><br><br></li>" +
                    "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics แต่ขอรับไฟล์โครงการในรูปแบบเอกสารด้วย </b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=aknowledgehardcopy</a><br><br></li>" +
                    "<li style='padding-bottom: 30px;'><u><b><span class=txt-danger>ไม่สะดวกในการประเมินโครงการ </span></b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=cannotassesment<br><br></li>" +
                 "</ol>" +
               "" +
               "<p>สำนักงานจริยธรรมการวิจัย ขอขอบพระคุณท่านเป็นอย่างสูงสำหรับความอนุเคราะห์ในครั้งนี้ </p>" +
               "<p>หากลิงค์ไม่ทำงาน กรุณา copy ลิงค์เพื่อเปิดกับเว็บเบราว์เซอร์ <br>" +
               "สอบถามเพิ่มเติม ติดต่อ คุณณัฎฐา ศิริรักษ์ สำนักงานจริยธรรมการวิจัยในมนุษย์<br>" +
               "E-mail: sinuttha@medicine.psu.ac.th หรือ โทร. 1149 และ1157</p>" +
               "<p>หมายเหตุ : ** กรุณาอย่าตอบกลับอีเมล์ฉบับนี้ (Do not reply)</p>" +
               "<hr>" +
               "<p>สำนักงานจริยธรรมการวิจัยในมนุษย์ หน่วยส่งเสริมและพัฒนาทางวิชาการ คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์" +
               "<br>(Human Research Ethic Committee, Faculty of Medicine, Prince of Songkla University) </p>";

  if(type == 'Reviewer 1'){
    content = "<p><strong>ขอเชิญเป็นผู้เชี่ยวชาญอิสระ</strong></p>" + "<p><strong>เรียน</strong> " + fname + " ที่นับถือ </p>" +
                 "<p>สำนักงานจริยธรรมฯ คณะแพทยศาสตร์ ม.สงขลานครินทร์ ขอทาบทามท่านเป็น<u><b>ผู้เชี่ยวชาญอิสระ (Primary reviewer)</b></u> เนื่องจาก ได้พิจารณาแล้วว่าท่านเป็นผู้มีความเชี่ยวชาญ และคุณวุฒิเหมาะสมในการพิจารณาโครงการที่แสดงข้างล่างนี้ " +
                   "<p>ชื่อโครงการ (ไทย) : " + $('#txtThtitle').text() + "<br>ชื่อโครงการ (อังกฤษ) : " + $('#txtEntitle').text() + "</p>" +
                   "เพื่อให้งานวิจัยของคณะแพทยศาสตร์มีคุณภาพ เกิดประโยชน์สูงสุด และเป็นไปตามหลักจริยธรรมการวิจัยในมนุษย์" +
                 "" +
                 "<p><strong>ขอความอนุเคราะห์จากท่าน</strong></p>" +
                   "<ol>" +
                      "<li>ประเมินโครงการวิจัย โดยกรอกความคิดเห็นและข้อแนะนำของท่านในแบบประเมิน ซึ่งอยู่ในระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS) (คลิกลิ้งค์ด้านล่าง หากยินดีประเมินโครงการ)</li>" +
                      "<li>ให้ความเห็นเชิงวิชาการเกี่ยวกับโครงการ ในที่ประชุมคณะกรรมการ EC วันที่.... 2561 เวลา ..........ถึง.............น. ห้อง A401 อาคารบริหารฯ คณะแพทยศาสตร์</li>" +
                   "</ol>" +
                 "กำหนดส่งผลการประเมินโครงการ ภายในวันที่ " + getNext14Days() + " เพื่อให้เจ้าหน้าที่สำนักงานฯ ดำเนินการต่อไปได้ตามกรอบเวลา" +
                 "<p>โปรดคลิกที่ลิ้งค์ เพื่อเลือกการตัดสินใจของท่าน</p>" +
                 "" +
                   "<ol>" +
                      "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics </b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=aknowledge<br><br></li>" +
                      "<li style='padding-bottom: 30px;'><u><b>ยินดีประเมินโครงการ ผ่านระบบ electronics แต่ขอรับไฟล์โครงการในรูปแบบเอกสารด้วย </b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=aknowledgehardcopy<br><br></li>" +
                      "<li style='padding-bottom: 30px;'><u><b><span class=txt-danger>ไม่สะดวกในการประเมินโครงการ </span></b></u> " + root_domain + "controller/bp.php?email=" + em +"&sid=" + pwd + "&pid=" + id +"&next=cannotassesment<br><br></li>" +
                   "</ol>" +
                 "" +
                 "<p>สำนักงานจริยธรรมการวิจัย ขอขอบพระคุณท่านเป็นอย่างสูงสำหรับความอนุเคราะห์ในครั้งนี้ </p>" +
                 "<p>หากลิงค์ไม่ทำงาน กรุณา copy ลิงค์เพื่อเปิดกับเว็บเบราว์เซอร์ <br>" +
                 "สอบถามเพิ่มเติม ติดต่อ คุณณัฎฐา ศิริรักษ์ สำนักงานจริยธรรมการวิจัยในมนุษย์<br>" +
                 "E-mail: sinuttha@medicine.psu.ac.th หรือ โทร. 1149 และ1157</p>" +
                 // "<p>หมายเหตุ : <br>** ระบบ RMIS อยู่ในระหว่างการทดสอบ (เริ่มทดลองใช้เต็มรูปแบบ มกราคม 2561) ความเห็นที่ได้จากท่านจะถูกนำไปพัฒนาระบบให้ดียิ่งขึ้น<br>*** กรุณาอย่าตอบกลับอีเมล์ฉบับนี้ (Do not reply)</p>" +
                 "<p>หมายเหตุ : *** กรุณาอย่าตอบกลับอีเมล์ฉบับนี้ (Do not reply)</p>" +
                 "<hr>" +
                 "<p>สำนักงานจริยธรรมการวิจัยในมนุษย์ หน่วยส่งเสริมและพัฒนาทางวิชาการ คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์" +
                 "<br>(Human Research Ethic Committee, Faculty of Medicine, Prince of Songkla University) </p>";
  }

  var ext = '';
  if((rtype == 'Fullboard (Bio)') || (rtype == 'Fullboard (Social)')){
    ext = 'และให้ข้อมูลในวันประชุม board'
  }

  $('#txtEmailTitle').val("คณะกรรมการจริยธรรมการวิจัยขอความอนุเคราะห์เป็น Reviewer ประเมินโครงการวิจัย " + rtype + " REC." + code )
  editdata_reviewer_email.setData(content)
}

function sendEmailToReviewer(){

    var msg = editdata_reviewer_email.getData()
    if(msg == ''){
      swal("คำเตือน", "กรุณากรอกข้อความที่จะส่งถึงผู้เชี่ยวชาญอิสระก่อนทำการบันทึก", "error")
      return ;
    }

    swal({    title: "ยืนยันการดำเนินการ",
          text: "คุณแน่ใจหรือไม่ที่จะส่งข้อความนี้ไปยังนักวิจัย!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยันการส่ง",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true },
          function(){

            preload.show()

            var review_type = $('#txtRwtype').val()
            var researchtype = $('#txtRType').val()
            var code_apdu = $('#txtCodeBC').val()

            var review = 'Reviewer'
            var ext = ''
            if(review_type == 'Reviewer 1'){
              review = 'Primary reviewer'
              ext = 'และให้ข้อมูลในวันประชุม board'
            }

            var param = {
              rir_id: $('#txtRID2').val(),
              id: current_user,
              msg_send: msg
            }

            var jxhr = $.post(ws_url + 'controller/staff/send_reviewer_msg1.php', param, function(){})
                        .always(function(resp){
                          if(resp == 'Y'){
                            // preload.hide()
                            var str = msg.replace(/\n/g, ' ')
                            var param = {
                              title: $('#txtEmailTitle').val(),
                              content: str,
                              user: 'tagoon.p@gmail.com',
                              key: 'idj&skeoXf2**r123X',
                              toemail: $('#txtEM').val(),
                              toname: ''
                            }
                            main.send_email(param, 'reload', 'ท่านส่งอีเมล์ถึง Reviewer เรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                            $('.btnClosemodal').trigger('click')
                            return ;
                          }
                        })
          });
}

function checkNextStatus(){

  if((checkrtype == 'Fullboard (Social)') || (checkrtype == 'Fullboard (Bio)')){

    var param = {
      id_rs: current_rs_id
    }

    var jxhr = $.post(ws_url + 'controller/get_fb_argendar.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap != '') && (snap.length > 0)){
                    snap.forEach(function(i){
                        $('#fbBtn').text('ถูกบรรจุเข้าวาระ ' + i.rafa_panal + ' การประชุมครั้งที่ ' + i.rafa_agn + ' แล้ว')
                        $('#fbBtn').prop('disabled','disabled')
                        $('#fbBtn').removeClass('btn-success')
                        $('#fbBtn').addClass('btn-default')
                        $('#fbReset').prop('disabled','')
                    })
                  }else{
                    $('#btnSummary').prop('disabled', 'disabled')
                  }
                }, 'json')

    $('#fbBtn').removeClass('dn')
    $('#expBtn').addClass('dn')

    // txtAgender
    if(checkrtype == 'Fullboard (Social)'){
      $('#txtAgender').val('4.3')
    }else{
      $('#txtAgender').val('4.2')
    }

    $fbConntent = '<p><strong>เรื่อง</strong> แจ้งวาระการพิจารณาจริยธรรมการวิจัยในกรรมการเต็มชุด</p>' +
                  '<p><strong>เรียน</strong> ' + $('#txtPi').text() + ' ที่นับถือ</p>' +
                  '<p>ตามที่ท่านเสนอโครงร่างการวิจัยเพื่อขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์ เรื่อง ' + $('#txtThtitle').text() + ' (' + $('#txtEntitle').text() + ') หมายเลขโครงการ <span style="color:red;">REC.' + $('#txtCode').text() + '</span> <br>โครงการของท่านได้ถูกกำหนดให้นำเข้า<strong>พิจารณาโดยคณะกรรมการเต็มชุด ในการประชุม ครั้งที่ ....../....... วันที่ ......... ช่วงเวลา .......</strong></p>' +
                  '<p><strong>ขอให้ท่าน standby ในวันเวลาดังกล่าว เนื่องจากกรรมการอาจโทรศัพท์สอบถามข้อมูลเกี่ยวกับโครงการของท่านเพิ่มเติมระหว่างพิจารณา</strong></p>' +
                  '<p>จึงเรียนมาเพื่อทราบ&nbsp;<br />' +
                  'ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>' +
                  '<p>หมายเหตุ : <br>* ท่านสามารถตรวจสอบสถานะโครงการของท่านด้วยตนเองได้ที่ ' + root_domain + ' <br>*** กรุณาอย่าตอบกลับทางอีเมล์ฉบับนี้ หากมีข้อสงสัย กรุณาติดต่อเจ้าหน้าที่สำนักงาน คุณณัฎฐา ศิริรักษ์ โทร 1149, 1157</p>'
                   ;
    // editData3.setData($fbConntent)

  }else if(checkrtype == 'Expedited'){
    // $('#fbBtn').addClass('dn')
    // $('#expBtn').removeClass('dn')
  }else{
    $('#fbBtn').addClass('dn')
    $('#expBtn').addClass('dn')
  }
}

function viewEform(file_id, reviewer_id, reviewer_name){
  $('.eformPanal').addClass('dn')

  var param = {
    fid: file_id,
    id_rs: current_rs_id,
    id_reviewer: reviewer_id
  }

  var  jxr = $.post(ws_url + 'controller/get_review_eform_info.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                    if((file_id == 2) || (file_id == 9)){
                      window.location = "assesment_form_bio_view_th.php?id_rs=" + current_rs_id + "&id_reviewer=" + reviewer_id
                    }
                    else if((file_id == 3) || (file_id == 10)){
                      window.location = "assesment_form_social_view_th.php?id_rs=" + current_rs_id + "&id_reviewer=" + reviewer_id
                    }
                    else if(file_id == 4){
                      window.location = "assesment_form_icf_view_th.php?id_rs=" + current_rs_id + "&id_reviewer=" + reviewer_id
                    }
                    else if(file_id == 8){
                      window.location = "assesment_form_mta_view_th.php?id_rs=" + current_rs_id + "&id_reviewer=" + reviewer_id
                    }
                    else if(file_id == 13){
                      window.location = "assesment_form_funding_view_th.php?id_rs=" + current_rs_id + "&id_reviewer=" + reviewer_id
                    }
                  // $('#btnEforminfo').trigger('click')
                  $('.txtReviewer').text(reviewer_name)
                }else{
                  swal("ขออภัย", "ไม่พบข้อมูลการประเมินจากผู้เชี่ยวชาญอิสระ", "error")
                }
              })
}

function FbtoECReviewer(){

    if(editdata_more_reviewer.getData() == ''){
      swal("ขออภัย", "กรุณาระบุข้าความเพื่อส่งหาเลขา EC", "error")
      return ;
    }

    swal({
      title: "ยืนยันการดำเนินการ",
      text: "ยืนยันส่งกลับเลขา EC เพื่อทำการเลือกผู้เชี่ยวชาญอิสระใหม่/เพิ่มเติมหรือไม่",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
      closeOnConfirm: true
    },function(){

      preload.show()
      var param = {
        id: current_user,
        id_rs: current_rs_id,
        msg: editdata_more_reviewer.getData()
      }

      var jxhr = $.post(ws_url + 'controller/staff/renew_reviewer.php', param, function(){})
                  .always(function(resp){
                    if(resp == 'Y'){
                      //Send email to ec
                      var jxhr2 = $.post(ws_url + 'controller/get_ec_info_response_to_research.php', param, function(){}, 'json')
                                  .always(function(snap){
                                    if((snap != '') && (snap.length > 0)){
                                      snap.forEach(function(i){
                                        var dataContent2 =  '<h3>REC.' + i.code_apdu + ' รอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)</h3>' +
                                                            '<p>เรียน ' + i.fname + ' ' + i.lname + '</p>' +
                                                            '<p>มีการแจ้งโครงการวิจัยรอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)จากเจ้าหน้าที่ รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                            'ได้ที่ ' + root_domain +' </p>' +
                                                            '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                                                            var param = {
                                                              title: 'REC.' + i.code_apdu + ' : รอการเลือกผู้เชี่ยวชาญอิสระ(เพิ่มเติม)จากเจ้าหน้าที่',
                                                              content: dataContent2,
                                                              user: 'tagoon.p@gmail.com',
                                                              key: 'idj&skeoXf2**r123X',
                                                              toemail: i.email,
                                                              toname: i.fname + ' ' + i.lname
                                                            }

                                                            main.send_email(param, 'rs-list-wait-process.html', 'กดตกลงเพื่อกลับสู่หน้ารายการ', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                                                            return ;
                                      })
                                    }
                                  })
                    }
                  })

      return ;
    }); // End swal
}
