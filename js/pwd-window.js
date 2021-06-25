$(document).ready(function(){

  $('#pwd-window-open').click(function(){
    $(".pwd-screen").css({"display": "block"});
  });
  $('#close').click(function(){
    $(".pwd-screen").css({"display": "none"});
  });

  $('#pwd-form').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '../ajax_php/change_pwd.php',
      type: "POST",
      dataType: 'html',
      data: $('#pwd-form').serialize(),
      success: function(result) {
        $("#msg-s").html(result);
      }
    });
  });
});
