function toggleCustomTab(tab_id)
{
  $('.custom_tab').addClass('dn')
  $('.' + tab_id).removeClass('dn')
}

function load_progress_tool(){
  console.log(current_rs_status);
  if((current_rs_status == 1) || (current_rs_status == 20)){
    var jsr = $.post(ws_url + 'controller/form/form_20.php', function(){})
               .always(function(resp){
                 $('.next_progress_tool').html(resp)

                 var editData = CKEDITOR.replace( 'brief_reports', {
                   wordcount : {
                     showCharCount : false,
                     showWordCount : true,
                     maxWordCount: 500
                   },
                   height: '250px'
                 });
               })


  }
}
