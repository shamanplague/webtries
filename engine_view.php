<?php require_once 'Cylinder.php';
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engine</title>
</head>
<body>

     <?php

    ini_set('error_reporting', E_ALL);  //вывод ошибок в браузер
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

     if(isset($_POST['cancel'])) session_unset();

     $engine = isset($_SESSION['engine'])
         ? $_SESSION['engine']:
         [$cylinder_one = new Cylinder(2),
         $cylinder_two = new Cylinder(3),
         $cylinder_three = new Cylinder(1),
         $cylinder_four = new Cylinder(0)];

     echo "<div style=\"overflow: hidden;\">";
     if(isset($_POST['next'])) foreach ($engine as $item){
         $item->next_cycle();
     };
     echo "</div>";

     foreach ($engine as $item){
         $item->show();
     }

     $_SESSION['engine'] = $engine;

    ?>

     <br><br>
     <form align="center" method="post" action="/engine_view.php">
<!--        <input type="submit" name="cancel" value="Clear session">-->
        <input type="submit" name="next" value="Next cycle">
     </form>

     <br><br><a href="/">На главную</a>

</body>
</html>