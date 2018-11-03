<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'tictac/game.php';
require_once 'tictac/baseController.php';

session_start();

echo <<<HEADER
<!DOCTYPE html>

<html>
    <head>
        <title>TicTac</title>
        <meta charset="UTF-8">
        <link href="tictac/style.css" rel="stylesheet">
        <script src="tictac/scripts.js"></script>
    </head>
    <style>
    h2 {
    margin-top: 1px;
    margin-bottom: 1px;
}
</style>
    <body>
HEADER;

echo <<<FORM

    <form id = "topform" align="center" method="post" action="/tictac.php">
        Player X: <input id="player_x" name="player_x">
        Player O: <input id="player_o" name="player_o">
        <br>
        Field size: <select id="field_size" name="field_size" onChange="change_select()"></select>
        Chars to win: <select id="chars_to_win" name="chars_to_win" onChange="">
            <option value="3">3</option>
        </select><br>
        <input type="hidden" name="new_game">
        <input type="submit" value="Start game!">
    </form>

    <script>filling_select();</script>

FORM;

$dbcontroller = new baseController('localhost','tictac','shaman', '1234');

$footer = "<a href='tictac/results.php'>Таблица результатов</a><br>
    <a href='/'>На главную</a></body></html>";

if(isset($_POST['new_game']))
{
    $field_size = $_POST['field_size'];
    $current_game = new game($field_size);
    $current_game->setCharsToWin($_POST['chars_to_win']);
    $current_game->player_x_name = ($_POST['player_x'])? $_POST['player_x']:'unnamed_x';
    $current_game->player_o_name = ($_POST['player_o'])? $_POST['player_o']:'unnamed_o';
    $dbcontroller->insert('game',
            ['player_x' => "$current_game->player_x_name",
             'player_o' => "$current_game->player_o_name"])->run();
    $res = $dbcontroller->select('game', ['*'])->last();
    $current_game->setGameId($res['id']);
    //echo $current_game->getGameId();

}
elseif (isset($_SESSION['game']))
{
    $current_game = $_SESSION['game'];
}
else
{
    echo $footer;
    return;
}

if( isset($_GET['x']) && isset($_GET['y']) ){
    $x = $_GET['x'];
    $y = $_GET['y'];
    if(isset($_GET['x']) && isset($_GET['y']) &&
       ($x < $current_game->getFieldSize() && $x >= 0) &&
       ($y < $current_game->getFieldSize() && $y >= 0)) {

        $move = 'x'.$x.'y'.$y;
        $game_id = $current_game->getGameId();
        $current_char = $current_game->getCurrentChar();
        $dbcontroller->insert('turn',
            ['game_id' => "$game_id",
             'move' => "$move",
             'players_char' => "$current_char"])->run();

        $current_game->move($x,$y);
    }
}

if ($current_game->check() != "Game in progress")
{

    $winner = ($current_game->getCurrentChar() == 'X')?
        $current_game->player_o_name:$current_game->player_x_name;

    echo "<h1 align='center'>".$winner.' '.$current_game->check()."</h1><br>";
    $game_id = $current_game->getGameId();
    $dbcontroller->insert('result',
    ['game_id' => "$game_id",
     'winner' => $winner])->run();

    echo "<div style='pointer-events: none; cursor: default'>";
    $current_game->show();
    echo "</div>";

}
else
{
    echo "<h1 align='center'>".$current_game->check()."</h1><br>";
    echo "<h2 align='center'> $current_game->player_x_name: X $current_game->player_o_name: O</h2><br>";
    echo "<h4 align='center'>Current move: ".$current_game->getCurrentChar().
    "  Chars for win: ".$current_game->getCharsToWin()."</h4><br>";
    $current_game->show();
}

$_SESSION['game'] = $current_game;

echo $footer;