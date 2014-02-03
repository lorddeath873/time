<?php
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
	$stmt = $mysqli->prepare("SELECT id, an, fm, street, plz, ort, tel FROM ".FA." ORDER BY fm DESC");
	$stmt->execute();
	$result = $stmt->get_result();
    echo '<table class="outer-border"><tr><td class="textbox center">'.$locate['151'].'</td><td class="textbox center">'.$locate['149'].'</td><td class="textbox center">'.$locate['113'].'</td><td class="textbox center">'.$locate['112'].'</td><td class="textbox center">'.$locate['114'].'</td><td class="textbox center">'.$locate['115'].'</td></tr>';
    while ($urs = $result->fetch_array()) {
        echo '<tr>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.an.firmen">'.$urs['an'].'</td> ';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.fm.firmen">'.$urs['fm'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.street.firmen">'.$urs['street'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.plz.firmen">'.$urs['plz'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.ort.firmen">'.$urs['ort'].'</td>';
        echo '<td class="textbox center editable" id="'.$urs['id'].'.tel.firmen">'.$urs['tel'].'</td>';
        echo '</tr>';
    }
	$stmt->close();
    echo '</table>';
}