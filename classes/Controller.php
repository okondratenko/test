<?php
class Controller
{
    static function tableDataYear($year)
    {
        if(is_int($year)==true) exit();
        $file_year=fopen(PATH.'/data/'.$year.'.tmp', 'a+');
        $json_content=file_get_contents(PATH.'/data/'.$year.'.tmp');
        $tables=json_decode($json_content);
        if($tables==""){
            $tables=array("1"=>"0","2"=>"0","3"=>"0","4"=>"0","5"=>"0","6"=>"0","7"=>"0","8"=>"0","9"=>"0","10"=>"0","11"=>"0","12"=>"0");
            $json_content=json_encode($tables);
            file_put_contents(PATH.'/data/'.$year.'.tmp', $json_content);
        }
        fclose($file_year);
        return $tables;
    }


    static function updateTableYear($year,$month, $table_name, $application_id, $type, $pdo)
    {
        if(is_int($year)==true || is_int($month)==true) exit();
        $long_month_text=Model::getLongMonthText($year,$month, $table_name, $application_id, $type, $pdo);
        $file_year=fopen(PATH.'/data/'.$year.'.tmp', 'a+');
        $json_content=file_get_contents(PATH.'/data/'.$year.'.tmp');
        fclose($file_year);
        $tables=json_decode($json_content);
        if($tables==""){
            $tables=array("1"=>"0","2"=>"0","3"=>"0","4"=>"0","5"=>"0","6"=>"0","7"=>"0","8"=>"0","9"=>"0","10"=>"0","11"=>"0","12"=>"0");
        }
        $tables->$month=$long_month_text;
        $json_content=json_encode($tables);
        $file_year=fopen(PATH.'/data/'.$year.'.tmp', 'w');
        file_put_contents(PATH.'/data/'.$year.'.tmp', $json_content);
        fclose($file_year);
        return $tables;
    }

    static function createFileMonth($year,$month, $table_name, $application_id, $type, $pdo)
    {
        if(is_int($year)==true || is_int($month)==true) exit();
        $articles=Model::getArticles($year,$month, $table_name, $application_id, $type, $pdo);
        $file_month=fopen(PATH.'/data/'.$year.'-'.$month.'.tmp','w');
        $art_json=json_encode($articles);
        file_put_contents(PATH.'/data/'.$year.'-'.$month.'.tmp', $art_json);
    }

    static function getFileMonth($year, $month)
    {
        if(is_int($year)==true || is_int($month)==true) exit();
        $file_nonth=fopen(PATH.'/data/'.$year.'-'.$month.'.tmp', 'a+');
        $json_content=file_get_contents(PATH.'/data/'.$year.'-'.$month.'.tmp');
        $tables=json_decode($json_content);
        if($tables==NULL){
            echo '<h3>файл пустой</h3>';
            exit();
        }
        return $tables;
    }
}
?>