<?php
/**
 * Created by PhpStorm.
 * User: shaman
 * Date: 02.11.18
 * Time: 12:20
 */

interface iBaseController
{

    public function select(string $tableName, array $args);
    public function insert(string $tableName, array $args);//associative
    public function update(string $tableName, array $args);//associative
    public function delete(string $tableName);
    public function where(array $args);
    public function orWhere(array $args);
    public function andWhere(array $args);
    public function run();

}