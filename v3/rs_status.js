var rs_update = {
  update_1: function(){

    var udateb = $('#start_date').val().split('-')
    var b = (parseInt(udateb[0]) - 543) + '-' + udateb[1] + '-' + udateb[2] + ' ' + '00:00:00'
    var param = {
      id: current_user,
      id_rs: current_rs_id,
      udate: b,
      next_status: '3'
    }


    var jxhr = $.post(ws_url + 'controller/staff/update_status_1.php', param , function(){}, 'json')
                .always(function(resp){

                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      if(i.status == 'Y'){

                        var dataContent = '<h3>ข้อมูลการปรับสถานะโครงการวิจัย REC.' + i.rec_id + '</h3>' +
                                          '<p>เรียน ' + i.fullname + ' ที่นับถือ</p>' +
                                          '<p>โครงการวิจัยที่ท่านเสนอขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์ ได้รับการตรวจสอบและปรับสถานะ ' +
                                          'ท่านสามารถติดตามสถานะโครงการของท่านที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                          '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                        var emailParam = {
                          email: emailConfig.user,
                          api_key: emailConfig.key,
                          title: "{ No-reply } REC." + i.rec_id + " : โครงการวิจัยของท่านมีการปรับสถานะ โปรดตรวจสอบ",
                          to_email: i.email ,
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
                          text: "กดตกลงเพื่อทำการรีโหลดข้อมูล",
                          type: "success",
                          showCancelButton: false,
                          confirmButtonColor: "#126cd5",
                          confirmButtonText: "ตกลง",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location.reload()
                        });
                      }else{
                        alert('ไม่สามารถปรับปรุงข้อมูลได้')
                      }
                    })
                  }
                }, 'json')
  },
  update_2: function(){


    var udateb = $('#start_date_2').val().split('-')
    var b = (parseInt(udateb[0]) - 543) + '-' + udateb[1] + '-' + udateb[2] + ' ' + '00:00:00'
    var param = {
      id: current_user,
      id_rs: current_rs_id,
      udate: b,
      next_status: '3'
    }


    var jxhr = $.post(ws_url + 'controller/staff/update_status_2.php', param , function(){}, 'json')
                .always(function(resp){

                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      if(i.status == 'Y'){

                        var dataContent = '<h3>ข้อมูลการปรับสถานะโครงการวิจัย REC.' + i.rec_id + '</h3>' +
                                          '<p>เรียน ' + i.fullname + ' ที่นับถือ</p>' +
                                          '<p>โครงการวิจัยที่ท่านเสนอขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์ ได้รับการตรวจสอบและปรับสถานะ ' +
                                          'ท่านสามารถติดตามสถานะโครงการของท่านที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                          '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                        var emailParam = {
                          email: emailConfig.user,
                          api_key: emailConfig.key,
                          title: "{ No-reply } REC." + i.rec_id + " : ข้อมูลการปรับสถานะโครงการวิจัย",
                          to_email: i.email ,
                          content: dataContent
                        }
                        var jxhr = $.post(emailProvider, emailParam, function(){})
                                    .always(function(res){
                                      if(res!='Y'){
                                        // main_app.emailErr('Change password', window.localStorage.getItem('rmis_current_user_email'))
                                        alert('ไม่สามารถสงอีเมล์ได้')
                                      }else{
                                        swal({
                                          title: "ดำเนินการสำเร็จ",
                                          text: "กดตกลงเพื่อทำการรีโหลดข้อมูล",
                                          type: "success",
                                          showCancelButton: false,
                                          confirmButtonColor: "#126cd5",
                                          confirmButtonText: "ตกลง",
                                          closeOnConfirm: false
                                        },
                                        function(){
                                          window.location.reload()
                                        });
                                      }
                                    })


                      }else{
                        alert('ไม่สามารถปรับปรุงข้อมูลได้')
                      }
                    })
                  }
                }, 'json')
  },
  update_3: function(){


    var udateb = $('#start_date_2').val().split('-')
    var b = (parseInt(udateb[0]) - 543) + '-' + udateb[1] + '-' + udateb[2] + ' ' + '00:00:00'
    var param = {
      id: current_user,
      id_rs: current_rs_id,
      udate: b,
      next_status: $('#txtStatus').val()
    }


    var jxhr = $.post(ws_url + 'controller/staff/update_status_2.php', param , function(){}, 'json')
                .always(function(resp){

                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      if(i.status == 'Y'){

                        var dataContent = '<h3>ข้อมูลการปรับสถานะโครงการวิจัย REC.' + i.rec_id + '</h3>' +
                                          '<p>เรียน ' + i.fullname + ' ที่นับถือ</p>' +
                                          '<p>โครงการวิจัยที่ท่านเสนอขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์ ได้รับการตรวจสอบและปรับสถานะ ' +
                                          'ท่านสามารถติดตามสถานะโครงการของท่านที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                          '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                        var emailParam = {
                          email: emailConfig.user,
                          api_key: emailConfig.key,
                          title: "{ No-reply } REC." + i.rec_id + " : ข้อมูลการปรับสถานะโครงการวิจัย",
                          to_email: i.email ,
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
                          text: "กดตกลงเพื่อทำการรีโหลดข้อมูล",
                          type: "success",
                          showCancelButton: false,
                          confirmButtonColor: "#126cd5",
                          confirmButtonText: "ตกลง",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location.reload()
                        });
                      }else{
                        alert('ไม่สามารถปรับปรุงข้อมูลได้')
                      }
                    })
                  }
                }, 'json')
  }
}

var rs_check = {
  status_1: function(){
    var param = {
      id_rs: current_rs_id
    }

    var jxhr = $.post(ws_url + 'controller/staff/check_1.php', param ,function(){},'json')
                .always(function(resp){
                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      $('#start_date').val(i.ld)
                      $('.date_accept').text(main_app.convertThaidate(i.log_datetime))
                      $('#btn1').addClass('dn');
                    })
                  }


                },'json')
  },
  status_2: function(){
    var param = {
      id_rs: current_rs_id
    }

    var jxhr = $.post(ws_url + 'controller/staff/check_2.php', param ,function(){},'json')
                .always(function(resp){
                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      $('#start_date').val(i.ld)

                      $info = '<br>(เอกสารถูกต้อง อยู่ในระหว่างเสนอเลขาเลือกประเภทการพิจารณา)'
                      if(i.log_activity == 'Wait for acknowledge'){
                        $info = '<br>(ผลการพิจารณาเป็น Exempt รอออกใบรับรองภายใน 7 วันทำการ)'
                      }
                      $('.date_approve').html(main_app.convertThaidate(i.log_datetime) + $info)
                      $('#btn1').addClass('dn');
                    })
                  }


                },'json')
  }
}
