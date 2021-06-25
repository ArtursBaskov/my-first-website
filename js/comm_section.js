$(document).ready(function()
{
  //komentēšana
  $('#form-comment').submit(function(e){
    $name = $("#hidden-input-name");
    $id = $("#hidden-input-id");
    $commentText = $("#user-comment");
    e.preventDefault();
    if($commentText.val()){
      $.ajax({
        url: '../ajax_php/com_posts.php',
        type: "POST",
        dataType: 'html',
        data: {uzn_name: $name.val(), uzn_id: $id.val(), comment: $commentText.val()},
        success: function(result) {
          //$(".comment-s").html(result);
          $commentText.val('');
          $("#msg").html(result);
          getComments();
        }
      });
    }
  });
  //admin deletes comment
  $('body').on('click', '#delCom', function getID(e){
    $id = $(this).attr('value');
    $.ajax({
      url: '../ajax_php/admin_del_com.php',
      type: "POST",
      dataType: 'html',
      data: {commID: $id},
      success: function(result) {
        //$(".comment-s").html(result);
        $("#msg").html(result);
        getComments();
      }
    });
  });

  //rāda atsauksmes konkrētai publikācijai
  function getComments()
  {
    $name = $("#hidden-input-name");
    $id = $("#hidden-input-id");
    $commentText = $("#user-comment");

    $.ajax({
      url: '../ajax_php/comm_sec.php',
      type: "POST",
      dataType: 'html',
      data: {uzn_name: $name.val(), uzn_id: $id.val()},
      success: function(res) {
        $(".comment-s").html(res);
      }
    });
  }
  getComments();
});
