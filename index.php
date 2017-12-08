<?php
include_once ('config.php');


include_once (PATH.'/view/header.php');

include_once (PATH.'/view/view_index.php');

if (isset($_POST['ReedTableYear'])) {
    $table_year = File::tableDataYear($_POST['number_year']);
    include_once(PATH . '/view/select_month.php');
}

if (isset($_POST['UpdateTableYear'])) {
    $m=new Articles($pdo);
    $textLength = $m->textLength($_POST['number_year'], $_POST['number_month'],
        $ini_array['sql']['table_name'], $ini_array['sql']['application_id'], $ini_array['sql']['type']);
    $update_table_year=File::getTable($textLength, $_POST['number_month'], $_POST['number_year']);
    File::putTable($update_table_year, $_POST['number_year']);
    include_once(PATH . '/view/select_month.php');
    $articles = $m->getArticlesMonth($_POST['number_year'], $_POST['number_month'], $ini_array['sql']['table_name'],
        $ini_array['sql']['application_id'], $ini_array['sql']['type']);
    File::putArticlesMonth($articles, $_POST['number_month'], $_POST['number_year']);
}


include_once(PATH.'/view/footer.php');
?>