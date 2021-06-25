<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>kvd</title>
</head> 
<body>
<header>
    <nav>
        <a class="active" href="index.php"> home icon </a>
        <a href="#"> Uzņēmumiem </a>
        <a href="#"> Vēstules </a>
        <a href="#"> FAQ </a>
    </nav>
</header>
<?php
$_SESSION = array();
session_destroy();
//$_SESSION['id'] = "";
//$_SESSION['sess_username'] = "";

if(empty($_SESSION['id'])){ 
   header("location: index.php");
}
?>


</body>