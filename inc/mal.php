<?php
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
	if (isset($erg) or isset($ergd)) {
		echo '<table class="outer-border" id="main"><tr><td class="failure">'.$erg.'<br>'.$ergd.'</td></tr></table>';
	}
	$id = '1';
	$stmt = $mysqli->prepare("SELECT id, name, surname, geb, street, plz, ort, tel, mob, logrp, lo, ber, mail FROM ".USR." WHERE me = ? AND NOT id = ? ORDER BY surname DESC");
	$stmt->bind_param('ii', $_SESSION['mid'], $id);
	$stmt->execute();
	$result = $stmt->get_result();
    echo '<table class="outer-border"><tr><td class="tabhead center">'.$locate['110'].'</td><td class="tabhead center">'.$locate['109'].'</td><td class="tabhead center">'.$locate['111'].'</td><td class="tabhead center">'.$locate['114'].'</td><td class="tabhead center">'.$locate['112'].'</td><td class="tabhead center">'.$locate['113'].'</td><td class="tabhead center">'.$locate['115'].'</td><td class="tabhead center">'.$locate['116'].'</td><td class="tabhead center">'.$locate['108'].'</td><td class="tabhead center">'.$locate['107'].'</td><td class="tabhead center">'.$locate['120'].'</td><td class="tabhead center">'.$locate['124'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
        echo '<tr>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.name.usr_login">'.$urs['name'].'</td> ';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.surname.usr_login">'.$urs['surname'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.geb.usr_login">'.$urs['geb'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.street.usr_login">'.$urs['street'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.plz.usr_login">'.$urs['plz'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.ort.usr_login">'.$urs['ort'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.tel.usr_login">'.$urs['tel'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.mob.usr_login">'.$urs['mob'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.logrp.usr_login">'.$urs['logrp'].'</center></td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.lo.usr_login">'.$urs['lo'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.ber.usr_login">'.$urs['ber'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.mail.usr_login">'.$urs['mail'].'</td>';
		echo '<form action="'.$_SERVER['PHP_SELF'].'?site=mal" name="deluser" method="post"><td class="table-body"><input type="hidden" name="del" value="'.$urs['id'].'"><input type="image" src="'.IMG.'x.jpg" width="30px" height="30px"></form><td>';
        echo '</tr>';
    }
	$stmt->close();
    echo '</table>';
}
if ($_REQUEST['del']) {
	$usr = $_POST['del'];
	$stmt = $mysqli->prepare ("SELECT ma FROM ".USR." WHERE id= ? ");
	$stmt->bind_param('i', $usr);
	$stmt->execute();
	$result = $stmt->get_result();
	$dusr = $result->fetch_array();
	$dusr = "tt".$dusr['ma'];
	$stmt->close();
	if ($mysqli->query ("DROP TABLE ".$dusr."") === true) {
			$ergd = "Mitarbeiter Datenbank entfernt";
		} else {
			$ergd = "Datenbank konnte nicht gelöscht werden";
		}
	$stmt = $mysqli->prepare ("DELETE FROM ".USR." WHERE id= ? ");
	$stmt->bind_param('i', $usr);
	$stmt->execute();
	if ($stmt->affected_rows == "1") {
		$erg = "Mitarbeiter gelöscht";
	} else {
		$erg = "Keine Aktion ausgeführt, wenden Sie sich an Ihrem Administartor!";
	}
	$stmt->close();
	$mysqli->close();
	echo'<meta http-equiv="refresh" content="1; URL=./index.php?site=mal">';
	
}
