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

    public function __construct()
    {
        $array = [];
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $array[$i][$j] = 0;
            }
        }

        $this->users_field = $array;
    }

}