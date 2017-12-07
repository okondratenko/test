<?php
echo '<form action="index.php" method="post">';
    echo '<select name="number_year">';
    for($i=date(Y)-1; $i<=date(Y)+3;$i++) {
        echo '<option value="'.$i.'"';  echo ($i==$_POST["number_year"]) ? 'selected': ''; echo '>' .$i. '</option>';
    }
        echo '</select>';
    echo '<input type="submit" name="ReedTableYear" value="Посмотреть год" class="btn btn-success">';
    echo '<select name="number_month" class="select_month">';
        for ($i = 1; $i <= 12; $i++) {
            $i=str_pad($i, 2, '0', STR_PAD_LEFT);
        echo '<option value="' . $i . '"'; echo ($i==$_POST["number_month"]) ? 'selected' :''; echo '>' . $monthNames[$i] . '</option>';
        }
        echo '</select>';
    echo '<input type="submit" name="UpdateTableYear" value="Обновить месяц" class="btn btn-success">';
echo '</form>';
    ?>