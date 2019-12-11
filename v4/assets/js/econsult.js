var current_select_user = window.localStorage.getItem(config.prefix + '_select_user')
var current_user = window.localStorage.getItem(config.prefix + '_uid')
var current_select_research = window.localStorage.getItem(config.prefix + '_select_research')
var ecs = {
  load_users: function(){
    var jxr = $.post(config.ws_url + 'load_user.php', function(){}, 'json')
              .always(function(snap){
                if(fnc.checksnap(snap)){
                  $('.table_response').empty()
                  snap.forEach(function(i){

                    $btn = '<button class="btn btn-secondary btn-square btn-sm mr-5"><i class="fas fa-pencil-alt"></i></button>' +
                           '<button class="btn btn-secondary btn-square btn-sm mr-5" onclick="manageConsultperson(\'' + i.uid + '\')"><i class="fas fa-search"></i></button>' +
                           '<button class="btn btn-danger btn-square btn-sm"><i class="fas fa-trash"></i></button>'

                    $data = '<tr>' +
                               '<td>' + i.fname + ' ' + i.lname +
                                 '<div style="font-size: 0.8em;">E-amil : ' + i.email + '</div>' +
                                 '<div class="pt-10"></div>' +
                               '</td>' +
                               '<td></td>' +
                               '<td class="text-right">' + $btn + '</td>' +
                            '</tr>'
                    $('.table_response').append($data)
                  })
                  preload.hide()
                }else{
                  preload.hide()
                }
              })
  },
  load_author_form: function(){
    var jxr = $.post(config.ws_url + 'load_author.php', function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   $('.table_response').empty()
                   $select = '<option value="nsecific">ไม่ระบุเจาะจงผู้ให้คำปรึกษา - Not specific author</option>'
                   $('#txtAuthor').append($select)

                   snap.forEach(function(i){
                     $select = '<option value="' + i.uid + '">' + i.fname + ' ' + i.lname + '</option>'
                     $('#txtAuthor').append($select)
                   })
                   preload.hide()
                 }else{
                   preload.hide()
                 }
               })
  },
  load_author: function(){
    var jxr = $.post(config.ws_url + 'load_author.php', function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   $('.table_response').empty()
                   snap.forEach(function(i){

                     $btn = '<button class="btn btn-secondary btn-square btn-sm mr-5"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button class="btn btn-danger btn-square btn-sm"><i class="fas fa-trash"></i></button>'

                     $data = '<tr>' +
                                '<td>' + i.fname + ' ' + i.lname +
                                  '<div style="font-size: 0.8em;">' + i.expertise + '</div>' +
                                  '<div class="pt-10">' + $btn + '</div>' +
                                '</td>' +
                                '<td>' + i.acc_regdate + '</td>' +
                             '</tr>'
                     $('.table_response').append($data)

                     $select = '<option value="' + i.uid + '">' + i.fname + ' ' + i.lname + '</option>'
                     $('#txtAuthor').append($select)
                   })
                   preload.hide()
                 }else{
                   preload.hide()
                 }
               })
  },
  load_department: function(){
    var jxr = $.post(config.ws_url + 'load_department.php', function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   $('.table_response').empty()
                   snap.forEach(function(i){

                     $btn = '<button class="btn btn-secondary btn-square btn-sm mr-5"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button class="btn btn-danger btn-square btn-sm"><i class="fas fa-trash"></i></button>'

                     $data = '<tr>' +
                                '<td> [' + i.id_dept + '] ' + i.dept_name + '</td>' +
                                '<td>' + i.dept_status + '</td>' +
                                '<td class="text-center">' + $btn + '</td>' +
                             '</tr>'
                     $('.table_response').append($data)

                     $data2 = '<option value="' + i.id_dept + '">' + i.dept_name + '</option>'

                     $('#txtDepartment').append($data2)
                   })
                   preload.hide()
                 }else{
                   preload.hide()
                 }
               })
  },
  check_await_app: function(){
    var param = {
      uid: current_select_user,
      pid: current_select_research
    }
    var jxr = $.post(config.ws_url + 'check_await_app.php', param, function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   $('.appointment_div').addClass('dn')
                   $('.await_div').removeClass('dn')
                   $('.table_response_2').empty()
                   snap.forEach(function(i){
                      console.log(i);

                      $btn = '<button class="btn btn-secondary btn-square btn-sm mr-5"><i class="fas fa-pencil-alt"></i> Update appointment</button>' +
                             '<button class="btn btn-secondary btn-square btn-sm mr-5" data-toggle="modal" data-target=".bs-example-modal-lg-calendar"><i class="fas fa-calendar"></i> View calendar</button>' +
                             '<button class="btn btn-danger btn-square btn-sm" onclick="deleteAppointmentAwait(\'' + i.aw_id + '\')"><i class="fas fa-trash"></i> Withdrawn</button>'

                      $data = '<tr>' +
                                '<td>' + i.aw_session_id + '<div class="pt-10">' + $btn +'</div></td>' +
                                '<td>' + i.aw_create_datetime + '</td>' +
                              '</tr>'

                      $('.table_response_2').append($data)
                   })
                 }
               })
  },
  load_project_info: function(id){
    var param = {
      pid: id
    }
    var jxr = $.post(config.ws_url + 'get_project_info.php', param, function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   snap.forEach(function(i){
                     $('#textProjecttitle').text(i.et_title)
                     $('#textProjectfunding').text(i.et_fund)
                   })
                 }else{
                   alert('No project found')
                   window.history.back()
                 }
               })
  },
  load_project_appointment: function(id){
    var param = {
      uid: current_select_user,
      pid: current_select_research
    }

    var jxr = $.post(config.ws_url + 'list_appoinment.php', param, function(){}, 'json')
               .always(function(snap){
                 if(fnc.checksnap(snap)){
                   $('.table_response_1').empty()
                   console.log(snap);
                   if(snap.length >= 3){
                     $('.appSessionRound').text(3 - snap.length)
                     $('#btnViewCalendar').addClass('dn', 'dn')
                     $('#alertDiv').toggleClass('alert-danger')
                     $('#delvas').removeClass('dn')
                     $('#inlvas').addClass('dn')
                   }else{
                     $('.appSessionRound').text(3 - snap.length)
                   }
                   snap.forEach(function(i){

                     $btn = '<button class="btn btn-secondary btn-square btn-sm mr-5"><i class="fas fa-pencil-alt"></i> Edit</button>' +
                            '<button class="btn btn-danger btn-square btn-sm" onclick="deleteAppointment(\'' + i.app_id + '\')"><i class="fas fa-trash"></i> Delete</button>'

                     $app_person = i.fname + ' ' + i.lname
                     if(i.app_author == 'nsecific'){
                       $app_person = 'ไม่ระบุ (Not specific author)'
                     }
                     $data = '<tr>' +
                               '<td>' + $app_person + '<div class="pt-10">' + $btn +'</div></td>' +
                               '<td>' + i.app_date + '</td>' +
                               '<td>' + i.app_start_value + '</td>' +
                               '<td>' + i.app_end_value + '</td>' +
                             '</tr>'
                     $('.table_response_1').append($data)
                   })
                 }else{

                 }
               })
  },
  load_project: function(id){
    var param = {
      uid: id
    }
    if(id == null){
      param = {
        uid: ''
      }
    }

    var jsr = $.post(config.ws_url + 'load_project.php', param, function(){}, 'json')
               .always(function(snap){
                 $('.table_response_1').empty()
                 $('.table_response_1_p').empty()
                 if(fnc.checksnap(snap)){
                   snap.forEach(function(i){
                     $btn = '<button class="btn btn-sm btm-square btn-secondary mr-5"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button class="btn btn-sm btm-square btn-secondary mr-5" onclick="manageConsultproject(\'' + i.et_id + '\')"><i class="fas fa-search"></i></button>' +
                            '<button class="btn btn-sm btm-square btn-danger mr-5"><i class="fas fa-trash"></i></button>'
                     $data = '<tr>' +
                                '<td><span style="font-weight: 500;" class="text-primary">' + i.et_title + '</span>' +
                                  '<div style="font-size: 0.8em;">' +
                                    'Funding source : ' + i.et_fund + '<br>' +
                                    'Last update : ' + i.et_regdate +
                                  '</div>' +
                                '</td>' +
                                '<td class="text-right">' + $btn + '</td>' +
                             '</tr>'
                     $('.table_response_1').append($data)

                     $btn = '<button class="btn btn-sm btm-square btn-secondary mr-5"><i class="fas fa-pencil-alt"></i> Edit</button>' +
                            '<button class="btn btn-sm btm-square btn-secondary mr-5" onclick="manageConsultproject(\'' + i.et_id + '\')"><i class="fas fa-wrench"></i> Project management</button>' +
                            '<button class="btn btn-sm btm-square btn-danger mr-5" onclick="deleteProject(\'' + i.et_id + '\')"><i class="fas fa-trash"></i> Delete</button>'

                     $data2 = '<tr>' +
                                '<td><span style="font-weight: 500;" class="text-primary">' + i.et_title + '</span>' +
                                  '<div style="font-size: 0.8em;">' +
                                    'Funding source : ' + i.et_fund +
                                  '</div>' +
                                  '<div class="pt-5">' + $btn + '</div>' +
                                  '<td class="text-left">' + i.et_regdate + '</td>' +
                                '</td>' +
                             '</tr>'
                     $('.table_response_1_p').append($data2)
                   })
                   preload.hide()
                 }else{

                 }
               })
  }
}

function confirm_appointment(){
  preload.show()
  var param = {
    uid: current_select_user,
    pid: current_select_research
  }

  var jsr = $.post(config.ws_url + 'confirm_appointment.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 // preload.hide()
                 // alert('Appointment send!')
                 // window.location.reload()

                 // Send email to staff
                 var jsr2 = $.post(config.ws_url + 'get_appointment_nofity.php', param, function(){}, 'json')
                             .always(function(snap){
                               if(fnc.checksnap(snap)){
                                 var sended_email = [];
                                 snap.forEach(function(i){
                                   if(i.app_author == 'nsecific'){
                                     var dataContent = '<h3>New appointment notification</h3>' +
                                                       '<p>Dear consultation coordinator</p>' +
                                                       '<p>You have an appoiment record, please login to e-consultation system and check this appointment</p>' +
                                                       '<p>Regards,<br>Epidemiology Unit e-Consultation System</p>'

                                     var param_email = {
                                       title: 'New appointment notification',
                                       content: dataContent,
                                       key: mailer_config.api_key,
                                       toemail: 'wansabay@hotmail.com',
                                       toname: 'K.Walailuk Jitpiboon'
                                     }

                                     if(sended_email.includes(i.email)){

                                     }else{
                                       sended_email.push(i.email)
                                       mailer_fnc.send(param_email, false, '', '', '')
                                     }


                                   }else{
                                     var dataContent = '<h3>New appointment notification</h3>' +
                                                       '<p>Dear ' + i.fname + ' ' + i.lname + '</p>' +
                                                       '<p>You have an appoiment record, please login to e-consultation system and check this appointment</p>' +
                                                       '<p>Regards,<br>Epidemiology Unit e-Consultation System</p>'

                                     var param_email = {
                                       title: 'New appointment notification',
                                       content: dataContent,
                                       key: mailer_config.api_key,
                                       toemail: i.email,
                                       toname: i.fname + ' ' + i.lname
                                     }

                                     if(sended_email.includes(i.email)){

                                     }else{
                                       sended_email.push(i.email)
                                       mailer_fnc.send(param_email, false, '', '', '')
                                     }
                                   }
                                 })

                                 setTimeout(function(){
                                   alert('Appointment send!')
                                   window.location.reload()
                                 }, 3000)
                               }else{
                                 preload.hide()
                                 alert('Appointment send!')
                                 window.location.reload()
                               }
                             })
               }else{
                 alert('Error')
                 preload.hide()
               }
             })
}

function manageConsultperson(id){
  window.localStorage.setItem(config.prefix + '_select_user', id)
  window.location = 'user_manage.html'
}

function manageConsultproject(id){
  // console.log(id);
  // return ;
  window.localStorage.setItem(config.prefix + '_select_research', id)
  window.location = 'user_research_manage.html'
}

function create_project(){
  setTimeout(function(){
    $('#txtProjectTitle').focus()
  }, 500)
}

function saveAppointment(){
  var check = 0;
  $('.form-control').removeClass('is-invalid')
  $('.invalid-feedback').remove()
  $('#hdRq').css('background', 'rgb(245, 245, 245)')
  $('#hdRq').css('border-color', 'rgb(210, 210, 210)')

  if($('#txtAuthor').val() == ''){
    check++
    $('#txtAuthor').addClass('is-invalid')
  }

  if($('#txtAppDate').val() == ''){
    check++
    $('#txtAppDate').addClass('is-invalid')
  }

  if($('#txtStarttime').val() == ''){
    check++
    $('#txtStarttime').addClass('is-invalid')
  }

  if($('#txtEndtime').val() == ''){
    check++
    $('#txtEndtime').addClass('is-invalid')
  }

  $cb1 = 0; $cb2 = 0; $cb3 = 0; $cb4 = 0; $cb5 = 0; $cb6 = 0; $cb7 = 0;

  if ($('#checkbox_1').is(':checked')){ $cb1 = 1; }
  if ($('#checkbox_2').is(':checked')){ $cb2 = 1; }
  if ($('#checkbox_3').is(':checked')){ $cb3 = 1; }
  if ($('#checkbox_4').is(':checked')){ $cb4 = 1; }
  if ($('#checkbox_5').is(':checked')){ $cb5 = 1; }
  if ($('#checkbox_6').is(':checked')){ $cb6 = 1; }
  if ($('#checkbox_7').is(':checked')){ $cb7 = 1; }

  if(($cb1 == 0) && ($cb2 == 0) && ($cb3 == 0) && ($cb4 == 0) && ($cb5 == 0) && ($cb6 == 0) && ($cb7 == 0)){
    check++
    $('#hdRq').css('background', '#fcf1f2')
    $('#hdRq').css('border-color', '#dc3545')
  }

  if($cb7 == 1){
    if($('#txtReq_o').val() == ''){
      check++
      $('#txtReq_o').addClass('is-invalid')
    }
  }

  var start = parseInt($('#txtStarttime').val())
  var end = parseInt($('#txtEndtime').val())

  if(start >= end){
    check++
    $('#txtStarttime').addClass('is-invalid')
    $('#txtEndtime').addClass('is-invalid')
  }

  if(check != 0){
    return false;
  }

  preload.show()

  var param = {
    author: $('#txtAuthor').val(),
    rq_1: $cb1,
    rq_2: $cb2,
    rq_3: $cb3,
    rq_4: $cb4,
    rq_5: $cb5,
    rq_6: $cb6,
    rq_7: $cb7,
    rq_o: $('#txtReq_o').val(),
    date_consult: $('#txtAppDate').val(),
    start: $('#txtStarttime').val(),
    end: $('#txtEndtime').val(),
    uid: current_user,
    pid: current_select_research
  }

  var jxr = $.post(config.ws_url + 'save_appoinment.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 window.location.reload()
               }else{
                 alert('Error')
                 console.log(resp);
                 preload.hide()
               }
             })
             .fail(function(){
               reload.hide()
             })
}

function deleteAppointmentAwait(id){
  var r = confirm("Are you sure?");
  if (r == true) {
    preload.show()
    var param = {
      ws_id: id,
      uid: current_user,
      pid: current_select_research
    }

    var jxr = $.post(config.ws_url + 'delete_app_await_session.php', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   window.location.reload()
                 }else{
                   alert('Error')
                   preload.hide()
                 }
               })
  }
}

function deleteAppointment(id){
  var r = confirm("Are you sure?");
  if (r == true) {
    preload.show()
    var param = {
      app_id: id,
      uid: current_user,
      pid: current_select_research
    }

    var jxr = $.post(config.ws_url + 'delete_app_session.php', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   window.location.reload()
                 }else{
                   alert('Error')
                   preload.hide()
                 }
               })
  }
}

function deleteProject(id){
  var r = confirm("Are you sure?");
  if (r == true) {
    preload.show()
    var param = {
      pid: id,
      uid: current_user
    }

    var jxr = $.post(config.ws_url + 'delete_project.php', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   ecs.load_project(current_user)
                 }else{
                   alert('Error')
                   preload.hide()
                 }
               })
  }
}

function saveProject(){
  var check = 0;
  $('.form-control').removeClass('is-invalid')
  $('.invalid-feedback').remove()

  if($('#txtProjectTitle').val() == ''){
    check++
    $('#txtProjectTitle').addClass('is-invalid')
  }

  if($('#txtPurpose').val() == ''){
    check++
    $('#txtPurpose').addClass('is-invalid')
  }else if($('#txtPurpose').val() == '5'){
    if($('#txtPurpose_o').val() == ''){
      check++

      console.log('a');
      $('#txtPurpose_o').addClass('is-invalid')
    }
  }

  if($('#txtInvolment').val() == ''){
    check++
    $('#txtInvolment').addClass('is-invalid')
  }else if($('#txtInvolment').val() == '5'){
    if($('#txtInvolment_o').val() == ''){
      check++
      console.log('b');
      $('#txtInvolment_o').addClass('is-invalid')
    }
  }

  if(check != 0){
    return false;
  }

  preload.show()

  if(current_select_user == null){
    current_select_user = current_user
  }

  var param = {
    uid: current_select_user,
    title: $('#txtProjectTitle').val(),
    fund: $('#txtProjectFund').val(),
    purpose: $('#txtPurpose').val(),
    purpose_o: $('#txtPurpose_o').val(),
    involment: $('#txtInvolment').val(),
    involment_o: $('#txtInvolment_o').val()
  }

  var jxr = $.post(config.ws_url + 'register-project.php', param, function(){})
             .always(function(resp){
               if(resp == 'Y'){
                 $('.btnCloseModal').trigger('click')
                 ecs.load_project(current_user)
               }else{
                 alert('Can not add new research title ....')
                 preload.hide()
               }
             })
}

$(function(){
  $('#txtInvolment').change(function(){
    if($('#txtInvolment').val() == '5'){
      $('.hdInvolment').removeClass('dn')
    }else{
      $('.hdInvolment').addClass('dn')
      $('#txtInvolment_o').val('')
    }
  })

  $('#txtPurpose').change(function(){
    if($('#txtPurpose').val() == '5'){
      $('.hdPurpose').removeClass('dn')
    }else{
      $('.hdPurpose').addClass('dn')
      $('#txtPurpose_o').val('')
    }
  })

  $('#checkbox_7').click(function(){
    if ($('#checkbox_7').is(':checked')){
      $('.hdRqother').removeClass('dn')
    }else{
      $('.hdRqother').addClass('dn')
      $('#txtReq_o').val('')
    }
  })


})
