<?php
    $year = $_POST["year"];
    $month = $_POST["month"];
    echo $year." ".$month;

    $now_month = date("Y年n月"); //表示する年月
    $start_date = date('Y-m-01',strtotime($year.'-'.sprintf("%02d",$month).'-01')); //開始の年月日
    $end_date = date('Y-m-t',strtotime($year.'-'.sprintf("%02d",$month).'-01')); //終了の年月日
    //(曜日,今月の開始日)
    $start_week = date("w",strtotime($start_date)); //開始の曜日の数字
    $end_week = 6 - date("w",strtotime($end_date)); //終了の曜日の数字

    $min_year = 1900;
    $max_year = 2022;

    // 一月づつのボタン処理

    //前月
    if(isset($_POST['prev'])){
        if($month>1){
            --$month;
        }else{
            $month = 12;
            --$year;
        }
    }

    // 翌月
    if(isset($_POST['next'])){
        if($month==12){
            $month = 1;
            ++$year;
        }else{
            ++$month;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- 年のドロップダウン -->
    <form action="/calendar/calendar.php" method="post">
        <select name="year" id="year">
            <?php
                for($i=$min_year; $i<=$max_year; $i++){
                    if($year == "" && $i == date('Y')){
                        echo '<option value="'.$i.'" selected>'.$i.'年</option>';
                    } elseif ($year == $i){
                        echo '<option value="'.$i.'" selected>'.$i.'年</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'年</option>';  
                    }
                }
            
            ?>
        </select>
        
        <!-- 月のドロップダウン -->
        <select name="month" id="month">
            <?php
                for($i=1; $i<=12; $i++){
                    if($month == "" && $i == date('M')){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    }elseif ($month == $i){
                        echo '<option value="'.$i.'" selected>'.$i.'月</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'月</option>';  
                    }
                }
            ?>
        </select>
        <button type="submit">表示</button>
        <?php
        // if($year != $min_year && $month != 1){
        //     echo '<button type="submit" name="prev" id="prev">前月</button>';
        // }
        // if($year !=$max_year && $month != 12){
        //     echo'<button type="submit" name="next" id="next">翌月</button>';
        // }


        if(!($year == $min_year && $month == 1)){
            echo '<button type="submit" name="prev" id="prev">前月</button>';
        }else{
            echo '<button type="submit" name="prev" id="prev" disabled>前月</button>';
        }
        if(!($year ==$max_year && $month == 12)){
            echo'<button type="submit" name="next" id="next">翌月</button>';
        }
        ?>

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
                //開始曜日まで日付を進める
                for($i=0; $i<$start_week; $i++){
                    echo '<td></td>';
                }
                
                //1日～月末までの日付繰り返し
                for($i=1; $i<=date("t",strtotime($end_date)); $i++){
                    $set_date = date("Y-m",strtotime($start_date)).'-'.sprintf("%02d",$i);
                    $week_date = date("w", strtotime($set_date));
                    echo '<td>'.$i.'</td>';
                    if($week_date == 6){
                        echo '</tr>';
                        echo '<tr>';
                    }
                }
                
                //末日の余りを空白で埋める
                for($i=0; $i<$end_week; $i++){
                    echo '<td></td>';
                }
            ?>
        </tr>
    </table>
</body>
</html>