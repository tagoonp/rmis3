var rw_comment = {
  loadComment: function(j){
    var param = {
      part_id: j,
      id_rs: current_rs_id
    }

    var jxhr = $.post(ws_url + 'controller/readCommentQuestion.php', param, function(){}, 'json')
                .always(function(snap){
                  $('#p' + j).html('<tr><td colspan="2">ไม่มีข้อมูล</td></tr>')

                  var contentData  = '';
                  var prev_seq = 0;
                  var next_seq = 0;
                  var seq = 0;

                  if((snap != '') && (snap.length > 0)){
                    lp.sl()
                    $('#p' + j).empty()
                    snap.forEach(function(i){

                      if(j == 1){
                        contentData = i.riwc_q + '<div class="pt-10"><button class="btn btn-success btn-xs  pl-10 pr-10" data-toggle="modal" data-target=".bs-example-modal-lg-1-2" onclick="setEContent(1, \'' + i.riwc_id  + '\')"><i class="zmdi zmdi-edit"></i> แก้ไข</button> <button class="btn btn-info btn-xs  pl-10 pr-10"  onclick="deleteQ(\'' + i.riwc_id + '\')"><i class="zmdi zmdi-delete"></i> ลบ</button></div>';
                      }else if((j == 2) || (j == 3) || (j == 4)){
                        
                        number_of_comment++

                        if(snap[(seq - 1)] != null){
                          prev_seq = snap[(seq - 1)].riwc_seq
                        }else{
                          prev_seq = i.riwc_seq
                        }

                        if(snap[(seq + 1)] != null){
                          next_seq = snap[(seq + 1)].riwc_seq
                        }


                        $disabled_p = ''
                        $disabled_n = ''

                        if(i.riwc_seq == prev_seq){
                          $disabled_p = 'disabled'
                        }

                        if(i.riwc_seq == next_seq){
                          $disabled_n = 'disabled'
                        }

                        contentData += '<tr>' +
                                '<td class="f500 col-sm-3">คำถามหรือข้อเสนอแนะ :</td>' +
                                '<td>' + i.riwc_q + '<div class="pt-10"><button class="btn btn-success btn-xs  pl-10 pr-10"   data-toggle="modal" data-target=".bs-example-modal-lg-' + j + '-2"  onclick="setEContent( \'' + j + '\', \'' + i.riwc_id  + '\')"><i class="zmdi zmdi-edit"></i> แก้ไข</button> ' +
                                '<button class="btn btn-success btn-xs  pl-10 pr-10" ' + $disabled_p + ' onclick="setMoveUp(\'' + i.riwc_id  + '\', \'' + prev_seq + '\', \'' + i.riwc_seq + '\', \'' + j + '\')"><i class="zmdi zmdi-chevron-up"></i> </button> ' +
                                '<button class="btn btn-success btn-xs  pl-10 pr-10" ' + $disabled_n + ' onclick="setMoveDown(\'' + i.riwc_id  + '\', \'' + next_seq + '\', \'' + i.riwc_seq + '\', \'' + j + '\')"><i class="zmdi zmdi-chevron-down"></i> </button> ' +
                                '<button class="btn btn-info btn-xs  pl-10 pr-10"  onclick="deleteQ(\'' + i.riwc_id + '\')"><i class="zmdi zmdi-delete"></i> ลบ</button></div>' +
                                '</td>' +
                              '</tr>';
                      }else{
                        contentData = '<tr>' +
                                '<td colspan="2"><div class="f500 txt-dark">' + i.rirc_key + ' <small>(' + main_app.convertThaidatetime(i.riwc_staff_add_date) + ')</small></div>' + i.riwc_q + '<div class="pt-10"><button class="btn btn-success btn-xs  pl-10 pr-10"  data-toggle="modal" data-target=".bs-example-modal-lg-5-2"  onclick="setEContent(5, \'' + i.riwc_id  + '\')"><i class="zmdi zmdi-edit"></i> แก้ไข</button> <button class="btn btn-info btn-xs  pl-10 pr-10" onclick="deleteQ(\'' + i.riwc_id + '\')"><i class="zmdi zmdi-delete"></i> ลบ</0</div>' +
                                '</td>' +
                              '</tr>';

                      }

                      seq++;
                    });

                    $('#p' + j).append(contentData)
                    lp.hl()

                  }else{
                    $('#p' + j).html('<tr><td colspan="2">ไม่มีข้อมูล</td></tr>')
                    lp.hl()
                  }
                })
  }
}


function setMoveDown(record_id, prev_seq, current_seq, part){
  var param = {
    c_id: record_id,
    c_seq: current_seq,
    n_seq: prev_seq,
    id_rs: current_rs_id,
    ipart: part,
    f: 'down'
  }

  var jxr = $.post(ws_url + 'controller/set_comment_sequence.php', param, function(){})
             .always(function(r){
               // console.log(r);
               if(r == 'Y'){
                  loadComment()
               }else{
                 alert('error')
               }
             })
}

function setMoveUp(record_id, prev_seq, current_seq, part){
  var param = {
    c_id: record_id,
    c_seq: current_seq,
    n_seq: prev_seq,
    id_rs: current_rs_id,
    ipart: part,
    f: 'up'
  }

  var jxr = $.post(ws_url + 'controller/set_comment_sequence.php', param, function(){})
             .always(function(r){
               if(r == 'Y'){
                  loadComment()
               }else{
                 alert('error')
               }
             })
}
