var admin = {
  init: function(){

    console.log('Checking user role ....');
    if((current_user == null) || (current_role == null) || (current_role != 'administrator')){
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
                  // console.log(snap);
                  if(snap != ''){

                    snap.forEach(function(childSnap){
                      $('.userFullname').text(childSnap.prefix_name + childSnap.fname + ' ' + childSnap.lname)
                      if(childSnap.profile == ''){
                        profile = '../v3/dist/img/user1.png'
                      }else{
                        profile = '../images/profile/' + childSnap.profile;
                      }

                      $( "#profileImg" ).html('<img src="'+ profile +'" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status">' );
                      $('.profileImg').html('<img class="inline-block mb-10" id="profileImg" src="'+ profile +'" alt="user" />')



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
  search_project: function(sk){

    console.log('s');
    var dt = $('#datable_1').dataTable().api();

    if(sk == ''){
      dt.clear().draw();
      return ;
    }

    var param = {
      searchkey: sk
    }

    var jxhr = $.post(ws_url + 'controller/staff/search_all_research.php', param, function(){}, 'json')
                .always(function(snap){

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
                                  '<button class="btn btn-primary btn-sm btn-icon-anim btn-square" onclick="setDataView(\'' + childSnap.id_rs +'\')"><i class="fa fa-search"></i></button>&nbsp; ' +
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
  load_all_reviewer: function(){
    var jxhr = $.post(ws_url + 'controller/administrator/get_all_reviewer.php', function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap.length != 0) && (snap != '')){
                    var dt = $('#datable_1').dataTable().api();
                    dt.clear().draw();
                    $c = 1;
                    snap.forEach(function(i){

                      var id_pm = 'ไม่ระบุ'
                      if(i.id_pm != ''){
                        id_pm = i.id_pm
                      }

                      var active_btn = '<a class="text-success" href="#" onclick="">เปิดใช้งานอยู่</a>'
                      if(i.allow_status == 0){
                        var active_btn = '<a class="text-danger" href="#" onclick="">ปิดใช้งานแล้ว</a>'
                      }

                      $reviewer_status = 'ภายใน'

                      if(i.reviewer_status == '1'){
                        $reviewer_status = 'ภายนอก'
                      }
                      
                      var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="add_report(\''  + i.id +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"><i class="fa fa-search"></i></button>' +
                        '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="update_info(\''  + i.id +  '\', \'reviewer_update.html\')" data-toggle="tooltip" data-placement="top" title="แก้ไข"><i class="zmdi zmdi-edit"></i></button>' +
                        '<button class="btn btn-danger btn-xs btn-icon-anim btn-square"  onclick=widthdraw_research("' + i.id +'") data-toggle="tooltip" data-placement="top" title="ลบ"><i class="fa fa-trash"></i></button>' +
                      '</div></div>';

                      dt.row.add([
                        $c,
                        '<a href="#">' + i.prefix_name + i.fname + ' ' + i.lname + '</a><div class="fs08"><strong>รหัสบุคคลากร : </strong> ' + id_pm + '<br><strong>E-mail : </strong> ' + i.email + '<br><strong>สถานะ : </strong> ' + $reviewer_status + '</div>',
                        active_btn ,
                        command_btn
                      ]);
                      $c++;
                    })
                    dt.draw();
                  }
                }, 'json')
                .fail(function(){
                  alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้')
                  window.location = './'
                })
  },
  load_all_ec: function(){
    var jxhr = $.post(ws_url + 'controller/administrator/get_all_ec.php', function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap.length != 0) && (snap != '')){
                    var dt = $('#datable_1').dataTable().api();
                    dt.clear().draw();
                    $c = 1;
                    snap.forEach(function(i){

                      var id_pm = 'ไม่ระบุ'
                      if(i.id_pm != ''){
                        id_pm = i.id_pm
                      }

                      var active_btn = '<a class="text-success" href="#" onclick="">เปิดใช้งานอยู่</a>'
                      if(i.allow_status == 0){
                        var active_btn = '<a class="text-danger" href="#" onclick="">ปิดใช้งานแล้ว</a>'
                      }

                      var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="add_report(\''  + i.account_id +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="fa fa-search"></i></button>' +
                        '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="add_report(\''  + i.account_id +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                        '<button class="btn btn-danger btn-xs btn-icon-anim btn-square"  onclick=widthdraw_research("' + i.account_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                      '</div></div>';

                      dt.row.add([
                        $c,
                        '<a href="#">' + i.prefix_name + i.fname + ' ' + i.lname + '</a><div class="fs08"><strong>รหัสบุคคลากร : </strong> ' + id_pm + '<br><strong>E-mail : </strong> ' + i.email + '</div>',
                        active_btn ,
                        command_btn
                      ]);
                      $c++;
                    })
                    dt.draw();
                  }
                }, 'json')
                .fail(function(){
                  alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้')
                  window.location = './'
                })
  },
  load_all_staff: function(){
    var jxhr = $.post(ws_url + 'controller/administrator/get_all_staff.php', function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if((snap.length != 0) && (snap != '')){
                    var dt = $('#datable_1').dataTable().api();
                    dt.clear().draw();
                    $c = 1;
                    snap.forEach(function(i){

                      var id_pm = 'ไม่ระบุ'
                      if(i.id_pm != ''){
                        id_pm = i.id_pm
                      }

                      var active_btn = '<a class="text-success" href="#" onclick="">เปิดใช้งานอยู่</a>'
                      if(i.allow_status == 0){
                        var active_btn = '<a class="text-danger" href="#" onclick="">ปิดใช้งานแล้ว</a>'
                      }

                      var command_btn = '<div class="text-center" style="width: 140px !important; float: right;"><div class="btn-group btn-group-xs" role="group">' +
                      '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="add_report(\''  + i.account_id +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="fa fa-search"></i></button>' +
                        '<button class="btn btn-primary btn-xs btn-icon-anim btn-square"  onclick="add_report(\''  + i.account_id +  '\', \'1\')" data-toggle="tooltip" data-placement="top" title="แก้ไขรายงาน"><i class="zmdi zmdi-edit"></i></button>' +
                        '<button class="btn btn-danger btn-xs btn-icon-anim btn-square"  onclick=widthdraw_research("' + i.account_id +'") data-toggle="tooltip" data-placement="top" title="ลบรายงาน"><i class="fa fa-trash"></i></button>' +
                      '</div></div>';

                      dt.row.add([
                        $c,
                        '<a href="#">' + i.prefix_name + i.fname + ' ' + i.lname + '</a><div class="fs08"><strong>รหัสบุคคลากร : </strong> ' + id_pm + '<br><strong>E-mail : </strong> ' + i.email + '</div>',
                        active_btn ,
                        command_btn
                      ]);
                      $c++;
                    })
                    dt.draw();
                  }
                }, 'json')
                .fail(function(){
                  alert('ไม่สามารถเชื่อมต่อฐานข้อมูลได้')
                  window.location = './'
                })
  }
}
