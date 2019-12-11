var staff_cont = {
  check_new_report: function(){
    var param = $.post(ws_url + 'controller/staff/check-new-report.php', function(){},'json')
                 .always(function(snap){
                   // Gen in Table
                   if((snap!='') && (snap.length > 0)){
                     // Gen in button
                     $('#cont_n_1').text('(' + snap.length +')')
                     $('#cont_n_1_btn').addClass('btn-danger')
                   }
                 }, 'json')
  },
  check_new_report_by_year: function(){
    var param = {
      year: parseInt($('#txtYear').val()) + 1999
    }

    var jxr = $.post(ws_url + 'controller/staff/check-new-report.php', param, function(){},'json')
                 .always(function(snap){

                   // Gen in Table
                   var dt = $('#datable_1').dataTable().api();
                   if((snap!='') && (snap.length > 0)){

                     dt.clear().draw();
                     $c = 1;
                     snap.forEach(function(i){
                       dt.row.add([
                         $c,
                         i.rp_code_apdu,
                         cont.getProgressType(i.rp_progress_id),
                         '<span class="text-success f500" style="font-size: 1.1em;">' + i.title_th + '</span>' +
                         '<div style="font-size: 0.8em;">รายงานเมื่อ : ' + main_app.convertThaidatetime(i.rp_submit_date) + '</div>' +
                         '<div style="font-size: 0.8em;padding-top: 5px;">' +
                          '<a href="#" onclick="cont.progress_step_1(\'' + i.rp_id_rs + '\', \'' + i.rp_progress_id + '\', \'' + i.rp_session + '\')"><i class="zmdi zmdi-edit"></i> ดำเนินการ</a> | ' +
                          // ' <a href="#" class="txt-danger"><i class="zmdi zmdi-delete"></i> ถอนรายงานโดยเจ้าหน้าที่</a>' +
                         '</div>' ,
                         '<span class="txt-danger">' + i.status_name + '</span>'
                       ]);
                       $c++;

                     })
                     dt.draw();

                   }else{

                     dt.clear().draw();
                   }
                 }, 'json')
  }
}
