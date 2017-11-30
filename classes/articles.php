<?php

class Articles
{
    static function count_symbol($month, $year, $table_name, $type, $application_id, $pdo)
    {
        try {
            $sel = "SELECT name, elements FROM $table_name WHERE application_id=? AND type=? AND publish_up LIKE '$year-$month-%%'";
            $ps  = $pdo->prepare($sel);
            $ps->execute(array($application_id, $type));
            $long = 0;
            while ($row = $ps->fetch()) {
                $obj        = json_decode($row['elements']);
                $text_count = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
                $text_count = strip_tags($text_count);
                $ar         = [' ', "\r\n", "\r", "\n"];
                $text_count = str_replace($ar, "", $text_count);
                $long       += iconv_strlen($text_count);
            }

            return $long;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    static function setMonth($month, $year, $table_name, $type, $application_id, $pdo)
    {
        try {
            $ps = $pdo->prepare("select name, elements from $table_name WHERE application_id=? AND type=? AND publish_up LIKE '$year-$month-%%'");
            $ps->execute(array($application_id, $type));
            $total_symbol = 0;
            $line         = '';
            while ($row = $ps->fetch()) {
                $obj          = json_decode($row['elements']);
                $text_count   = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
                $text_count   = strip_tags($text_count);
                $ar           = [' ', "\r\n", "\r", "\n"];
                $text_count   = str_replace($ar, "", $text_count);
                $long_text    = iconv_strlen($text_count);
                $total_symbol = $total_symbol + $long_text;
                $line         .= $row['name'] . '&' . $long_text . ';';
            }
            return $line;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    static function getArticles($month, $year)
    {
        try {
            $path          = '../data/' . $year . '-' . $month . '-articles.tmp';
            $articles_file = file_get_contents($path);
            $articles_file = json_decode($articles_file);
            $articles_file = (explode(';', $articles_file));
            return $articles_file;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }
}

?>