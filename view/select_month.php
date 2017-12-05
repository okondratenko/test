<?php
echo '<div class="container">';
echo '<form action="index.php" method="post">';
echo '<select name="number_year">';
echo '<option value="2016">2016</option>';
echo '<option value="2017">2017</option>';
echo '<option value="2018">2018</option>';
echo '<option value="2019">2019</option>';
echo '</select>';
echo '<input type="submit" name="sub1" value="Посмотреть год" class="btn btn-success">';
echo '<select name="number_month" class="select_month">';
$monthNames = Helper::monthName();
for ($i = 1; $i <= 12; $i++) {
    echo '<option value="' . $i . '">' . $monthNames[$i] . '</option>';
}
echo '</select>';
echo '<input type="submit" name="sub2" value="Обновить месяц" class="btn btn-success">';
echo '</form>';


if (isset($_POST['sub1'])) {
    $table_year = Controller::tableDataYear($_POST['number_year']);
    echo '<h2><span style="color:green;"> Год ' . $_POST['number_year'] . '</span></h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    foreach ($table_year as $key => $value) {
        echo '<tr><td>' . $monthNames[$key] . '</td><td><a href="view/table_month.php?m=' . $key . '&y=' . $_POST['number_year'] . '">' . $value . '</a></td></tr>';
    }
    echo '</table>';
}


if (isset($_POST['sub2'])) {
    $update_table_year = Controller::updateTableYear($_POST['number_year'], $_POST['number_month'],
        $ini_array['sql']['table_name'], $ini_array['sql']['application_id'], $ini_array['sql']['type'], $pdo);
    echo '<h2><span style="color:green;"> Год ' . $_POST['number_year'] . '</span></h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    foreach ($update_table_year as $key => $value) {
        echo '<tr><td>' . $monthNames[$key] . '</td><td><a href="view/table_month.php?m=' . $key . '&y=' . $_POST['number_year'] . '">' . $value . '</a></td></tr>';
    }
    echo '</table>';
    $array=Controller::createFileMonth($_POST['number_year'], $_POST['number_month'], $ini_array['sql']['table_name'],
        $ini_array['sql']['application_id'], $ini_array['sql']['type'], $pdo);
}

echo '</div>';
?>