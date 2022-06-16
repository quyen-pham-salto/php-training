<?php
date_default_timezone_set('Asia/Tokyo');


if (!empty($_POST["selectYear"]) && !empty($_POST["selectMonth"])) {
	$selectYear = $_POST["selectYear"];
	$selectMonth = $_POST["selectMonth"];
	$selectDate = "{$selectYear}-{$selectMonth}-01";
}

if (isset($_POST['calendar'])) {
	$tmp = !is_string(key($_POST['calendar'])) ? '' : key($_POST['calendar']);
	if (strpos($tmp, '*') !== false) {
		$date = substr($tmp, 8, 10);
		$get_y = substr($tmp, 0, 4);
		$get_m = substr($tmp, 5, 2);
	} else {
		$date = $tmp;
		$get_y = date('Y', strtotime($date));
		$get_m = date('n', strtotime($date));
	}
} else {
	$date = date('Y-m-d');
	$get_y = date('Y');
	$get_m = date('n');
}

function get_rsv_calendar($yyyy, $mm, $date)
{
	$thisyear = $yyyy;
	$thismonth = $mm;
	$unixmonth = mktime(0, 0, 0, $thismonth, 1, $thisyear);
	$last_day = date('t', $unixmonth);
	$prev = date('Y-m', strtotime('-1 month', $unixmonth));
	$next = date('Y-m', strtotime('+1 month', $unixmonth));

	$calendar_output = '<table class="rsv_calendar">' . "\n\t" . '<form action="" method="post">' . "\n\t" . '<caption>';
	$calendar_output .= "\n\t\t" . '<input type="submit" name="calendar[' . $prev . '*' . $date . ']" value="<<">';
	$calendar_output .= "\n\t\t" . $thisyear . '年' . $thismonth . '月';
	$calendar_output .= "\n\t\t" . '<input type="submit" name="calendar[' . $next . '*' . $date . ']" value=">>">';
	$calendar_output .= "\n\t</caption>\n\t<thead>\n\t<tr>";

	$myweek = array("日", "月", "火", "水", "木", "金", "土");

	foreach ($myweek as $wd) {
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$wd</th>";
	}

	$calendar_output .= '
  </tr>
  </thead>
  <tbody>
  <tr>';

	$pad = date('w', $unixmonth);
	if (0 != $pad)
		$calendar_output .= "\n\t\t" . '<td colspan="' . $pad . '" class="pad"> </td>' . "\n\t\t";

	for ($day = 1; $day <= $last_day; ++$day) {
		if (isset($newrow) && $newrow)
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;

		$sp_date = explode("-", $date);
		if ($day == $sp_date[2] && $thismonth == $sp_date[1] && $thisyear == $sp_date[0])
			$calendar_output .= '<td id="current">';
		elseif ($day == date('j') && $thismonth == date('m') && $thisyear == date('Y'))
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';

		$calendar_output .= '<input type="submit" name="calendar[' . $thisyear . '-' . str_pad($thismonth, 2, "0", STR_PAD_LEFT) . '-' . str_pad($day, 2, "0", STR_PAD_LEFT) . ']" value="' . $day . '">';
		$calendar_output .= "</td>\n\t\t";

		if (6 == date('w', mktime(0, 0, 0, $thismonth, $day, $thisyear)))
			$newrow = true;
	}

	$pad = 7 - date('w', mktime(0, 0, 0, $thismonth, $day, $thisyear));
	if ($pad != 0 && $pad != 7)
		$calendar_output .= "\n\t\t" . '<td class="pad" colspan="' . $pad . '"> </td>'; //余ったtdを埋める

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</form>\n</table>";

	echo $calendar_output;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Title</title>
</head>

<body>

	<div id="calendar_box">
		<div>
			<form action="index.php" method="POST">
				<select name="selectYear">
					<option value="" selected hidden>選択してください</option>
					<?php optionLoop('1900', date('Y')); ?>
				</select>
				年
				<select name="selectMonth">
					<option value="" selected hidden>選択してください</option>
					<?php optionLoop('1', '12'); ?>
				</select>
				月
				<input type="submit" name="submit" value="送信" />
			</form>

		</div>
		<?php
		function optionLoop($start, $end)
		{
			for ($i = $start; $i <= $end; $i++) {
				echo "<option value=\"{$i}\">{$i}</option>";
			}
		}
		?>
		<?php
		isset($selectYear) && isset($selectMonth) ?
			get_rsv_calendar($selectYear, $selectMonth, $selectDate) :
			get_rsv_calendar($get_y, $get_m, $date);
		?>
	</div>
</body>

</html>