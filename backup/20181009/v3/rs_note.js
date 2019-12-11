var pi_day = 0
var pi_time = 0
var st_day = 0
var st_time = 0
var ec_day = 0
var ec_time = 0
var rw_day = 0
var rw_time = 0
var cm_day = 0
var cm_time = 0

var budget_modal1 = '<div id="my_budget_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
											'<div class="modal-dialog modal-sm">' +
												'<div class="modal-content">' +
													'<div class="modal-header" style="background: rgb(16, 171, 120);">' +
														'<button type="button" class="close btnClosemodal" data-dismiss="modal" aria-hidden="true">×</button>' +
														'<h5 class="modal-title txt-light f500" id="myModalLabel">แก้ไขข้อมูลงบประมาณ</h5>' +
													'</div>' +
													'<div class="modal-body">' +
														'<div class="form-group dn">' +
															'<label class="txt-dark f500">ID ผู้บันทึก <span class="text-danger">**</span></label>' +
															'<input type="text" class="form-control" id="txtbudgetOwnerID" readonly>' +
														'</div>' +
														'<table>' +
															'<thead>' +
																'<tr>' +
																	'<th>หัวข้อ</th>' +
																	'<th>หัวข้อ</th>' +
																'</tr>' +
															'</thead>' +
														'</table>' +
														'<div class="form-group">' +
															'<label class="txt-dark f500">ยอดงบประมาณ <span class="text-danger">**</span></label>' +
															'<input type="number" class="form-control" id="txtBudgetNew">' +
															'<div>กรุณากรอกเฉพาะตัวเลขเท่านั้น</div>' +
														'</div>' +
                            '<div class="form-group">' +
                              '<div class="clearfix"></div>' +
                              '<button class="btn btn-success btn-block" onclick="note.save_budget_log()">บันทึก</button>' +
                            '</div>' +
                          '</div>' +
												'</div>' +
											'</div>' +
										'</div>'

										var budget_modal2 = '<div id="my_budget_transection_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
																					'<div class="modal-dialog modal-lg">' +
																						'<div class="modal-content">' +
																							'<div class="modal-header" style="background: rgb(16, 171, 120);">' +
																								'<button type="button" class="close btnClosemodal" data-dismiss="modal" aria-hidden="true">×</button>' +
																								'<h5 class="modal-title txt-light f500" id="myModalLabel">ประวัติการแก้ไขข้อมูลงบประมาณ</h5>' +
																							'</div>' +
																							'<div class="modal-body">' +
																								'<div class="row">' +
																									'<div class="col-sm-12">' +
																										'<table class="table table-bordered">' +
																											'<thead>' +
																												'<tr>' +
																													'<th>#</th>' +
																													'<th>งบประมาณ</th>' +
																													'<th>โดย</th>' +
																													'<th>แก้ไขเมื่อ</th>' +
																												'</tr>' +
																											'</thead>' +
																											'<tbody id="budgetLogTable">' +
																												'<tr>' +
																													'<td colspan="4">ไม่มีประวัติการปรับปรุงงบประมาณ</td>' +
																												'</tr>' +
																											'</tbody>' +
																										'</table>' +
																									'</div>' +
																								'</div>' +
										                          '</div>' +
																						'</div>' +
																					'</div>' +
																				'</div>'

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
                              '<label class="txt-dark f500">การคำนวณวันดำเนินการ <span class="text-danger">**</span></label>' +
                              '<select class="form-control" id="txtCanrange">' +
																'<option value="0" selected>ไม่ใช้เพื่อคำนวน Timeline</option>' +
																'<option value="1" >ใช้คำนวน Timeline</option>' +
															'</select>' +
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
	save_budget_log: function(){
		if($('#txtBudgetNew').val() == ''){
			swal("ขออภัย!", "กรุณาระบุงบประมาณ!", "error")
			$('#txtBudgetNew').parent().addClass('has-error')
			return ;
		}

		swal({
			title: "ยืนยันดำเนินการ",
      text: "คุณแน่ใจหรือไม่ที่จะเปลี่ยนแปลงข้อมูลงบประมาณของโครงการนี้",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#1f92db",
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
      closeOnConfirm: false,
      closeOnCancel: true
		},
    function(isConfirm){
      if (isConfirm) {

				var param = {
		      id_rs: current_rs_id,
		      user: $('#txtbudgetOwnerID').val(),
		      budget: $('#txtBudgetNew').val()
		    }

		    var jxr = $.post(ws_url + 'controller/budget_commit.php', param, function(){})
		               .always(function(resp){
		                 if(resp == 'Y'){
		                   $('.btnClosemodal').trigger('click')
											 swal("สำเร็จ", "ปรับปรุงข้อมูลสำเร็จ", "success")
											 staff.load_rs_info();
		                 }else{
		                   swal("เกิดข้อผิดพลาด", "ไม่สามารถปรับปรุงข้อมูลได้", "error")
		                 }
		               })
			}
    });

	},
  add_note_btn: function(){
		$extra =  '<li>' +
								'<a  href="#" data-toggle="modal" data-target="#my_edit_modal" onclick="setEditResearchInfo()"><div class="pull-left"><i class="zmdi zmdi-edit mr-10"></i><span class="right-nav-text">แก้ไขข้อมูลโครงการวิจัย</span></div><div class="clearfix"></div></a>' +
							'</li>' +
							'<li>' +
								 '<a href="#" data-toggle="modal" data-target="#my_note_modal"><div class="pull-left"><i class="zmdi zmdi-edit mr-10"></i><span class="right-nav-text">เพิ่มบันทึก</span></div><div class="clearfix"></div></a>' +
							 '</li>'
		// $('.extramenu').append($extra)
    document.write('<div class="note_btn" style="background: none;"><button class="btn btn-success" alt="default" data-toggle="modal" data-target="#my_edit_modal" onclick="setEditResearchInfo()"><i class="zmdi zmdi-edit"></i> แก้ไขข้อมูล</button> <button class="btn btn-info" alt="default" data-toggle="modal" data-target="#my_note_modal"><i class="zmdi zmdi-edit"></i> เพิ่มบันทึก</button></div>' + note_modal + edit_modal)
		document.write(note_modal + edit_modal + budget_modal1 + budget_modal2)
    rs_note = CKEDITOR.replace( 'txtNoteArea', {
      wordcount : {
        showCharCount : false,
        showWordCount : true
      },
      height: '250px'
    });

		$('#txtRBudget').after('<div class="pt-5">' +
															'<button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#my_budget_modal" onclick="setBudgetUserId()"><i class="zmdi zmdi-edit"></i> แก้ไขงบประมาณ</button>' +
															'<button class="btn btn-success btn-sm ml-5" data-toggle="modal" data-target="#my_budget_transection_modal" onclick="showBudgetTransection()"><i class="fa fa-search"></i> ดูประวัตการแก้ไข</button>' +
													'</div>')
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
			crange: $('#txtCanrange').val(),
      role: 'staff',
      fnc: 'set'
    }

    var jxr = $.post(ws_url + 'controller/note.php', param, function(){})
               .always(function(resp){
                 console.log(resp);
                 if(resp == 'Y'){
                   // alert('บันทึกข้อมูลสำเร็จ')
                   $('.btnClosemodal').trigger('click')
                   // note.load_note()
									 window.location.reload()
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

								 console.log(snap);

                 $('.noteSpan').empty()

                 if((snap != '') && (snap.length > 0)){
									 $c = 0
									 var stime = ''
									 var etime = ''
									 var role = ''
									 var cm_check_date = ''
									 var dumptime = ''
									 var dumpstage = 0

                   snap.forEach(function(i){
                     $row = '<tr>' +
                              '<td>' + main_app.convertThaidatetime(i.log_datetime) + '</td>' +
                              '<td>' + i.log_detail + '</td>' +
                              '<td>Role ' + i.log_by_role + ' >> ID : ' + i.log_by_id + '<br>' + i.fname + ' ' + i.lname + '</td>' +
                            '</tr>'
                      $('.noteSpan').append($row)

											console.log(i.log_countrange);

											// if(i.log_countrange == 1){
											// 	$daynum = 0
											// 	stime = i.log_datetime
											// 	etime = i.log_datetime
											// 	role = i.log_by_role
											//
											// 	if($c != 0){
											// 		etime = i.log_datetime
											// 		stime = etime
											// 	}else{
											// 		cm_check_date = i.log_datetime
											// 	}
											//
											// 	if($c < (snap.length - 1)){
											// 		if(snap[$c + 1].log_countrange == 1){
											// 			console.log('Call 1');
											// 			if(dumpstage == 1){
											// 				$daynum = cdatetime(snap[$c + 1].log_datetime, dumptime);
											// 				dumpstage = 0
											// 			}else{
											// 				$daynum = cdatetime(snap[$c + 1].log_datetime, stime);
											// 			}
											//
											//
											// 			if(role == 'pi'){
											// 				pi_day += $daynum
											// 				pi_time++
											// 			}
											//
											// 			if(role == 'staff'){
											// 				st_day += $daynum
											// 				st_time++
											// 			}
											//
											// 			if(role == 'ec'){
											// 				ec_day += $daynum
											// 				ec_time++
											// 			}
											//
											// 			if(role == 'reviewer'){
											// 				rw_day += $daynum
											// 				rw_time++
											// 			}
											//
											// 			if(role == 'chairman'){
											// 				cm_day += $daynum
											// 				cm_time++
											// 			}
											// 			console.log('Time between ' + stime + ' - ' + snap[$c + 1].log_datetime + ' role -> ' + role + ' Days -> ' + $daynum);
											// 		}else{
											// 			dumptime = i.log_datetime
											// 			dumpstage = 1
											// 		}
											// 	}
											// }else{
											// 	// etime = i.log_datetime
											// 	dumptime = i.log_datetime
											// 	// stime = i.log_datetime
											// }

											role = i.log_by_role
											$daynum = 0

											if($c == 0){
												if(i.log_countrange == 1){
													stime = i.log_datetime
													cm_check_date = i.log_datetime
												}
											}else{
												role = snap[$c - 1].log_by_role
												if($c < snap.length - 1){
													if(i.log_countrange == 1){
														$daynum = cdatetime(i.log_datetime, stime);
														console.log('Time between ' + stime + ' - ' + i.log_datetime + ' role -> ' + role + ' Days -> ' + $daynum);
														stime = i.log_datetime
													}

													if(role == 'pi'){
														pi_day += $daynum
														pi_time++
													}

													if(role == 'staff'){
														st_day += $daynum
														st_time++
													}

													if(role == 'ec'){
														ec_day += $daynum
														ec_time++
													}

													if(role == 'reviewer'){
														rw_day += $daynum
														rw_time++
													}

													if(role == 'chairman'){
														cm_day += $daynum
														cm_time++
													}
												}else{
													role = snap[$c - 1].log_by_role
													if(i.log_countrange == 1){
														$daynum = cdatetime(i.log_datetime, stime);
														console.log('Time between ' + snap[$c - 1].log_datetime + ' - ' + i.log_datetime + ' role -> ' + role + ' Days -> ' + $daynum);
														stime = i.log_datetime
													}

													if(role == 'pi'){
														pi_day += $daynum
														pi_time++
													}

													if(role == 'staff'){
														st_day += $daynum
														st_time++
													}

													if(role == 'ec'){
														ec_day += $daynum
														ec_time++
													}

													if(role == 'reviewer'){
														rw_day += $daynum
														rw_time++
													}

													if(role == 'chairman'){
														cm_day += $daynum
														cm_time++
													}
												}

											}

											$c++;
                   })

									 // console.log(cm_day);

									 setTimeout(function(){
										 $('#pi_day').text(pi_day)
										 $('#pi_round').text(pi_time)
										 $('#st_day').text(st_day)
										 $('#st_round').text(st_time)
										 $('#ec_day').text(ec_day)
										 $('#ec_round').text(ec_time)
										 $('#rw_day').text(rw_day)
										 $('#rw_round').text(rw_time)
										 $('#cm_day').text(cm_day)
										 $('#cm_round').text(cm_time)

										 //Check reviewer dates
										 var param = {
											 id_rs: current_rs_id
										 }
										 var jxrs = $.post(ws_url + 'controller/check_reviewer_reponse_period.php', param, function(){}, 'json')
										 						.always(function(snap){
																	if(snap != ''){
																		$daynum = cdatetime(snap['start'], snap['end']);
																		$('#rw_day').text($daynum)
																		$('#rw_round').text('1')

																		$stdate = $('#st_day').text()
																		$newstdate = parseInt($stdate) - $daynum
																		if($newstdate <= 0){
																			$newstdate = $stdate
																		}
																		$('#st_day').text($newstdate)

																	}
																})


										 // Check chairman send document
										 if((cm_day == 0) && (cm_time == 0)){
											 var param = {
												 id_rs: current_rs_id
											 }
											 var jxr = $.post(ws_url + 'controller/check_chairman_sign_period.php', param, function(){})
											 						.always(function(resp){
																		console.log(resp);
																		if(resp != ''){
																			$daynum = cdatetime(cm_check_date, resp);
																			$('#cm_day').text($daynum)
																			$('#cm_round').text('1')
																		}

																	})
										 }
									 }, 2000)

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

function cdatetime(d1, d2){
	// Here are the two dates to compare
	// var date1 = '2011-12-24';
	// var date2 = '2012-01-01';
	var bs1 = d1.split(' ')
	var bs2 = d2.split(' ')
	var date1 = bs1[0];
	var date2 = bs2[0];

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
}

function setBudgetUserId(){
	$('#txtbudgetOwnerID').val(current_user)
}

function showBudgetTransection(){
	// #budgetLogTable
	var param = {
		id_rs: current_rs_id
	}

	var jxr = $.post(ws_url + 'controller/budget_commit_transection.php', param, function(){}, 'json')
						 .always(function(snap){
							 console.log(snap);
							 if((snap != '') && (snap.length > 0)){
								 $('#budgetLogTable').empty()
								 $c = 1;
								 snap.forEach(function(i){
									 $data = '<tr>' +
									 					 '<td>' + $c + '</td>' +
														 '<td>' + i.lb_budget + '</td>' +
														 '<td>' + i.fname + ' ' + i.lname + '</td>' +
														 '<td>' + main_app.convertThaidatetime(i.lb_updateon) + '</td>' +
									 				 '</tr>'
									 $('#budgetLogTable').append($data)
									 $c++;
								 })
							 }else{
								 $('#budgetLogTable').empty()
								 $('#budgetLogTable').append('<tr>' +
									 '<td colspan="4">ไม่มีประวัติการปรับปรุงงบประมาณ</td>' +
								 '</tr>')
							 }
						 })
}
