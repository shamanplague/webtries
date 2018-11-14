<?php

/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 11.11.18
 * Time: 15:40
 */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//print_r($_POST);

$array = [];
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        $array[] = ["$i$j" => 1];
    }
}
$json_array = json_encode($array);


echo '<br>';
?>

<html>
<head>
    <title>Battleship</title>
    <meta charset="UTF-8">
    <link href="battleship/style.css" rel="stylesheet">
    <script src="battleship/scripts.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
</head>

<body>
<div align="center">
    <input type="checkbox" name="vertical">
    <label for="vertical">Вертикальное размещение</label>
<form method="post">
    <script>
        var json_array = <?= $json_array ?>;
        filling();
    </script>

</form>



</div>

</body>

</html>