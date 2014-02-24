<?php
if (isset($_SESSION['mid'])) {
	$id = $_SESSION['mid'];
	$stmt = $mysqli->prepare("SELECT fid, start, end FROM tt".$_SESSION['mid']." WHERE ma= ?");
	$stmt->bind_param('i', $id);
	$stmt-> execute();
	$result = $stmt->get_result();
	$stmts = $mysqli->prepare("SELECT SUM(start) AS start FROM tt".$_SESSION['mid']."");
	$stmts->execute();
	$stmts->bind_result($start);
	$stmts->fetch();
	$stmts->close();
	$stmti = $mysqli->prepare("SELECT SUM(end) AS end FROM tt".$_SESSION['mid']."");
	$stmti->execute();
	$stmti->bind_result($end);
	$stmti->fetch();
	$stmti->close();
    echo '<table class="outer-border" id="hori"><tr><td class="tabhead">'.$locate['149'].'</td><td class="tabhead">'.$locate['166'].'</td><td class="tabhead">'.$locate['167'].'</td><td class="tabhead">'.$locate['166'].'</td><td class="tabhead">'.$locate['168'].'</td><td class="tabhead">'.$locate['169'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
		$stmtf  = $mysqli->prepare("SELECT fm FROM ".FA." WHERE id = ? ");
		$stmtf->bind_param('i', $urs['fid']);
		$stmtf->execute();
		$res = $stmtf->get_result();
		while ($ress = $res->fetch_array()) {
        	$diff=date_differ($urs['start'], $urs['end']);
        	echo '<tr>';
        	echo '<td class="textbox">'.$ress['fm'].'</td>';
        	echo '<td class="textbox">'.date("d.m.Y", $urs['start']).'</td>';
        	echo '<td class="textbox">'.date("H:i", $urs['start']).'</td>';
        	echo '<td class="textbox">'.date("d.m.Y", $urs['end']).'</td>';
        	echo '<td class="textbox">'.date("H:i", $urs['end']).'</td>';
        	echo '<td class="textbox">'.$diff['hour'].','.$diff['minute'].'</td>';
        	echo '</tr>';
    	}
		$stmtf->close();
	}
	$stmt->close();
    $diff=date_differ($start, $end);
    echo '<tr><td></td><td></td><td></td><td class="tabhead">'.$locate['170'].'</td><td></td><td class="textbox">'.$diff['hour'].','.$diff['minute'].'</td></tr>';
    echo "</table>";


} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['142'].'</td></tr></table>';
}
