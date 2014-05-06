<?php
if (isset($_SESSION['mid'])) {
	$id = $_SESSION['mid'];
	setlocale(LC_TIME, 'de_DE.utf8');
	echo '<div align="left">';
	include TEMPLATE."out.php";
	echo '</div>';
	if (isset($_POST['month']))
	{
		$mon = $_POST['month'];
	} else {
		$mon = date('n');
	}
	$sqlmonth = mktime (0,0,0,$mon,1,date("Y"));
	$month = strftime ('%B', $sqlmonth);
	echo '<div align="center">';
	echo '<h1><span class="tabhead">'.$month.'</span></h1>';
	echo '</div>';
	$sqlmonthr = mktime (0,0,0,$mon+1,1,date("Y"));
	$stmt = $mysqli->prepare("SELECT fid, start, end FROM tt".$_SESSION['mid']." WHERE ma= ? AND start >= ? AND start <= ?");
	$stmt->bind_param('iii', $id, $sqlmonth, $sqlmonthr);
	$stmt-> execute();
	$result = $stmt->get_result();
    echo '<table class="outer-border" id="hori"><tr><td class="tabhead">'.$locate['149'].'</td><td class="tabhead">'.$locate['166'].'</td><td class="tabhead">'.$locate['167'].'</td><td class="tabhead">'.$locate['166'].'</td><td class="tabhead">'.$locate['168'].'</td><td class="tabhead">'.$locate['169'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
		$stmtf  = $mysqli->prepare("SELECT fm FROM ".FA." WHERE id = ? ");
		$stmtf->bind_param('i', $urs['fid']);
		$stmtf->execute();
		$res = $stmtf->get_result();
		while ($ress = $res->fetch_array()) {
			$diff = $urs['end'] - $urs['start'];
			$diff = diff_time ($diff);
        	echo '<tr>';
        	echo '<td class="textbox">'.$ress['fm'].'</td>';
        	echo '<td class="textbox">'.date("d.m.Y", $urs['start']).'</td>';
        	echo '<td class="textbox">'.date("H:i", $urs['start']).'</td>';
        	echo '<td class="textbox">'.date("d.m.Y", $urs['end']).'</td>';
        	echo '<td class="textbox">'.date("H:i", $urs['end']).'</td>';
			echo '<td class="textbox">'.$diff['std'].','.$diff['min'].'</td>';
        	echo '</tr>'; 
			$gesamtstd []= $diff['std'];
			$gesamtmin []= $diff['min'];
    	}
		$stmtf->close();
	}
	$sum = 0;
    foreach ($gesamtstd as $key=>$val) {
        $sum += $val;
    }
	$gsum = 0;
    foreach ($gesamtmin as $key=>$val) {
        $gsum += $val;
    }
	$stmt->close();
    echo '<tr><td></td><td></td><td></td><td class="tabhead">'.$locate['170'].'</td><td></td><td class="textbox">'.$sum.','.$gsum.'</td></tr>';
    echo "</table>";


} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['142'].'</td></tr></table>';
}
