<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 24.09.18
 * Time: 13:11
 */

class game {

    private $field = [];
    private $field_size;
    private $current_char = 'X';
    private $chars_to_win = 3;

    public function __construct($size){
        for($i = 0; $i < $size; $i++){
            for($j = 0; $j < $size; $j++){
                $this->field[$i][$j] = "_";                                 //пустые поля обозначены как "_"
            }
        }
        $this->field_size = $size;
    }

    public function getFieldSize()
    {
        return $this->field_size;
    }

    public function setFieldSize($field_size)
    {
        $this->field_size = $field_size;
    }

    public function getCurrentChar()
    {
        return $this->current_char;
    }

    public function setCurrentChar($current_char)
    {
        $this->current_char = $current_char;
    }

    public function getCharsToWin()
    {
        return $this->chars_to_win;
    }

    public function setCharsToWin($chars_to_win)
    {
        $this->chars_to_win = $chars_to_win;
    }

    //установка символа
    public function move($x,$y){
        if($this->field[$y][$x] != "_") return;
            $this->field[$y][$x] = $this->current_char;
            $this->changeChar();
    }

    private function changeChar(){
        if ($this->current_char == 'X') $this->current_char = 'O'; else{
            $this->current_char = 'X';
        }
    }

    private function offset_left($x,$y){
        $temp_arr = [];

        for($i = $x, $j = $y; $i >= 0 & $j < count($this->field); $i--, $j++){
            $temp_arr[] = $this->field[$i][$j];

        }

        if(count($temp_arr) >= $this->chars_to_win) {
            return implode($temp_arr);
        }
    }

    private function offset_right($x,$y){

        $temp_arr = [];

        for($i = $x, $j = $y; $i < count($this->field)  & $j < count($this->field); $i++, $j++){
            $temp_arr[] = $this->field[$j][$i];

        }

        if(count($temp_arr) >= $this->chars_to_win) {
            return implode($temp_arr);
        }
    }

    public function check(){

        $pattern = "/X{".$this->chars_to_win.",}|O{".$this->chars_to_win.",}/";

        for($i = 0; $i < count($this->field); $i++) {                       //horisontal check
            $check_string = implode("", $this->field[$i]);
            if (preg_match($pattern, $check_string))return $this->current_char." lose :(";
        }

        $check_string = '';

        for($i = 0; $i < count($this->field); $i++) {                       //vertical check
            for($j = 0; $j < count($this->field); $j++) {
                $check_string = $check_string.$this->field[$j][$i];
            }
            if (preg_match($pattern, $check_string)) return $this->current_char." lose :(";
            $check_string = '';
        }

        for($i = 0; $i < count($this->field[0]); $i++){                     //diagonal left
            $check_string = $this->offset_left($i, 0);
            if (preg_match($pattern, $check_string)) return $this->current_char." lose :(";
        }

        for($i = 1; $i < count($this->field); $i++){                        //diagonal left
            $check_string = $this->offset_left( (count($this->field)-1), $i);
            if (preg_match($pattern, $check_string)) return $this->current_char." lose :(";
        }

        for($i = 0; $i < count($this->field[0]);$i++) {             //diagonal right
            $check_string = $this->offset_right($i, 0);
            if (preg_match($pattern, $check_string)) return $this->current_char." lose :(";
        }

        for($i = 1; $i < count($this->field);$i++) {                //diagonal right
            $check_string = $this->offset_right(0, $i);
            if (preg_match($pattern, $check_string)) return $this->current_char." lose :(";
        }

        return "Game in progress";

    }

    public function show() {
        echo "<table rules='all'>";
        for($i = 0; $i < count($this->field); $i++){
            echo "<tr>";
            for($j = 0; $j < count($this->field); $j++){
                if($this->field[$i][$j] == '_')
                    echo "<td><a href='/tictac.php?x=".$j."&y=".$i."'> ".$this->field[$i][$j]."</a></td>";
                else echo "<td>".$this->field[$i][$j]."</td>";;
            }
            echo "</tr>";
        }
        echo "</table>";
    }

}