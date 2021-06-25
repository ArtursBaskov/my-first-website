$(document).ready(function(){
  $('body').on('click', '#editorZero', function getID(e){
    $('#editor1').removeAttr('id');
    $(this).prop("id","editor1")
    CKEDITOR.replace( 'editor1', {
      uiColor: '#ccffcc',
      extraPlugins: 'notification'
    });
    $id = $(this).attr('id');
  });
})
