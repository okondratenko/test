<?php

class Tools
{
    static function connect($host, $user, $pass, $dbname)
    {
        $cs = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );
        try {
            $pdo = new PDO($cs, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

class Articles
{
    static function count_symbol($month)
    {
        try {
            global $host;
            global $user;
            global $pass;
            global $dbname;
            global $table_name;
            global $type;
            global $application_id;
            $pdo = Tools::connect($host, $user, $pass, $dbname);
            $sel = "SELECT name, elements 
                  FROM $table_name
                  WHERE application_id=? AND type=? AND publish_up LIKE '%%-$month-%%'";
            $ps = $pdo->prepare($sel);
            $ps->execute(array($application_id, $type));
            $long = 0;
            while ($row = $ps->fetch()) {
                $obj = json_decode($row['elements']);
                $text_count = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
                $text_count = strip_tags($text_count);
                $ar=[' ', "\r\n", "\r", "\n", "<br>", "<br/>"];
                $text_count = str_replace($ar,"", $text_count);
                echo '<pre>';
                print_r($text_count);
                echo '</pre>';
                $long += iconv_strlen($text_count);
            }

            return $long;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function getMonthName($monthid)
    {
        try {
            global $host;
            global $user;
            global $pass;
            global $dbname;
            $pdo = Tools::connect($host, $user, $pass, $dbname);
            $ps = $pdo->prepare('select month from month where id=?');
            $ps->execute(array($monthid));
            $row = $ps->fetch();
            $month = $row['month'];
            return $month;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

?>