<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<div class="container-fluid">
<?php
$ini_array = parse_ini_file("config.ini", true);
$host = $ini_array[PDO][host];
$user = $ini_array[PDO][user];
$pass = $ini_array[PDO][pass];
$dbname = $ini_array[PDO][dbname];
$table_name = $ini_array[sql][table_name];
$type = $ini_array[sql][type];
$application_id = $ini_array[sql][application_id];
include_once ('pages/classes.php');
include_once ('pages/select_month.php');
?>
</div>
</body>
</html>