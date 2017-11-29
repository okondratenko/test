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
    static function count_symbol($month, $year)
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
                  WHERE application_id=? AND type=? AND publish_up LIKE '$year-$month-%%'";
            $ps = $pdo->prepare($sel);
            $ps->execute(array($application_id, $type));
            $long = 0;
            while ($row = $ps->fetch()) {
                $obj = json_decode($row['elements']);
                $text_count = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
                $text_count = strip_tags($text_count);
                $ar = [' ', "\r\n", "\r", "\n"];
                $text_count = str_replace($ar, "", $text_count);
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

    static function getArticles($month, $year)
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
            $num = 100;
            $page = $_GET['page'];
            $res = $pdo->query("SELECT COUNT(*) FROM $table_name");
            $res->setFetchMode(PDO::FETCH_NUM);
            $temp = $res->fetch();
            $posts = $temp[0];
            $total = (($posts - 1) / $num) + 1;
            $total = intval($total);
            $page = intval($page);
            if (empty($page) || $page < 0) $page = 1;
            if ($page > $total) $page = $total;
            $start = $page * $num - $num;
            $pdo = Tools::connect($host, $user, $pass, $dbname);
            $ps = $pdo->prepare("select name, elements 
                                from $table_name 
                                WHERE application_id=? AND type=? AND publish_up LIKE '$year-$month-%%'
                                LIMIT $start, $num");
            $ps->execute(array($application_id, $type));
            echo '<table class="table table-striped">';
            echo '<tr><th>Название записи</th><th>Количество символов</th></tr>';
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            $total_symbol = 0;
            while ($row = $ps->fetch()) {
                $obj = json_decode($row['elements']);
                $text_count = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
                $text_count = strip_tags($text_count);
                $ar = [' ', "\r\n", "\r", "\n"];
                $text_count = str_replace($ar, "", $text_count);
                $long_text = iconv_strlen($text_count);
                $total_symbol = $total_symbol + $long_text;
                echo '<tr><td>' . $row['name'] . '</td><td>' . $long_text . '</td></tr>';
            }
            echo '<tr><th><h4>Итого</h4></th><th><h4>' . $total_symbol . '</h4></th></tr>';
            echo '</table>';

            if ($page != 1) $pervpage = '<a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=1></a> | <a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=' . ($page - 1) . '></a> | ';
            if ($page != $total) $nextpage = ' | <a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=' . ($page + 1) . '></a> | <a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=' . $total . '></a>';

            if ($page - 1 > 0) $page1left = '<a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=' . ($page - 1) . '>' . ($page - 1) . '</a> | ';
            if ($page + 1 <= $total) $page1right = ' | <a href=table_month.php?mid=' . $month . '&yid=' . $year . '&page=' . ($page + 1) . '>' . ($page + 1) . '</a>';

            if ($total > 1) {
                echo "<div class='text-center'>";
                echo $pervpage . $page1left . '<b>' . $page . '</b>' . $page1right . $nextpage;
                echo "</div>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

?>