<?php
echo '<form action="index.php" method="post">';
    echo '<select name="number_year">';
    for($i=date(Y)-1; $i<=date(Y)+3;$i++) {
        echo '<option value="'.$i.'"'; if($i==$_POST["number_year"]) echo 'selected'; echo '>' .$i. '</option>';
    }
        echo '</select>';
    echo '<input type="submit" name="ReedTableYear" value="Посмотреть год" class="btn btn-success">';
    echo '<select name="number_month" class="select_month">';
        for ($i = 1; $i <= 12; $i++) {
        echo '<option value="' . $i . '"'; if ($i==$_POST["number_month"]) echo 'selected'; echo '>' . $monthNames[$i] . '</option>';
        }
        echo '</select>';
    echo '<input type="submit" name="UpdateTableYear" value="Обновить месяц" class="btn btn-success">';
    echo '</form>';
    ?>