<?php
include_once ('config.php');
include_once (PATH.'/view/header.php');

include_once (PATH.'/view/view_index.php');

if (isset($_POST['ReedTableYear'])) {
    $table_year = File::tableDataYear($_POST['number_year']);
    include_once(PATH . '/view/select_month.php');
}

if (isset($_POST['UpdateTableYear'])) {
    $m=new Model($pdo);
    $update_table_year = $m->updateTableYear($_POST['number_year'], $_POST['number_month'],
        $ini_array['sql']['table_name'], $ini_array['sql']['application_id'], $ini_array['sql']['type']);
    $update_table_year=File::getTables($update_table_year, $_POST['number_month']);
    include_once(PATH . '/view/select_month.php');
    $articles = $m->getArticlesMonth($_POST['number_year'], $_POST['number_month'], $ini_array['sql']['table_name'],
        $ini_array['sql']['application_id'], $ini_array['sql']['type']);
    File::putArticlesMonth($articles);
}


include_once(PATH.'/view/footer.php');
?>