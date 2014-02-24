<?php
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
	if (isset($erg) or isset($ergd)) {
		echo '<table class="outer-border" id="main"><tr><td class="failure">'.$erg.'<br>'.$ergd.'</td></tr></table>';
	}
	$stmt = $mysqli->prepare("SELECT id, an, fm, street, plz, ort, tel FROM ".FA." ORDER BY fm DESC");
	$stmt->execute();
	$result = $stmt->get_result();
    echo '<table class="outer-border"><tr><td class="tabhead center">'.$locate['151'].'</td><td class="tabhead center">'.$locate['149'].'</td><td class="tabhead center">'.$locate['113'].'</td><td class="tabhead center">'.$locate['112'].'</td><td class="tabhead center">'.$locate['114'].'</td><td class="tabhead center">'.$locate['115'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
        echo '<tr>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.an.firmen">'.$urs['an'].'</td> ';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.fm.firmen">'.$urs['fm'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.street.firmen">'.$urs['street'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.plz.firmen">'.$urs['plz'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.ort.firmen">'.$urs['ort'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.tel.firmen">'.$urs['tel'].'</td>';
		echo '<form action="./index.php?site=fal" name="delfa" method="post"><td class="table-body"><input type="hidden" name="delfa" value="'.$urs['id'].'"><input type="image" src="'.IMG.'x.jpg" width="30px" height="30px"></form><td>';
        echo '</tr>';
    }
	$stmt->close();
    echo '</table>';
}
if ($_REQUEST['delfa']) {
	$usr = $_POST['delfa'];
	$stmt = $mysqli->prepare ("DELETE FROM ".FA." WHERE id= ? ");
	$stmt->bind_param('i', $usr);
	$stmt->execute();
	if ($stmt->affected_rows == "1") {
		$erg = "Firma gelöscht";
	} else {
		$erg = "Keine Aktion ausgeführt, wenden Sie sich an Ihrem Administartor!";
	}
	$stmt->close();
	$mysqli->close();
	echo'<meta http-equiv="refresh" content="1; URL=./index.php?site=fal">';
	
}