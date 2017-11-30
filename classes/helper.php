<?php
class Helper
{
    static function month_name($id)
    {
        if ($id==1){
            $month_name='Январь';
        }
        elseif ($id==2){
            $month_name='Февраль';
        }
        elseif ($id==3){
            $month_name='Март';
        }
        elseif ($id==4){
            $month_name='Апрель';
        }
        elseif ($id==5){
            $month_name='Май';
        }
        elseif ($id==6){
            $month_name='Июнь';
        }
        elseif ($id==7){
            $month_name='Июль';
        }
        elseif ($id==8){
            $month_name='Август';
        }
        elseif ($id==9){
            $month_name='Сентябрь';
        }
        elseif ($id==10){
            $month_name='Октябрь';
        }
        elseif ($id==11){
            $month_name='Ноябрь';
        }
        elseif ($id==12){
            $month_name='Декабрь';
        }
        return $month_name;
    }
}
?>