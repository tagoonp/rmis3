var research_list = [];
var row_per_page = 20
var start_row = 0

var ec = {
  get_all_init: function(rpp, st){
    preload.show()
    var param = {
      id: current_user,
      id_year: $('#txtYear').val(),
      ppp: rpp,
      start: st
    }
    var jxhr = $.post(ws_url + 'controller/ec/v2-all-init.php', param, function(){},'json')
                 .always(function(snap){
                   console.log(snap);
                   if((snap != '') && (snap.length > 0)){
                     $('#projectList').empty()
                     $c = 1
                     if(start_row != 0){
                       $c = start_row + 1
                     }
                     snap.forEach(ele => {
                       $title = ele.title_th
                       if($title == '-'){ $title = ele.title_en }
                       $rowdata = '<tr class="fw300">' +
                                     '<td>' +
                                       '<div class="row">' +
                                         '<div class="col-sm-1 d-none d-sm-block">' + $c + '</div>' +
                                         '<div class="col-sm-2 text-success">' + ele.code_apdu + '</div>' +
                                         '<div class="col"><span class="text-dark">' + $title + '</span>' +
                                            '<div class="fz08  text-muted fw300">หัวหน้าโครงการ : ' + ele.fname + ' ' + ele.lname + '</div>' +
                                            '<div class="fz08  text-muted fw300">ลงทะเบียนเมื่อ : ' + main_app.convertThaidatetime(ele.date_submit) + '</div>' +
                                            '<div class="fz08  text-muted fw300">ประเภทการพิจารณา : ' + main_app.convertThaidatetime(ele.date_submit) + '</div>' +
                                            '<div class="fz08  text-muted fw300">เลขาผู้รับผิดชอบ : ' + ele.ec_consider_name + '</div>' +
                                            '<div class="fz08  text-muted fw300">เลขาการประชุม : ' + ele.ec_board_name + '</div>' +
                                         '</div>' +
                                         '<div class="col-sm-1 d-none d-sm-block">' + ele.ep + '</div>' +
                                         '<div class="col-sm-3 d-none d-sm-block text-danger">' + ele.status_name + '</div>' +
                                         '<div class="col-sm-1 pt-10">' +
                                            '<button class="btn btn-success btn-icon" onclick=viewRsInfoOnly(\'' + ele.id_rs +'\')><i class="fas fa-search"></i></button>' +
                                         '</div>' +
                                       '</div>' +
                                     '</td>' +
                                   '</tr>'
                        $('#projectList').append($rowdata)
                        $c++
                     })
                     loadstage++
                   }else{
                     $('#projectList').empty()
                     $('#projectList').append('<tr scope="row">' +
                                                 '<td colspan="6">' +
                                                   '<div class="row">' +
                                                     '<div class="col-12">' +
                                                       'ไม่พบข้อมูลโครงการวิจัย' +
                                                     '</div>' +
                                                   '</div>' +
                                                 '</td>' +
                                               '</tr>')
                      loadstage++
                   }
                 })
  },
  get_ec_info: function(preload_stage){
    if((current_user == null) || (current_role == null)){
      core.session_denine('timeout')
      return ;
    }
    else if(current_role != 'ec'){
      core.session_denine('permission')
      return ;
    }

    var param = {
      id: current_user,
      role: current_role
    }

    var jxhr = $.post(ws_url + 'controller/check_user.php', param, function(){}, 'json')
                .always(function(snap){
                  snap.forEach(ele => {
                    $('.userFullname').text(ele.prefix_name + ele.fname + ' ' + ele.lname)

                    $('#txtPrefixTh').val(ele.prefix_th)
                    $('#txtFnameTh').val(ele.fname)
                    $('#txtLnameTh').val(ele.lname)
                    $('#txtPrefixEn').val(ele.prefix_en)
                    $('#txtFnameEn').val(ele.fname_en)
                    $('#txtLnameEn').val(ele.lname_en)
                    $('#txtExp').val(ele.expertise)
                    $('#txtRI').val(ele.rs_interest)
                    $('#txtMobile').val(ele.tel_mobile)
                    $('#txtOffice').val(ele.tel_office)
                    $('#txtAddress').val(ele.address)

                    if(ele.id_dept != '19'){
                      $('#profile_p3').addClass('dn')
                    }else{
                      pi_deptgroup = 'out'
                      $('#txtDeptEn').val(ele.dept_en)
                      $('#txtDeptTh').val(ele.dept)
                      $('#txtInstitutionType').val(ele.dept_group)
                    }
                  })
                  if(preload_stage){
                    setTimeout(function(){ preload.hide() }, 1000)
                  }
                })
  }
}
