var current_user = localStorage.getItem(config.prefix + 'uid')
var current_role = localStorage.getItem(config.prefix + 'role')
var current_domain = localStorage.getItem(config.prefix + 'domain')

var admin = {
  init(){
    if(current_user == null){
      window.location = './login'
      return ;
    }

    console.log(current_domain);
    authen.user()
  },
  user_create(parm){
    preload.show()
    var jxr = $.post(config.api + 'authen.php?login=3', parm, function(){})
               .always(function(resp){
                 if(resp == 'Y'){
                   window.location.reload()
                 }else{
                   preload.hide()
                   alert('Can not create account')
                 }
               })
  },
  menu_list(){
    var param = {
      uid: current_user,
      domain: current_domain
    }
    var jxr = $.post(config.api + 'menu.php?stage=list', param, function(){}, 'json')
               .always(function(snap){
                 if(wisnior.exists(snap)){
                   $('#result1').empty()
                   $c = 1;
                   snap.forEach(i=>{
                     $data = '<tr>' +
                                '<td>' + $c + '</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
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
