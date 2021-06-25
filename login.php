<?php
require_once("config.php");
use kvd\Classes\DbPDO;
use kvd\Classes\LoginCheck;



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
        <title>login</title>
</head> 
<body>
<div class="cd-bg" >
            
            </div> 
<div class="row col-xs-12 col-md-6 mx-auto registration-form">
    <form class="reg" method="POST">
        
        <label>Ēpasts</label>
        <input type="email" id="email" name="email" placeholder="Ievadi savu ēpastu" required></input>
       
        <label>Parole</label>
        <input type="password" id="userPassword" name="userPassword" autocomplete="off" placeholder="Ievadi savu paroli" required></input>
        <?php
        if (isset($_POST['submit'])) {
            $checkLogin = new LoginCheck();
            $checkLogin->correctLogin();
        }
        ?>
        

        <button type="submit" name="submit" method="POST" >Ielogoties</button> <br> <br>
        <a href="registration.php"> Piereģistrēties </a> <br> <br>
        <a href="index.php">Atcelt</a>
    </form>
</div>
</body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/pwdStrength.js"></script>
</html>