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

//print_r($_GET).'<br>';

if(isset($_GET['new_game'])){
    $current_game = new game();
}

else
{
    $current_game = $_SESSION['game'];
}

if(!empty($_GET) && key($_GET) != 'new_game')
{
    $deck_number = array_shift($current_game->pre_field);
    $row = $_GET['x'];
    $col = $_GET['y'];

    if(isset($_GET['v']))

    {

        for($i = 0; $i < $deck_number; $i++)
        $current_game->users_field[$row + $i][$col] = 's';

    }

    else

    {

        for($i = 0; $i < $deck_number; $i++)
        $current_game->users_field[$row][$col + $i] = 's';

    }

}

//view

//    for($i = 0; $i < 10; $i++){
//        echo '<br>';
//        for($j = 0; $j < 10; $j++){
//            echo $current_game->users_field[$i][$j];
//        }
//    }
if ($current_game->pre_field[0] == 0) $current_game->ai_field = $current_game->users_field;
$_SESSION['game'] = $current_game;

$field_for_placement = json_encode($current_game->users_field);


echo '<br>';
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

    <script>
        var field_for_placement = <?= $field_for_placement ?>;
        var deck_number = <?= $current_game->pre_field[0]?>;
        filling();
   </script>

</div>

<?= '</body>' ?>

</html>
