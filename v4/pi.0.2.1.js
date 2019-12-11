var pi_deptgroup = 'in'
var pi = {
  init: function(){
    $('title').text(':: RMIS :: สำหรับหัวหน้าโครงการ ::')
  },
  get_pi_info: function(preload_stage){
    if((current_user == null) || (current_role == null)){
      core.session_denine('timeout')
      return ;
    }
    else if(current_role != 'pm'){
      core.session_denine('permission')
      return ;
    }

    var param = {
      id: current_user,
      role: current_role
    }

    var jxhr = $.post(ws_url + 'controller/check_user.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
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
  },
  update_profile: function(){
    $check = 0;
    $('.form-control').removeClass('is-invalid')


    if($('#txtFnameTh').val()==''){
      $check++;
      $('#txtFnameTh').addClass('is-invalid')
    }

    if($('#txtLnameTh').val()==''){
      $check++;
      $('#txtLnameTh').addClass('is-invalid')
    }

    if($('#txtFnameEn').val()==''){
      $check++;
      $('#txtFnameEn').addClass('is-invalid')
    }

    if($('#txtLnameEn').val()==''){
      $check++;
      $('#txtLnameEn').addClass('is-invalid')
    }

    if($('#txtPosition').val()==''){
      $check++;
      $('#txtPosition').addClass('is-invalid')
    }

    if($('#txtExp').val()==''){
      $check++;
      $('#txtExp').addClass('is-invalid')
    }

    if($('#txtRI').val()==''){
      $check++;
      $('#txtRI').addClass('is-invalid')
    }

    if($('#txtAddress').val()==''){
      $check++;
      $('#txtAddress').addClass('is-invalid')
    }

    if($('#txtMobile').val()==''){
      $check++;
      $('#txtMobile').addClass('is-invalid')
    }

    if($('#txtOffice').val()==''){
      $check++;
      $('#txtOffice').addClass('is-invalid')
    }

    if(pi_deptgroup == 'out'){
      if($('#txtDeptTh').val()==''){
        $check++;
        $('#txtDeptTh').addClass('is-invalid')
      }

      if($('#txtDeptEn').val()==''){
        $check++;
        $('#txtDeptEn').addClass('is-invalid')
      }

      if($('#txtInstitutionType').val()==''){
        $check++;
        $('#txtInstitutionType').addClass('is-invalid')
      }
    }

    if($check!=0){
      swal("ขออภัย!", "กรุณากรอกข้อมูลให้ครบถ้วน!", "error")
      return ;
    }

    preload.show()

    var param = {
      prefix_th: $('#txtPrefixTh').val(),
      prefix_en: $('#txtPrefixEn').val(),
      fname_th: $('#txtFnameTh').val(),
      fname_en: $('#txtFnameEn').val(),
      lname_th: $('#txtLnameTh').val(),
      lname_en: $('#txtLnameEn').val(),
      position: $('#txtPosition').val(),
      exp: $('#txtExp').val(),
      ri: $('#txtRI').val(),
      institution: $('#txtInstitutionType').val(),
      dept_th: $('#txtDeptTh').val(),
      dept_en: $('#txtDeptEn').val(),
      address: $('#txtAddress').val(),
      mobile: $('#txtMobile').val(),
      office: $('#txtOffice').val(),
      uid: current_user
    }

    var jxr = $.post(ws_url + 'controller/update_profiler_v3.php', param, function(){})
               .always(function(resp){
                 if(resp == 'Y'){

                 }else{

                 }
               })

  }
}

pi.init()
