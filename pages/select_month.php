<?php
echo '<form action="index.php" method="post">
    <select name="number_month" class="select_montch">';
$pdo = Tools::connect($host, $user, $pass, $dbname);
$sel = 'select * from month';
$ps = $pdo->prepare($sel);
$ps->execute();
while ($row = $ps->fetch()) {
    echo '<option value="' . $row[id] . '">' . $row[month] . '</option>';
}
echo
'</select>
    <select name="number_year">
        <option value="2016">2016</option>
        <option value="2017">2017</option>
        <option value="2018">2018</option>
    </select>
    <input type="submit" name="sub1" value="Посмотреть" class="btn btn-success">
    <input type="submit" name="sub2" value="Обновить" class="btn btn-success">
</form>';

if (isset($_POST['sub1'])) {
    $month = $_POST['number_month'];
    $year = $_POST['number_year'];
    echo '<h2>Год ' . $year . '</h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    $path = 'data/' . $year . '.tmp';
    $year_open = fopen($path, 'r');
    $json_read = file_get_contents($path);
    fclose($year_open);
    $table_years = json_decode($json_read);
    $data = explode(';', $table_years);
    for ($i = 0; $i < 12; $i++) {
        $td = explode(':', $data[$i]);
        echo '<tr><td>' . $td[0] . '</td><td>' . $td[1] . '</td></tr>';
    }
    echo '</table>';
}


if (isset($_POST['sub2'])) {
    $month = $_POST['number_month'];
    /*echo '<table class="table table-striped">
            <tr><th>Месц</th><th>Количество символов</th></tr>
            <tr><td>' . Articles::getMonthName($month). '</td><td>' .Articles::count_symbol($month). '</td></tr>
        </table>';*/
    $year = $_POST['number_year'];
    echo '<h2>Год ' . $year . '</h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месяц</th><th>Количество символов</th></tr>';
    $pdo = Tools::connect($host, $user, $pass, $dbname);
    /*$sel = 'select * from month';
    $ps = $pdo->prepare($sel);
    $ps->execute();
    $line = null;
    while ($row = $ps->fetch()) {
        $id = $row['id'];
        echo '<tr><td>' . $row['month'] . '</td><td><a href="pages/table_month.php?mid=' . $id . '&yid=' . $year . '">' . Articles::count_symbol($id, $year) . '</a></td></tr>';
        $line .= $row['month'] . ':' . Articles::count_symbol($id, $year) . ";\r\n";
    }
    echo '</table>';
    $json_year = json_encode($line);
    $path = 'data/' . $year . '.tmp';
    $data_year = fopen($path, 'w');
    fputs($data_year, $json_year);
    fclose($data_year);*/
}

?>