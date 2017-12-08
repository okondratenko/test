<?php
/**
 * Created by PhpStorm.
 * User: Office
 * Date: 08.12.2017
 * Time: 17:20
 */

class Db
{
    protected $pdo;
    function __construct()
    {
        $ini_array  = parse_ini_file("config.ini", true);
            $cs = 'mysql:host=' . $ini_array['PDO']['host'] . ';dbname=' .  $ini_array['PDO']['dbname'] . ';charset=utf8;';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );
        try {
            $pdo = new PDO($cs, $ini_array['PDO']['user'], $ini_array['PDO']['pass'], $options);
            $this->pdo=$pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}