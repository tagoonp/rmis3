var current_user = localStorage.getItem(config.prefix + 'uid')
var current_role = localStorage.getItem(config.prefix + 'role')
var current_domain = localStorage.getItem(config.prefix + 'domain')
var current_page = localStorage.getItem(config.prefix + 'page')

var admin = {
  init(){
    if(current_user == null){
      window.location = './login'
      return ;
    }

    console.log(current_domain);
    authen.user()
  },
  page_group_list(){
    cdm = current_domain
    if(current_domain == null){
      cdm = 'null'
    }

    var param = {
      uid: current_user,
      domain: cdm
    }

    var jxr = $.post(config.api + 'page_group.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if(wisnior.exists(snap)){
                   snap.forEach(i=>{
                     console.log(i);
                   })
                 }else{

                 }
               })

  },
  post_group_create(){
    $check = 0
    $('.form-control').removeClass('is-invalid')

    if($('#txtName').val() == ''){
      $('#txtName').addClass('is-invalid')
      $check++
    }

    if($('#txtElement').val() == ''){
      $('#txtElement').addClass('is-invalid')
      $check++
    }

    if($check != 0){ return; }

    preload.show()

    cdm = current_domain
    if(current_domain == null){
      cdm = 'null'
    }

    var param = {
      uid: current_user,
      domain: cdm,
      category_name: $('#txtName').val(),
      cat_element_name: $('#txtElement').val(),
      lang: $('#txtLang').val()
    }

    var jxr = $.post(config.api + 'post_group.php?stage=create', param, function(){})
               .always(function(response){
                 console.log(response);
                 if(response == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not create new category", "error")
                 }
               })
  },
  loadMediaList(){
    var param = {
      uid: current_user,
      domain: current_domain
    }

    var jxr = $.post(config.api + 'media.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 $('#media-list').empty()
                 if(wisnior.exists(snap)){
                   snap.forEach(i=>{

                     if((i.media_ext == 'pdf') || (i.media_ext == 'doc') || (i.media_ext == 'docx') || (i.media_ext == 'xls') || (i.media_ext == 'xlsx')){
                       $('#media-list').append('<div class="col-12 col-sm-3">' +
                         '<div class="outer media-panal">' +
                           '<div class="img-wrap">' +
                               '<a href="' + i.media_file_fullwebpath + '" target="_blank"><img src="../media/upload/file-flat-icon.jpg" alt="" class="img-feed-cover-1" data-toggle="tooltip" data-placement="top" title="' + i.media_originalname + '"></a>' +
                           '</div>' +
                         '</div>' +
                       '</div>')
                     }else{
                       $('#media-list').append('<div class="col-12 col-sm-3">' +
                         '<div class="outer media-panal">' +
                           '<div class="img-wrap">' +
                               '<img src="' + i.media_file_fullwebpath + '" alt="" class="img-feed-cover-1" data-toggle="tooltip" data-placement="top" title="' + i.media_originalname + '">' +
                           '</div>' +
                         '</div>' +
                       '</div>')
                     }

                   })
                   $('[data-toggle="tooltip"]').tooltip()
                 }else{
                   $('#media-list').html('<div class="col-12 text-center p-5">No media found.</div>')
                 }
               })
  },
  page_group_create(){
    $('.form-control').removeClass('is-invalid')
    if($('#txtName').val() == ''){
      $('#txtName').addClass('is-invalid')
      return ;
    }
    preload.show()

    cdm = current_domain
    if(current_domain == null){
      cdm = ''
    }

    var param = {
      uid: current_user,
      domain: cdm,
      group_name: $('#txtName').val(),
      lang: $('#txtLang').val()
    }

    var jxr = $.post(config.api + 'page_group.php?stage=create', param, function(){})
               .always(function(response){
                 console.log(response);
                 if(response == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not create new page category", "error")
                 }
               })

  },
  post_create(param){
    preload.show()
    if($('#txtID').val() == ''){
      var jxr = $.post(config.api + 'post.php?stage=create', param, function(){})
                 .always(function(resp){
                   console.log(resp);
                   if(resp == 'Y'){
                     window.location = 'modules-post-list'
                   }else{
                     preload.hide()
                     swal("Error!", "Can not create page", "error")
                   }
                 })
    }else{
      var jxr = $.post(config.api + 'post.php?stage=update', param, function(){})
                 .always(function(resp){
                   console.log(resp);
                   if(resp == 'Y'){
                     window.location = 'modules-post-list'
                   }else{
                     preload.hide()
                     swal("Error!", "Can not create page", "error")
                   }
                 })
    }
  },
  page_create(param){
    preload.show()
    if($('#txtID').val() == ''){
      var jxr = $.post(config.api + 'page.php?stage=create', param, function(){})
                 .always(function(resp){
                   console.log(resp);
                   if(resp == 'Y'){
                     window.location = 'modules-page-list'
                   }else{
                     preload.hide()
                     swal("Error!", "Can not create page", "error")
                   }
                 })
    }else{
      var jxr = $.post(config.api + 'page.php?stage=update', param, function(){})
                 .always(function(resp){
                   console.log(resp);
                   if(resp == 'Y'){
                     window.location = 'modules-page-list'
                   }else{
                     preload.hide()
                     swal("Error!", "Can not create page", "error")
                   }
                 })
    }
  },
  toggleMenuStage(id, status){
    var param = {
      uid: current_user,
      menu_id: id,
      to_status: status
    }

    preload.show()
    // console.log(param);
    // return ;

    var jxr = $.post(config.api + 'menu.php?stage=status', param, function(){})
               .always(function(response){
                 console.log(response);
                 if(response == 'Y'){
                   preload.hide()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not chage status", "error")
                 }
               })
  },
  page_toggle(id, status){
    var param = {
      uid: current_user,
      content_id: id,
      to_status: status
    }

    preload.show()

    var jxr = $.post(config.api + 'page.php?stage=status', param, function(){})
               .always(function(response){
                 console.log(response);
                 if(response == 'Y'){
                   // window.location.reload()
                   preload.hide()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not chage status", "error")
                 }
               })
  },
  post_list(par){
    var param = {
      uid: current_user,
      domain: current_domain,
      start: par.start,
      rpp: par.rpp,
      search: par.search
    }
    console.log(param);
    var jxr = $.post(config.api + 'post.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 // return ;
                 if(wisnior.exists(snap)){
                   $('#result1').empty()
                   $c = $('#txtStartNum').val();
                   snap.forEach(i=>{

                     $menu = '<button class="btn btn-sm btn-icon" onclick="admin.post_edit(\'' + i.POST_ID + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                             '<button class="btn btn-sm btn-icon" onclick="admin.post_delete(\'' + i.POST_ID + '\')"><i class="fas fa-trash"></i></button>'


                     $visibility = '<label class="custom-switch mt-2 pl-0">' +
                               '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.POST_ID + '" onclick="admin.page_toggle(\'' + i.POST_ID + '\', \'public\')">' +
                               '<span class="custom-switch-indicator"></span>' +
                             '</label>'

                     if(i.post_status == 'public'){
                       $visibility = '<label class="custom-switch mt-2 pl-0">' +
                                 '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.POST_ID + '" checked onclick="admin.page_toggle(\'' + i.POST_ID + '\', \'private\')">' +
                                 '<span class="custom-switch-indicator"></span>' +
                               '</label>'
                     }

                     $data = '<tr>' +
                                '<td>' + $c + '</td>' +
                                '<td>' + i.post_title +
                                  '<div style="font-size: 0.8em;">URL : <a href="' + i.post_url + '" target="_blank">' + i.post_url + '</a></div>' +
                                '</td>' +
                                '<td>' + i.lang_long_name + '</td>' +
                                '<td>' + i.post_read + '</td>' +
                                '<td>' + $visibility + '</td>' +
                                '<td class="text-right">' + $menu + '</td>' +
                             '</tr>'
                     $('#result1').append($data)
                     $c++
                   })
                   preload.hide()
                 }else{
                   $('#result1').html('<tr><td colspan="6" scope="row" class="text-center">No post found</td></tr>')
                   preload.hide()
                 }
               })
  },
  page_list(par){
    var param = {
      uid: current_user,
      domain: current_domain,
      start: par.start,
      rpp: par.rpp,
      search: par.search
    }
    console.log(param);
    var jxr = $.post(config.api + 'page.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 // return ;
                 if(wisnior.exists(snap)){
                   $('#result1').empty()
                   $c = $('#txtStartNum').val();
                   snap.forEach(i=>{

                     $menu = '<button class="btn btn-sm btn-icon" onclick="admin.page_edit(\'' + i.POST_ID + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                             '<button class="btn btn-sm btn-icon" onclick="admin.page_delete(\'' + i.POST_ID + '\')"><i class="fas fa-trash"></i></button>'


                     $visibility = '<label class="custom-switch mt-2 pl-0">' +
                               '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.POST_ID + '" onclick="admin.page_toggle(\'' + i.POST_ID + '\', \'public\')">' +
                               '<span class="custom-switch-indicator"></span>' +
                             '</label>'

                     if(i.post_status == 'public'){
                       $visibility = '<label class="custom-switch mt-2 pl-0">' +
                                 '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.POST_ID + '" checked onclick="admin.page_toggle(\'' + i.POST_ID + '\', \'private\')">' +
                                 '<span class="custom-switch-indicator"></span>' +
                               '</label>'
                     }

                     $data = '<tr>' +
                                '<td>' + $c + '</td>' +
                                '<td>' + i.post_title +
                                  '<div style="font-size: 0.8em;">URL : <a href="' + i.post_url + '" target="_blank">' + i.post_url + '</a></div>' +
                                '</td>' +
                                '<td>' + i.lang_long_name + '</td>' +
                                '<td>' + i.post_read + '</td>' +
                                '<td>' + $visibility + '</td>' +
                                '<td class="text-right">' + $menu + '</td>' +
                             '</tr>'
                     $('#result1').append($data)
                     $c++
                   })
                   preload.hide()
                 }else{
                   $('#result1').html('<tr><td colspan="6" scope="row" class="text-center">No items found</td></tr>')
                   preload.hide()
                 }
               })
  },
  page_delete(id){

      swal({   title: "Are you sure?",
               text: "You will not be able to recover this content!",
               type: "warning",
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "Yes, delete it!",
               cancelButtonText: "Cancel!",
               closeOnConfirm: true,
               closeOnCancel: true },
               function(isConfirm){
                  if (isConfirm) {
                    var param = {
                      uid: current_user,
                      content_id: id
                    }

                    preload.show()

                    var jxr = $.post(config.api + 'page.php?stage=delete', param, function(){})
                               .always(function(response){
                                 if(response == 'Y'){
                                   window.location.reload()
                                 }else{
                                   preload.hide()
                                   swal("Error!", "Can not delete page", "error")
                                 }
                               })
                  }
              });
  },
  user_create(parm){
    preload.show()
    var jxr = $.post(config.api + 'authen.php?login=3', parm, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   // alert('Can not create account')
                   swal("Error!", "Can not create account", "error")
                 }
               })
  },
  menu_update(){
    $check = 0;
    $('.form-control').removeClass('is-invalid')

    if($('#txtID').val() == ''){
      $('#txtID').addClass('is-invalid')
      $check++
    }

    if($('#txtName2').val() == ''){
      $('#txtName2').addClass('is-invalid')
      $check++
    }

    if($('#txtPosition2').val() == ''){
      $('#txtPosition2').addClass('is-invalid')
      $check++
    }

    if($('#txtLang2').val() == ''){
      $('#txtLang2').addClass('is-invalid')
      $check++
    }

    if($check != ''){
      return ;
    }

    preload.show()

    cdm = current_domain
    if(current_domain == null){
      cdm = ''
    }

    var param = {
      uid: current_user,
      domain: cdm,
      id: $('#txtID').val(),
      name: $('#txtName2').val(),
      position: $('#txtPosition2').val(),
      parent: $('#txtParent2').val(),
      url: $('#txtUrl2').val(),
      subdomain: $('#txtSubdomain2').val(),
      lang: $('#txtLang2').val(),
      target: $('#txtTarget2').val()
    }

    var jxr = $.post(config.api + 'menu.php?stage=update', param, function(){})
               .always(function(response){
                 console.log(response);
                 // return ;
                 if(response == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not create new menu", "error")
                 }
               })
  },
  menu_create(){
    $check = 0;
    $('.form-control').removeClass('is-invalid')
    if($('#txtName').val() == ''){
      $('#txtName').addClass('is-invalid')
      $check++
    }

    if($('#txtPosition').val() == ''){
      $('#txtPosition').addClass('is-invalid')
      $check++
    }

    if($('#txtLang').val() == ''){
      $('#txtLang').addClass('is-invalid')
      $check++
    }

    if($check != ''){
      return ;
    }

    preload.show()

    cdm = current_domain
    if(current_domain == null){
      cdm = ''
    }

    var param = {
      uid: current_user,
      domain: cdm,
      name: $('#txtName').val(),
      position: $('#txtPosition').val(),
      parent: $('#txtParent').val(),
      url: $('#txtUrl').val(),
      subdomain: $('#txtSubdomain').val(),
      lang: $('#txtLang').val(),
      target: $('#txtTarget').val()
    }

    // console.log(param);
    // return ;

    var jxr = $.post(config.api + 'menu.php?stage=create', param, function(){})
               .always(function(response){
                 console.log(response);
                 if(response == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   swal("Error!", "Can not create new menu", "error")
                 }
               })
  },
  menu_delete(id){
    swal({   title: "Are you sure?",
             text: "You will not be able to recover this menu!",
             type: "warning",
             showCancelButton: true,
             confirmButtonColor: "#DD6B55",
             confirmButtonText: "Yes, delete it!",
             cancelButtonText: "Cancel!",
             closeOnConfirm: true,
             closeOnCancel: true },
             function(isConfirm){
                if (isConfirm) {
                  var param = {
                    uid: current_user,
                    menu_id: id
                  }

                  preload.show()

                  var jxr = $.post(config.api + 'menu.php?stage=delete', param, function(){})
                             .always(function(response){
                               if(response == 'Y'){
                                 window.location.reload()
                               }else{
                                 preload.hide()
                                 swal("Error!", "Can not delete menu", "error")
                               }
                             })
                }
            });
  },
  post_edit(id){
    window.location = 'modules-post-new?id=' + id
  },
  page_edit(id){
    // localStorage.setItem(config.prefix + 'page', id)
    window.location = 'modules-page-new?id=' + id
  },
  menu_edit(id){
    preload.show()
    $('#txtID').val(id)
    var param = {
      uid: current_user,
      menu_id: id
    }
    var jxr = $.post(config.api + 'menu.php?stage=info', param, function(){}, 'json')
               .always(function(snap){
                 if(wisnior.exists(snap)){
                   snap.forEach(i=>{
                     console.log(i.menu_name);
                     showModal('update_menu_modal')
                     $('#txtName2').val(i.menu_name)
                     $('#txtPosition2').val(i.menu_position)
                     $('#txtParent2').val(i.parent_id)
                     $('#txtUrl2').val(i.url)
                     $('#txtLang2').val(i.mn_lang_id)
                     $('#txtSubdomain2').val(i.domain_id)
                     $('#txtTarget2').val(i.url_target)
                   })
                   setTimeout(function(){ preload.hide() }, 1000)
                 }else{
                   preload.hide()
                   swal("Error!", "Menu information not found.", "error")
                 }
               })
  },
  menu_list(par){
    console.log();
    var param = {
      uid: current_user,
      domain: current_domain,
      start: par.start,
      rpp: par.rpp,
      search: par.search
    }
    console.log(param);
    var jxr = $.post(config.api + 'menu.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if(wisnior.exists(snap)){
                   $('#result1').empty()
                   $c = $('#txtStartNum').val();
                   snap.forEach(i=>{

                     $menu = '<button class="btn btn-sm btn-icon" onclick="admin.menu_edit(\'' + i.ID + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                             '<button class="btn btn-sm btn-icon" onclick="admin.menu_delete(\'' + i.ID + '\')"><i class="fas fa-trash"></i></button>'

                     $parent = ''
                     if(i.level != 0){
                       $parent = i.pname
                     }

                     $visibility = '<label class="custom-switch mt-2 pl-0">' +
                               '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.ID + '" onclick="admin.toggleMenuStage(\'' + i.ID + '\', \'1\')">' +
                               '<span class="custom-switch-indicator"></span>' +
                             '</label>'

                     if(i.status == '1'){
                       $visibility = '<label class="custom-switch mt-2 pl-0">' +
                                 '<input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="txtDie_' + i.ID + '" checked onclick="admin.toggleMenuStage(\'' + i.ID + '\', \'0\')">' +
                                 '<span class="custom-switch-indicator"></span>' +
                               '</label>'
                     }

                     $dm = '-'
                     if((i.domain_id == 'null') || (i.domain_id == null) || (i.domain_id == '')) {

                     }else{
                       $dm = i.sub_domain
                     }

                     $data = '<tr>' +
                                '<td>' + $c + '</td>' +
                                '<td>' + i.mname +
                                  '<div style="font-size: 0.8em;">URL : <a href="' + i.url + '" target="_blank">' + i.url + '</a></div>' +
                                '</td>' +
                                '<td>' + $parent + '</td>' +
                                '<td>' + $dm + '</td>' +
                                '<td>' + $visibility + '</td>' +
                                '<td class="text-right">' + $menu + '</td>' +
                             '</tr>'
                     $('#result1').append($data)
                     $c++
                   })
                   preload.hide()
                 }else{
                   $('#result1').html('<tr><td colspan="5" scope="row" class="text-center">No items found</td></tr>')
                   preload.hide()
                 }
               })
  },
  subdomain_create(){
    preload.show()
    var param = {
      uid: current_user,
      subdomain: $('#txtName').val(),
      desc: $('#txtDesc').val()
    }

    var jxr = $.post(config.api + 'create-domain.php?stage=create', param, function(){})
               .always(function(resp){
                 if(resp == 'D'){
                   preload.hide()
                   alert('Duplicate sub-domain name')
                 }else if(resp == 'Y'){
                   window.location = 'modules-subdomain-list'
                 }else{
                   preload.hide()
                   alert('Can not create new sub-domain')
                 }
               })
  }
}

admin.init()
