<?php
session_start();
require_once("../config.php");
//session_start();
use kvd\Classes\CommentSection;

$ser = new CommentSection();
$ser->commentQuery();
