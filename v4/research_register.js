var project_session = window.localStorage.getItem('rmis_current_project_session_id')

var rs = {
  init: function(){
    if(project_session == null){
      var param = {
        id: current_user
      }
      var jxhr = $.post(ws_url + '/controller/rs-create-project-session.php', param, function(){})
                  .always(function(resp){
                    if(resp != ''){
                      project_session = resp
                      window.localStorage.setItem('rmis_current_project_session_id', project_session)
                      console.log(project_session);
                    }
                  })
    }


    rs.autosave()
    setInterval(function(){
      rs.autosave()
    }, 30000);

  },
  check_sum: function(){

  },
  autosave: function(){
    if($('#txtTitleTH').val() != ''){

      var param = {
        
      }

    }
  }
}

rs.init()
