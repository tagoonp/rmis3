var authen = {
  login(){
    var param = {
      username: $('#txtUsername').val(),
      password: $('#txtPassword').val()
    }

    var jxr = $.post(config.api + 'authen.php?login=1', param, function(){}, 'json')
               .always(function(snap){

                  if(wisnior.exists(snap)){
                    snap.forEach(function(i){
                      if(i.status == 'Success'){
                        window.localStorage.setItem(config.prefix + 'uid', i.data.ID)
                        window.localStorage.setItem(config.prefix + 'role', i.data.user_role)
                        window.localStorage.setItem(config.prefix + 'domain', i.data.user_domain)
                        window.location = '../' + i.data.user_role
                      }else{
                          alert('Invalid user account')
                      }
                    })
                  }else{
                    // preload.hide()
                    alert('Invalid user account')
                    console.log("no data");
                  }
               })
               .fail(function(){
                 main.error_log()
               })
  }
}
