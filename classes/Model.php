<?php
class Model
{
    static function getLongMonthText($year,$month, $table_name, $application_id, $type, $pdo)
    {
        $y_m=$year.'-'.$month.'-%%';
        $sel = "SELECT elements FROM $table_name WHERE application_id=? AND type=? AND publish_up LIKE ?";
        $ps=$pdo->prepare($sel);
        $ps->execute(array($application_id, $type, $y_m));
        $long=0;
        while ($row = $ps->fetch()) {
            $obj             = json_decode($row['elements']);
            $obj_text        = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
            $text_strip_tags = strip_tags($obj_text);
            $ar              = [' ', "\r\n", "\r", "\n"];
            $only_characters = str_replace($ar, "", $text_strip_tags);
            $long            += iconv_strlen($only_characters);
        }
    return $long;
    }

    static function getArticles($year,$month, $table_name, $application_id, $type, $pdo)
    {
        $y_m=$year.'-'.$month.'-%%';
        $sel = "SELECT name, elements FROM $table_name WHERE application_id=? AND type=? AND publish_up LIKE ?";
        $ps=$pdo->prepare($sel);
        $ps->execute(array($application_id, $type, $y_m));
        $articles=array();
        $summ=0;
        while ($row = $ps->fetch()) {
            $name=$row['name'];
            $obj             = json_decode($row['elements']);
            $obj_text        = $obj->{'3034c0b9-e036-4573-b3a8-c7353bd5b51e'}->{0}->value;
            $text_strip_tags = strip_tags($obj_text);
            $ar              = [' ', "\r\n", "\r", "\n"];
            $only_characters = str_replace($ar, "", $text_strip_tags);
            $long            = iconv_strlen($only_characters);
            $articles[$name]=$long;
            $summ+=$long;
        }
        $articles['Итого']=$summ;
        return $articles;
    }


}
?>