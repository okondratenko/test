<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<h2><a href="../index.php">Главная</a></h2>
<?php
include_once ('classes.php');
$ini_array = parse_ini_file("config.ini", true);
$host = $ini_array[PDO][host];
$user = $ini_array[PDO][user];
$pass = $ini_array[PDO][pass];
$dbname = $ini_array[PDO][dbname];
$table_name = $ini_array[sql][table_name];
$type = $ini_array[sql][type];
$application_id = $ini_array[sql][application_id];
$month=$_GET['mid'];
$year=$_GET['yid'];
Articles::getArticles($month, $year);
?>
</body>
</html>