<?php
    // POST データ取得
    $year = $_POST['year'];
    if(isset($_POST['next'])){
        $month = $_POST['month']+1;
        if($month > 12){
            $month = 1;
            ++$year;
        }
    } elseif (isset($_POST['prev'])){
        $month = $_POST['month']-1;
        if($month < 1){
            $month = 12;
            --$year;
        }
    } else {
        $month = $_POST['month'];
    }

    // 表示用データ取得
    $min_year = 1900;
    $max_year = 2022;
    $start_date = date('Y-m-01', strtotime($year.'-'.sprintf("%02d",$month).'-01'));
    $end_date = date("Y-m-t", strtotime($year.'-'.sprintf("%02d",$month).'-01'));
    $start_week = date("w", strtotime($start_date));
    $end_week = 6 - date("w", strtotime($end_date));
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/" method="POST">
        <select name="year" id="year">
            <?php
                for($i=$min_year; $i<=$max_year; $i++){
                    if($year == "" && $i == date('Y')){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    } elseif ($year == $i){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'月</option>';
                    }
                }
            ?>
        </select>
        <select name="month" id="month">
            <?php
                for($i=1; $i<=12; $i++){
                    if($month == "" && $i == date('n')){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    } elseif ($month == $i){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'月</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" value="表示"><br>
        <?php
            if($year != $min_year || $month != 1){
                echo '<input type="submit" name="prev" value="前月">';
            }
            if($year != $max_year || $month != 12){
                echo '<input type="submit" name="next" value="翌月">';
            }
        ?>

    </form>
    <table>
        <tr>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
        </tr>
        <tr>
            <?php
                // 1日までに足りない td を埋める処置
                for($i=0; $i<$start_week; $i++){
                    echo '<td></td>';
                }
                // 日付出力
                for($i=1; $i<=date('t', strtotime($end_date)); $i++){
                        $set_date = date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i);
                        $week_date = date("w", strtotime($set_date));
                        echo '<td>'.$i.'</td>';
                    if($week_date == 6){
                        echo '</tr>';
                        echo '<tr>';
                    }
                }
                // 足りない td を埋める処理
                for($i=0; $i<$end_week; $i++){
                    echo '<td></td>';
                }
            ?>
        </tr>
    </table>
</body>
</html>