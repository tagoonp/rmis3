var root_domain = 'http://localhost/public_html/rmis3/';
var ws_url = 'http://localhost/public_html/rmis3/';


var root_domain = 'http://rmis2.medicine.psu.ac.th/rmis/';
var ws_url = 'http://rmis2.medicine.psu.ac.th/rmis/';

var emailProvider = 'https://wisniorproject.com/nservice/mailer/email-service.php'

var emailConfig = {
  user: "rmismedpsu@gmail.com",
  key: "idj&skeoXf2**r123X"
}
var current_user = window.localStorage.getItem('rmis_current_user')
var current_user_fullname = '';
var current_user_id = '';
var profile = '';

var thmonth = new Array ("", "มกราคม","กุมภาพันธ์","มีนาคม",
"เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
"ตุลาคม","พฤศจิกายน","ธันวาคม");

var thmonth_sh = new Array ("", "ม.ค.","ก.พ.","มี.ค.",
"เม.ย.","พ.ค.","มิ.ย.", "ก.ค.","ส.ค.","ก.ย.",
"ต.ค.","พ.ย.","ธ.ค.");

var enmonth = new Array ("", "January","February","March",
"April","May","June", "July","August","September",
"October","November","December");

var enmonth_sh = new Array ("", "Jan","Feb","Mar",
"Apr","May","Jun", "Jul","Aug","Sep",
"Oct","Nov","Dec");

$('.page-wrapper').addClass('ml-0')
$('.fixed-sidebar-left').hide()
$('.alert-drp').hide()

$.ajaxSetup({cache: false});

var main = {
  inbox: function(){
    swal("ขออภัย!", "ฟังก์ชันนี้ยังไม่เปิดให้ใช้งาน", "error")
  },
  init: function(role, user, pages){
    // Set access log
    var param = {
      lrole: role,
      luser: user,
      lpage: pages
    }
    $.post(ws_url + 'set_access_log.php', param, function(){})
    // End set access log


  },
  init_log: function(u, i, desc){
    var param = {
      id: current_user,
      lactivity: i,
      ldesc: desc,
      role: current_role
    }
    $.post(ws_url + 'controller/set_log.php', param, function(){})
  },
  init_pm: function(){

    var param = {
      email: current_user
    }

    // console.log(param);

    var jxhr = $.post(ws_url + 'get_current_user_pm.php', param, function(){}, 'json')
               .always(function(snap){

                //  console.log(snap);

                 if(snap!=''){
                   snap.forEach(function(childSnap){
                     $('#txtEmailPM').val(childSnap.email)
                     current_user_fullname = childSnap.prefix_name + childSnap.name + ' ' + childSnap.surname
                     current_user_id = childSnap.id_pm;
                     $('#profileImg').html('<img src="../images/profile/' + childSnap.profile_img + '" alt="user_auth" class="user-auth-img img-circle"/>')
                     $('.profileImgc').html('<img src="../images/profile/' + childSnap.profile_img + '" alt="user_auth" class="user-auth-img"/>')

                     $('#txtPrefix').val(childSnap.id_prefix);
                     $('#txtFname').val(childSnap.name);
                     $('#txtLname').val(childSnap.surname);
                     $('#txtType').val(childSnap.id_personnel);
                     $('#txtDept').val(childSnap.id_dept);
                     $('#txtExpertize').val(childSnap.expertise);
                     $('#txtResearch').val(childSnap.rs_interest);
                     $('#txtAddress').val(childSnap.address);
                     $('#txtMobile').val(childSnap.tel_mobile);
                     $('#txtOffice').val(childSnap.tel_office);
                     $('#txtFax').val(childSnap.tel_fax);
                     $('#txtEmail').val(childSnap.email);

                   })

                   if(current_page!=null){
                     if(current_page == 'profile'){
                       $('#txtPrefix').selectpicker('refresh');
                       $('#txtType').selectpicker('refresh');
                       $('#txtDept').selectpicker('refresh');
                     }
                   }



                   $('.userFullname').text(current_user_fullname)

                 }else{
                   if(current_user==null){
                     swal({
                       title: "Session timeout",
                       text: "กด ตกลง เพื่อเข้าสู่ระบบ",
                       type: "warning",
                       showCancelButton: false,
                       confirmButtonColor: "#DD6B55",
                       confirmButtonText: "ตกลง",
                       closeOnConfirm: false },
                     function(){
                       window.location = root_domain
                     });

                     return ;
                   }
                 }
               }, 'json')
  },
  init_staff: function(){

    var param = {
      email: current_user
    }

    var jxhr = $.post(ws_url + 'get_current_user_staff.php', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if(snap!=''){
                   snap.forEach(function(childSnap){
                     current_user_fullname = childSnap.fname_off
                     current_user_id = childSnap.id_off;
                   })

                   $('.userFullname').text(current_user_fullname)

                 }else{
                   if(current_user==null){
                     swal({
                       title: "Session timeout",
                       text: "กด ตกลง เพื่อเข้าสู่ระบบ",
                       type: "warning",
                       showCancelButton: false,
                       confirmButtonColor: "#DD6B55",
                       confirmButtonText: "ตกลง",
                       closeOnConfirm: false },
                     function(){
                       window.location = root_domain
                     });

                     return ;
                   }
                 }
               }, 'json')
  },
  init_personnel: function(){
    var param = {
      id_personnel: current_user
    }
    var jxhr = $.post(ws_url + 'get_current_user_personnel.php', param,function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  if(snap==''){
                    swal({
                      title: "ขออภัย",
                      text: "ไม่พบข้อมูลในฐานบุคลากร กรุณาติดต่อเจ้าหน้าที่",
                      type: "error",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "กลับสู่หน้าหลัก",
                      closeOnConfirm: false
                    },
                    function(){
                      window.location = '../'
                    });
                  }else{
                    snap.forEach(function(childSnap){
                      $('.userFullname').text(childSnap.name + ' ' + childSnap.surname)

                      $('#txtFname').val(childSnap.name)
                      $('#txtLname').val(childSnap.surname)
                    })
                  }
                })
  },
  load_researchtype: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_researchtype.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtResearchType').append('<option value="' + item.id_type +'">' + item.type_name + '</option>')
                    })
                    $('#txtResearchType').selectpicker('refresh');

                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }else{

                  }
                }, 'json')
  },
  load_reviewer: function(){
    var jxhr = $.post(ws_url + 'controller/ec/get_all_reviewer.php', function(){}, 'json')
                .always(function(snap){
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(item){
                      $('#txtRw').append('<option value="' + item.id +'">' +  item.fname + ' ' + item.lname + '</option>')
                    })

                  }
                })
  },
  load_year: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_year.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtYear').append('<option value="' + item.id_year +'">' + item.year_name + '</option>')
                    })
                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  load_prefix: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_prefix.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtPrefix').append('<option value="' + item.id_prefix +'">' + item.prefix_name + '</option>')
                      $('#copi_prefix').append('<option value="' + item.id_prefix +'">' + item.prefix_name + '</option>')
                    })
                    // $('#txtPrefix').selectpicker('refresh');

                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  load_in_dept: function(){
    var jxhr = $.post(ws_url + 'get_all_dept.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtDept').append('<option value="' + item.id_dept +'">' + item.dept_name + '</option>')
                    })
                    $('#txtDept').selectpicker('refresh');

                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  load_personnel_type: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_personnel_type.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtPosition').append('<option value="' + item.id_personnel +'">' + item.personnel_name + '</option>')
                    })
                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  load_personnel_type_2: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_personnel_type.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      if((item.id_personnel == '7') || (item.id_personnel == '8')){

                      }else{
                        $('#txtPosition').append('<option value="' + item.id_personnel +'">' + item.personnel_name + '</option>')
                      }

                    })


                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  load_department: function(){
    var jxhr = $.post(ws_url + 'controller/get_all_dept.php', function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(item){
                      $('#txtDept').append('<option value="' + item.id_dept +'">' + item.dept_name + '</option>')
                    })

                    setTimeout(function(){
                      $('.loaddiv').addClass('dn')
                      $('.contentdiv').removeClass('dn')
                    }, 2000)
                  }
                })
  },
  clear_notify: function(){
    console.log('Loading notification ...');
    var param = {
      user: current_user
    }
    var jxhr = $.post(ws_url + 'controller/set_notify_read.php', param, function(){})
    $('.notification_panal').empty();
    $('.notification_number').html('');
  },
  load_notify_pm: function(){
    console.log('Loading notification ...');
    var param = {
      user: current_user
    }
    var jxhr = $.post(ws_url + 'controller/get_notify_unread_list.php', param, function(){}, 'json')
                .always(function(snap){

                  if(snap!=''){
                    $num = 0;
                    snap.forEach(function(i){

                      $icon = '<div class="sl-avatar"><img class="img-responsive" src="' + window.localStorage.getItem('rmis_current_user_profile') +'" alt="avatar"/></div>'

                      if(i.log_activity == 'signin'){

                        $icon = '<div class="icon bg-blue">' +
                                  '<i class="fa fa-sign-in"></i>' +
                                '</div>'

                      }else if(i.log_activity == 'update profile'){
                        $icon = '<div class="icon bg-blue">' +
                                  '<i class="zmdi zmdi-account"></i>' +
                                '</div>'
                      }else if(i.log_activity == 'changepassword'){
                        $icon = '<div class="icon bg-green">' +
                                  '<i class="zmdi zmdi-key"></i>' +
                                '</div>'
                      }else if((i.log_activity == 'signout') || (i.log_activity == 'logout')){
                        $icon = '<div class="icon bg-red">' +
                                  '<i class="fa fa-sign-out"></i>' +
                                '</div>'
                      }

                      $title = window.localStorage.getItem('rmis_current_user_fullname');
                      var arr = [ "signin", "update profile", "changepassword", 'signout' ];
                      var checkStatus = 0;
                      arr.forEach(function(b){
                        if(b == i.log_activity){
                          checkStatus++;
                        }
                      })

                      if(checkStatus == 0){
                        $title = 'สำนักงาน REC';
                        $icon = '<div class="sl-avatar"><img class="img-responsive" src="../images/hrec-not.jpg" alt="avatar"/></div>'
                      }

                      $buffer = '<div class="sl-item">' +
                        '<a href="javascript:void(0)">' +
                          $icon +
                          '<div class="sl-content">' +
                            '<span class="inline-block capitalize-font  pull-left truncate head-notifications">' + $title +'</span>' +
                            '<span class="inline-block font-11  pull-right notifications-time">' + main_app.convertThaidate2(i.log_datetime) +'</span>' +
                            '<div class="clearfix"></div>' +
                            '<p class="truncate">' + i.log_detail + '</p>' +
                          '</div>' +
                        '</a>' +
                      '</div>' +
                      '<hr class="light-grey-hr ma-0"/>';
                      $('.notification_panal').append($buffer);
                      $num++;
                    })

                    $('.notification_number').html('<span class="top-nav-icon-badge">' + $num + '</span>');
                  }else{
                    $('.notification_panal').html('<div class="sl-item_ ma-20">ไม่มีรายการแจ้งเตือน</div>');
                  }
                }, 'json')

  },
  send_email: function(param, nextStage, successText, failText){

    lp.sl()

    var jxr = $.post('http://simanh.psu.ac.th/icustomsystem/mailer/sender.php', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   swal({
                     title: "ดำเนินการสำเร็จ",
                     text: successText,
                     type: "success",
                     showCancelButton: false,
                     confirmButtonColor: "#126cd5",
                     confirmButtonText: "ตกลง",
                     closeOnConfirm: true
                   },
                   function(){

                     if(nextStage == 'reload'){
                        window.location.reload();
                     }else{
                       window.location = nextStage
                     }

                   });
                 }else{
                   swal({
                     title: "คำเตือน",
                     text: failText,
                     type: "warning",
                     showCancelButton: false,
                     confirmButtonColor: "#126cd5",
                     confirmButtonText: "ตกลง",
                     closeOnConfirm: true
                   },
                   function(){
                     if(nextStage == 'reload'){
                        window.location.reload();
                     }else{
                       window.location = nextStage
                     }
                   });
                 }
               })
               .fail(function(){
                 swal({
                   title: "คำเตือน",
                   text: "เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข",
                   type: "warning",
                   showCancelButton: false,
                   confirmButtonColor: "#126cd5",
                   confirmButtonText: "ตกลง",
                   closeOnConfirm: true
                 },
                 function(){
                   if(nextStage == 'reload'){
                      window.location.reload();
                   }else{
                     window.location = nextStage
                   }
                 });
               })
  },
  changepassword: function(){
    var param = {
      id: current_user,
      role: current_role,
      newpassword: $('#txtNewpwd').val()
    }
    var jxhr = $.post(ws_url + 'controller/update_password.php', param, function(){})
              .always(function(resp){

                if(resp == 'Y'){

                  var dataContent = '<h3>ข้อมูลปรับปรุงรหัสผ่านเพื่อเข้าใช้งานระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS) </h3>' +
                                    '<p>เรียน ' + $('.userFullname').text() + '</p>' +
                                    '<p>เนื่องจากการที่ท่านได้ทำการปรับปรุงรหัสผ่านสำหรับการเข้าใช้งานระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS) ไว้นั้น บัดนี้ ระบบได้ส่งข้อมูลรหัสผ่านใหม่ของท่านมา ณ ที่นี่ ซึ่งรหัสผ่านของท่านปัจจุบัน คือ' +
                                    '</p>' +
                                    '<p>ชื่อบัญชีผู้ใช้ : ' + window.localStorage.getItem('rmis_current_user_email') + '<br>รหัสผ่านใหม่ <span style="color:red;">: ' + $('#txtNewpwd').val() + '<span></p>' +
                                    '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>'

                  var param = {
                    title: 'ข้อมูลปรับปรุงรหัสผ่านเพื่อเข้าใช้งานระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)',
                    content: dataContent,
                    user: 'tagoon.p@gmail.com',
                    key: 'idj&skeoXf2**r123X',
                    toemail: window.localStorage.getItem('rmis_current_user_email'),
                    toname: $('.userFullname').text()
                  }

                  main.send_email(param, 'reload', 'ท่านได้ทำการปรับปรุงรหัสผ่านสำเร็จแล้ว ทั้งนี้ ระบบจะส่งข้อมูลรหัสผ่านใหม่ของท่านไปยังอีเมล์', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                  return ;

                  var emailParam = {
                    email: emailConfig.user,
                    api_key: emailConfig.key,
                    title: "{ No-reply } ข้อมูลปรับปรุงรหัสผ่านเพื่อเข้าใช้งานระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)",
                    to_email: window.localStorage.getItem('rmis_current_user_email'),
                    content: dataContent
                  }
                  var jxhr = $.post(emailProvider, emailParam, function(){})
                              .always(function(res){
                                if(res!='Y'){
                                  // main_app.emailErr('Change password', window.localStorage.getItem('rmis_current_user_email'))
                                }
                              })

                  swal({
                    title: "ดำเนินการสำเร็จ",
                    text: "ท่านได้ทำการปรับปรุงรหัสผ่านสำเร็จแล้ว ทั้งนี้ ระบบจะส่งข้อมูลรหัสผ่านใหม่ของท่านไปยังอีเมล์",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#126cd5",
                    confirmButtonText: "ตกลง",
                    closeOnConfirm: false
                  },
                  function(){
                    window.location.reload();
                  });
                }else{
                  $('.contentdiv').removeClass('dn')
                  $('.loaddiv').addClass('dn')
                  swal("ขออภัย", "ไม่สามารถแก้ไขรหัสผ่านได้ กรุณาลองใหม่อีกครั้ง หรือติดต่อเจ้าหน้าที่", "error")
                  return ;
                }
              })
  },
  signout: function(){
    swal({
      title: "ออกจากระบบ",
      text: "คุณยืนยันที่จะออกจากระบบหรือไม่? กด 'ตกลง' เพื่อออกจากระบบ",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "ตกลง",
      cancelButtonText: "ยกเลิก",
      closeOnConfirm: false
    },
    function(){

      if(current_role == 'pm'){
        main.init_log(current_user, 'logout', 'คุณได้ออกจากระบบ');
      }

      localStorage.clear();
      window.localStorage.removeItem('rmis_current_user');
      window.location = '../'
    });
  },
  mailbox: function(){
    swal("ขออภัย!", "ฟังก์ชันนี้ยังไม่เปิดใช้งาน!", "error")
  }
}

var main_app = {

  convertThaidatetime: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + thmonth[parseInt(cdate[1])] + ' ' + (parseInt(cdate[0]) + 543) + ' ' + a[1];
  },
  convertThaidate: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + thmonth[parseInt(cdate[1])] + ' พ.ศ. ' + (parseInt(cdate[0]) + 543);
  },
  convertThaidate2: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + thmonth_sh[parseInt(cdate[1])] + ' ' + ((parseInt(cdate[0]) + 543).toString()).substring(2,4);
  },
  convertEndatetime: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + enmonth[parseInt(cdate[1])] + ', ' + (parseInt(cdate[0])) + ' ' + a[1];
  },
  convertEndate: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + enmonth[parseInt(cdate[1])] + ', ' + (parseInt(cdate[0]));
  },
  convertEnThaidate2: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + enmonth_sh[parseInt(cdate[1])] + ', ' + ((parseInt(cdate[0])).toString()).substring(2,4);
  },
  randomString: function(L){
    var s = '';
    var randomchar = function() {
      var n = Math.floor(Math.random() * 62);
      if (n < 10) return n; //1-10
      if (n < 36) return String.fromCharCode(n + 55); //A-Z
      return String.fromCharCode(n + 61); //a-z
    }
    while (s.length < L) s += randomchar();
    return s;
  },
  randomNumber: function(){
    return Math.floor((Math.random() * 99999) + 1);
  },
  check_dateformat: function(datevalue){
    var res = datevalue.split("-");
    if(res.length > 0){
      if(res[0].length > 2){
        return (parseInt(res[0]) - 543) + '-' + res[1] + '-' + res[2];
      }else{
        return (parseInt(res[2]) - 543) + '-' + res[1] + '-' + res[0];
      }
    }else{
      return datevalue;
    }
  },
  calDateDiff: function(start, end){
    // Here are the two dates to compare
    var date1 = start;
    var date2 = end;
    // console.log(date1);

    // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
    date1 = date1.split('-');
    date2 = date2.split('-');

    // Now we convert the array to a Date object, which has several helpful methods
    date1 = new Date(date1[0], date1[1], date1[2]);
    date2 = new Date(date2[0], date2[1], date2[2]);

    // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);

    // This is the calculated difference in seconds
    var timeDifference = date2_unixtime - date1_unixtime;

    // in Hours
    var timeDifferenceInHours = timeDifference / 60 / 60;

    // and finaly, in days :)
    var timeDifferenceInDays = timeDifferenceInHours  / 24;

    return timeDifferenceInDays;
  },
  load_rs_info: function(id_rs_input){
    var param = {
      id_rs: id_rs_input
    }

    var jxhr = $.post(ws_url + 'get_current_rs_info.php', param, function(){}, 'json')
                .always(function(snap){
                  if(snap!=''){
                    snap.forEach(function(childSnap){
                      $('.txtTitleEN').text(childSnap.title_en)
                      $('.txtTitleTH').text(childSnap.title_th)
                      $('#txtTtTh').val(childSnap.title_th)
                      $('#txtTtEn').val(childSnap.title_en)
                    })
                  }else{
                    alert('Research not found!');
                  }
                })
  },
  emailErr: function(stage, toEmail){
    var param = {
      email: toEmail,
      reason: stage
    }
    var jxhr = $.post(ws_url + 'set_email_err_log.php', param, function(){}, 'json')
  }
}




function get_today_date(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!

  var yyyy = today.getFullYear();
  if(dd<10){
      dd='0'+dd;
  }
  if(mm<10){
      mm='0'+mm;
  }
  var today = yyyy+'-'+mm+'-'+dd;
  return today;
}

var lp = {
  sl: function(){
    $('.ld').show()
    $('.cd').hide()
    $('.loaddiv').removeClass('dn')
    $('.contentdiv').addClass('dn')
  },
  hl: function(){
    $('.ld').hide()
    $('.cd').show()
    $('.loaddiv').addClass('dn')
    $('.contentdiv').removeClass('dn')
  }
}

function printForm(divName){
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}

function setInfoReply(idrs){
  var param = {
    id_rs: idrs,
    id: current_user
  }

  var jxhr = $.post(ws_url + 'controller/get-log-reply-once.php', param, function(){}, 'json')
              .always(function(resp){
                // console.log();

                if((resp != '') && (resp.length > 0)){
                  resp.forEach(function(i){
                    $('#replyMsg').html(i.log_detail);
                  })

                  var jxhr2 = $.post(ws_url + 'controller/ec/check_file_reply_to_pi.php', param, function(){}, 'json')
                                .always(function(snap){
                                  console.log(snap);
                                  if((snap != '') && (snap.length > 0)){
                                    snap.forEach(function(childSnap){

                                      // console.log(childSnap.rfa_filefullpart);
                                      var data = '<li class="mb-5">' +
                                                  '<div class="row" style="border: solid; border-width: 0px 0px 0px 0px; border-color: rgb(136, 136, 136); padding: 10px 0px; background: rgb(245, 244, 244);">' +
                                                    '<div class="col-sm-8">' +
                                                      '<a class="f500 txt-dark" href="' + childSnap.rfa_filefullpart + '" target="_blank" style="font-size: 1.2em;">' + childSnap.rfa_filename + '</a>' +
                                                    '</div>' +
                                                    '<div class="col-sm-2">' +
                                                      '<a class="btn btn-block btn-success" href="' + childSnap.rfa_filefullpart + '" target="_blank"><i class="fa fa-download text-light mr-5"></i></a>' +
                                                    '</div>' +
                                                  '</div>' +
                                                  '</li>';
                                      $('#replyMsg').append(data);

                                  })
                                }
                                }, 'json')

                }else{
                  $('#replyMsg').html('<p>ไม่พบข้อมูล</p>');
                }

              }, 'json')
              .fail(function(){
                swal("เกิดข้อผิดพลาด!", "ไม่สามารถเชื่มอต่อฐานข้อมูลได้", "error")
              })
}
