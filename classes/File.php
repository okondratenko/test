<?php

class File
{
    static function tableDataYear($year)
    {
        try {
            $file_year    = fopen(PATH . '/data/' . $year . '.tmp', 'a+');
            $json_content = file_get_contents(PATH . '/data/' . $year . '.tmp');
            $tables       = json_decode($json_content);
            if ($tables == "") {
                $tables       = array(
                    "1"  => "0",
                    "2"  => "0",
                    "3"  => "0",
                    "4"  => "0",
                    "5"  => "0",
                    "6"  => "0",
                    "7"  => "0",
                    "8"  => "0",
                    "9"  => "0",
                    "10" => "0",
                    "11" => "0",
                    "12" => "0"
                );
                $json_content = json_encode($tables);
                file_put_contents(PATH . '/data/' . $year . '.tmp', $json_content);
            }
            fclose($file_year);

            return $tables;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    static function getFileMonth($year, $month)
    {
        try {
            $file_nonth   = fopen(PATH . '/data/' . $year . '-' . $month . '.tmp', 'a+');
            $json_content = file_get_contents(PATH . '/data/' . $year . '-' . $month . '.tmp');
            $tables       = json_decode($json_content);
            if ($tables == null) {
                echo '<h3>файл небыл обновлён</h3>';
                exit();
            }

            return $tables;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    static function getTable($long, $month, $year)
    {
        try {
            $file_year    = fopen(PATH . '/data/' . $year . '.tmp', 'a+');
            $json_content = file_get_contents(PATH . '/data/' . $year . '.tmp');
            fclose($file_year);
            $tables = json_decode($json_content);
            if ($tables == "") {
                $tables = array(
                    "1"  => "0",
                    "2"  => "0",
                    "3"  => "0",
                    "4"  => "0",
                    "5"  => "0",
                    "6"  => "0",
                    "7"  => "0",
                    "8"  => "0",
                    "9"  => "0",
                    "10" => "0",
                    "11" => "0",
                    "12" => "0"
                );
                $tables = json_encode($tables);
                $tables = json_decode($tables);
            }
            $tables->$month = $long;
            $json_content   = json_encode($tables);
            $file_year      = fopen(PATH . '/data/' . $year . '.tmp', 'w');
            file_put_contents(PATH . '/data/' . $year . '.tmp', $json_content);
            fclose($file_year);

            return $tables;
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    static function putArticlesMonth($articles, $month, $year)
    {
        try {
            $file_month = fopen(PATH . '/data/' . $year . '-' . $month . '.tmp', 'w');
            $art_json   = json_encode($articles);
            file_put_contents(PATH . '/data/' . $year . '-' . $month . '.tmp', $art_json);
        } catch (PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }
}

?>