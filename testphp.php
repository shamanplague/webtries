<?php

ini_set('error_reporting', E_ALL);  //вывод ошибок в браузер
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo <<<END
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Task</title>

</head>

<body>

    <p>Задание: Определить, является ли строка, введённая пользователем, палиндромом.
    <br>Если является - вывести строку целиком
    <br>Если не вся строка является палиндромом - вывести самую длинную подстроку, являющуюся палиндромом
    <br>Иначе вывести первый символ строки</p>

    <form id = "topform" method="post" action="/testphp.php">
        Enter your string: <input id="current_string" name="current_string"></input>
        <input type="submit" value="Check!">
    </form>

END;

$string = isset($_POST['current_string'])? $_POST['current_string']:"А роза упала на лапу азора";

echo "Текущая строка: ".$string."<br><br>";

echo "Результат: ".output($string);

function output($string)
{
    $cluster_length = mb_strlen($string) + 1;
    for ($i = $cluster_length; $i > 1; $i--)      //кластер
        for ($j = 0; $j < $cluster_length - $i; $j++) {    //смещение

            if (check(mb_substr($string, $j, $i))) return mb_substr($string, $j, $i);
        }
     return mb_substr($string, 0, 1);
}

function check($string)
{
    $string = preg_replace('/\s+/','',mb_strtolower($string));
    $len = mb_strlen($string)-1;
    $newstring = '';

    for ($n = $len;$n >= 0;$n--){
        $newstring .= mb_substr($string, $n, 1);
    }

    return $string == $newstring;
}


?>

<br><br><a href="/">На главную</a>

</body>
</html>