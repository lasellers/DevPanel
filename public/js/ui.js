$(document).ready(function(){

 $("#click-login").click(function(e){
  e.preventDefault();
  if($("#login-box").is(":visible"))
  {
    $("#login-box").hide();
  }
  else
  {
    $("#login-box").show();
  }
});

 $("#click-signup").click(function(e){
  e.preventDefault();
  if($("#signup-box").is(":visible"))
  {
    $("#signup-box").hide();
  }
  else
  {
    $("#signup-box").show();
  }
});

});
