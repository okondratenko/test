<?php
class Controller
{
    static function tableDataYear($year)
    {
        $file_year=fopen($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp', 'a+');
        $json_content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp');
        $tables=json_decode($json_content);
        if($tables==""){
            $tables=array("1"=>"0","2"=>"0","3"=>"0","4"=>"0","5"=>"0","6"=>"0","7"=>"0","8"=>"0","9"=>"0","10"=>"0","11"=>"0","12"=>"0");
            $json_content=json_encode($tables);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp', $json_content);
        }
        fclose($file_year);
        return $tables;
    }


    static function updateTableYear($year,$month, $table_name, $application_id, $type, $pdo)
    {
        $long_month_text=Model::getLongMonthText($year,$month, $table_name, $application_id, $type, $pdo);
        $file_year=fopen($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp', 'a+');
        $json_content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp');
        fclose($file_year);
        $tables=json_decode($json_content);
        if($tables==""){
            $tables=array("1"=>"0","2"=>"0","3"=>"0","4"=>"0","5"=>"0","6"=>"0","7"=>"0","8"=>"0","9"=>"0","10"=>"0","11"=>"0","12"=>"0");
        }
        $tables->$month=$long_month_text;
        $json_content=json_encode($tables);
        $file_year=fopen($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp', 'w');
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'.tmp', $json_content);
        fclose($file_year);
        return $tables;
    }

    static function createFileMonth($year,$month, $table_name, $application_id, $type, $pdo)
    {
        $articles=Model::getArticles($year,$month, $table_name, $application_id, $type, $pdo);
        $file_month=fopen($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'-'.$month.'.tmp','w');
        $art_json=json_encode($articles);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'-'.$month.'.tmp', $art_json);
    }

    static function getFileMonth($year, $month)
    {
        $file_nonth=fopen($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'-'.$month.'.tmp', 'a+');
        $json_content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/data/'.$year.'-'.$month.'.tmp');
        $tables=json_decode($json_content);
        if($tables==NULL){
            echo '<h3>файл пустой</h3>';
            exit();
        }
        return $tables;
    }
}
?>