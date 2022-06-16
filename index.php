<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_calendar_shinooka</title>
    <style>
        /* .calendar-container {
        width: 500px;
        margin: 0 auto;
        border-radius: 5px;
        background: #f6f5f4;
        color: #1a1a1a;
        } */
    </style>
</head>

<body>
<form method="post">

    <?php
        // ボタンが押されたかのフラグ
        $button_flg = FALSE;
        // 選択された年
        $selected_year = null;
        // 選択された月
        $selected_month = null;

        // 選択ボタンが押下された場合
        if (isset($_POST['select_button'])) {
            $button_flg = TRUE;
            $selected_year = $_POST["year"];
            $selected_month = $_POST["month"];
        }

        // prevボタンが押下された場合
        if (isset($_POST['prev_button'])){
            $button_flg = TRUE;
            $selected_year = $_POST["year"];
            $selected_month = $_POST["month"];
            // 1月の場合は、前年の12月にする
            if ($selected_month == 1){
                $selected_month = 12;
                $selected_year = --$selected_year;
            // 1月でない場合は単純に月から-1引く
            }else{
                $selected_month = --$selected_month;
            }
        }

        // nextボタンが押下された場合
        if (isset($_POST['next_button'])){
            $button_flg = TRUE;
            $selected_year = $_POST["year"];
            $selected_month = $_POST["month"];
            // 12月の場合は、次年の1月にする
            if ($selected_month == 12){
                $selected_month = 1;
                $selected_year = ++$selected_year;
            // 12月でない場合は単純に月に1足す
            }else{
                $selected_month = ++$selected_month;
            }
        }
    ?>

    <!-- 年選択プルダウン -->
    <select id="year" name="year">
        <?php            
            // 1900年から2022年まで表示
            for($i=1900; $i<=2022; $i++){
                if ($i == $selected_year){
                    echo ('<option value="' . $i. '" selected>' . $i . '年</option>');
                }else{
                    echo ('<option value="' . $i. '">' . $i . '年</option>');
                }
            }
        ?>
    </select>

    <!-- 月選択プルダウン -->
    <select id="month" name="month">
        <?php
            // 1月から12月まで表示
            for($i=1; $i<=12; $i++){
                if ($i == $selected_month){
                    echo ('<option value="' . $i. '" selected>' . $i . '月</option>');
                }else{
                    echo ('<option value="' . $i. '">' . $i . '月</option>');
                }
            }
        ?>
    </select>

    <!-- 選択ボタン -->
    <input type="submit"name="select_button"value="選択"/>

    <!-- 前月へ移動するボタン -->
    <input type="submit"name="prev_button"value="prev"/>

    <!-- 次月へ移動するボタン -->
    <input type="submit"name="next_button"value="next"/>

</form>

    <div class="calendar-container">
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
                    // ボタンが押下された場合
                    if ($button_flg == TRUE){

                        // 参考にしたサイト：https://php1st.com/1001#0table
                        $day = 1;

                        // 月初めの日の曜日を取得する
                        $wd1 = date("w", mktime(0, 0, 0, $selected_month, 1, $selected_year));
                        // 月初めの日まで空欄を表示させる
                        for ($i = 1; $i <= $wd1; $i++) {
                            echo "<td>　</td>";
                        }

                        // 日付が存在する間ループ
                        while (checkdate($selected_month, $day, $selected_year)) {
                            echo "<td>$day</td>";
                            // 土曜日の場合は改行する
                            if (date("w", mktime(0, 0, 0, $selected_month, $day, $selected_year)) == 6) {
                                echo "</tr>";
                            }
                            $day++;
                        }
                    }
                ?>
            </tr>    
        </table>
    </div>

</body>
</html>
