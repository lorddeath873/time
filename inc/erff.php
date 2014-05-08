<?php
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
    ?>
    <form name="erff" action="<? $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return pruefen()">
    <table class='outer-border' id='main'>
    <tr>
    <td class="tabhead"><? echo $locate['149'] ?></td>
    <td class="table-body"><input name="fa" type="text" /></td>
    <td class="textbox"><? echo $locate['150'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['151'] ?></td>
    <td class="table-body"><input name="an" type="text" /></td>
    <td class="textbox"><? echo $locate['152'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['113'] ?></td>
    <td class="table-body"><input name="ort" type="text" /></td>
    <td class="textbox"><? echo $locate['153'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['112'] ?></td>
    <td class="table-body"><input name="plz" type="text" /></td>
    <td class="textbox"><? echo $locate['155'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['114'] ?></td>
    <td class="table-body"><input name="street" type="text" /></td>
    <td class="textbox"><? echo $locate['154'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['115'] ?></td>
    <td class="table-body"><input name="tel" type="text" /></td>
    <td class="textbox"><? echo $locate['156'] ?></td>
    </tr>
    <tr>
    <td class="table-body"><input class="button" name="submit" type="submit" value="<? echo $locate['243'] ?>" /></td>
    </tr>
    </table>
    </form>

    <?php
    if (isset($_REQUEST['submit'])) {
		if ($_POST['fa'] != ""){
		$stmt = $mysqli->prepare("INSERT INTO firmen (an, fm, ort, plz, street, tel) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('ssssss', $_POST['an'], $_POST['fa'], $_POST['ort'], $_POST['plz'], $_POST['street'], $_POST['tel']);
		$stmt->execute();
		$stmt->close();
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['157'].'</td></tr></table>';
		} else {
			echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['255'].'</td></tr></table>';
		}
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}
