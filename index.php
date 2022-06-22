<?php
    // 現在年
    $selected_year = date("Y");
    // 現在月
    $selected_month = date("m");

    // 選択ボタンが押下された場合
    if (isset($_POST['select_button'])) {
        $selected_year = $_POST["year"];
        $selected_month = $_POST["month"];
    }

    // prevボタンが押下された場合
    if (isset($_POST['prev_button'])){
        $selected_year = $_POST["year"];
        $selected_month = $_POST["month"];
        // 1月の場合は、前年の12月にする
        if ($selected_month == 1){
            $selected_month = 12;
            --$selected_year;
        // 1月でない場合は月から1引く
        }else{
            --$selected_month;
        }
    }

    // nextボタンが押下された場合
    if (isset($_POST['next_button'])){
        $selected_year = $_POST["year"];
        $selected_month = $_POST["month"];
        // 12月の場合は、次年の1月にする
        if ($selected_month == 12){
            $selected_month = 1;
            ++$selected_year;
            
        // 12月でない場合は月に1足す
        }else{
            ++$selected_month;
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_calendar_shinooka</title>
    <style>
        .btn {
            border-radius: 16px;
            /* 枠線を消す */
            border: none;
            /* 上下4px、左右16px */
            padding: 4px 16px;
        }
    </style>
</head>

<body>
<form method="post">

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
    <input type="submit" name="select_button" value="選択" class="btn"/>

    <div>
    <!-- 前月へ移動するボタン -->
    <?php
        // 1900年1月以外の場合に前月移動ボタンを表示
        if ($selected_year != 1900 | $selected_month != 1){
            echo ('<input type="submit" name="prev_button" value="prev" class="btn"/>');
        }

        // 2022年12月以外の場合に次月移動ボタンを表示
        if ($selected_year != 2022 | $selected_month != 12){
            echo ('<input type="submit" name="next_button" value="next" class="btn"/>');
        }
    ?>
    </div>

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
					// 参考にしたサイト：https://php1st.com/1001#0table
					$day = 1;

					// 月初めの日の曜日を取得する
					$wd1 = date("w", mktime(0, 0, 0, $selected_month, 1, $selected_year));
					// 月初めの日まで空欄を表示させる
					for ($i = 1; $i <= $wd1; $i++) {
						echo "<td>&emsp;</td>";
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
                ?>
            </tr>    
        </table>
    </div>

</body>
</html>
