<form action="index.php" method="post">
    <select name="number_year">
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
    </select>
    <select name="number_month" class="select_month">
        <?php
        include_once('classes/helper.php');
        for ($i = 1; $i <= 12; $i++) {
            echo '<option value="' . $i . '">' . Helper::month_name($i) . '</option>';
        }
        ?>
    </select>
    <input type="submit" name="sub1" value="Посмотреть месяц" class="btn btn-success">
    <input type="submit" name="sub2" value="Обновить месяц" class="btn btn-success">
</form>
<?php
if (isset($_POST['sub1'])) {
    $month       = $_POST['number_month'];
    $year        = $_POST['number_year'];
    $path        = $path_month = 'data/' . $year . '-' . $month . '.tmp';
    $json_read   = file_get_contents($path);
    $table_years = json_decode($json_read);
    $data        = explode(':', $table_years);
    echo '<table class="table table-striped">
         <tr><th>Год</th><th>Месц</th><th>Количество символов</th></tr>
            <tr><td>' . $year . '</td><td>' . Helper::month_name($month) . '</td><td><a href="view/table_month.php?m=' . $month . '&y=' . $year . '">' . $data[1] . '</a></td></tr>
        </table>';
    echo '</table>';
}


if (isset($_POST['sub2'])) {
    $month = $_POST['number_month'];
    $year  = $_POST['number_year'];
    include_once('classes/articles.php');
    $symbol_sum = Articles::count_symbol($month, $year, $table_name, $type, $application_id, $pdo);
    $path       = $path_month = 'data/' . $year . '-' . $month . '.tmp';
    $file_month = fopen($path, 'w+');
    $line_month = $month . ':' . $symbol_sum;
    $line_month = json_encode($line_month);
    fputs($file_month, $line_month);
    fclose($file_month);
    //cоздаём файл сo статьями
    $text_articles = Articles::setMonth($month, $year, $table_name, $type, $application_id, $pdo);
    $path          = $path_month = 'data/' . $year . '-' . $month . '-articles.tmp';
    $file_month    = fopen($path, 'w');
    $text_articles = json_encode($text_articles);
    fputs($file_month, $text_articles);
    fclose($file_month);
    echo '<table class="table table-striped">
         <tr><th>Год</th><th>Месц</th><th>Количество символов</th></tr>
            <tr><td>' . $year . '</td><td>' . Helper::month_name($month) . '</td><td><a href="view/table_month.php?m=' . $month . '&y=' . $year . '">' . $symbol_sum . '</a></td></tr>
        </table>';
}


?>