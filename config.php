<?php
    define("PATH", __DIR__);
    spl_autoload_register(function ($class_name) {
        include_once PATH . '/classes/' . $class_name . '.php';
    });
    $ini_array  = parse_ini_file("config.ini", true);
    $pdo        = Conect::pdo($ini_array['PDO']['host'], $ini_array['PDO']['user'], $ini_array['PDO']['pass'],
        $ini_array['PDO']['dbname']);
    $monthNames = Help::monthName();
?>