<?php
session_start();
require_once("config.php");
use kvd\Classes\DbPDO;
use kvd\Classes\CreateAccount;
use kvd\Classes\RegistrationCheck;
use kvd\Classes\FormVerify;
use kvd\Classes\Email;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" href="css/tooplate-style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <title>Ē-pasta apstiprināšana</title>
</head>
<body>
<div class="cd-bg"></div>





<div class="row col-xs-12 col-md-6 mx-auto registration-form">

    <form class="reg verify-code" method="POST">
        <?php
        $ver = new FormVerify();
        if(isset($_POST['submit'])){
          $ver->checkCode();
        }
        ?>
        <label>Ievadiet kodu, kas bija aizsūtīts uz Jūsu e-pastu.</label>
        <input type="text" id="code" name="em_ver_code" autocomplete="off" placeholder="" ></input>
        <button type="submit" id="submit" name="submit" method="POST">Apstiprināt e-pastu</button> <br>
        <br><br>
        <label>Ja kods nav saņemts vai e-pasts bija nepareizi ievadīts - sūtiet vēlreiz.</label>
        <input type="text" id="code" name="email-again" autocomplete="off" placeholder="Ievadit savu e-pastu" ></input>
        <button type="submit" id="submit" name="send-again" method="POST">Sūtīt</button> <br>
        <br>
        <a href="index.php">Atcelt</a> <br>
         <!-- error check -->
         <label class="error">
        <?php
        $send = new Email();
        isset($_POST['send-again']) ? $send->sendAgain(): null;
        ?>
        </label>
    </form>
</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/pwdStrength.js"></script>
</body>
</html>
