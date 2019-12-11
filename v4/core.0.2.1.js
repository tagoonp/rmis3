var current_user = window.localStorage.getItem('rmis_current_user')
var current_role = window.localStorage.getItem('rmis_current_role')
var fileload = false;
var loadstage = 0

$(':input[type=number]').on('mousewheel', function(e){
    $(this).blur();
});

$('[data-toggle="tooltip"]').tooltip()

var core = {
    get_year: function(){

    },
    check_load_stage: function(loadnum){
      console.log(loadstage + ' ' + loadnum);
        setTimeout(function(){
          if(loadstage < (loadnum - 1)){
            loadstage++
            core.check_load_stage(loadnum)
          }else{
            preload.hide()
          }
        }, 1000)
    },
  signout: function(){
    swal({    title: "คุณแน่ใจหรือไม่",
              text: "คลิก 'ยืนยัน' เพื่อออกจากระบบ หรือคลิก 'ยกเลิก' เพื่ออยู่ในระบบต่อไป",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "ยืนยัน",
              cancelButtonText: "ยกเลิก",
              closeOnConfirm: false },
              function(){
                window.location = config.root_domain
              });
  },
  session_denine: function(stage){
    if(stage == 'timeout'){
      swal({
        title: "Session timeout",
        text: "Click OK and go to login.",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true },
      function(){
        window.location = '../index.html'
      });
    }else if(stage == 'permission'){
      swal({
        title: "Permission denied.",
        text: "Click OK and go to login.",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true },
      function(){
        window.location = '../index.html'
      });
    }else{
      swal({
        title: "System denied.",
        text: "Click OK and go to login.",
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OK",
        closeOnConfirm: true },
      function(){
        window.location = '../index.html'
      });
    }
  }
}
