<?php require_once 'game.php';
session_start(); ?>

<!DOCTYPE html>

<html>
    <head>
        <title>TicTac</title>
        <meta charset="UTF-8">
        <style>

            td a {
                display:    block;
            }

            td {
                width:      50px;
                height:     50px;
                text-align: center;
                font-size:  45px;
            }

            #topform {
                border: 2px solid olive;
                border-radius: 7px;
                margin: 10px;
            }

            #topform input{
                margin: 10px;
            }

            #topform select{
                margin: 10px;
            }

            table {
                margin-left:    auto;
                margin-right:   auto;
            }

            td a, td a:active, td a:visited, td a:hover {
                color:white;
            }

        </style>
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
    ?>

    <body>

    <form id = "topform" align="center" method="post" action="/tictac.php">
        Field size: <select id="field_size" name="field_size" onChange="change_select()"></select>
        Chars to win: <select id="chars_to_win" name="chars_to_win" onChange="">
            <option value="3">3</option>
        </select><br>
        <input type="hidden" name="cancel">
        <input type="submit" value="Start game!">
    </form>

    <script>

        var tempObj = document.getElementById("field_size");
        for (i = 3; i <= 20; i++) {
            tempObj.options[tempObj.options.length] = new Option(i, i);
        }


        function change_select(){

            var objSel = document.getElementById("chars_to_win");
            objSel.options.length = 0;

            var e = document.getElementById("field_size");
            var value = e.options[e.selectedIndex].value;

            for (i = 3; i <= value; i++) {
                objSel.options[objSel.options.length] = new Option(i, i);
            }

            var temp = e.offsetTop;

        }

    </script>



    <?php

    echo "<h1 align='center'>".$current_game->check()."</h1><br>";

    if ($current_game->check() != "Game in progress"){
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

    <a href="/">На главную</a>

    </body>
</html>
