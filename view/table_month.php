<?php
include_once ('../config.php');
include_once (PATH.'/view/header.php');

$articles=File::getFileMonth($_GET['y'],$_GET['m']);
echo '<table class="table">';
echo '<tr><th>Название статьи</th><th>Количество символов</th></tr>';
$monthNames = Helper::monthName();
foreach ($articles as $key => $value){
    echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
}
echo '</table>';

include_once(PATH.'/view/footer.php');
?>