var note_modal = '<div id="my_note_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
											'<div class="modal-dialog modal-lg">' +
												'<div class="modal-content">' +
													'<div class="modal-header" style="background: rgb(16, 171, 120);">' +
														'<button type="button" class="close btnClosemodal" data-dismiss="modal" aria-hidden="true">×</button>' +
														'<h5 class="modal-title txt-light f500" id="myModalLabel">เพิ่มบันทึกสำหรับงานวิจัย</h5>' +
													'</div>' +
													'<div class="modal-body">' +
                            '<div class="row dn">' +
                              '<div class="col-sm-6">' +
                                '<div class="form-group">' +
                                  '<label class="txt-dark f500">ผู้บันทึก <span class="text-danger">**</span></label>' +
                                  '<input type="text" class="form-control" id="txtNoteOwner" readonly>' +
                                '</div>' +
                              '</div>' +
                              '<div class="col-sm-6">' +
                                '<div class="form-group">' +
                                  '<label class="txt-dark f500">ID ผู้บันทึก <span class="text-danger">**</span></label>' +
                                  '<input type="text" class="form-control" id="txtNoteOwnerID" readonly>' +
                                '</div>' +
                              '</div>' +
                            '</div>' +
														'<div class="form-group">' +
                              '<label class="txt-dark f500">ข้อความหรือบันทึกสำหรับโครงการวิจัยนี้ <span class="text-danger">**</span></label>' +
                              '<textarea id="txtNoteArea"></textarea>' +
                            '</div>' +
                            '<div class="form-group">' +
                              '<div class="clearfix"></div>' +
                              '<button class="btn btn-success btn-block" onclick="note.save_note()">บันทึก</button>' +
                            '</div>' +
                          '</div>' +
												'</div>' +
											'</div>' +
										'</div>'

										var edit_modal = '<div id="my_edit_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
																					'<div class="modal-dialog modal-lg">' +
																						'<div class="modal-content">' +
																							'<div class="modal-header" style="background: rgb(16, 171, 120);">' +
																								'<button type="button" class="close btnClosemodal" data-dismiss="modal" aria-hidden="true">×</button>' +
																								'<h5 class="modal-title txt-light f500" id="myModalLabel">แก้ไขข้อมูลเบื้องต้นโครงการวิจัย</h5>' +
																							'</div>' +
																							'<div class="modal-body">' +
										                            '<div class="row dn">' +
										                              '<div class="col-sm-6">' +
										                                '<div class="form-group">' +
										                                  '<label class="txt-dark f500">ผู้บันทึก <span class="text-danger">**</span></label>' +
										                                  '<input type="text" class="form-control" id="txtNoteOwner" readonly>' +
										                                '</div>' +
										                              '</div>' +
										                              '<div class="col-sm-6">' +
										                                '<div class="form-group">' +
										                                  '<label class="txt-dark f500">ID ผู้บันทึก <span class="text-danger">**</span></label>' +
										                                  '<input type="text" class="form-control" id="txtNoteOwnerID" readonly>' +
										                                '</div>' +
										                              '</div>' +
										                            '</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">ชื่อโครงการ<br><small class="fs08 pl-0">(ภาษาไทย)</small> <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtTitleTH">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">Title<br><small class="fs08 pl-0">(ภาษาอังกฤษ)</small> <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtTitleEN">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">คำสำคัญ <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtKeywordTH">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">Keyword <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtKeywordEN">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">ประเภทโครงการ <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<select class="form-control" id="txtResearchType">' +
																												'<option value="">-- เลือกประเภทโครงการวิจัย --</option>' +
																												'<option value="01">วิทยาศาสตร์พื้นฐาน (Basic science)</option>' +
																												'<option value="02">สังคมศาสตร์/พฤติกรรมศาสตร์ (Social/Behavioral science)</option>' +
																												'<option value="03">การสร้างสรรค์นวัตกรรม (Innovation study)</option>' +
																												'<option value="05">วิทยาศาสตร์ชีวการแพทย์ (Biomedical science)</option>' +
																												'<option value="06">สัตวศาสตร์ (Animal study)</option>' +
																												'<option value="07">บทความปริทัศน์ (Review article)</option>' +
																											'</select>' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">งบประมาณที่ขอ <span class="text-danger">**</span></label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtFundBudget">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
																								'<div class="row">' +
																									'<div class="col-sm-3">' +
																										'<div class="form-group">' +
																											'<label class="txt-dark f500">งบประมาณที่ได้รับจริง</label>' +
																										'</div>' +
																									'</div>' +
																									'<div class="col-sm-9">' +
																										'<div class="form-group">' +
																											'<input type="text" class="form-control" id="txtReadBudget">' +
																										'</div>' +
																									'</div>' +
																								'</div>' +
										                            '<div class="form-group">' +
										                              '<div class="clearfix"></div>' +
										                              '<button class="btn btn-success btn-block" onclick="save_update_research()">บันทึก</button>' +
										                            '</div>' +
										                          '</div>' +
																						'</div>' +
																					'</div>' +
																				'</div>'

var rs_note = '';
var note = {
  add_note_btn: function(){
    document.write('<div class="note_btn" style="background: none;"><button class="btn btn-success" alt="default" data-toggle="modal" data-target="#my_edit_modal" onclick="setEditResearchInfo()"><i class="zmdi zmdi-edit"></i> แก้ไขข้อมูล</button> <button class="btn btn-info" alt="default" data-toggle="modal" data-target="#my_note_modal"><i class="zmdi zmdi-edit"></i> เพิ่มบันทึก</button></div>' + note_modal + edit_modal)
    rs_note = CKEDITOR.replace( 'txtNoteArea', {
      wordcount : {
        showCharCount : false,
        showWordCount : true
      },
      height: '250px'
    });
  },
  add_param: function(){
    if(current_user == null){
      alert('หน้านี้ไม่สามารถเพิ่มบันทึกได้')
      return ;
    }
    $('#txtNoteOwnerID').val(current_user)
  },
  save_note: function(){
    var note_data = rs_note.getData();
    if(note_data == ''){
      alert('กรุณาเพิ่มเนื้อหา/บันทึกก่อน')
      return ;
    }

    var param = {
      id_rs: current_rs_id,
      content: note_data,
      user: $('#txtNoteOwnerID').val(),
      role: 'staff',
      fnc: 'set'
    }

    var jxr = $.post(ws_url + 'controller/note.php', param, function(){})
               .always(function(resp){
                 console.log(resp);
                 if(resp == 'Y'){
                   // alert('บันทึกข้อมูลสำเร็จ')
                   $('.btnClosemodal').trigger('click')
                   note.load_note()
                 }else{
                   alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง')
                 }
               })
               .fail(function(){
                 alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง')
               })
  },
  load_note: function(){

    lp.sl()

    if(current_rs_id == null){
      return ;
    }

    var param = {
      id_rs: current_rs_id,
      role: 'staff',
      fnc: 'get'
    }

    var jxr = $.post(ws_url + 'controller/note.php', param, function(){}, 'json')
               .always(function(snap){

                 $('.noteSpan').empty()

								 console.log(snap);
                 if((snap != '') && (snap.length > 0)){

                   snap.forEach(function(i){
                     $row = '<tr>' +
                              '<td>' + main_app.convertThaidatetime(i.log_datetime) + '</td>' +
                              '<td>' + i.log_detail + '</td>' +
                              '<td>Role ' + i.log_by_role + ' >> ID : ' + i.log_by_id + '<br>' + i.fname + ' ' + i.lname + '</td>' +
                            '</tr>'
                      $('.noteSpan').append($row)
                   })

                   lp.hl()

                 }else{
                   $row = '<tr><td colspan="3">ไม่พบข้อมูลบันทึก </td></tr>'
                   $('.noteSpan').append($row)
                   lp.hl()
                 }
               })
               .fail(function(){
                 $('.noteSpan').empty()
                 $row = '<tr><td colspan="3">ไม่สามารถอ่านข้อมูลได้</td></tr>'
                 $('.noteSpan').append($row)
                 lp.hl()
               })


  }
}

function setEditResearchInfo(){
	var param = {
		id_rs: current_rs_id,
		id: current_user
	}

	var jxr = $.post(ws_url + 'controller/get_staff_researh_info.php', param, function(){}, 'json')
						 .always(function(snap){
							 if((snap != '') && (snap.length > 0)){
								 snap.forEach(function(i){
									 $('#txtTitleTH').val(i.title_th)
									 $('#txtTitleEN').val(i.title_en)
									 $('#txtKeywordTH').val(i.keywords_th)
									 $('#txtKeywordEN').val(i.keywords_en)
									 $('#txtResearchType').val(i.id_type)
									 $('#txtFundBudget').val(i.budget)
									 $('#txtReadBudget').val(i.final_budget)
								 })
							 }else{
								 alert('ไม่พบมูล')
							 }
						 })
}

function save_update_research(){

	$check = 0
	$('form-group').removeClass('has-error')

	if($('#txtTitleTH').val() == ''){
		$check++
		$('#txtTitleTH').parent().addClass('has-error')
	}

	if($('#txtTitleEN').val() == ''){
		$check++
		$('#txtTitleEN').parent().addClass('has-error')
	}

	if($('#txtKeywordTH').val() == ''){
		$check++
		$('#txtKeywordTH').parent().addClass('has-error')
	}

	if($('#txtKeywordEN').val() == ''){
		$check++
		$('#txtKeywordEN').parent().addClass('has-error')
	}

	if($('#txtResearchType').val() == ''){
		$check++
		$('#txtResearchType').parent().addClass('has-error')
	}

	if($('#txtFundBudget').val() == ''){
		$check++
		$('#txtFundBudget').parent().addClass('has-error')
	}

	swal({   title: "คำเตือน",
             text: "คุณยืนยันการปรับปรุงข้อมูลโครงการวิจัยนี้หรือไม่ ?",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "ยืนยัน",
             cancelButtonText: "ยกเลิก",
             closeOnConfirm: true,
             closeOnCancel: true },
             function(isConfirm){
                 if (isConfirm) {
                     lp.sl()

										 $('.btnClosemodal').trigger('click')

										 var param = {
											 th_title: $('#txtTitleTH').val(),
											 en_title: $('#txtTitleEN').val(),
											 th_keyword: $('#txtKeywordTH').val(),
											 en_keyword: $('#txtKeywordEN').val(),
											 rtype: $('#txtResearchType').val(),
											 b1: $('#txtFundBudget').val(),
											 b2: $('#txtReadBudget').val(),
											 id: current_user,
											 id_rs: current_rs_id
										 }
										 var jxr = $.post(ws_url + 'controller/staff_update_research_info_1.php', param, function(){})
										 						.always(function(resp){
																	console.log(resp);
																	if(resp == 'Y'){
																		setTimeout(function(){
																			swal({    title: "ดำเนินการสำเร็จ",
												              text: "กด ตกลง เพื่อทำการรีโหลดข้อมูล",
												              type: "success",
												              showCancelButton: false,
												              confirmButtonColor: "#DD6B55",
												              confirmButtonText: "ตกลง",
												              closeOnConfirm: true },
												              function(){
													              window.location.reload()
												              });
																		}, 1000)
																	}else{
																		alert('error 1')
																		lp.hl()
																	}
																})
																.fail(function(){
																	alert('error')
																	lp.hl()
																})
									 }
                 else {

									 }
            });
}
