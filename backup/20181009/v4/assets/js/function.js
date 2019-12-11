var enmonth_sh = new Array ("", "Jan","Feb","Mar",
"Apr","May","Jun", "Jul","Aug","Sep",
"Oct","Nov","Dec");

var fnc = {
  randomString: function(L){
    var s = '';
    var randomchar = function() {
      var n = Math.floor(Math.random() * 62);
      if (n < 10) return n; //1-10
      if (n < 36) return String.fromCharCode(n + 55); //A-Z
      return String.fromCharCode(n + 61); //a-z
    }
    while (s.length < L) s += randomchar();
    return s;
  },
  checksnap: function(snap){ // Function for check json response
    if((snap != '') && (snap.length > 0)){
      return true;
    }else{
      return false;
    }
  },
  convertEngdatetime: function(input){
    if(input == null){
      return "-"
      return ;
    }
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + enmonth_sh[parseInt(cdate[1])] + ', ' + (parseInt(cdate[0])) + ' ' + a[1];
  },
  convertEngdate: function(input){
    let a = input.split(' ');
    let cdate = a[0].split('-');
    return parseInt(cdate[2]) + ' ' + enmonth_sh[parseInt(cdate[1])] + ', ' + (parseInt(cdate[0]));
  }
}
