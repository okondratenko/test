<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/view/header.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/config.php');

$articles=Controller::getFileMonth($_GET['y'],$_GET['m']);
echo '<table class="table">';
echo '<tr><th>Название статьи</th><th>Количество символов</th></tr>';
$monthNames = Helper::monthName();
foreach ($articles as $key => $value){
    echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
}
echo '</table>';

include_once($_SERVER['DOCUMENT_ROOT'].'/joomla_count_symbols/view/footer.php');
?>