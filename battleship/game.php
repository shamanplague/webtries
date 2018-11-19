<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 11.11.18
 * Time: 15:43
 */

class game
{
    public $pre_field = [4, 3, 3, 2, 2, 2, 1, 1, 1, 1, 0];
    public $users_field;
    public $ai_field;
    public $current_player = 'ai';

    public function __construct()
    {
        $array = [];
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $array[$i][$j] = 'e';
            }
        }

        $this->users_field = $array;
    }

    public function winner()

    {

        $result_string = '';

        foreach ($this->users_field as $row) {
            foreach ($row as $cell) {
                $result_string .= $cell;
            }
        }

        if (stripos($result_string, 's') === false) return 'AI won!';

        $result_string = '';

        foreach ($this->ai_field as $row) {
            foreach ($row as $cell) {
                $result_string .= $cell;
            }
        }

        if (stripos($result_string, 's') === false) return 'User won!';

        return false;
    }

    public function changePlayer()
    {
        $this->current_player = ($this->current_player == 'user')? 'ai':'user';
    }

    public function aiMove()
    {
        echo 'ai_move_pre';

        $x = rand(0, 9);
        $y = rand(0, 9);

        echo 'ai_move x='.$x.'y='.$y;

        $this->users_field[$x][$y] = 'c';

    }

}