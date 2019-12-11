var nextStatusCheck = null;



var staff = {
  init: function(){

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
                      // $('.userFullname').text(childSnap.prefix_name + childSnap.fname + ' ' + childSnap.lname)
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
                    }
                  })
  },
  checkNewRetro: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-retro.php', function(){},'json')
                 .always(function(snap){
                   if((snap!='') && (snap.length > 0)){
                     $('.retro1').text('(' + snap.length + ')')
                     $('#btnRetro1').addClass('btn-danger')
                   }
                 })
  },
  checkNewWaitProgess: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-wait-process.php', function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   if((snap!='') && (snap.length > 0)){
                     $('.NewWaitAllProcess').text('(' + snap.length + ')')
                     $('#btnN3').addClass('btn-danger')
                     $('#btnN3').removeClass('btn-green')
                     $('#btnN3').addClass('btn-orange')
                     console.log('a');
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
                     $('#btnN1').addClass('btn-danger')
                     $('#btnN1').removeClass('btn-green')
                     $('#btnN1').addClass('btn-orange')

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
    var param = $.post(ws_url + 'controller/staff/check-new-init.php', function(){},'json')
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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

                                $('#tableCopi').empty()
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

                                  $copiTable = '<tr>' +
                                                  '<td>' + $n + '</td>' +
                                                  '<td>' + i.prefix_name + i.co_fname + ' ' + i.co_lname  +
                                                    '<br>' + i.co_prefix_en + i.co_fname_en + ' ' + i.co_lname_en  +
                                                    '<div class="pt-10"><a href="Javascript:editTeam(\'' + i.copi_id + '\')" class="ml-0"><i class="fa fa-pencil"></i> แก้ไข</a><a href="" class="ml-10"><i class="fa fa-times"></i> ลบ</a></div>' +
                                                  '</td>' +
                                                  '<td>' + i.co_dept + '</td>' +
                                                  '<td>' + i.co_ratio + '</td>' +
                                               '</tr>'
                                  $('#tableCopi').append($copiTable)
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

    // console.log(param);
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      // console.log(i);
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)

                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtPi2').text(i.fname + ' ' + i.lname)

                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)

                      $('#txtRtype').text(i.type_name)
                      // console.log(i.rct_type);
                      // console.log(i.rct_type);
                      $('#txtRTypess').text(i.rct_type)

                      $('#txtEC_response').text(i.rct_ec_name)

                      if((i.rct_type == 'Fullboard (Bio)') || (i.rct_type == 'Fullboard (Social)') || (i.rct_type == 'Expedited')){
                        $('#txtEC_board').text(i.rct_fb_name)
                      }

                      checkrtype = i.rct_type;
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)
                      $('#txtPertype').val(i.id_personnel)

                      // console.log(i.dept);
                      if(i.id_dept == '19'){
                        $('#txtPiDept').text(i.dept)
                      }else{
                        $('#txtPiDept').html(i.dept_name + ' คณะแพทยศาสตร์<br>มหาวิทยาลัยสงขลานครินทร์')
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
                      // console.log($durr);

                      if(i.code_apdu != ''){
                        $('#txtCode').text(i.code_apdu)
                        console.log('a');
                        console.log(i.code_apdu);
                        $('#txtCodeBCAPCU').val(i.code_apdu)
                        $('.docSessCodeAPDU').val(i.code_apdu)
                        $('#COAAPDU').val(i.code_apdu)

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
                                        '<div class="col-xs-3 f500">Consultant : </div>' +
                                        '<div class="col-xs-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-xs-5"><span class="f500">Affiliation :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }else{
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-xs-3 f500">ที่ปรึกษา : </div>' +
                                        '<div class="col-xs-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-xs-5"><span class="f500">สังกัด :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }

                                  }else{

                                    if(lang == 'en'){
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-xs-3 f500">Co-investigator : </div>' +
                                        '<div class="col-xs-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-xs-5"><span class="f500">Affiliation :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }else{
                                      $('.subPiDiv').append('<div class="row pb-10">' +
                                        '<div class="col-xs-3 f500">ผู้ร่วมวิจัย : </div>' +
                                        '<div class="col-xs-4">' + i.co_fname + ' ' + i.co_lname + '</div>' +
                                        '<div class="col-xs-5"><span class="f500">สังกัด :</span> <span id="txtPiDept" class="txt-danger">' + i.co_dept + '</span> <i class="zmdi zmdi-edit" data-toggle="modal" data-target=".bs-example-modal-lg-copi" onclick="setCopiInfo(' + i.copi_id + ')"></i></div>' +
                                      '</div>')
                                    }

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

function viewRsInfo17(rid){
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
                    window.location = 'research_info_17.html'
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
                          var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank">s<i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';

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
                          var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.f_name + '</li>';
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
                console.log(snap);
                $('#rw_table').empty()

                if((snap!='') && (snap.length > 0)){
                  $i = 1;
                  snap.forEach(function(i){

                    if((i.rct_type == 'Fullboard (Bio)') || (i.rct_type == 'Fullboard (Social)')){
                      $('.fbInfo').removeClass('dn')
                      var param2 = {
                        id_rs: current_rs_id
                      }

                      var jxh = $.post(ws_url + 'controller/get_fb_argendar.php', param, function(){} ,'json')
                                 .always(function(sm){
                                   // console.log(sm);
                                   if((sm != '') && (sm.length > 0)){
                                     sm.forEach(function(j){
                                       if(j.rafa_result == '2'){
                                         $('#Fbresult').text('Minor')
                                       }else if(j.rafa_result == '3'){
                                         $('#Fbresult').text('Major')
                                       }else if(j.rafa_result == '4'){
                                         $('#Fbresult').text('Dis-approve')
                                       }else if(j.rafa_result == null){
                                         $('#Fbresult').text('ยังไม่มีการระบุมติ')
                                       }else{
                                         $('#Fbresult').html('Approve <div>รายงานความก้าวหน้าทุก ' + j.rafa_progress + ' เดือน </div>')
                                       }

                                       $meetinninfo = '<div>การประชุมครั้งที่ : ' + j.rafa_agn + ' วันที่ : ' + main_app.convertThaidate(j.rafa_date) + '</div>' +
                                                      '<div>วาระ : ' + j.rafa_panal + ' ชุดที่ : ' + j.rafa_set + '</div>'
                                       $('#Fbminfo').html($meetinninfo)
                                     })
                                   }

                                 }, 'json')
                    }

                    console.log(i);
                    var pname = i.prefix_name + i.fname + ' ' + i.lname;

                    if(i.rw_sending_status == '0'){
                      $buffer = '<tr>' +
                                   '<td style="width: 250px;">' + pname + '<br><div style="font-size: 0.8em;">' + i.rir_status +'</div></td>' +
                                   '<td>' +
                                     'ยังไม่ทำการส่งต่อผู้เชี่ยวชาญอิสระ' +
                                   '</td>' +
                                  '<tr>';
                      $('#rw_table').append($buffer)
                    }else{
                      $buffer = '<tr>' +
                                   '<td style="width: 250px;">' + pname + '<br><div style="font-size: 0.8em;">' + i.rir_status +'</div></td>' +
                                   '<td>' +
                                     '<div style="padding: 10px;  background: rgb(244, 244, 244);" id="st' + $i + '" class="dn">' +
                                      '<span class="f500 txt-dark">สถานะการส่งผู้เชี่ยวชาญอิสระ </span> : <span class="text-success">ส่งแล้ว</span><br>' +
                                      '<span class="f500 txt-dark">ส่งเมื่อ </span> : <span class="text-muted" id="sd' + $i + '">NA</span><br>' +
                                      '<span class="f500 txt-dark">เตือนเจ้าหน้าที่เมื่อ </span> : <span class="text-muted" id="nd' + $i + '">NA</span><br>' +
                                      '<span class="f500 txt-dark">หมดเขตช่วงการพิจารณา </span> : <span class="text-danger" id="ed' + $i + '">NA</span><br>' +
                                      '<span class="f500 txt-dark">การตอบรับการพิจารณา </span> : <span class="text-muted" id="reply_status' + $i + '">NA</span><br>' +
                                      '<span class="f500 txt-dark">ตอบรับเมื่อ </span> : <span class="text-muted" id="reply_date' + $i + '">-</span><br>' +
                                      '<span class="f500 txt-dark">ไฟล์แนบกลับ </span> : <span class="text-muted" id="ass_status' + $i + '">-</span><br>' +
                                     '</div>' +
                                   '</td>' +
                                  '<tr>';
                      $('#rw_table').append($buffer)
                      loadCHeckfile(i.rir_id, $i)
                      loadCHeckProcess(i.rir_id, $i, i.rw_sending_status, i.rw_sending_datetime, i.rw_sending_notify_date, i.rw_sending_expire_date, i.rw_reply_status, i.rw_reply_datetime, i.rir_id_reviewer)

                    }


                    $('#txtRID3').val(i.rir_id)
                    $('#txtEM3').val(i.email)
                    $('#txtRwtype3').val(i.rir_status)
                    $('#txtRType3').val(i.rct_type)
                    $('#txtCodeBC3').val(i.code_apdu)

                    $i++;
                  })

                  setTimeout(function(){
                    // checkNextStatus();
                  }, 2000)

                }
              },'json')
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
