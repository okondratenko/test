<?php
spl_autoload_register(function ($class_name) {
    include_once $_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/classes/' . $class_name . '.php';
});
$ini_array      = parse_ini_file("config.ini", true);
$pdo = Connect::pdo($ini_array['PDO']['host'], $ini_array['PDO']['user'], $ini_array['PDO']['pass'], $ini_array['PDO']['dbname']);
?>