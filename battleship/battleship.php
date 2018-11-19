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

echo '<br>';

//print_r($_SESSION);

if(isset($_SESSION['game'])) {

    $current_game = $_SESSION['game'];

        if (!empty($_GET)) {
            $row = $_GET['x'];
            $col = $_GET['y'];

            if ($current_game->ai_field[$row][$col] == 's')
                $current_game->ai_field[$row][$col] = 'c';
            else
                $current_game->ai_field[$row][$col] = 'm';
        }


    $_SESSION['game'] = $current_game;

    echo ($current_game->winner())? $current_game->winner():'Game in progress!';

    $users_field = json_encode($current_game->users_field);
    $ai_field = json_encode($current_game->ai_field);

//        //view
//
//    for($i = 0; $i < 10; $i++){
//        echo '<br>';
//        for($j = 0; $j < 10; $j++){
//            echo $current_game->users_field[$i][$j];
//        }
//    }
//
//    echo '<br>';
//        //view
//
//    for($i = 0; $i < 10; $i++){
//        echo '<br>';
//        for($j = 0; $j < 10; $j++){
//            echo $current_game->ai_field[$i][$j];
//        }
//    }
//
//

}

else
{
    header ("Location: /battleship/placement.php?new_game=true");
}

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
<form action="/battleship/placement.php" method="get" align='center'>
    <input type="hidden" name="new_game" value="true">
    <input type="submit" value="Новая игра">
</form>
    <script>
        var users_field = <?= $users_field ?>;
        var ai_field = <?= $ai_field ?>;
        playViewForAI();
        playViewForUser();
   </script>



</div>

<?= '</body>' ?>

</html>
