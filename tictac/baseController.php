<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 02.11.18
 * Time: 12:10
 */
require_once 'iBaseController.php';

class baseController implements iBaseController
{
    private $connect;
    //private $request;
    public $request;

    public function __construct($host, $db, $user, $pswd)
    {
        $this->connect = mysqli_connect($host, $user, $pswd) or die("Unable to connect to MySQL");
        mysqli_select_db($this->connect, $db) or die("Could not select table for use");

    }

    public function delete(string $tableName)
    {
        $this->request = "DELETE FROM $tableName ";
        return $this;

    }

    public function insert($tableName, array $args)
    {
        $this->request = "INSERT INTO $tableName (".implode(array_keys($args), ", ").
            ") VALUES (\"".implode(array_values($args), "\", \"")."\")";
        return $this;
    }

    public function select($tableName, array $args)
    {
        $this->request = "SELECT ".implode($args, ', ')." FROM $tableName";
        return $this;

    }

    public function update($tableName, array $args)
    {
        $this->request = "UPDATE $tableName SET ";
        foreach ($args as $key=>$value)
        {
            $this->request .= "$key = '$value', ";
        }
        $this->request = substr($this->request, 0, -2);
        return $this;
    }

    public function where($args)
    {
        $this->request .= " WHERE ".implode($args, ' ');
        return $this;

    }

    public function andWhere($args)
    {
        $this->request .= 'AND'.implode($args, ' ');
        return $this;
    }

    public function orWhere($args)
    {
        $this->request .= ' OR '.implode($args, ' ');
        return $this;
    }

    public function last()
    {
        $this->request .= " ORDER BY id DESC LIMIT 0, 1";
        $current_request = mysqli_query($this->connect, $this->request);
        return mysqli_fetch_assoc($current_request);
        //return $this;
    }

    public function run()
    {
        //echo $this->request.'<br>';
        //echo (mysqli_query($this->connect, $this->request))? "Success":"Fail" ;
        return mysqli_query($this->connect, $this->request);
    }
}