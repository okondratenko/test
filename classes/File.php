<?php

class File
{
    static function tableDataYear($year)
    {
        if (file_exists(PATH . '/data/' . $year . '.tmp')) {
            $json_content = file_get_contents(PATH . '/data/' . $year . '.tmp');
            $tables       = json_decode($json_content);
        } else {
            $tables = [];
            for ($i = 1; $i <= 12; $i++) {
                $i          = str_pad($i, 2, '0', STR_PAD_LEFT);
                $tables[$i] = 0;
            }
        }

        return $tables;
    }

    static function getFileMonth($year, $month)
    {
        if (file_exists(PATH . '/data/' . $year . '-' . $month . '.tmp')) {
            $json_content = file_get_contents(PATH . '/data/' . $year . '-' . $month . '.tmp');
            $tables       = json_decode($json_content);
        } else {
            echo '<h3>файл небыл обновлён</h3>';
            exit();
        }

        return $tables;
    }

    static function getTable($long, $month, $year)
    {
        if (file_exists(PATH . '/data/' . $year . '.tmp')) {
            $json_content = file_get_contents(PATH . '/data/' . $year . '.tmp');
            $tables       = json_decode($json_content);
        } else {
            $tables = [];
            for ($i = 1; $i <= 12; $i++) {
                $i          = str_pad($i, 2, '0', STR_PAD_LEFT);
                $tables[$i] = 0;
            }
            $tables = (object)$tables;
        }
        $tables->$month = $long;

        return $tables;
    }

    static function putTable($tables, $year)
    {
        $json_content = json_encode($tables);
        $file_year    = fopen(PATH . '/data/' . $year . '.tmp', 'w');
        file_put_contents(PATH . '/data/' . $year . '.tmp', $json_content);
        fclose($file_year);
    }


    static function putArticlesMonth($articles, $month, $year)
    {
        $file_month = fopen(PATH . '/data/' . $year . '-' . $month . '.tmp', 'w');
        $art_json   = json_encode($articles);
        file_put_contents(PATH . '/data/' . $year . '-' . $month . '.tmp', $art_json);
        fclose($file_month);
    }
}

?>