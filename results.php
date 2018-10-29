<!DOCTYPE html>

<html>
<head>
    <title>TicTac</title>
    <meta charset="UTF-8">
</head>

<?= '<body>'?>
<?php
require_once 'mysql_connect.php';
$query = "Select * from result";
$res = mysqli_query($dbh, $query);
echo "<table><tr><td>Игрок Х</td><td>Игрок О</td><td>Победитель</td><td>Дата игры</td></tr>";
while($row = mysqli_fetch_array($res))
{
    echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
        $row['player_x'], $row['player_o'], $row['winner'], $row['game_date']);
//echo "Игрок Х: ".$row['player_x']."<br>\n";
}
echo "</table>";

?>


    <a href="/tictac.php">В игру</a><br>
    <a href="/">На главную</a>

</body>

</html>