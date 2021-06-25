<?php
session_start();
require_once("../config.php");
//session_start();
use kvd\Classes\UserProfile;

$ser = new UserProfile();
$ser->checkNewPassword();
