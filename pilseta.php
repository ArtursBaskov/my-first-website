<?php
require_once("config.php");
//session_start();
use kvd\Classes\DbPDO;
use kvd\Classes\LoginCheck;
use kvd\Classes\CreateInfo;
use kvd\Classes\Search;
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="css/mainPage.css">
         <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="css/hero-slider-style.css">
    <!-- Hero slider style (https://codyhouse.co/gem/hero-slider/) -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Magnific popup style (http://dimsemenov.com/plugins/magnific-popup/) -->
    <link rel="stylesheet" href="css/tooplate-style.css">

        <title>kvd</title>
</head>
<body>

        <div class="cd-bg" >
           <!-- Background -->
        </div>

        <!-- Content -->
<div class="cd-hero">

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
                        <li class="nav-item active selected">
                            <a class="nav-link" href="index.php" data-no="1">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="uznemumiem.php" data-no="2">Uzņēmumiem</a>
                        </li>


                        <?php
        $loggedin = new LoginCheck();
        $loggedin->sessionState();
        ?>
                        </ul>
                         </div>
                        </div>
                    </nav>
                </div>
            </div>







    <?php

      $post = new CreateInfo();
      $post->cityPage();
    ?>




  <!-- -->











                    </div> <!-- .cd-full-width -->

                    <?php
                    //$ser = new Search();
                    //isset($_POST['search-btn-uzn']) ? $ser->getSearchedUzn() : 0;
                    ?>


        <!-- load JS files -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/search_info.js"></script>
        <script src="js/tether.min.js"></script>                <!-- http://tether.io/ -->
        <script src="js/isInViewport.min.js"></script>          <!-- isInViewport js (https://github.com/zeusdeux/isInViewport) -->
        <script src="js/bootstrap.min.js"></script>             <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
        <script src="js/hero-slider-main.js"></script>          <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
        <script src="js/jquery.magnific-popup.min.js"></script> <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->

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
