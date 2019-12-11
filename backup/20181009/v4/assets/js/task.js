var task = {
  create: function(){
    var check = 0;
    $('.form-control').removeClass('is-invalid')
    $('.invalid-feedback').remove()

    if($('#txtTaskname').val() == ''){
      check++
      $('#txtTaskname').addClass('is-invalid')
    }

    if($('#txtTasktype').val() == ''){
      check++
      $('#txtTasktype').addClass('is-invalid')
    }

    if(check != 0){
      return false;
    }
  }
}

function resetTasktype(){
  $('.tasktype').addClass('dn')
}

$(function(){
  $('#txtTasktype').change(function(){
    resetTasktype()
    $tv = $('#txtTasktype').val()
    if($tv == '4'){
      $('#dailyInput').removeClass('dn')
    }else if($tv == '5'){
      $('#monthlyInput').removeClass('dn')
    }
  })
})
