<?php
include_once ('../config.php');
include_once (PATH.'/view/header.php');

$articles=File::getFileMonth($_GET['y'],$_GET['m']);
/*
echo '<table class="table">';
echo '<tr><th>Название статьи</th><th>Дата</th><th>Количество символов</th></tr>';
foreach ($articles as $key => $value){
    echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
}
echo '</table>';*/
//echo '<pre>';
//var_dump($articles);
echo '<table class="table">';
echo '<tr><th>Название статьи</th><th>Дата</th><th>Количество символов</th></tr>';
foreach ($articles as $key => $value) {
    if(is_array($value)) {
        echo '<tr><td>' . $key . '</td><td>' . $value[1] . '</td><td>' . $value[0] . '</td></tr>';
    }else{
        echo '<tr><th>' . $key . '</th><th>'.$monthNames[$_GET['m']].'</th><th>' . $value . '</th></tr>';
    }
}
echo '</table>';
include_once(PATH.'/view/footer.php');
?>