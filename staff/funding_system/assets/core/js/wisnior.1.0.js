"use strict"

var wisnior = {
  init(){
    var jxr = $.post(config.api + 'core/get_start.php', function(resp){
      if(resp == 'No database install'){
        window.location = config.domain + 'installation/'
        return ;
      }
    })
  },
  exists(snap){
    if((snap != '') && (snap.length > 0)){
      return true;
    }else{
      return false;
    }
  }
}

wisnior.init()

function showModal(id){
  $('#' + id).modal()
}

$(function(){
  $('#txtSearchTextBox').keyup(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      var search_text = $('#txtSearchTextBox').val()
      window.location = 'search?key=' + search_text
    }
  })

  // $('#txtSearchTextBox').keyup(function(){
  //   var search_text = $('#txtSearchTextBox').val()
  //   console.log(search_text);
  // })
})
