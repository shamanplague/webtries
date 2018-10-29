<?php
$host='localhost';
$database='tictac';
$user='shaman';
$pswd='1234';

$dbh = mysqli_connect($host, $user, $pswd) or die;
mysqli_select_db($dbh, $database) or die;
