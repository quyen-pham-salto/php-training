<?php
// //POSTデータの受け取り
$year = filter_input(INPUT_POST, 'year') ?? date('Y');
$month = filter_input(INPUT_POST, 'month') ?? date('n');

//西暦の設定
$min_year = 1900;
$max_year = 2022;

// $year = $_POST['year'];
if (isset($_POST['next'])) {
    $month += 1;
    if ($month > 12) {
        $month = 1;
        ++$year;
    }
} elseif (isset($_POST['prev'])) {
    $month -= 1;
    if ($month < 1) {
        $month = 12;
        --$year;
    }
} else {
    $month;
}
?>
<?php
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
$calendar = array();
$j = 0;

for ($i = 1; $i < $last_day + 1; $i++) {
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));
    if ($i == 1) {
        for ($s = 1; $s <= $week; $s++) {
            $calendar[$j]['day'] = '';
            $j++;
        }
    }
    $calendar[$j]['day'] = $i;
    $j++;
    if ($i == $last_day) {
        for ($e = 1; $e <= 6 - $week; $e++) {
            $calendar[$j]['day'] = '';
            $j++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>カレンダー</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <table>
        <thead>
            <tr>
                <form action="" method="POST">

                    <select name="year" id="year">
                        <?php
                        for ($i = $min_year; $i <= $max_year; $i++) {
                            if ($year == "" && $i == date('Y')) {
                                echo '<option value="' . $i . '" selected>' . $i . '月</option>';
                            } elseif ($year == $i) {
                                echo '<option value="' . $i . '" selected>' . $i . '月</option>';
                            } else {
                                echo '<option value="' . $i . '">' . $i . '月</option>';
                            }
                        }
                        ?>
                    </select>

                    <select name="month" id="month">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            if ($month == "" && $i == date('n')) {
                                echo '<option value="' . $i . '" selected>' . $i . '月</option>';
                            } elseif ($month == $i) {
                                echo '<option value="' . $i . '" selected>' . $i . '月</option>';
                            } else {
                                echo '<option value="' . $i . '">' . $i . '月</option>';
                            }
                        }
                        ?>
                    </select>

                    <input type="submit" value="表示"><br>
                    <?php
                    if ($year != $min_year || $month != 1) {
                        echo '<input type="submit" name="prev" value="前月">';
                    }
                    if ($year != $max_year || $month != 12) {
                        echo '<input type="submit" name="next" value="翌月">';
                    }
                    ?>
                </form>
            </tr>
            <tr>
                <th id="title" colspan="20"><?php echo $year; ?>年<?php echo $month; ?>月
                </th>
            </tr>
            <tr>
                <th class="red">日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th class="blue">土</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php $cnt = 0; ?>
                <?php foreach ($calendar as $key => $value) : ?>
                    <td>
                        <p>
                            <?php $cnt++; ?>
                            <?php echo $value['day']; ?>
                        </p>
                    </td>
                    <?php if ($cnt == 7) : ?>
            </tr>
            <tr>
                <?php $cnt = 0; ?>
            <?php endif; ?>
        <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</body>

</html>