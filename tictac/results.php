<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo <<<END
<!DOCTYPE html>

<html>
<head>
    <title>TicTac</title>
    <meta charset="UTF-8">
</head>

<body>

END;

require_once 'baseController.php';

$dbcontroller = new baseController('localhost','tictac','shaman', '1234');
$winners = $dbcontroller->select('result',['*'])->run();
//print_r($result);
//$game = $dbcontroller->select('game', ['player_x', 'player_o', 'game_date'])->run();

echo "<table><tr><td>Игрок Х</td><td>Игрок О</td><td>Победитель</td><td>Дата игры</td></tr>";
while ($winner = mysqli_fetch_assoc($winners)){
    $winner_id = $winner['game_id'];
    $game = mysqli_fetch_assoc($dbcontroller->select('game', ['player_x','player_o','game_date'])
        ->where(["id", "=", "$winner_id"])->run());
    echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
        $game['player_x'], $game['player_o'], $winner['winner'], $game['game_date']);

}
echo "</table>";


echo <<<END


    <a href="/tictac.php">В игру</a><br>
    <a href="/">На главную</a>

</body>

</html>
END;
