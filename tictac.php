<?php require_once 'game.php';
session_start();?>

<!DOCTYPE html>

<html>
    <head>
        <title>TicTac</title>
        <meta charset="UTF-8">
        <link href="style.css" rel="stylesheet">
        <script src="scripts.js"></script>
    </head>

    <?php

    ini_set('error_reporting', E_ALL);  //вывод ошибок в браузер
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    if(isset($_POST['cancel'])) session_unset();
    $field_size = isset($_POST['field_size'])? $_POST['field_size']:3;
    $current_game = !isset($_SESSION['game'])? new game($field_size):$current_game = $_SESSION['game'];
    if (isset($_POST['chars_to_win'])) $current_game->setCharsToWin($_POST['chars_to_win']);
    $chars_to_win = $current_game->getCharsToWin();

    if( isset($_GET['x']) && isset($_GET['y']) ){
        $x = $_GET['x'];
        $y = $_GET['y'];

        if(isset($_GET['x']) && isset($_GET['y']) &&
           ($x < $current_game->getFieldSize() && $x >= 0) &&
           ($y < $current_game->getFieldSize() && $y >= 0)) {
            $current_game->move($x,$y);
        }
    }

    if(isset($_POST['player_x'])) $current_game->player_x_name = $_POST['player_x'];
    if(isset($_POST['player_o'])) $current_game->player_o_name = $_POST['player_o'];

    ?>

    <?= '<body>'?>

    <form id = "topform" align="center" method="post" action="/tictac.php">
        Player X: <input id="player_x" name="player_x" value="<?= $current_game->player_x_name ?>">
        Player O: <input id="player_o" name="player_o" value="<?= $current_game->player_o_name ?>"><br>
        Field size: <select id="field_size" name="field_size" onChange="change_select()"></select>
        Chars to win: <select id="chars_to_win" name="chars_to_win" onChange="">
            <option value="3">3</option>
        </select><br>
        <input type="hidden" name="cancel">
        <input type="submit" value="Start game!">
    </form>

    <script>filling_select();</script>

    <?php

    echo "<h1 align='center'>".$current_game->check()."</h1><br>";

    if ($current_game->check() != "Game in progress"){

        require_once 'mysql_connect.php';
        $winner = ($current_game->getCurrentChar() == 'X')? $current_game->player_o_name:$current_game->player_x_name;
        $query = sprintf("insert into result (player_x, player_o, winner) values ('%s', '%s', '%s')",
            $current_game->player_x_name, $current_game->player_o_name, $winner);
        mysqli_query($dbh, $query);

        echo "<div style='pointer-events: none; cursor: default'>";
        $current_game->show();
        echo "</div>";}
    else {

        echo "<h2 align='center'>Current move: ".$current_game->getCurrentChar().
        "  Chars for win: ".$chars_to_win."</h2><br>";
        $current_game->show();
    }

    $_SESSION['game'] = $current_game;

    ?>

    <a href="/results.php">Таблица результатов</a><br>
    <a href="/">На главную</a>

    </body>
</html>
