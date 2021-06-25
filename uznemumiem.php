<?php
require_once("config.php");
use kvd\Classes\DbPDO;
use kvd\Classes\LoginCheck;
use kvd\Classes\CreateInfo;
use kvd\Classes\Upload;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/uznemumiemStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/hero-slider-style.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/tooplate-style.css">

        <title>Uzņēmumiem</title>
</head>
<body>

        <div class="cd-bg" >

        </div>

        <!-- Content -->
<div class="cd-hero ">

            <!-- Navigation -->
    <div class="cd-slider-nav">
        <div class="container">
          <nav class="navbar">
            <div class="tm-navbar-bg">
              <a class="navbar-brand text-uppercase" href="index.php">Pilsētas</a>
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                                &#9776;
                </button>
            <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
            <ul class="nav navbar-nav">
              <li>
                <a class="nav-link" href="index.php" >Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="uznemumiem.php" data-no="2">Uzņēmumiem</a>
              </li>

                        <?php
        $loggedin = new LoginCheck();
        $loggedin->sessionState();
        $loggedin->guestLeavesPage();
        ?>
                        </ul>
                         </div>
                        </div>
                    </nav>
                </div>
            </div>





  <div class="cd-full-width">


            <div class="title-cont  row col-xs-12 col-md-10 mx-auto">
                <h class="tm-text-title text-xs-center tm-home-title">
                  Ievadiet informāciju par jūsu uzņēmumu šajā formā</h>
            </div>
            <div class=" uzn-container
            row col-xs-12 col-md-10 mx-auto">

        <!-- Forms to create business info
 class="text-xs-left tm-textbox"
      -->

            <!-- contact form -->
            <form class="uzn" name="uzn_form" method="POST" enctype="multipart/form-data">
            <div class="userForm col-xs-12 col-md-8">
              <label class="error">
             <?php
             if (isset($_POST['submit'])) {


                 $input = new CreateInfo();
                 $input->userInputCheck();
                 $upl = new Upload();
                 $upl->uplImg();

             }
             ?>
             </label>

                <div class="form-g">
                  <label>Nosaukums</label>
                  <input class="uzn-inpt" name="nosaukums" type="text" autocomplete="off" ></input>
                </div>
                <div class="form-g addr">
                  <label>Adrese</label>
                  <label class="adress">Iela </label>
                  <input class="adr uzn-inpt" name="iela" type="text" autocomplete="off" >
                  <label class="adress" >Pilsēta </label>
                  <input class="adr uzn-inpt" name="pilseta" type="text" autocomplete="off" >
                  <label class="adress">Indeks </label>
                  <input class="adr uzn-inpt" name="indeks" type="text" autocomplete="off" >
                </div>
                <div class="form-g">
                  <label>Darba laiks</label>
                  <input class="uzn-inpt" name="darba_laiks" type="text" autocomplete="off" >
                </div>
                <div class="form-g">
                  <label>Tālrunis</label>
                  <input class="uzn-inpt" name="talrunis" type="text" autocomplete="off" >
                </div>
                <div class="form-g">
                  <label>Uzņēmuma ēpasts</label>
                  <input class="uzn-inpt" name="epasts" type="text" autocomplete="off" >
                </div>
                  <textarea name="apraksts" id="editor1"></textarea>

                  <button type="submit" name="submit" method="POST"  >Izveidot</button>


            </div>

            <div class="form col-xs-12 col-md-4 mx-auto">
                <label>Uzņēmuma attēls</label>
                <div class="upload">
                  <div id="img-in">
                    <input type="FILE" id="uzn_img" name="up_img">
                  </div>
                  <div id="img-cont">
                    <img id="prewImg" src="../img/empty.jpg" >
                  </div>
                </div>
              <!--  <input  type="submit" value="Upload" name="upl_btn"> -->


            </div>
            </form>
        </div>


</div>
   <!-- .cd-full-width -->







       <script src="../ckeditor\ckeditor.js"> </script>
       <script>
           CKEDITOR.replace( 'editor1', {
             uiColor: '#ccffcc',
             extraPlugins: 'notification'
           });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="../js/uzn.js"></script>
        <script src="js/isInViewport.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/hero-slider-main.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>

        <script>

            function adjustHeightOfPage(pageNo) {

                var offset = 80;
                var pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height();

                if($(window).width() >= 992) { offset = 120; }
                else if($(window).width() < 480) { offset = 40; }

                // Get the page height
                var totalPageHeight = 335 + $('.cd-slider-nav').height()
                                        + pageContentHeight + offset
                                        + $('.tm-footer').height();

                // Adjust layout based on page height and window height
                if(totalPageHeight > $(window).height())
                {
                    $('.cd-hero-slider').addClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
                }
                else
                {
                    $('.cd-hero-slider').removeClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
                }
            }



            // Everything is loaded including images.
            $(window).load(function(){

                adjustHeightOfPage(1); // Adjust page height


                /* Collapse menu after click
                -----------------------------------------*/
                $('#tmNavbar a').click(function(){
                    $('#tmNavbar').collapse('hide');

                    adjustHeightOfPage($(this).data("no")); // Adjust page height
                });

                /* Browser resized
                -----------------------------------------*/
                $( window ).resize(function() {
                    var currentPageNo = $(".cd-hero-slider li.selected .js-tm-page-content").data("page-no");

                    // wait 3 seconds
                    setTimeout(function() {
                        adjustHeightOfPage( currentPageNo );
                    }, 3000);

                    if($( window ).width() > 800) {
                       uploadVideo();
                    }

                });



        </script>

</body>
</html>
