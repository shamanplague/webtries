<?php

//**
// * Created by PhpStorm.
// * User: shaman
// * Date: 11.11.18
// * Time: 15:40
//**
require_once 'game.php';
session_start();

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo 'Игра';


echo '<br>';

//print_r($_SESSION['game']);

$current_game = $_SESSION['game'];

//print_r($current_game->users_field);

$json_array = json_encode($current_game->users_field);

?>

<html>
<head>
    <title>Battleship</title>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet">
    <script src="scripts.js"></script>
</head>

<?= '<body>' ?>

<div align="center">
<form method="post">
    <script>

   </script>

</form>

</div>

<?= '</body>' ?>

</html>
