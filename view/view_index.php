<?php
echo '<form action="index.php" method="post">';
    echo '<select name="number_year">';
        echo '<option value="2016">2016</option>';
        echo '<option value="2017">2017</option>';
        echo '<option value="2018">2018</option>';
        echo '<option value="2019">2019</option>';
        echo '</select>';
    echo '<input type="submit" name="ReedTableYear" value="Посмотреть год" class="btn btn-success">';
    echo '<select name="number_month" class="select_month">';
        $monthNames = Helper::monthName();
        for ($i = 1; $i <= 12; $i++) {
        echo '<option value="' . $i . '">' . $monthNames[$i] . '</option>';
        }
        echo '</select>';
    echo '<input type="submit" name="UpdateTableYear" value="Обновить месяц" class="btn btn-success">';
    echo '</form>';
    ?>