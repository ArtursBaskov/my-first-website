<?php
require_once("../config.php");
//session_start();
use kvd\Classes\Search;

$ser = new Search();
echo $ser->getSearchedUzn();
