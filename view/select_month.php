<?php
echo '<div class="container">';
if (isset($_POST['ReedTableYear'])) {
    echo '<h2><span style="color:green;"> Год ' . $_POST['number_year'] . '</span></h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    foreach ($table_year as $key => $value) {
        echo '<tr><td>' . $monthNames[$key] . '</td><td><a href="view/table_month.php?m=' . $key . '&y=' . $_POST['number_year'] . '">' . $value . '</a></td></tr>';
    }
    echo '</table>';
}

if (isset($_POST['UpdateTableYear'])) {
    echo '<h2><span style="color:green;"> Год ' . $_POST['number_year'] . '</span></h2>';
    echo '<table class="table table-striped">';
    echo '<tr><th>Месц</th><th>Количество символов</th></tr>';
    foreach ($update_table_year as $key => $value) {
        echo '<tr><td>' . $monthNames[$key] . '</td><td><a href="view/table_month.php?m=' . $key . '&y=' . $_POST['number_year'] . '">' . $value . '</a></td></tr>';
    }
    echo '</table>';
}

echo '</div>';
?>