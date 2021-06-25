$(document).ready(function(){

  $('#ser-form').submit(function(e){
    $ser = $("#serF").val();
    //alert($ser);
    e.preventDefault();

    $.ajax({
      url: '../ajax_php/ser_city.php',
      type: "POST",
      dataType: 'html',
      data: $('#ser-form').serialize(),
      success: function(result) {
        $("#cit-cont").html(result);
      }
    });
  });

  $('#ser-uzn-form').submit(function(e){
    $ser = $("#serF-uzn").val();
    //alert($ser);
    pageURL = window.location.search;
    urlCitName = pageURL.substring(3, pageURL.length);
    $('#ser-uzn-form').append('<input name="cit" type="text" id="remInp" value="'+urlCitName+'">');
    e.preventDefault();

    $.ajax({
      url: '../ajax_php/ser_uzn.php',
      type: "POST",
      dataType: 'html',
      data: $('#ser-uzn-form').serialize(),
      success: function(result) {
        $("#uzn-cont").html(result);
        $("#remInp").remove();
      }
    });
  });
});
