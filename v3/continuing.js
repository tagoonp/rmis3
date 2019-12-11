var cont = {
  getProgressType: function(id){
    if(id == '1'){
      return 'Progress'
    }else if(id == '2'){
      return 'Amendment'
    }
  },
  progress_step_1: function(i, j, k){

    var param = {
      id_rs: i,
      progress_type: j,
      session_id: k,
      user: current_user
    }

    window.localStorage.setItem('current_progress_type', j)
    window.localStorage.setItem('current_progress_key', k)
    window.localStorage.setItem('current_progress_id_rs', i)


    if(j == 2){
      window.location = 'cont_progress_1_2.html'
    }else{
      window.location = 'cont_progress_1_1.html'
    }
  },
  load_rs_info: function(){
    var param = {
      id: current_user,
      sess: current_pr_session,
      id_rs: current_pr_id_rs,
      progress_type: current_pr_type
    }
    var jxhr = $.post(ws_url + 'controller/staff/continuing/get-rs-info.php', param, function(){}, 'json')
                .always(function(snap){
                  console.log(snap);
                  // return ;
                  if((snap!='') && (snap.length > 0)){
                    snap.forEach(function(i){
                      $('#txtCodeApdu').text(i.code_apdu )
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

                      $('.txtProgressSubtype').text(pg2.getTitle(i.rp2_t1type))

                      // console.log(i.rp2_t1type);
                      if(i.rp2_t1type == 3){
                        $('#info_type3').removeClass('dn')
                        $innerData = '<span class="f500">ชื่อโครงการใหม่ (ภาษาไทย) : </span> ' + i.rp2_title_th	+ '<br>' +
                                     '<span class="f500">ชื่อโครงการใหม่ (ภาษาอังกฤษ) : </span> ' + i.rp2_title_en	+ '<br>'
                        $('.txtProgressInfo').html($innerData)

                        if(i.rp2_t2 == 1){
                          $('#p2-1').removeClass('dn')
                          $('#rp2_t2').html('<i class="zmdi zmdi-check-square text-success"></i>')
                          $('#p2-1').text(i.rp2_t2info)
                        }

                        if(i.rp2_t3 == 1){
                          $('#p2-2').removeClass('dn')
                          $('#rp2_t3').html('<i class="zmdi zmdi-check-square text-success"></i>')
                          $('#rp2_t3a').text(i.rp2_t3a)
                          $('#rp2_t3b').text(i.rp2_t3b)
                          $('#rp2_t3c').text(i.rp2_t3c)
                          $('#rp2_t3d').text(i.rp2_t3d)
                          $('#rp2_t3e').text(i.rp2_t3e)
                          $('#rp2_t3f').text(i.rp2_t3f)
                          $('#rp2_t3g').text(i.rp2_t3g)
                        }
                      }else if(i.rp2_t1type == 1){
                        $('#info_type1').removeClass('dn')
                      }else{
                        $('#info_typeother').removeClass('dn')
                      }

                      if(i.rp2_t4 == 1){
                        $('#rp2_t4').html('<i class="zmdi zmdi-check-square text-success"></i>')
                      }

                      if(i.rp2_t5 == 1){
                        $('#rp2_t5').html('<i class="zmdi zmdi-check-square text-success"></i>')
                      }

                      if(i.rp2_t6 == 1){
                        $('#rp2_t6').html('<i class="zmdi zmdi-check-square text-success"></i>')
                      }

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


                var jxhr2 = $.post(ws_url + 'controller/staff/pm-co-pi-info.php', {sess: current_pr_id_rs, id: current_user}, function(){}, 'json')
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
  checkFileAttachedProgress: function(){
    for(var i = 1; i <= 8 ; i++){
      cont.checkDataProgress(i);
    }
  },
  checkDataProgress: function(i){


      $('#ft_att_' + i + '_c').empty()

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
        var param = {
          id_rs: current_pr_id_rs,
          fgroup: i,
          sess_id: current_pr_session
        }
        var response = $.post(ws_url + 'controller/staff/continuing/check_upload_file_progress_report.php', param, function(){}, 'json')
                        .always(function(snap){
                          if((snap != '') && (snap.length > 0)){
                            $('#ft_att_' + i + '_c').empty();
                            snap.forEach(function(childSnap){
                              var data = '<li class="mb-5"><a href="../tmp_file/' + childSnap.rpfa_file_name + '" target="_blank"><i class="fa fa-download text-info mr-5"></i></a> ' + childSnap.rpfa_file_name + '</li>';
                              $('#ft_att_' + i + '_c').append(data);
                            })
                          }else{
                            $('#ft_att_' + i + '_c').append('-');
                          }
                        },'json');
      }
  },
  loadRevisedInfo: function(){
    revise_record_num = 0

    var param = {
      id_rs: current_pr_id_rs,
      sess: current_pr_session
    }

    var jxr = $.post(ws_url + 'controller/pm/get-revise-amendment.php', param, function(){}, 'json')
               .always(function(snap){
                 if((snap != '') && (snap.length > 0)){
                   $('#reviseSpan').empty()
                   $c = 1;
                   snap.forEach(function(i){
                     var data = '<tr>' +
                                  '<td>' + $c + '</td>' +
                                  '<td>' + i.p2r_line +
                                  '</td>' +
                                  '<td>' + i.p2r_before + '</td>' +
                                  '<td>' + i.p2r_after + '</td>' +
                                  '<td>' + i.p2r_reason + '</td>' +
                                  '<td>' + i.p2r_effect + '</td>' +
                                '</tr>'
                     $('#reviseSpan').append(data)
                     $c++
                     revise_record_num++
                   })

                 }else{
                   $('#reviseSpan').empty()
                   var data = '<tr>' +
                                '<td colspan="6">ไม่พบข้อมูลรายละเอียด</td>' +
                              '</tr>'
                   $('#reviseSpan').append(data)
                   checkBeforeSave(0)
                 }
               }, 'json')
               .fail(function(){
                 $('#reviseSpan').empty()
                 var data = '<tr>' +
                              '<td colspan="6">ไม่พบข้อมูลรายละเอียด</td>' +
                            '</tr>'
               })
  }
}
