var config = {
  ws_url: 'http://localhost/public_html/econsultation/controller/',
  root_domain: 'http://localhost/public_html/econsultation/',
  prefix: 'ecs18_'
}

// var config = {
//   ws_url: 'http://medipe2.psu.ac.th/econsultation/controller/',
//   root_domain: 'http://medipe2.psu.ac.th/econsultation/',
//   prefix: 'ecs18_'
// }

var main = {
  init: function(){
    $w = $(document).width()
    if($w > 500){
      console.log($w);
      $('.navbar, .main-panel').css('padding-left', '260px')
    }else{
      $('.leftmenu').hide()
    }
  },
  signout: function(){
    window.localStorage.removeItem(config.prefix + '_uid')
    window.localStorage.removeItem(config.prefix + '_role')
    window.location = '../../'
  }
}
