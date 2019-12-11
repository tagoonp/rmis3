// Operation
var editdata_1 = ''
var editdata_19 = ''
var editdata_21 = ''
var editdata_reviewer_email = ''
var editdata_more_reviewer = ''

editdata_1 = CKEDITOR.replace( 'operation-1', {
  height: '250px'
});

editdata_19 = CKEDITOR.replace( 'operation-19', {
  height: '350px'
});

editdata_21 = CKEDITOR.replace( 'operation-21', {
  height: '250px'
});



function save_operation_1(){
  $result = $('#txtResult').val()

  if($result == ''){
    $('#txtResult').addClass('is-invalid')
    swal("คำเตือน", "กรุณาเลือกผลการตรวจสอบเอกสาร", "error")
    return ;
  }

  if($result == '2'){ //เอกสารไม่ถูกต้อง
    $message = editdata_1.getData()
    if($message == ''){
      swal("คำเตือน", "กรุณากรอกข้อความที่จะส่งถึงหัวหน้าโครงการวิจัยก่อนทำการบันทึก", "error")
      return ;
    }

    preload.show()

    var param = {
      sess_id: current_rs,
      id_rs: current_rs_id,
      info: $message,
      id: current_user,
      next_status: $result
    }
    var jxhr = $.post(ws_url + 'controller/staff/replay_back_2.php', param, function(){}, 'json')
                .always(function(snap){
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      if(i.status == 'Y'){
                        var dataContent = '<h3>ชื่อเรื่อง : ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                          '<p>ชื่อโครงการ (ภาษาไทย) : ' + $('#txtThtitle').text() + '</p>' +
                                          '<p>ชื่อโครงการ (English) : ' + $('#txtEntitle').text() + ' </p>' +
                                          '<p>เรียน ' + i.fullname + '</p>' +
                                          "<p>เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสารเบื้องต้นพบว่า <span style=\"color: red;\"><strong style=color:red;>เอกสารยังไม่ถูกต้อง/ไม่ครบถ้วน</strong></span> จึงขอให้ท่านดำเนินการต่อไปนี้" +
                                          '</p>' +
                                          '<p style="padding: 20px; background: rgb(240, 240, 240);"> -------------------------------------------' +
                                            '<div style="padding: 20px; background: rgb(240, 240, 240);">' + editdata_1.getData() + '</div>' +
                                          '------------------------------------------- </p>' +
                                          '<p>กรุณายื่นเอกสารผ่านระบบ RMIS มาเพื่อตรวจสอบอีกครั้ง <strong>ระบบจะแจ้งผลการตรวจสอบทางอีเมล์แก่ท่านภายใน 3 วันทำการ</stong></p>' +
                                          '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>' +
                                          'ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS ' + root_domain +' หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157';

                        var str = dataContent.replace(/\n/g, ' ')

                        var param = {
                          title: "ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์",
                          content: str,
                          user: 'tagoon.p@gmail.com',
                          key: 'idj&skeoXf2**r123X',
                          toemail: i.email,
                          toname: i.fullname
                        }

                        setMessaging($message, 'เจ้าหน้าที่')

                        setTimeout(function(){
                          preload.hide()
                        }, 2000)
                        
                        main.send_email(param, 'index.html', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                        $('.btnClosemodal').trigger('click')
                        return ;

                      }else{
                        preload.hide()
                        swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                        return ;
                      }
                    })
                  }else{
                    preload.hide()
                    swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                    return ;
                  }
                }, 'json')
                .fail(function(){
                  preload.hide()
                  swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาลองใหม่ภายหลัง", "error")
                  return ;
                })

  }
  else if($result == '3'){ //เอกสารถูกต้อง

    $message = editdata_1.getData()

    var check = 0;
    $('.form-control').removeClass('is-invalid')

    if($('#txtEC').val() == ''){
      check++;
      $('#txtEC').addClass('is-invalid')
    }

    if($('#txtYear').val() == ''){
      check++;
      $('#txtYear').addClass('is-invalid')
    }

    if($('#txtDept').val() == ''){
      check++;
      $('#txtDept').addClass('is-invalid')
    }

    if($('#txtPertype').val() == ''){
      check++;
      $('#txtPertype').addClass('is-invalid')
    }

    if(check!=0){
      swal("คำเตือน", "กรุณากรอกข้อมูลให้ครบถ้วนก่อนทำการบันทึก", "error")
      return ;
    }

    var param = {
      sess_id: current_rs,
      id_rs: current_rs_id,
      info: $message,
      id: current_user,
      ec: $('#txtEC').val(),
      year: $('#txtYear').val(),
      dept: $('#txtDept').val(),
      ptype: $('#txtPertype').val(),
      next_status: '3'
    }

    swal({   title: "คำเตือน",
             text: "กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนดำเนินการ หากท่านดำเนินการแล้วจะไม่สามารถย้อนกลับมายังสถานะของโครงการนี้ได้อีก",
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

                var jxhr = $.post(ws_url + 'controller/staff/replay_back_3_update.php', param, function(){}, 'json')
                            .always(function(snap){
                              if((snap!='') && (snap.length > 0)){
                                snap.forEach(function(i){
                                  if(i.status == 'Y'){
                                    // var dataContent = '<p>เรียน นักวิจัยหลัก (' + i.fullname + ')</p>' +
                                    //                   '<p style="font-size: 1.3em;"><strong>รหัสโครงการ <span style="color: red;">REC ' + i.rec_id + '</span></strong></p>' +
                                    //                   '<p><strong>ชื่อโครงการ (ภาษาไทย)</strong> ' + $('#txtThtitle').text() + '<br><strong>ชื่อโครงการ (English)</strong> ' + $('#txtEntitle').text() + '</p>' +
                                    //                   '<p>เจ้าหน้าที่สำนัก ฯ ตรวจสสอบเอกสารพบว่า <span style=\"color: green;\"><strong style=color:red;>เอกสารเบื้องต้นถูกต้อง</strong></span> และอยู่ระหว่างส่งต่อเลขา EC เพื่อตรวจสอบเพิ่มเติม และดำเนินการต่อ</p>' +
                                    //                   '<p>' +
                                    //                   ' - ขอให้ท่านตรวจสอบอีเมล์ของท่านเป็นระยะ สำนักงาน ฯ จะแจ้งอีกครั้ง (เฉพาะโครงกาารทุนภาคเอกชน ให้ส่งเอกสาร Hard copy จำนวน 13 ชุด มาที่สำนักงานทันทีที่ได้รับอีเมล์แจ้งฉบับนี้)<br>' +
                                    //                   ' - <strong>ท่านสามารถตรวจสอบสถานะโครงการของท่านด้วยตนเองได้ที่ ' + root_domain + '</strong>' +
                                    //                   '</p>' +
                                    //                   '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>' +
                                    //                   '<p><span style="color: red;">** กรุณาอย่าตอบกลับทางอีเมล์ฉบับนี้ หากมีข้อสงสัย กรุณาติดต่อเจ้าหน้าที่สำนักงาน คุณณัฎฐา ศิริรักษ์ โทร 1149, 1157</span></p>';
                                    var dataContent = '<p style="font-size: 1.3em;"><strong>รหัสโครงการ <span style="color: red;">REC ' + i.rec_id + '</span></strong></p>' +
                                                      '<p><strong>ชื่อโครงการ (ภาษาไทย)</strong> ' + $('#txtThtitle').text() + '<br><strong>ชื่อโครงการ (English)</strong> ' + $('#txtEntitle').text() + '</p>' +
                                                      '<p>' +
                                                        '<strong>รหัสโครงการวิจัยของท่านคือ REC ' + i.rec_id + '</strong>' +
                                                      '</p>' +
                                                      '<p>' +
                                                      ' •	เอกสารจะถูกส่งต่อเลขา EC เพื่อตรวจสอบความครบถ้วนเพิ่มเติมและพิจารณาประเภทของการพิจารณาต่อไป<br>' +
                                                      ' •	หากโครงการเข้าข่ายต้องรับการพิจารณาโดยคณะกรรมการเต็มชุด สำนักงานฯ จะแจ้งจำนวนชุดของเอกสารในรูปแบบ hard copy ให้ท่านทราบภายใน 7 วันทำการ<br>' +
                                                      ' •	ขอให้ท่านตรวจสอบอีเมล์ของท่านเป็นระยะ (รวมถึง junk box)' +
                                                      '</p>' +
                                                      '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS http://rmis2.medicine.psu.ac.th/rmis/  หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157</p>' +
                                                      '<p><span style=\"color: red;\"><strong style=color:red;>** กรณีเป็น industrial sponsored trial ขอให้จัดส่งเอกสารในรูป hard copy จำนวน 14 ชุดมาที่สำนักงานโดยเร็วหลังได้อีเมล์นี้</strong></span></p>';

                                    var str = dataContent.replace(/\n/g, ' ')
                                    var param = {
                                      title: "{No-reply} REC." + i.rec_id + " : แจ้งรหัสโครงการ",
                                      content: str,
                                      user: 'tagoon.p@gmail.com',
                                      key: 'idj&skeoXf2**r123X',
                                      toemail: i.email,
                                      toname: i.fullname
                                    }

                                    main.send_email(param, 'index.html', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                                    $('.btnClosemodal').trigger('click')

                                    var param2 = {
                                      id_ec: $('#txtEC').val()
                                    }

                                    var jxhr2 = $.post(ws_url + 'controller/get_ec_info.php', param2, function(){}, 'json')
                                                 .always(function(snap2){
                                                   if((snap2 != '') && (snap2.length > 0)){
                                                     snap2.forEach(function(j){
                                                       var dataContent2 = '<h3>REC.' + i.rec_id + ' โครงการวิจัยรอการตรวจสอบความถูกต้อง</h3>' +
                                                                         '<p>เรียน ' + $('#txtEC option:selected').text() + '</p>' +
                                                                         '<p>มีโครงการวิจัยรอการตรวจสอบความถูกต้อง รหัส REC.' + i.rec_id + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                                         'ได้ที่ ' + root_domain +'</a></p>' +
                                                                         '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                                                       var str = dataContent2.replace(/\n/g, ' ')
                                                       var param3 = {
                                                         title: "REC." + i.rec_id + " : โครงการวิจัยรอการตรวจสอบความถูกต้อง/แยกประเภท",
                                                         content: str,
                                                         user: 'tagoon.p@gmail.com',
                                                         key: 'idj&skeoXf2**r123X',
                                                         toemail: j.email,
                                                         toname: ''
                                                       }

                                                       main.send_email(param3, 'index.html', 'กดตกลงเพื่อกลับสู่หน้าแรก', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                                                       $('.btnClosemodal').trigger('click')

                                                       return ;
                                                     })
                                                   }
                                                 })

                                    return ;

                                  }else{
                                    preload.hide()
                                    swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                                    return ;
                                  }
                                })
                              }else{
                                preload.hide()
                                swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                                return ;
                              }
                            }, 'json')
                            .fail(function(){
                              lp.hl();
                              swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาลองใหม่ภายหลัง", "error")
                              return ;
                            })
              }
            });


  }
}

function save_operation_19(){
  $message = editdata_19.getData()
  if($message == ''){
    swal("คำเตือน", "กรุณากรอกข้อความเพื่อส่งต่อผู้วิจัย", "error")
    return ;
  }

  swal({    title: "ยืนยันการดำเนินการ",
          text: "คุณยืนยันที่ดำเนินการดังกล่าวหรือไม่ เนื่องจากท่านจะไม่สามารถกลับมาแก้ไขข้อมูลได้อีก",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "ยืนยัน",
          cancelButtonText: "ยกเลิก",
          closeOnConfirm: true
        },
          function(){

            var param = {
              id: current_user,
              id_rs: current_rs_id,
              msg: $message
            }

            var jxhr = $.post(ws_url + '/controller/staff/add_feeback_to_pi.php', param, function(){}, 'json')
                        .always(function(resp){
                          if((resp!= '') && (resp.length > 0)){
                            resp.forEach(function(i){
                              if(i.status == 'Y'){

                                $('#btnCloseMoredocwant').trigger('click');

                                preload.show()

                                var dataContent = $message;
                                  dataContent = dataContent.replace(/\n/g, ' ')
                                var param = {
                                  title: '{No-reply} REC.' + i.rec_id + ' : ขอเอกสารเพิ่มเติมเพื่อประกอบการพิจารณาจริยธรรมการวิจัยในมนุษย์',
                                  content: dataContent,
                                  user: 'tagoon.p@gmail.com',
                                  key: 'idj&skeoXf2**r123X',
                                  toemail: i.email,
                                  toname: $('#txtPi').text()
                                }

                                setMessaging($('.main_content_19').html(), 'เจ้าหน้าที่')

                                main.send_email(param, 'index.html', 'ส่งข้อมูลถึงผู้วิจัยเรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                                return ;

                              }else{
                                alert(i.status)
                              }
                            })
                          }else{
                            alert(resp)
                          }

                        }, 'json')
          });
}

function save_operation_21(){

  $result = $('#txtResult21').val()

  if($result == ''){
    $('#txtResult21').addClass('is-invalid')
    swal("คำเตือน", "กรุณาเลือกผลการตรวจสอบเอกสาร", "error")
    return ;
  }

  if($result == '2'){ //เอกสารไม่ถูกต้อง
    $message = editdata_21.getData()
    if($message == ''){
      swal("คำเตือน", "กรุณากรอกข้อความเพื่อส่งต่อผู้วิจัย", "error")
      return ;
    }

    preload.show()

    var param = {
      sess_id: current_rs,
      id_rs: current_rs_id,
      info: $message,
      id: current_user,
      next_status: '20'
    }

    var jxhr = $.post(ws_url + 'controller/staff/replay_back_20.php', param, function(){}, 'json')
                .always(function(snap){
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      if(i.status == 'Y'){
                        var dataContent = '<h3>ชื่อเรื่อง : REC. ' + $('.txtCodes').text() + ' ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                          '<p>ชื่อโครงการ (ภาษาไทย) : ' + $('#txtThtitle').text() + '</p>' +
                                          '<p>ชื่อโครงการ (English) : ' + $('#txtEntitle').text() + ' </p>' +
                                          '<p>เรียน ' + i.fullname + '</p>' +
                                          "<p>เจ้าหน้าที่ได้ทำการตรวจสอบความครบถ้วนและถูกต้องเอกสารเบื้องต้นพบว่า <span style=\"color: red;\"><strong style=color:red;>เอกสารยังไม่ถูกต้อง/ไม่ครบถ้วน</strong></span> จึงขอให้ท่านดำเนินการต่อไปนี้" +
                                          '</p>' +
                                          '<p style="padding: 20px; background: rgb(240, 240, 240);"> -------------------------------------------' +
                                            '<div style="padding: 20px; background: rgb(240, 240, 240);">' + $message + '</div>' +
                                          '------------------------------------------- </p>' +
                                          '<p>กรุณายื่นเอกสารผ่านระบบ RMIS มาเพื่อตรวจสอบอีกครั้ง <strong>ระบบจะแจ้งผลการตรวจสอบทางอีเมล์แก่ท่านภายใน 3 วันทำการ</stong></p>' +
                                          '<p>หมายเหตุ : กรุณาอย่าตอบกลับทาง e-mail นี้ <br>' +
                                          'ท่านสามารถตรวจสอบสถานะของโครงการโดยเข้าไปที่ระบบ RMIS ' + root_domain +' หรือติดต่อเจ้าหน้าที่ (คุณณัฎฐา  ศิริรักษ์) โทร.1149, 1157';

                        setMessaging($message, 'เจ้าหน้าที่')

                        var param = {
                          title: '{No-reply} REC. ' + $('.txtCodes').text() + ' ผลการตรวจสอบความถูกต้องของเอกสารโครงการวิจัยที่ขอรับพิจารณาจริยธรรมการวิจัยในมนุษย์',
                          content: dataContent,
                          user: 'tagoon.p@gmail.com',
                          key: 'idj&skeoXf2**r123X',
                          toemail: i.email,
                          toname: i.fullname
                        }
                        main.send_email(param, 'index.html', 'ส่งข้อมูลถึงผู้วิจัยเรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                        return ;

                      }else{
                        preload.hide()
                        swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                        return ;
                      }
                    })
                  }else{
                    preload.hide()
                    swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                    return ;
                  }
                }, 'json')
                .fail(function(){
                  preload.hide()
                  swal("เกิดข้อผิดพลาด", "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ กรุณาลองใหม่ภายหลัง", "error")
                  return ;
                })

  }
  else{ // เอกสารถูกต้อง

    $message = editdata_21.getData()

    preload.show()

    var param = {
      sess_id: current_rs,
      id_rs: current_rs_id,
      info: $message,
      id: current_user,
      next_status: '6'
    }

    var jxhr = $.post(ws_url + 'controller/staff/replay_pi_update.php', param, function(){}, 'json')
                .always(function(resp){
                  if((resp != '') && (resp.length > 0)){
                    resp.forEach(function(i){
                      var dataContent = '<h3>แจ้งเตือนโครงการรอพิจารณาประเภทการพิจารณาจริยธรรมการวิจัยในมนุษย์</h3>' +
                                        '<p>เรียน คุณ' + i.fname + ' ' + i.lname + '</p>' +
                                        '<p>เจ้าหน้าที่ได้ทำการตรวจสอบข้อมูลเบื้องต้นโครงการวิจัยรหัส REC. ' + i.code_apdu + ' ซึ่งได้ผ่านการแจ้งให้ผู้วิจัยให้ทำการแก้ไข/ขอเอกสารเพิ่มเติม และได้ดำเนินการเรียบร้อยแล้ว และโครงการของท่านจะถูกส่งต่อเลขา EC เพื่อตรวจสอบความครบถ้วนเพิ่มเติมและพิจารณาต่อไป</p>' +
                                        '<p>ทั้งนี้ ท่านสามารถตรวจสอบข้อมูลและดำเนินการต่อได้ที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                        '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';

                      var param = {
                        title: "REC." + i.code_apdu + " แจ้งเตือนโครงการรอพิจารณาประเภทการพิจารณาจริยธรรมการวิจัยในมนุษย์",
                        content: dataContent,
                        user: 'tagoon.p@gmail.com',
                        key: 'idj&skeoXf2**r123X',
                        toemail: i.email,
                        toname: i.fname + ' ' + i.lname
                      }

                      setMessaging('<p>เจ้าหน้าที่ตรวจสอบเอกสารโครงการถูกต้อง/ครบถ้วน</p>', 'เจ้าหน้าที่')

                      main.send_email(param, 'none', 'ส่งข้อมูลถึงผู้วิจัยเรียบร้อยแล้ว', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')

                        var param2 = {
                          id_ec: i.id_ec
                        }

                        var jxhr2 = $.post(ws_url + 'controller/get_ec_info.php', param2, function(){}, 'json')
                                     .always(function(snap2){
                                        if((snap2 != '') && (snap2.length > 0)){
                                          snap2.forEach(function(j){
                                            var dataContent2 = '<h3>REC.' + i.code_apdu + ' โครงการวิจัยรอการตรวจสอบความถูกต้อง</h3>' +
                                                              '<p>เรียน ' + j.prefix_name + j.fname + ' ' + j.lname + '</p>' +
                                                              '<p>มีโครงการวิจัยรอการตรวจสอบความถูกต้อง รหัส REC.' + i.code_apdu + ' กรุณาเข้าสู่ระบบ RMIS และดำเนินการต่อ' +
                                                              'ได้ที่ <a href="' + root_domain + '" target="_blank">' + root_domain +'</a></p>' +
                                                              '<p>จึงเรียนมาเพื่อทราบ <br>ระบบสารสนเทศเพื่อการจัดการงานวิจัย (RMIS)</p>';
                                            var param = {
                                              title: "REC." + i.code_apdu + " โครงการวิจัยรอการตรวจสอบความถูกต้องและรอพิจารณาประเภทการพิจารณาจริยธรรมการวิจัยในมนุษย์",
                                              content: dataContent2,
                                              user: 'tagoon.p@gmail.com',
                                              key: 'idj&skeoXf2**r123X',
                                              toemail: j.email,
                                              toname: j.fname + ' ' + j.lname
                                            }

                                            main.send_email(param, 'index.html', 'กดตกลงเพื่อกลับสู่หน้ารายการ', 'ระบบได้ดำเนินการตามกระบวนที่ท่านได้ดำเนินการแล้ว แต่เกิดข้อผิดพลาดในส่วนของการส่งอีเมล์ กรุณาแจ้งเจ้าหน้าที่เพื่อตรวจสอบและดำเนินการแก้ไข')
                                            return ;

                                          })
                                        }
                                     }, 'json')
                    })
                  }else{
                    preload.hide()
                    swal("เกิดข้อผิดพลาด", "ไม่สามารถส่งข้อมูลได้", "error")
                    return ;
                  }
                }, 'json')
  }
}
