var id_ec = '';
var nextStatusCheck = 0;

var ec = {
  init: function(){

    var path = window.location.pathname;
    var page = path.split("/").pop();
    // console.log( page );
    if(page != 'research_register.html'){
      window.localStorage.removeItem('rmis_current_rs_session_id')
    }

    console.log('Checking user role ....');
    if((current_user == null) || (current_role == null) || (current_role != 'ec')){
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
                    console.log('1');
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
    console.log('Checking role success ....');
  },
  loadNewInit_by_year_6: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-init-by-year-6.php', param, function(){},'json')
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

                       var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo6("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                         i.code_apdu,
                         i.title_th + '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' ,
                         i.ep,
                         '<span class="txt-danger">' + i.status_name + '</span>',
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
  loadNewInit_by_year_24: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-init-by-year-24.php', param, function(){},'json')
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

                       var command_btn = '<div class="text-left" style="font-size: 0.8em;">' +
                         '<a href="#" onclick=viewRsInfo24("' + i.id_rs +'") class="txt-success" ><i class="fa fa-search"></i> ตรวจสอบข้อมูลใบรับรอง</a>' +
                       '</div>';

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
                         i.code_apdu,
                         '<a href="#" onclick=viewRsInfo24("' + i.id_rs +'") class="txt-dark f500" >' + i.title_th + '</a><div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div><div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' + command_btn ,
                         '<span class="txt-danger">' + i.status_name + '</span>',
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
  loadNewInit_by_year_28: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-init-by-year-28.php', param, function(){},'json')
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

                       var command_btn = '<div class="text-left" style="font-size: 0.8em;">' +
                         '<a href="#" onclick=viewRsInfo28("' + i.id_rs +'") class="txt-success" ><i class="fa fa-wrench"></i> ดำเนินการ</a>' +
                       '</div>';

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
                         i.code_apdu,
                         '<a href="#" onclick=viewRsInfo27("' + i.id_rs +'") class="txt-dark f500" >' + i.title_th + '</a><div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div><div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' + command_btn ,
                         '<span class="txt-danger">' + i.status_name + '</span>',
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
  loadNewInit_by_year_27: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-init-by-year-27.php', param, function(){},'json')
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

                       var command_btn = '<div class="text-left" style="font-size: 0.8em;">' +
                         '<a href="#" onclick=viewRsInfo27("' + i.id_rs +'") class="txt-success" ><i class="fa fa-wrench"></i> ดำเนินการ</a>' +
                       '</div>';

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
                         i.code_apdu,
                         '<a href="#" onclick=viewRsInfo27("' + i.id_rs +'") class="txt-dark f500" >' + i.title_th + '</a><div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div><div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' + command_btn ,
                         '<span class="txt-danger">' + i.status_name + '</span>',
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
  checkStatus5: function(){

      var param = {
        id: current_user,
      }

      var param = $.post(ws_url + 'controller/ec/check-new-status-5.php', param, function(){},'json')
                   .always(function(snap){
                     var dt = $('#datable_1').dataTable().api();
                     if((snap!='') && (snap.length > 0)){


                       $('.NewStatus5').text('(' + snap.length +')')
                       $('#btnN2').addClass('btn-danger')

                       swal({
                        title: "คำเตือน!",
                        text: "คุณมีโครงการวิจัยใหม่รอการตรวจสอบผลการพิจารณาจากผู้เชี่ยวชาญอิสระ",
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
                           '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                   }, 'json')

  },
  checkStatus28: function(){
    var param = {
      id: current_user
    }

    var param = $.post(ws_url + 'controller/ec/check-new-status-28.php', param, function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){


                     $('.NewStatus28').text('(' + snap.length +')')
                     $('#btnN28').addClass('btn-danger')

                     swal({
                      title: "คำเตือน!",
                      text: "คุณมีโครงการวิจัยใหม่รอการตรวจสอบผลการพิจารณาจากผู้เชี่ยวชาญอิสระ",
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                 }, 'json')
  },
  checkStatus24: function(){

      var param = {
        id: current_user,
      }

      var param = $.post(ws_url + 'controller/ec/check-new-status-24.php', param, function(){},'json')
                   .always(function(snap){
                     console.log(snap);
                     var dt = $('#datable_1').dataTable().api();
                     if((snap!='') && (snap.length > 0)){


                       $('.NewStatus24').text('(' + snap.length +')')
                       $('#btnN3').addClass('btn-danger')

                       swal({
                        title: "คำเตือน!",
                        text: "คุณมีโครงการวิจัยใหม่รอการตรวจสอบผลการพิจารณาจากผู้เชี่ยวชาญอิสระ",
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
                           '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                   }, 'json')

  },
  checkStatus27: function(){

      var param = {
        id: current_user,
      }

      var param = $.post(ws_url + 'controller/ec/check-new-status-27.php', param, function(){},'json')
                   .always(function(snap){
                     console.log(snap);
                     var dt = $('#datable_1').dataTable().api();
                     if((snap!='') && (snap.length > 0)){


                       $('.NewStatus27').text('(' + snap.length +')')
                       $('#btnN4').addClass('btn-danger')

                       swal({
                        title: "คำเตือน!",
                        text: "คุณมีโครงการวิจัยใหม่รอการตรวจสอบผลการพิจารณาจากผู้เชี่ยวชาญอิสระ",
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
                           '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                   }, 'json')

  },
  checkNewInit: function(){
    var param = {
      id: current_user,
    }

    var param = $.post(ws_url + 'controller/ec/check-new-init.php', param, function(){},'json')
                 .always(function(snap){
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){


                     $('.NewRegister').text('(' + snap.length +')')
                     $('#btnN1').addClass('btn-danger')

                     swal({
                      title: "คำเตือน!",
                      text: "คุณมีโครงการวิจัยใหม่รอการตรวจสอบ กรุณาทำการตรวจสอบและดำเนินการ",
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
  checkCont3: function(){
    var param = {
      id: current_user,
    }

    var param = $.post(ws_url + 'controller/ec/check-cont-init.php', param, function(){},'json')
                 .always(function(snap){
                   if((snap != '') && (snap.length > 0)){
                     $('.c1').text('('+ snap.length  +')')
                     $('#btnc1').addClass('btn-danger')
                   }
                 }, 'json')
  },
  loadNewInit: function(){
    var param = $.post(ws_url + 'controller/ec/check-new-init.php', function(){},'json')
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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
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
                         '<span class="txt-danger">' + i.status_name + '</span>',
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
  loadNewCont_by_year: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-cont-by-year.php', param, function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){

                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       // console.log(i);

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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         // '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       var rpid = i.rp_id
                       var pid = i.rp_progress_id
                       var ref_id = (parseInt(i.id_year) + 41) + '-' + i.id_rs + '-' + rpid + '-' + pid;

                       $('#txt-ref').text(ref_id)

                       dt.row.add([
                         $c,
                         i.code_apdu,
                         ref_id,
                         '<a href="#" class="txt-dark f500" onclick="ecDoProgress(\'' + i.rp_progress_status + '\', \'' + i.rp_id + '\', \'' + i.rp_progress_id + '\')" >' + i.title_th + 's</a>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div style="font-size: 0.8em;">' +
                            '<a href="#" onclick="ecDoProgress(\'' + i.rp_progress_status + '\', \'' + i.rp_id + '\', \'' + i.rp_progress_id + '\')" class="txt-success"><i class="fa fa-wrench"></i> ดำเนินการต่อ</a>' +
                         '</div>',
                         '<span class="txt-danger">' + i.status_name + '</span>'
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  loadNewInit_by_year: function(){
    var param = {
      id: current_user,
      id_year: $('#txtYear').val()
    }
    var jxhr = $.post(ws_url + 'controller/ec/check-new-init-by-year.php', param, function(){},'json')
                 .always(function(snap){
                   // console.log(snap);
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){

                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){

                       // console.log(i);

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
                         '<button class="btn btn-primary btn-xs btn-icon-anim btn-square" onclick=viewRsInfo1("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ดูข้อมูลโครงการวิจัย"><i class="fa fa-search"></i></button>' +
                         // '<button class="btn btn-danger btn-xs btn-icon-anim btn-square" ' + $bt3 + ' onclick=widthdraw_research("' + i.id_rs +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                       '</div></div>';

                       var code = i.code_apdu;

                       dt.row.add([
                         $c,
                         i.code_apdu,
                         '<a href="#" class="txt-dark f500" onclick=viewRsInfo1("' + i.id_rs +'") >' + i.title_th + 's</a>' +
                         '<div style="font-size: 0.8em;">หัวหน้าโครงการ : ' + i.prefix_name + i.fname + ' ' + i.lname + '</div>' +
                         '<div style="font-size: 0.8em;">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(i.date_submit) + '</div>' +
                         '<div style="font-size: 0.8em;">' +
                            '<a href="#" onclick=viewRsInfo1("' + i.id_rs +'") class="txt-success"><i class="fa fa-wrench"></i> ดำเนินการต่อ</a>' +
                         '</div>',
                         i.ep,
                         '<span class="txt-danger">' + i.status_name + '</span>'
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{
                     dt.clear().draw();
                   }
                 }, 'json')
  },
  load_coa_content: function(){
    var param = {
      id: current_user,
      id_rs: current_rs_id
    }

    var jxhr = $.post(ws_url + 'controller/ec/coe_content.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap != '') && (snap.length > 0)){
                    snap.forEach(function(resp){
                      // editData.setData(resp.rfad_doc_content)
                      var str = resp.rai_full_content
                      var replaceString = str.replace(/txtPiDept/g, '')
                      replaceString = replaceString.replace(/txt-danger/g, 'txt-dark')
                      replaceString = replaceString.replace(/zmdi zmdi-edit/g, '')

                      // $('.coa_content').html(resp.rai_full_content)
                      $('.coa_content').html(replaceString)
                      $('#doc_round').val(resp.rai_round_meeting)
                      $('#txtReportRange').val(resp.rai_report_round)

                      // $('.coa_content').

                    })
                  }

                }, 'json')
  },
  load_rs_info_2: function(){
    var param = {
      id: current_user,
      sess: current_rs,
      id_rs: current_rs_id
    }
    var jxhr = $.post(ws_url + 'controller/staff/get-rs-info-2.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtIdrs').text(i.submit_year + '/' + i.id_rs )
                      $('#txtThtitle').text(i.title_th)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtThtitle2').text(i.title_th)
                      $('#txtEntitle2').text(i.title_en)
                      $('#txtEntitle').text(i.title_en)
                      $('#txtPi').text(i.prefix_name + i.fname + ' ' + i.lname)
                      $('#txtPi2').text(i.fname + ' ' + i.lname)
                      $('#txtThkeyword').text(i.keywords_th)
                      $('#txtEnkeyword').text(i.keywords_en)
                      $('#txtRtype').text(i.type_name)
                      $('#txtRTypess').text(i.rct_type)
                      $('#txtYear').val(i.id_year)
                      $('#txtDept').val(i.id_dept)

                      if(i.id_dept == '19'){
                        $('#txtPiDept').text(i.dept)
                      }else{
                        $('#txtPiDept').text(i.dept_name)
                      }

                      $('#txtPertype').val(i.id_personnel)
                      $('#txtCode').text(i.code_apdu)
                      $('.txtCode').text(i.code_apdu)

                      $('#txtIdCodeAPDURp').val(i.code_apdu)
                      window.localStorage.setItem('current_rs_email', i.email)
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
  }
}

function viewRsInfo6(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/ec/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_6.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
              })
}

function viewRsInfo24(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/ec/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_24.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
              })
}

function viewRsInfo27(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/ec/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_27.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
              })
}

function viewRsInfo28(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/ec/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_28.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
              })
}

function viewRsInfo1(rid){
  var param = {
    id_rs: rid,
    id: current_user
  }
  var jxhr = $.post(ws_url + '/controller/ec/check-rs-session.php', param, function(){}, 'json')
              .always(function(snap){
                if((snap != '') && (snap.length > 0)){
                  snap.forEach(function(i){
                    window.localStorage.setItem('current_selected_project_session', i.session_id)
                    window.localStorage.setItem('current_selected_project_id', i.id_rs)
                    window.location = 'research_info_1.html'
                  })
                }else{
                  swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
                }
              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่พบข้อมูลโครงการวิจัย กรุณาติดต่อเจ้าหน้าที่!", "error")
              })
}

function checkFileAttached(){
  // for(var i = 1; i <=8 ; i++){
  //   checkData(i);
  // }
  for(var i = 1; i <=15 ; i++){
    checkData(i);
  }
}

function checkData(i){

  $('#ft_att_' + i).empty()
  var response = $.post(ws_url + 'controller/staff/check_upload_file_research_registration.php', {doctype: i, session_id: current_rs}, function(){}, 'json')
                  .always(function(snap){
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

function checkReviewer(){
  var param = {
    id_rs: current_rs_id
  }

  var jxhr = $.post(ws_url + 'controller/staff/get_reviewer_review_list.php', param, function(){}, 'json')
              .always(function(snap){
                // console.log(snap);
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
                                         $('#Fbresult').html('<div>ยังไม่ระบุมติเข้าประชุม</div>')
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

function loadCHeckfile(ririd, ord){

  return ;

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

function checkReviewer_summary(){
  var param = {
    id_rs: current_rs_id
  }

  var jxhr = $.post(ws_url + 'controller/ec/load_summary_file.php', param, function(){}, 'json')
              .always(function(snap){

                console.log(snap);

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

function checkDataReplyToPiFile(){
  var param = {
    id: current_user,
    id_rs: current_rs_id
  }
  var response = $.post(ws_url + 'controller/ec/check_file_reply_to_pi.php', param, function(){}, 'json')
                  .always(function(snap){
                    if((snap != '') && (snap.length > 0)){
                      numreplyfile = 0;
                      $('#ft_ec_reply_to_pi').empty()
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
                                        '<a class="btn btn-block btn-danger" href="Javascript:deleteReplyToPi(' + childSnap.rfa_id + ')" target="_blank"><i class="fa fa-trash text-light mr-5"></i> <span class="hidden-sm">ลบ</span></a>' +
                                      '</div>' +
                                    '</div>' +
                                    '</li>';
                        $('#ft_ec_reply_to_pi').append(data);
                      })
                    }else{
                      $('#ft_ec_reply_to_pi').empty()
                    }
                  }, 'json')
                  .fail(function(){
                    $('#ft_assesment_reply').append('ยังไม่เชื่อมต่อฐานข้อมูลได้')
                  })
}

function deleteReplyToPi(did){

  var param = {
    id: current_user,
    id_rs: current_rs_id,
    fid: did
  }

  var jxhr = $.post(ws_url + 'controller/ec/delete_file_reply_to_pi.php', param, function(){})
              .always(function(resp){
                if(resp != 'Y'){
                  alert(resp)
                  checkDataReplyToPiFile()
                }
                checkDataReplyToPiFile()
              })


}

function ecDoProgress(pstatus, pid, progress){

  window.localStorage.setItem('current_progress_id', pid)
  window.localStorage.setItem('current_progress', progress)
  window.localStorage.setItem('current_progress_status', pstatus)

  window.location = 'progress_info.html'
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
