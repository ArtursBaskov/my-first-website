

    <?php
    require_once("config.php");

    use kvd\Classes\DbPDO;
    use kvd\Classes\LoginCheck;
    use kvd\Classes\{CreateInfo, CommentSection};
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

            <title>Info lapa</title>
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

  <div class="cd-full-width">
    <div class="panel row col-xs-12 col-md-9 mx-auto">
        <h name="cityName">Uzņēmuma informācija<h>
    </div>
    <div class="BG row col-xs-12 col-md-10 mx-auto">

      <?php
      $info = new CreateInfo;
      $info->postPage();
      ?>

      <div class="comment-section">

        <div class="comment-form">
          
          <form method="post" id="form-comment">
            <p id="msg"></p>
            <h1>Jūsu atsauksme</h1>
            <button type="submit" class="changeBtn">Komentēt</button>
            <textarea name="comment" id="user-comment"></textarea>
          </form>
        </div>

        <div class="comment-s">

        </div>

      </div>
    </div>
  </div>

  </div> <!-- .cd-full-width -->




  <!-- load JS files -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/comm_section.js"></script>
  <script src="js/tether.min.js"></script>                <!-- http://tether.io/ -->
  <script src="js/isInViewport.min.js"></script>          <!-- isInViewport js (https://github.com/zeusdeux/isInViewport) -->
  <script src="js/bootstrap.min.js"></script>             <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
  <script src="js/hero-slider-main.js"></script>          <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
  <script src="js/jquery.magnific-popup.min.js"></script> <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->



  </body>
  </html>
