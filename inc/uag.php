<link href="../template/css/style.css" rel="stylesheet" type="text/css" />

<?
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2") {
	include TEMPLATE."uag.php";
	echo '<form action="'.$_SERVER['PHP_SELF'].'?site=uag&user='.$_SESSION['mid'].'" method="post"><table class="outer-border"><tr><td class="tabhead center">'.$locate['109'].'</td><td class="tabhead center">'.$locate['184'].'</td><td class="tabhead center">'.$locate['185'].'</td><td class="tabhead center">'.$locate['159'].'</td><td class="tabhead center">'.$locate['186'].'</td></tr>';
	$stmt = $mysqli->prepare("SELECT id, ma, von, bis, ges, gen FROM ".UL." WHERE me = ? ORDER BY von ASC");
	$stmt->bind_param('i', $_SESSION['mid']);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($us = $result->fetch_array())
	{
		if ($us['gen'] == "1") {
			$gen = '<input type="submit" value="'.$locate['191'].'" name="button['.$us['id'].'][]"">';
			$b = "";
			$d = "";
		}
		if ($us['gen'] == "0") {
			$gen = '<input type="submit" value="'.$locate['186'].'" name="button['.$us['id'].'][]"">';
			$b = "";
			$d = "";
		}
		if ($us['gen'] == "2") {
			$gen = '<input type="submit" value="'.$locate['186'].'" name="button['.$us['id'].'][]"">';
			$b = "<s>";
			$d = "</s>";
		}
		if ($us['end'] > time()) {
			$gen = '<input type="submit" value="'.$locate['189'].'" name="button['.$us['id'].'][]"">';
			$b = "<s>";
			$d = "</s>";
		}
		if ($us['ges'] > "1") {
			$ges = $locate['188'];
		} else {
			$ges = $locate['187'];
		}
		$von = date('d.m.Y', $us['von']);
		$bis = date('d.m.Y', $us['bis']);
		$stmtusr = $mysqli->prepare("SELECT name, surname, mail FROM ".USR." WHERE ma = ?");
		$stmtusr->bind_param('i', $us['ma']);
		$stmtusr->execute();
		$res = $stmtusr->get_result();
		while ($aus = $res->fetch_array())
		{
			$name = $aus['surname'].",&nbsp;".$aus['name'];
			echo '<tr>';
			echo '<td class="textbox">'.$b.'&nbsp;'.$name.'&nbsp;'.$d.'</td>';
			echo '<td class="textbox">'.$b.'&nbsp;'.$von.'&nbsp;'.$d.'</td>';
			echo '<td class="textbox">'.$b.'&nbsp;'.$bis.'&nbsp;'.$d.'</td>';
			echo '<td class="textbox">'.$b.''.$us['ges'].'&nbsp;'.$ges.''.$d.'</td>';
			echo '<td class="textbox">'.$gen.'</td>';
			echo '</tr>';
		}
		$stmtusr->close();
	}
	$stmt->close();
	echo '</table></form>';
	if ($_REQUEST['button']){
		$button = $_POST['button'];
		$button = array_pop(array_keys($button));
		if ($_POST['button'][$button][0] == $locate['186'])
		{
			$gens = "1";
			$stmt = $mysqli->prepare("UPDATE ".UL." SET gen = ? WHERE id = ? ");
			$stmt->bind_param('ii', $gens, $button);
			$stmt->execute();
			$stmt->close();
			echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['190'].'</td></tr></table>';
			echo '<meta http-equiv="refresh" content="1;url=./index.php?site=uag&user='.$_SESSION['mid'].'" />';	
		} 
		if ($_POST['button'][$button][0] == $locate['189'])
		{
			$stmt = $mysqli->prepare("DELETE FROM ".UL." WHERE id = ? ");
			$stmt->bind_param('i', $button);
			$stmt->execute();
			$stmt->close();
			echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['193'].'</td></tr></table>';
			echo '<meta http-equiv="refresh" content="1;url=./index.php?site=uag&user='.$_SESSION['mid'].'" />';
		}
		if ($_POST['button'][$button][0] == $locate['191'])
		{
			$gens = "2";
			$stmt = $mysqli->prepare("UPDATE ".UL." SET gen = ? WHERE id = ? ");
			$stmt->bind_param('ii', $gens, $button);
			$stmt->execute();
			$stmt->close();
			echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['192'].'</td></tr></table>';
			echo '<meta http-equiv="refresh" content="1;url=./index.php?site=uag&user='.$_SESSION['mid'].'" />';
		}
	}
	
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}
?>