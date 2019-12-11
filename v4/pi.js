var current_user = window.localStorage.getItem('rmis_current_user')
var current_role = window.localStorage.getItem('rmis_current_role')
var fileload = false;
$(':input[type=number]').on('mousewheel', function(e){
    $(this).blur();
});

$('title').text(':: RMIS :: สำหรับหัวหน้าโครงการ ::')

var id_pm = '';
var pi = {
  checkNotConfNew: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-unsend.php', param, function(){},'json')
                 .always(function(snap){
                   if((snap!='') && (snap.length > 0)){
                     $('.noNCNew').text('(' + snap.length +')')
                     $('#btnN2').addClass('btn-danger')

                     swal({
                      title: "คำเตือน!",
                      text: "คุณมีโครงการวิจัยใหม่ที่ยังไม่ได้ทำการยืนยันการส่งข้อมูล กรุณาทำการตรวจสอบและดำเนินการ",
                      type: "warning",
                      showCancelButton: false,
                      confirmButtonColor: "#b02308",
                      confirmButtonText: "รับทราบ",
                      closeOnConfirm: true
                     },function(){});
                   }
                 })
  },
  load_unconf_new: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-unsend.php', param, function(){},'json')
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick="add_report(\''  + i.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
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
                 })
  },
  checkDraftNew: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-draft.php', param, function(){},'json')
                 .always(function(snap){
                   if((snap!='') && (snap.length > 0)){
                     $('.noDraftNew').text('(' + snap.length +')')
                     // $('.noDraftNew').parent().parent().parent().addClass('btn-info')
                     $('.noDraftNew').parent().parent().addClass('btn-danger')
                     $('.noDraftNew').parent().addClass('txt-light')
                     $('.noDraftNew').parent().parent().prev().addClass('txt-light')
                   }
                 })
  },
  load_edit_new: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-edit-new.php', param, function(){},'json')
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

                       $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'") class="fs08">- ดูรายละเอียด -</a>'


                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=delete_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ทำการบันทึกฉบับจริง</div>'
                         }else{
                           code = i.year_name + '-' + i.ord_id + '-' + i.id_dept + '-' + i.id_personnel + '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }


                       dt.row.add([
                         $c,
                         i.id_rs,
                         '<div class="f500 txt-dark">' + i.title_th + '</div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            '<a href="#" onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัย</a> | ' +
                            '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" class="txt-danger"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                         '</div>',
                         i.ep,
                         '<span class="txt-danger">' + i.status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }

                   lp.hl()
                 })
  },
  load_edit_new2: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-edit-new-2.php', param, function(){},'json')
                 .always(function(snap){
                   // console.log(snap);
                   var dt = $('#datable_1').dataTable().api();

                   if((snap!='') && (snap.length > 0)){
                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';
                       $fileReply = '';
                       $ans = '';

                       if((i.id_status_research != 1) && (i.id_status_research != 2) && (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.q_rw == 1){
                         $ans = '<button class="btn btn-success" onclick="setQes(\'' + i.id_rs + '\')"><i class="zmdi zmdi-edit"></i> ตอบข้อคำถาม</button>'
                       }

                       // if(i.id_status_research == 20){
                       //   $fileReply = ' | <a href="../tmp_file/' + i.code_apdu +'/" target="_blank" class="fs08">- ไฟล์แนบ -</a>';
                       // }

                       $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'") class="fs08">- ดูรายละเอียด -</a>' + $fileReply;


                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=delete_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ทำการบันทึกฉบับจริง</div>'
                         }else{
                           code = i.year_name + '-' + i.ord_id + '-' + i.id_dept + '-' + i.id_personnel + '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       $code_apdu = ''
                       if(i.code_apdu != ''){
                         $code_apdu = '<br><span class="text-danger">' + i.code_apdu + '</span>'
                       }

                       $cmd = '<div class="fs08">' +
                          '<a href="#" onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัย</a> | ' +
                          '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" class="txt-danger"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                       '</div>'

                       console.log(i);

                       if(i.q_rw == 1){
                         // $cmd = '<button class="btn btn-success" onclick="setQes(\'' + i.id_rs + '\')"><i class="zmdi zmdi-edit"></i> ตอบข้อคำถาม</button>'
                         $cmd = '<div class="fs08">' +
                            '<a href="#" onclick=update_draft3("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงานและตอบข้อคำถาม" class="txt-success"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัยและตอบข้อคำถาม</a> | ' +
                            '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" class="txt-danger"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                         '</div>'
                       }


                       dt.row.add([
                         $c,
                         i.id_rs + $code_apdu,
                         '<div class="f500 txt-dark">' + i.title_th + '</div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         $cmd,
                         i.ep,
                         '<span class="txt-danger">' + i.status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }

                   lp.hl()
                 })
  },
  load_draft_new: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-draft.php', param, function(){},'json')
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=delete_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ทำการบันทึกฉบับจริง</div>'
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

                   lp.hl()
                 })
  },
  checkEditNet: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-edit-new.php', param, function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   if((snap!='') && (snap.length > 0)){
                     $('.noEditNew').text('(' + snap.length +')')
                     $('#btnN4').addClass('btn-danger')

                     swal({
                      title: "คำเตือน!",
                      text: "เอกสาร/ไฟล์โครงการวิจัยที่ท่านเสนอยังไม่สมบูรณ์ กรุณาตรวจสอบรายละเอียดและดำเนินการแก้ไข",
                      type: "warning",
                      showCancelButton: false,
                      confirmButtonColor: "#b02308",
                      confirmButtonText: "รับทราบ",
                      closeOnConfirm: true
                     },function(){});

                   }
                 })
  },
  checkEditNet2: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/check-rs-edit-new-2.php', param, function(){},'json')
                 .always(function(snap){

                   if((snap!='') && (snap.length > 0)){
                     $('.noEditNew2').text('(' + snap.length +')')
                     $('#btnN5').addClass('btn-warning')
                     showModal('modalNotify1-4')

                     // swal({
                     //  title: "คำเตือน!",
                     //  text: "เอกสาร/ไฟล์โครงการวิจัยที่ท่านเสนอยังไม่สมบูรณ์ กรุณาตรวจสอบรายละเอียดและดำเนินการแก้ไข",
                     //  type: "warning",
                     //  showCancelButton: false,
                     //  confirmButtonColor: "#b02308",
                     //  confirmButtonText: "รับทราบ",
                     //  closeOnConfirm: true
                     // },function(){});

                   }
                 })
  },
  load_rs_info_2: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }

    // console.log(param);
    var jxhr = $.post(ws_url + 'controller/pm/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){
                  // console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)

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
                        $('#txtCodeBCAPCU').val(i.code_apdu)
                        $('.docSessCodeAPDU').val(i.code_apdu)
                        $('#COAAPDU').val(i.code_apdu)

                        var s = i.code_apdu.split('-')
                        $('#txtOrd').val(s[1])
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
                          // $('.sign_panal').html('<div class="row">' +
                          //   '<div class="col-xs-5 text-right" style="padding-top: 20px;">ลงชื่อ</div>' +
                          //   '<div class="col-xs-4 text-left" style="margin-left: -10px;">' +
                          //     '<span class="signature"><img src="../images/signate/sig1.png" width="150"></span>' +
                          //   '</div>' +
                          // '</div>')

                          if(i.rai_lang == 'th'){
                            $('.sign_panal').html('<div class="row">' +
                              '<div class="col-xs-5 text-right" style="padding-top: 20px;">&nbsp;</div>' +
                              '<div class="col-xs-4 text-left" style="margin-left: -10px;">' +
                                '<span class="signature"><img src="../images/signate/sig2-th.png" width="120"></span>' +
                              '</div>' +
                            '</div>')

                            $('.approveDate_1').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))
                            $('.approveDate_2').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))

                          }else{
                            $('.sign_panal').html('<div class="row">' +
                              '<div class="col-xs-5 text-right" style="padding-top: 20px;">&nbsp;</div>' +
                              '<div class="col-xs-4 text-left" style="margin-left: -10px;">' +
                                '<span class="signature"><img src="../images/signate/sig2-eng.png" width="120"></span>' +
                              '</div>' +
                            '</div>')

                            $('.approveDate_1').text(main_app.convertEndate(i.rai_sign_date))
                            $('.approveDate_2').text(main_app.convertEndate(i.rai_sign_date))
                          }

                          $('#profile_tab_8').hide()
                          // $('.approveDate_1').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))
                          // $('.approveDate_2').text('วันที่ ' + main_app.convertThaidate(i.rai_sign_date))
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
  },
  load_rs_info: function(){

    $('.toDayThaiDate').text(main_app.convertThaidate(get_today_date()))

    // var param = {
    //   id: current_user,
    //   sess: current_project_session
    // }

    // console.log(param);

    // var jxhr = $.post(ws_url + 'controller/pm/get-rs-info.php', param, function(){}, 'json')

    var param = {
      id: current_user,
      sess: current_project_session
    }

    console.log(param);
    var jxhr = $.post(ws_url + 'controller/pm/pm-rs-info.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    // console.log(snap);
                    snap.forEach(function(i){
                      // console.log(i.id_rs);
                      current_rs_id = i.id_rs

                      $dname = i.dept
                      if(i.dept == ''){
                        $dname = i.dept_name
                      }

                      $('.departmentInfo').text($dname)
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text($('.userFullname').text())
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)

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

                      $('#txtProtocolNo').text(i.protocol_no)

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
                        $('#btnPrint').removeClass('dn')
                        $('#btnSending').addClass('disabled')
                        $('#btnEdit').addClass('disabled')
                        $('#btnSending').addClass('dn')
                      }else{
                        $('#btnPrint').addClass('dn')
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

                var jxhr2 = $.post(ws_url + 'controller/pm/pm-co-pi-info.php', {sess: current_project_session, id: current_user}, function(){}, 'json')
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
  init: function(){

    var path = window.location.pathname;
    var page = path.split("/").pop();

    // console.log(current_user);

    if(page != 'research_register.html'){
      window.localStorage.removeItem('rmis_current_rs_session_id')
    }

    console.log('Checking user role ....');
    if((current_user == null) || (current_role == null) || (current_role != 'pm')){
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

    console.log(param);

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

                      if(childSnap.dept_name == null){

                      }else{

                      }

                      if(childSnap.id_personnel == 1){
                        $('.userPosition').text('อาจารย์แพทย์')
                      }else if(childSnap.id_personnel == 2){
                        $('.userPosition').text('อาจารย์ไม่ใช่แพทย์')
                      }else if(childSnap.id_personnel == 3){
                        $('.userPosition').text('แพทย์ประจำบ้านต่อยอด')
                      }else if(childSnap.id_personnel == 4){
                        $('.userPosition').text('แพทย์ประจำบ้าน/แพทย์ใช้ทุน')
                      }else if(childSnap.id_personnel == 5){
                        $('.userPosition').text('นักศึกษาปริญญาโท/เอก ระบาดวิทยา')
                      }else if(childSnap.id_personnel == 6){
                        $('.userPosition').text('นักศึกษาแพทย์ และ นักศึกษาอื่นๆ (ที่ใม่ใช่สาขาระบาดวิทยา)')
                      }else if(childSnap.id_personnel == 7){
                        $('.userPosition').text('บุคลากร สาย ข')
                      }else if(childSnap.id_personnel == 8){
                        $('.userPosition').text('บุคลากร สาย ค')
                      }else if(childSnap.id_personnel == 9){
                        $('.userPosition').text('ประเภทอื่น ๆ')
                      }else{
                        $('.userPosition').text('ไม่สามารถระบุได้')
                      }

                      $( "#profileImg" ).html('<img src="'+ profile +'" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status">' );
                      $('.profileImg').html('<img class="inline-block mb-10" id="profileImg" src="'+ profile +'" alt="user" />')

                      $('.userEmail').text(window.localStorage.getItem('rmis_current_user_email'))
                      $('#txtEmail').val(childSnap.email)

                      $('#txtPrefix').val(childSnap.id_prefix)
                      $('#txtFname').val(childSnap.fname)
                      $('#txtLname').val(childSnap.lname)

                      // budgetForm
                      // console.log(childSnap.id_dept);
                      if(childSnap.id_dept == 19){
                        $('#budgetForm').removeClass('dn')
                      }


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
                      // console.log(childSnap.personnel_name);
                      $('.userPosition').text(childSnap.personnel_name)
                      $('#txtPosition').val(childSnap.id_personnel)

                      $('#uid').val(childSnap.id)

                      pi.count_rs()

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
  },
  count_rs: function(){

    var param = {
      id: current_user,
      pm: id_pm
    }

    var jxhr = $.post(ws_url + 'controller/pm/count_all_rs.php', param, function(){})
                .always(function(snap){
                  $('.counter-rs-no').text(snap)
                })
  },
  pi_role: function(){

  },
  load_all_progress_list: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/get_all_progress_list.php', param, function(){},'json')
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

                       if((i.id_status_research != 1) || (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       $notif = '';
                       status_color = 'txt-danger';
                       widthdraw_status = '';

                       if(i.id_status_research == 2){
                         $bt2 = ''
                         $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'")>- ดูรายละเอียด -</a>'
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.id_status_research == 18){
                         status_color = ' txt-success f500 '
                         widthdraw_status = ' dn '
                       }

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       var st = 'dn';
                       var status_name = 'ยังไม่ทำการส่ง'

                       if(i.id_status_research == 1){
                         st = '';
                       }

                       var rtype = ''
                       if(i.rp_progress_id == '1'){
                         rtype = 'รายงานความก้าวหน้า/ต่ออายุการรับรอง'
                       }else if(i.rp_progress_id == '2'){
                         rtype = 'ขอปรับโครงการวิจัย'
                       }else if(i.rp_progress_id == '3'){
                         rtype = 'รายงานเหตุไม่พึงประสงค์'
                       }else if(i.rp_progress_id == '4'){
                         rtype = 'รายงานการดำเนินการที่ดเบี่ยงเบน'
                       }else if(i.rp_progress_id == '5'){
                         rtype = 'รายงานปิดโครงการปกติ'
                       }else if(i.rp_progress_id == '6'){
                         rtype = 'รายงานยุติโครงการวิจัยก่อนกำหนด'
                       }

                       if(i.rp_sending_status == '0'){
                         status_name = 'ยังไม่ทำการส่ง'
                       }else{
                         status_name = i.status_name
                         st = 'dn';
                       }

                       var rpid = i.rp_id

                       var pid = i.rp_progress_id

                       dt.row.add([
                         $c,
                         '<div class="fs08_ txt-danger">' + code + '<div>',
                         '<div class="fs08_ txt-danger">' + (parseInt(i.id_year) + 41) + '-' + i.id_rs + '-' + rpid + '-' + pid + '<div>',
                         rtype,
                         // '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>รหัสโครงการ REC.' + i.code_apdu + '</a></div>' +
                         '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>' + i.title_th + '</a></div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            '<a href="#" onclick="viewProgress(\'' + i.rp_id +'\', \'' + i.rp_progress_id +'\')" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล </a> | ' +
                            '<a href="#" onclick=updateProgress("' + i.rp_id +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success ' + st + '"><i class="zmdi zmdi-edit"></i> แก้ไข | </a> ' +
                            '<a href="#" onclick="withdrawProgress(\'' + i.rp_id + '\', \'' + i.rp_progress_id +'\')" class="txt-danger ' + widthdraw_status +'"><i class="zmdi zmdi-close"></i> ถอนรายงาน</a>' +
                         '</div>',
                         '<span class="' + status_color + '">' + status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }
                 })
  },
  load_all_progress_list_edit: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/get_all_progress_list_edit.php', param, function(){},'json')
                 .always(function(snap){

                   console.log(snap);

                   var dt = $('#datable_1').dataTable().api();

                   if((snap!='') && (snap.length > 0)){

                     $('#btnce').addClass('btn-danger')
                     $('#ce').text('(' + snap.length  + ')')

                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';

                       if((i.id_status_research != 1) || (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       $notif = '';
                       status_color = 'txt-danger';
                       widthdraw_status = '';

                       if((i.id_status_research == 2) || (i.id_status_research == 19)){
                         $bt2 = ''
                         $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'")>- ดูรายละเอียด -</a>'
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.id_status_research == 18){
                         status_color = ' txt-success f500 '
                         widthdraw_status = ' dn '
                       }

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       var st = 'dn';
                       var status_name = 'ยังไม่ทำการส่ง'

                       if(i.id_status_research == 1){
                         st = '';
                       }

                       var rtype = ''
                       if(i.rp_progress_id == '1'){
                         rtype = 'รายงานความก้าวหน้า/ต่ออายุการรับรอง'
                       }else if(i.rp_progress_id == '2'){
                         rtype = 'ขอปรับโครงการวิจัย'
                       }else if(i.rp_progress_id == '3'){
                         rtype = 'รายงานเหตุไม่พึงประสงค์'
                       }else if(i.rp_progress_id == '4'){
                         rtype = 'รายงานการดำเนินการที่ดเบี่ยงเบน'
                       }else if(i.rp_progress_id == '5'){
                         rtype = 'รายงานปิดโครงการปกติ'
                       }else if(i.rp_progress_id == '6'){
                         rtype = 'รายงานยุติโครงการวิจัยก่อนกำหนด'
                       }

                       if(i.rp_sending_status == '0'){
                         status_name = 'ยังไม่ทำการส่ง'
                       }else{
                         status_name = i.status_name
                         st = 'dn';
                       }

                       var rpid = i.rp_id

                       var pid = i.rp_progress_id

                       dt.row.add([
                         $c,
                         '<div class="fs08_ txt-danger">' + code + '<div>',
                         '<div class="fs08_ txt-danger">' + (parseInt(i.id_year) + 41) + '-' + i.id_rs + '-' + rpid + '-' + pid + '<div>',
                         rtype,
                         // '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>รหัสโครงการ REC.' + i.code_apdu + '</a></div>' +
                         '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>' + i.title_th + '</a></div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            '<a href="#" onclick="viewProgress(\'' + i.rp_id +'\', \'' + i.rp_progress_id +'\')" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล </a> | ' +
                            '<a href="#" onclick=updateProgress("' + i.rp_id +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success ' + st + '"><i class="zmdi zmdi-edit"></i> แก้ไข | </a> ' +
                            '<a href="#" onclick="withdrawProgress(\'' + i.rp_id + '\', \'' + i.rp_progress_id +'\')" class="txt-danger ' + widthdraw_status +'"><i class="zmdi zmdi-close"></i> ถอนรายงาน</a>' +
                         '</div>',
                         '<span class="' + status_color + '">' + status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }
                 })
  },
  load_all_initial: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/get_all_init_list.php', param, function(){},'json')
                 .always(function(snap){
                   var dt = $('#datable_1').dataTable().api();

                   if((snap!='') && (snap.length > 0)){
                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';

                       if((i.id_status_research != 1) || (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       $notif = '';
                       status_color = 'txt-danger';
                       widthdraw_status = '';

                       if(i.id_status_research == 2){
                         $bt2 = ''
                         $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'")>- ดูรายละเอียด -</a>'
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.id_status_research == 18){
                         status_color = ' txt-success f500 '
                         widthdraw_status = ' dn '
                       }

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       var st = 'dn';

                       if(i.id_status_research == 2){
                         st = '';
                       }

                       var normal = '<a href="#" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล </a> '
                       if(i.id_status_research == 18){
                         normal = '<a href="#" onclick=viewRsInfoFinal("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล </a> '
                       }

                       dt.row.add([
                         $c,
                         i.id_rs + '<div class="fs08_ txt-danger">' + code + '<div>',
                         // '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>รหัสโครงการ REC.' + i.code_apdu + '</a></div>' +
                         '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>' + i.title_th + '</a></div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            normal +
                            '<a href="#" onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success ' + st + '"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัย </a> ' +
                            '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" data-toggle="modal" data-target="#myModal_withdrawn" class="txt-danger ' + widthdraw_status +'"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                         '</div>',
                         i.ep,
                         '<span class="' + status_color + '">' + i.status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }
                 })
  },
  load_all_retro_unsend: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/get_all_retro_unsend_list.php', param, function(){},'json')
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

                       if((i.id_status_research != 1) || (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       $notif = '';
                       status_color = 'txt-danger';
                       widthdraw_status = '';

                       if(i.id_status_research == 2){
                         $bt2 = ''
                         $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'")>- ดูรายละเอียด -</a>'
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.id_status_research == 18){
                         status_color = ' txt-success f500 '
                         widthdraw_status = ' dn '
                       }

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       var st = 'dn';

                       if(i.id_status_research == 2){
                         st = '';
                       }


                       dt.row.add([
                         $c,
                         i.id_rs + '<div class="fs08_ txt-danger">' + code + '<div>',
                         // '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>รหัสโครงการ REC.' + i.code_apdu + '</a></div>' +
                         '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>' + i.title_th + '</a></div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            '<a href="#" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล | </a> ' +
                            '<a href="#" onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัย | </a> ' +
                            '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" class="txt-danger"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                         '</div>',
                         i.ep,
                         '<span class="' + status_color + '">ยังไม่ทำการส่ง</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }
                 })
  },
  load_all_retro: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/pm/get_all_retro_list.php', param, function(){},'json')
                 .always(function(snap){
                   var dt = $('#datable_1').dataTable().api();

                   if((snap!='') && (snap.length > 0)){
                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       $bt1 = '';
                       $bt2 = '';
                       $bt3 = '';

                       if((i.id_status_research != 1) || (i.id_status_research != 9)) {
                         $bt2 = 'disabled ';
                       }

                       $notif = '';
                       status_color = 'txt-danger';
                       widthdraw_status = '';

                       if(i.id_status_research == 2){
                         $bt2 = ''
                         $notif = '<br><a href="#" data-toggle="modal" data-target="#myModal2" onclick=setInfoReply("' + i.id_rs +'")>- ดูรายละเอียด -</a>'
                       }

                       if((i.id_status_research == 10) || (i.id_status_research == 11) || (i.id_status_research == 12) || (i.id_status_research == 13) || (i.id_status_research == 14) || (i.id_status_research == 16)  || (i.id_status_research == 18)) {
                         $bt3 = 'disabled ';
                       }

                       if(i.id_status_research == 18){
                         status_color = ' txt-success f500 '
                         widthdraw_status = ' dn '
                       }

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                         '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       if(code == ''){
                         if(i.ord_id == ''){
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้ยืนยันการส่งข้อมูล</div>'
                         }else{
                           code = '<div style="font-size: 0.8em;" class="txt-danger">ยังไม่ได้การตรวจสอบจากเจ้าหน้าที่</div>'
                         }
                       }

                       var st = 'dn';

                       if(i.id_status_research == 2){
                         st = '';
                       }


                       dt.row.add([
                         $c,
                         i.id_rs + '<div class="fs08_ txt-danger">' + code + '<div>',
                         // '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>รหัสโครงการ REC.' + i.code_apdu + '</a></div>' +
                         '<div class="f500 txt-dark"><a href="#" onclick=viewRsInfo("' + i.id_rs + '")>' + i.title_th + '</a></div>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div class="fs08">' +
                            '<a href="#" onclick=viewRsInfo("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" class="txt-success"><i class="fa fa-search"></i> ดูข้อมูล </a> ' +
                            '<a href="#" onclick=update_draft("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน" class="txt-success ' + st + '"><i class="zmdi zmdi-edit"></i> แก้ไขข้อเสนอโครงการวิจัย </a> ' +
                            // '<a href="#" onclick="withdraw_rs(\'' + i.id_rs + '\')" class="txt-danger ' + widthdraw_status +'"><i class="zmdi zmdi-close"></i> ถอนโครงการจากการพิจารณา</a>' +
                         '</div>',
                         i.ep,
                         '<span class="' + status_color + '">' + i.status_name + '</span>' + $notif
                         // command_btn
                       ]);
                       $c++;

                     })
                     dt.draw();
                   }else{
                     dt.clear().draw();
                   }
                 })
  },
  load_all_draft: function(){
    var param = {
      user: current_user
    }

    var jxhr = $.post(ws_domain + 'pm/get_all_init_draft_list.php', param ,function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
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
                        '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=download_progress_attach("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-search"></i></button>' +
                        '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" ' + $bt2 + ' onclick="add_report(\''  + i.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                        '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=delete_report("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
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
                        code,
                        i.title_th + '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                        i.ep,
                        '<span class="txt-danger">' + i.status_name + '</span>',
                        command_btn
                      ]);
                      $c++;

                    })
                    dt.draw();

                    $('.noDraftNew').text('(' + ($c-1) +')')
                    $('.noDraftNew').parent().addClass('btn-success')
                  }else{

                  }
                }, 'json')
  }
}

function loadProgressInfo1(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 1
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){


                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 1).text('(' + numberOfObj +')')
                  }

                  dt1.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" ' + st2 + ' onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square" ' + st3 + '  onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    dt1.row.add([
                      $c,
                      childSnap.title_th ,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt1.draw();

                }
              }, 'json')
}

function loadProgressInfo2(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 2
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 2).text('(' + numberOfObj +')')
                  }
                  dt2.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" ' + st2 + '  onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square" ' + st3 + '  onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    dt2.row.add([
                      $c,
                      childSnap.title_th ,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt2.draw();
                }
              }, 'json')
}

function loadProgressInfo3(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 3
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 3).text('(' + numberOfObj +')')
                  }
                  dt3.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" ' + st2 + ' onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square" ' + st3 + '  onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    dt3.row.add([
                      $c,
                      childSnap.title_th ,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt3.draw();
                }
              }, 'json')
}

function loadProgressInfo4(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 4
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 4).text('(' + numberOfObj +')')
                  }
                  dt4.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square"  ' + st2 + ' onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square"  ' + st3 + ' onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    var stype = 'ไม่ระบุ';
                    if(childSnap.sae_location == 1){
                      stype = 'ในมหาวิทยาลัย'
                    }else if(childSnap.sae_location == 2){
                      stype = 'นอกมหาวิทยาลัย'
                    }

                    dt4.row.add([
                      $c,
                      childSnap.title_th ,
                      stype,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt4.draw();
                }
              }, 'json')
}

function loadProgressInfo5(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 5
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 5).text('(' + numberOfObj +')')
                  }
                  dt5.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" ' + st2 + '  onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square"  ' + st3 + ' onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    dt5.row.add([
                      $c,
                      childSnap.title_th ,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt5.draw();
                }
              }, 'json')
}

function loadProgressInfo6(){
  var param = {
    id_rs: current_id_rs,
    id_progress: 6
  }

  var jxhr = $.post(ws_domain + 'get_progress_num.php', param, function(){}, 'json')
              .always(function(snap){
                // var count = 0;
                if(snap!=''){
                  var numberOfObj = countValue(snap);
                  if(numberOfObj!=0){
                    $('.sp' + 6).text('(' + numberOfObj +')')
                  }

                  dt6.clear().draw();
                  $c = 1;
                  snap.forEach(function(childSnap){

                    var st1 = '';
                    var st2 = '';
                    var st3 = '';

                    if(childSnap.id_status_research > 1){
                      st2 = 'disabled';
                      st3 = 'disabled';
                    }

                    if(childSnap.id_status_research == 2){
                      st1 = 'disabled';
                      st2 = 'disabled';
                    }

                    var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick=download_progress_attach("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดไฟล์แนบทั้งหมด"><i class="fa fa-download"></i></button>' +
                      // '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" ' + st2 + '  onclick="add_report(\''  + childSnap.id_rs +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                      '<button class="btn btn-danger btn-sm btn-icon-anim btn-square" ' + st3 + '  onclick=delete_report("' + childSnap.pg_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                    '</div></div>';

                    dt6.row.add([
                      $c,
                      childSnap.title_th,
                      main_app.convertThaidate(childSnap.pg_date),
                      childSnap.status_name,
                      command_btn
                    ]);
                    $c++;
                  })
                  dt6.draw();
                }
              }, 'json')
}

function countValue(input){
  var  i = 0;
  input.forEach(function(j){
    i++;
  })
  return i;
}

function delete_report(rid){
  swal({
    title: "ยืนยันการดำเนินการ",
    text: "คุณยืนยันที่จะลบรายงานนี้หรือไม่",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยันการลบ",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: false,
    showLoaderOnConfirm: true
  },
  function(){

    var param = {
      pg_id: rid
    }

    var jxhr = $.post(ws_domain + 'delete_progress.php', param, function(){})
              .always(function(resp){
                console.log(resp);
                setTimeout(function(){

                  swal("ลบรายงานสำเร็จ");

                  loadProgressInfo1();
                  loadProgressInfo2();
                  loadProgressInfo3();
                  loadProgressInfo4();
                  loadProgressInfo5();
                  loadProgressInfo6();
                }, 2000);
              })

  });
}

function download_progress_attach(pg_id){
  var param = {
    pg_id: pg_id
  }

  var jxhr = $.post(ws_domain + 'download_file_progress.php', param, function(){}, 'json')
            .always(function(resp){
              if(resp!=''){
                resp.forEach(function(i){
                  window.open(root_domain + 'tmp_file/' + i.tf_name, "_blank");
                })
              }else{
                swal("ขออภัย", "ไม่พบไฟล์แนบ", "error")
              }
            }, 'json')
}

function widthdraw_research(id){

  var param = {
    user: current_user,
    id_rs: id
  }

  var jxhr = $.post(ws_domain + 'get_current_rs_status.php', param, function(){}, 'json')
            .always(function(snap){

              if(snap[0].id_status_research == '1'){

                swal({
                  title: "คำเตือน",
                  text: "คุณแน่ใจหรือไม่ที่ลบข้อมูลโครงการดังกล่าวออกจากการพิจารณา กด 'ตกลง' เพื่อยืนยัน!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "ตกลง",
                  cancelButtonText: "ยกเลิก",
                  closeOnConfirm: false },
                function(){

                  delete_research(id);
                  window.location.reload();

                });

              }else{

                swal({
                  title: "คำเตือน",
                  text: "คุณแน่ใจหรือไม่ที่จะขอถอนโครงการดังกล่าวออกจากการพิจารณา กด 'ตกลง' เพื่อยืนยัน ทั้งนี้ หากท่านยืนยันแล้ว ข้อมูลจะถูกส่งไปยังเจ้าหน้าที่เพื่อดำเนินการถอนโครงการนี้ต่อไป!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "ตกลง",
                  cancelButtonText: "ยกเลิก",
                  closeOnConfirm: false },
                function(){

                  widthdraw_research(id);
                  window.location.reload();

                });

              }
            }, 'json')

}

function setSAEInternal(){
  window.localStorage.setItem('current_progress_session_id', $('#txtSessionId').val());
  window.localStorage.setItem('current_progress_session_id_com', $('#txtProgressCom').val())
  window.localStorage.setItem('current_progress_session_id_type', 'sae_1')
  window.location = 'progress_sae_internal.html'
}

function setSAEExternal(){
  window.localStorage.setItem('current_progress_session_id', $('#txtSessionId').val());
  window.localStorage.setItem('current_progress_session_id_com', $('#txtProgressCom').val())
  window.localStorage.setItem('current_progress_session_id_type', 'sae_2')
  window.location = 'progress_sae_external.html'
}

function setProgress(){
  window.localStorage.setItem('current_progress_session_id', $('#txtSessionId').val());
  window.localStorage.setItem('current_progress_session_id_com', $('#txtProgressCom').val())
  window.localStorage.setItem('current_progress_session_id_type', 'progress')
  window.location = 'progress_progress1.html'
}

function setRenewal(){
  window.localStorage.setItem('current_progress_session_id', $('#txtSessionId').val());
  window.localStorage.setItem('current_progress_session_id_com', $('#txtProgressCom').val())
  window.localStorage.setItem('current_progress_session_id_type', 'renewal')
  window.location = 'progress_progress1.html'
}

function gotoProfile_pm(){
  window.location = './pm_edit.php?id=' + sess_id;
}

function gotoChangePwd_pm(){
  window.location = './changepassword.php?id=' + sess_id;
}

function viewRsInfoFinal(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/pm/check-rs-session.php', param, function(){}, 'json')
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

function viewRsInfo(rid){

  var param = {
    id_rs: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + '/controller/pm/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.location = 'research_info_all_progress.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
}

function withdraw_rs_2(){

  $('#txtWdInfo').removeClass('has-error')

  if($('#txtWdInfo').val() == ''){
    $('#txtWdInfo').addClass('has-error')
    swal("คำเตือน!", "กรุณาระบุเหตุผลของการถอนโครงการ", "error")
    return ;
  }

  swal({
    title: "ยืนยันดำเนินการ",
              text: "คุณยืนยันการถอนโครงการวิจัยนี้หรือไม่!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#dd5555",
              confirmButtonText: "ยืนยัน",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: false
            },
            function(){
              lp.sl()

              var param = {
                id: current_user,
                id_rs: $('#txtWdID').val(),
                info: $('#txtWdInfo').val()
              }

              var jxhr = $.post(ws_url + 'controller/pm/widthdraw_rs.php', param, function(){})
                          .always(function(resp){
                            if(resp == 'Y'){
                              swal({
                                title: "ดำเนินการสำเร็จ",
                                text: "กดปุ่ม ตกลง เพื่อรีโหลดข้อมูล",
                                type: "warning",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "ตกลง",
                                closeOnConfirm: false },
                              function(){
                                window.location.reload()
                              });
                            }else{
                              swal("เกิดข้อผิดพลาด!", "ไม่สามารถดำเนินการได้ กรุณาลองใหม่อีกครั้ง หรือติดต่อเจ้าหน้าที่!", "error")
                              lp.hl()
                            }
                          })
                          .fail(function(){
                            swal("เกิดข้อผิดพลาด!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้!", "error")
                            lp.hl()
                          })
            });
}

function withdraw_rs(rid){

  $('#btnWithdrwn').trigger('click')
  $('#txtWdID').val(rid)

  console.log(rid);

}

function checkFileAttached(){
  for(var i = 1; i <=10 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft' + i).empty()

  var current_project_session = null
  if(current_project_session == null){
    current_project_session = current_rs
  }
  var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i , session_id: current_project_session}, function(){}, 'json')
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

function checkFileAttached2(){
  for(var i = 1; i <=10 ; i++){
    checkData2(i);
  }
}

function checkData2(i){

  if((fileload == true) && (fileload != null)){
    $('#ft' + i).empty()
    var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i , session_id: current_project_session}, function(){}, 'json')
                    .always(function(snap){
                      if((snap != '') && (snap.length > 0)){
                        $('#ft' + i).empty();
                        snap.forEach(function(childSnap){
                          var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.f_name + '" target="_blank" class="text-primary">' + childSnap.f_name + '</a></li>';
                          $('#ft' + i).append(data);
                        })
                      }else{
                        $('#ft' + i).append('-');
                      }
                    },'json');
  }else{
    $('#ft' + i).empty()
    var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i , session_id: current_project_session}, function(){}, 'json')
                    .always(function(snap){
                      if((snap != '') && (snap.length > 0)){
                        $('#ft' + i).empty();
                        snap.forEach(function(childSnap){
                          var data = '<li class="mb-5"> ' + childSnap.f_name + '</li>';
                          $('#ft' + i).append(data);
                        })
                      }else{
                        $('#ft' + i).append('-');
                      }
                    },'json');
  }

}

function updateProgress(rid){
  var param = {
    rp_id: rid,
    id: current_user
  }

  var jxhr = $.post(ws_url + 'controller/get_progress_info_for_update.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_progress_id', i.rp_id);
                    if(i.rp_progress_id == 5){
                      window.location = 'progress5_1_update.html'
                    }
                  })
                }else{
                  swal("ขออภัย!", "ไม่พบข้อมูลรายงานดังกล่าว!", "error")
                  lp.hl()
                }
              }, 'json')
              .fail(function(){
                swal("ขออภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้่!", "error")
                lp.hl()
              })
}

function withdrawProgress(rid, pid){
  var param = {
    rp_id: rid,
    progress_id: pid,
    id: current_user
  }

  swal({
    title: "ยืนยันดำเนินการ",
    text: "คุณยืนยันการถอนการรายงานนี้หรือไม่",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "ยืนยัน",
    cancelButtonText: "ยกเลิก",
    closeOnConfirm: true
  },
  function(){

    var jxhr = $.post(ws_url + 'controller/withdraw_progress.php', param, function(){})
                .always(function(resp){
                  if(resp == 'Y'){
                    swal("ดำเนินการสำเร็จ!", "ระบบได้ทำการถอนรายงานดังกล่าวเรียบร้อยแล้ว!", "success")
                  }else{
                    swal("เกิดข้อผิดพลาด!", "ระบบไม่สามารถทำการถอนรายงานดังกล่าวได้!", "success")
                  }
                  pi.load_all_progress_list()
                })
                .fail(function(){
                  swal("ขออภัย!", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้่!", "error")
                  pi.load_all_progress_list()
                  lp.hl()
                })

  });
}

function viewProgress(rp_id, rp_progress_id){

  console.log(rp_id);
  console.log(rp_progress_id);
  window.localStorage.setItem('current_progress_id', rp_id)

  if(rp_progress_id == 1){

  }else if(rp_progress_id == 2){

  }else if(rp_progress_id == 3){

  }else if(rp_progress_id == 4){

  }else if(rp_progress_id == 5){
    window.location = 'progress_5_1_info.html'
  }else if(rp_progress_id == 6){
    window.location = 'progress_5_2_info.html'
  }else if(rp_progress_id == 7){

  }
}

function showModal(id){
  $("#" + id).modal();
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
                   if(i.msg_role == 'นักวิจัย'){
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


                  //
                  setTimeout(function(){
                    $("#messagePanal").animate({
                       scrollTop: $('#messagePanal')[0].scrollHeight - $('#messagePanal')[0].clientHeight
                     }, 500);

                    preload.hide()
                  }, 1000)
               }, 1000)
             })
}

function sendMessage(){
  $content = message_panal.getData()
  if($content == ''){
    swal("เกิดข้อผิดพลาด!", "กรุณาระบุข้อความที่ต้องการส่ง!", "success")
    return ;
  }

  setMessaging($content, 'นักวิจัย', $('#txtId_rs').val())
}

function setMessaging(message, role, id_rs){
  var param = {
    id_rs: id_rs,
    content: message,
    id: current_user,
    role: role
  }

  var jsr = $.post(ws_url + 'controller/set_messaging.php', param, function(res){ console.log(res); })
             .always(function(){
               setMessageContent(id_rs)
             })
}

pi.init()
