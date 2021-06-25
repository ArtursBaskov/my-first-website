<?php
require_once("config.php");
use kvd\Classes\DbPDO;
use kvd\Classes\TableSelect;
use kvd\Classes\LoginCheck;
use kvd\Classes\UserProfile;
use kvd\Classes\Upload;
use kvd\Classes\Email;
use kvd\Classes\CreateInfo;

//$emSend = new Email(@$emialB, @$emailSubj, @$emailMsgReciever);
//$emSend->sendEmail('12arturb34@gmail.com', "kods", "Hi");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/hero-slider-style.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="stylesheet" href="css/profile.css">

        <title>Profils</title>
</head>
<body>

        <div class="cd-bg" >

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



            <li class="selected">
            <div class="row">
            <div class="col-xs-12">
            <div class="background">


            <div class="tm-home-title-container">
                <h2 class="tm-text-title text-xs-center tm-home-title">Lietotāja profils</h2>
            </div>
            <div class="tm-home-description-container profile-cont">
            <div class="text-xs-left tm-textbox">
              <?php
              //profile info

              $user = new UserProfile();
              $upl = new Upload();
              isset($_POST['upload']) ? $upl->uplProfileImage() :null ;
              ?>
              <div class="profile">
                <form method="post" class="prof-form" enctype="multipart/form-data">
                  <div class="form-groupss">
                    <div class="form-gr">

                        <div id="user_inf">
                          <div id="inf">
                            <label>Lietotāja vārds: </label>
                            <input type="text" id="prof-inp" name="user-name" value="<?php $user->getUserName(); ?>">
                          </div>
                          <button class="changeBtn-prof" name="changeName" type="submit">Mainīt</button>
                        </div>
                        <?php
                        isset($_POST['changeName']) ? $user->changeUsernameIF() : 0;
                        ?>
                    </div>
                    <div class="form-gr">

                        <div id="user_inf">
                          <div id="inf">
                          <label>Ē-pasts: </label>
                          <input type="text" id="prof-inp" name="user-email" value="<?php $user->getUserEmail(); ?>">
                          </div>
                          <button class="changeBtn-prof" name="changeEmail" type="submit">Mainīt</button>
                        </div>
                        <?php
                        isset($_POST['changeEmail']) ? $user->checkNewEmail() : null ;
                        ?>
                    </div>
                  </div>
                  <div class="form-g" id="img-form">

                    <div class="upload">
                      <div id="img-in">
                        <input type="FILE" id="uzn_img" class="prof_img" name="up_img">
                      </div>
                      <div id="img-cont">
                        <img id="prewImg" class="prof_img-prew" src="<?php $user->getUserImage(); ?>" >
                      </div>

                    </div>
                    <button class="changeBtn upl" name="upload" type="submit">Saglabāt</button>
                  </div>

                </form>
                <div class="pwd-b">
                  <a role="button" id="pwd-window-open">Mainīt paroli</a>
                </div>
              </div>
        </div>

          <div class="uzn-info-profile-page">
            <?php
            $inf = new CreateInfo();
            $inf->showInf();
            isset($_POST['sagl']) ? $inf->validateUserInput() : 0;
            isset($_POST['dzest']) ? $inf->delInfo() : 0;
            ?>
          </div>
        </div>
    </div>
     </div>

    </div> <!-- .cd-full-width -->

 </li>
 <div class="pwd-screen">
   <div class="pwd-change-window">
      <form method="post" id="pwd-form">
        <button type="button" id="close">X</button>
        <div id="msg-s"></div>
        <label class="pwd-l">Veca parole</label>
        <input class="change-pwd-in" type="password" name="old-pwd">
        <label class="pwd-l">Jauna parole</label>
        <input class="change-pwd-in" type="password" name="new-pwd">
        <label class="pwd-l">Atkārtot jauno paroli</label>
        <input class="change-pwd-in" type="password" name="rep-new-pwd"><br>
        <button type="submit" class="changeBtn" name="new-pwd-submit">Apstiprināt</button>

        <?php
        isset($_POST['new-pwd-submit']) ? $user->checkNewPassword() : 0;
        ?>
      </form>
   </div>
 </div>





        <!-- CKeditor -->
        <script src="../ckeditor\ckeditor.js"> </script>
        <script>
                CKEDITOR.replace( 'editor1', {
                  uiColor: '#ccffcc',
                  extraPlugins: 'notification'
                });
                </script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/pwd-window.js"></script>
        <script src="../js/texarea_fix.js"></script>
        <script src="../js/uzn.js"></script>
</body>
</html>
