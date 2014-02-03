<?php
if (isset($_SESSION['mid'])) {
	$id = $_SESSION['mid'].".work";
	$id1 = $_SESSION['mid'].".fid";
	$stmt = $mysqli->prepare("SELECT * FROM tt".$_SESSION['mid']." LEFT JOIN ".WO." ON ".WO.".id = ? LEFT JOIN ".FA." ON ".FA.".id = ? ");
	$stmt->bind_param('ss', $id, $id1);
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
    echo '<table class="outer-border" id="hori"><tr><td class="textbox">'.$locate['149'].'</td><td class="textbox">'.$locate['159'].'</td><td class="textbox">'.$locate['166'].'</td><td class="textbox">'.$locate['167'].'</td><td class="textbox">'.$locate['166'].'</td><td class="textbox">'.$locate['168'].'</td><td class="textbox">'.$locate['169'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
        $diff=date_differ($urs['start'], $urs['end']);
        echo '<tr>';
        echo '<td class="textbox">'.$urs['fm'].'</td>';
        echo '<td class="textbox">'.$urs['work'].'</td>';
        echo '<td class="textbox">'.date("d.m.Y", $urs['start']).'</td>';
        echo '<td class="textbox">'.date("H:i", $urs['start']).'</td>';
        echo '<td class="textbox">'.date("d.m.Y", $urs['end']).'</td>';
        echo '<td class="textbox">'.date("H:i", $urs['end']).'</td>';
        echo '<td class="textbox">'.$diff['hour'].','.$diff['minute'].'</td>';
        echo '</tr>';
    }
	$stmt->close();
    $diff=date_differ($start, $end);
    echo '<tr><td class="textbox"></td><td class="textbox"></td><td class="textbox"></td><td class="textbox"></td><td class="textbox">'.$locate['170'].'</td><td class="textbox"></td><td class="textbox">'.$diff['hour'].','.$diff['minute'].'</td></tr>';
    echo "</table>";


} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['142'].'</td></tr></table>';
}
