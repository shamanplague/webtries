<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 28.09.18
 * Time: 11:02
 */

class Cylinder
{
private $intake_valve;
private $vent_valve;
private $piston;
private $spark_plug;
private $current_cycle;

    public function __construct($cycle)
    {
        $this->set_cycle($cycle);
    }

    private function set_cycle($cycle)
    {
        switch ($cycle) {
            case 0:
                $this->intake_valve = "open";
                $this->vent_valve = "close";
                $this->piston = "down";
                $this->spark_plug = "off";
                $this->current_cycle = 0;
                return;
            case 1:
                $this->intake_valve = "close";
                $this->vent_valve = "close";
                $this->piston = "up";
                $this->spark_plug = "off";
                $this->current_cycle = 1;
                return;
            case 2:
                $this->intake_valve = "close";
                $this->vent_valve = "close";
                $this->piston = "down";
                $this->spark_plug = "on";
                $this->current_cycle = 2;
                return;
            case 3:
                $this->intake_valve = "close";
                $this->vent_valve = "open";
                $this->piston = "up";
                $this->spark_plug = "off";
                $this->current_cycle = 3;
                return;
        }
    }

    public function next_cycle()
    {
        if ($this->current_cycle == 3)
        {
            $this->set_cycle(0);
            return;
        }
        $this->set_cycle($this->current_cycle + 1);
    }

    public function show()
    {
        echo "<div style='text-align: center; width: 25%; display: inline-block;'>";
        echo "Current cycle: ".$this->current_cycle."<br><br>";
        echo "in: <font color='red' style='margin: 10px'>".$this->intake_valve
            ."</font> spark plug: <font color='red' style='margin: 10px'>".$this->spark_plug
            ."</font> out: <font color='red' style='margin: 10px'>" .$this->vent_valve
            ."</font><br><br>Piston: <font color='red' style='margin: 10px'>" .$this->piston."</font></div>";
    }

}