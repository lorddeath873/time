<?php
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
	$id = '1';
	$stmt = $mysqli->prepare("SELECT id, name, surname, geb, street, plz, ort, tel, mob, logrp, lo, ber, mail FROM ".USR." WHERE me = ? AND NOT id = ? ORDER BY surname DESC");
	$stmt->bind_param('ii', $_SESSION['mid'], $id);
	$stmt->execute();
	$result = $stmt->get_result();
    echo '<table class="outer-border"><tr><td class="textbox center">'.$locate['110'].'</td><td class="textbox center">'.$locate['109'].'</td><td class="textbox center">'.$locate['111'].'</td><td class="textbox center">'.$locate['114'].'</td><td class="textbox center">'.$locate['112'].'</td><td class="textbox center">'.$locate['113'].'</td><td class="textbox center">'.$locate['115'].'</td><td class="textbox center">'.$locate['116'].'</td><td class="textbox center">'.$locate['108'].'</td><td class="textbox center">'.$locate['107'].'</td><td class="textbox center">'.$locate['120'].'</td><td class="textbox center">'.$locate['124'].'</td></tr>';
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
        echo '</tr>';
    }
	$stmt->close();
    echo '</table>';
}
