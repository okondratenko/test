<h2>Год 2017</h2>
<?php
echo '<form action="index.php" method="post">
    <select name="number_month" class="select_montch">';
    $pdo=Tools::connect($host, $user, $pass, $dbname);
    $sel='select * from month';
    $ps=$pdo->prepare($sel);
    $ps->execute();
    while($row=$ps->fetch()){
        echo '<option value="' . $row[id] . '">' . $row[month] . '</option>';
    }
echo
    '</select>
    <input type="submit" name="sub1" value="Посмотреть" class="btn btn-success">
</form>';

if(isset($_POST['sub1'])) {
    $month=$_POST['number_month'];
    /*echo '<table class="table table-striped">
            <tr><th>Месц</th><th>Количество символов</th></tr>
            <tr><td>' . Articles::getMonthName($month). '</td><td>' .Articles::count_symbol($month). '</td></tr>
        </table>';*/
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    $pdo=Tools::connect($host, $user, $pass, $dbname);
    $sel='select * from month';
    $ps=$pdo->prepare($sel);
    $ps->execute();
    while($row=$ps->fetch()){
        $id=$row['id'];
        echo '<tr><td>'.$row['month'] . '</td><td><a href="page/table_month.php">'.Articles::count_symbol($id).'</a></td></tr>';
    }
    echo '</table>';
}
?>