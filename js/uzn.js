$(document).ready(function(){
  $("#uzn_img").change(function(){
    file = $("#uzn_img").get(0).files[0];
    if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#prewImg").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
  })
})
