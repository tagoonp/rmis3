var authen = {
  user(){
    var param = {id: current_user, role: current_role}
    var jxr = $.post(config.api + 'authen.php?login=2', param, function(){}, 'json')
               .always(function(snap){
                 if(wisnior.exists(snap)){
                   snap.forEach(i=>{
                     $('.currentUserFullname').html(i.user_fullname)
                   })
                 }else{
                   window.localStorage.removeItem(config.prefix + 'uid')
                   window.localStorage.removeItem(config.prefix + 'role')
                   window.location = './login'
                 }
               })
  },
  signout(){
    window.localStorage.removeItem(config.prefix + 'uid')
    window.localStorage.removeItem(config.prefix + 'role')
    window.location = './login'
  }
}
