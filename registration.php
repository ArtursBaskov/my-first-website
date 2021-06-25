<?php
require_once("config.php");
use kvd\Classes\DbPDO;
use kvd\Classes\CreateAccount;
use kvd\Classes\RegistrationCheck;
use kvd\Classes\FormVerify;


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
        <title>Registration</title>
</head>
<body>
<div class="cd-bg"></div>





<div class="row col-xs-12 col-md-6 mx-auto registration-form">

    <form class="reg" method="POST">

        <label>Lietotāja vārds</label>
        <input type="text" id="username" name="username" placeholder="Ievadiet savu lietotāja vārdu" ></input>
        <!-- username existance check
        <label class="error">

        </label> <br>    -->

        <label>Ēpasts</label>
        <input type="email" id="email" name="email" placeholder="Ievadiet savu ēpastu" ></input>

        <label>Parole</label>
        <div id="pwdField" class="pwdField">
        <input type="password"  id="userPassword" name="userPassword" autocomplete="off" placeholder="Ievadi savu paroli"  ></input>
        </div>
        <div class="password-strength-status" id="password-strength-status"></div>

        <label>Atkārto paroli</label>
        <input type="password" id="repeatUserPassword" name="repeatUserPassword" placeholder="Atkārtojiet paroli" autocomplete="off" ></input>
        <div id="password-match-status"></div>
        <button type="submit" id="submit" name="submit" method="POST"  >Piereģistrēties</button> <br>
        <br>
        <a href="index.php">Atcelt</a> <br>
         <!-- error check -->
         <label class="error">
        <?php
        if (isset($_POST['submit'])) {
            $checkUser = new RegistrationCheck();
            $checkUser->InputCheck();

        }
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
