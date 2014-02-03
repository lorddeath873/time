<?php
$timestamp = time();
$da = date("Y.m.d", $timestamp);
$uh = date("H:i:s", $timestamp);
$dae = date("d.m.Y", $timestamp);
if (isset($_SESSION['mid'])) {
	$stmt = $mysqli->prepare("SELECT awo FROM ".USR." WHERE ma = ? LIMIT 1");
	$stmt->bind_param('s', $_SESSION['mid']);
	$stmt->execute();
	$result = $stmt->get_result();
    while ($awo = $result->fetch_array()) {
        $awos = $awo['awo'];
    }
	$stmt->close();
    if ($awos == "1") {
        echo '<form method="post" action="'.$_SERVER['REQUEST_URI'].'"><table class="outer-border" id="main"><tr><td class="failure">'.$locate['161'].'</td><td class="table-body"><input type="submit" class="button" name="esub" value="Ende"/></td></tr></table></form>';
        if (isset($_REQUEST['esub'])) {
			$z ="0";
			$stmt = $mysqli->prepare("UPDATE ".USR." SET awo = ? WHERE ma = ? LIMIT 1");
			$stmt->bind_param('is', $z, $_SESSION['mid']);
			$stmt->execute();
			$stmt->close();
            $dbu = "tt".$_SESSION['mid'];
			$stmt = $mysqli->prepare("UPDATE ".$dbu." SET end = ? ORDER BY id DESC LIMIT 1");
			echo $mysqli->error;
			$stmt->bind_param('s', $timestamp);
			$stmt->execute();
			$stmt->close();
            echo '<table class="outer-border" id="main"><tr><td class="textbox"><h2>'.$locate['162'].$dae.' um '.$uh.' Uhr</h2></td></tr></table>';
            echo '<meta http-equiv="refresh" content="2"/>';
        }
        exit;
    }
	$stmt = $mysqli->prepare("SELECT id, fm FROM ".FA."");
	$stmt->execute();
	$result = $stmt->get_result();

    if (!check_data($result)){
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['146'].'</td></tr></table></form>';
        exit;
    } else {
        while ($fa = $result->fetch_array()) {
            $sele.='<option value ='.$fa['id'].'>'.$fa['fm'].'</option>';
        }
    }
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT id, work FROM ".WO."");
	$stmt->execute();
	$result = $stmt->get_result();
    if (!check_data($result)){
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['160'].'</td></tr></table>';
    } else {
        while ($wo = $result->fetch_array()) {
            $selew.='<option value ='.$wo['id'].'>'.$wo['work'].'</option>';
        }
    }
	$stmt->close();
    ?>
    <form method="post" action="<? $_SERVER['PHP_SELF']; ?>">
    <table class='outer-border' id='main'>
    <tr>
    <td class="textbox"><? echo $locate['105']; ?></td>
    <td class="table-body"><input type="text" name="ma" value="<?echo $_SESSION['mid'] ?>" readonly="readonly"/></td>
    <td class="textbox"><? echo $locate['100']; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['149']; ?></td>
    <td class="table-body"><select name="sel"><? echo $sele ?></select></td>
    <td class="textbox"><? echo $locate['141']; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['159']; ?></td>
    <td class="table-body"><select name="selw"><? echo $selew ?></select></td>
    <td class="textbox"><? echo $locate['158']; ?></td>
    </tr>
    <tr>
    <td class="table-body"><input type="submit" class="button" name="submit" value="Start"/></td>
    <td></td>
    </tr>
    </table>
    </form>
    <?php
    if (isset($_REQUEST['submit'])) {
        $_SESSION['wid'] = $_POST['selw'];
		$awo = "1";
		$stmt = $mysqli->prepare("UPDATE ".USR." SET awo = ? WHERE ma = ? LIMIT 1");
		$stmt->bind_param('ii', $awo, $_SESSION['mid']);
		$stmt->execute();
		$stmt->close();
		$ma = $_POST['ma'];
		$sel = $_POST['sel'];
		$selw = $_POST['selw'];
		$stmt = $mysqli->prepare("INSERT INTO tt".$_SESSION['mid']." (ma, fid, start, work) VALUES (?, ?, ?, ?)");
		$stmt->bind_param('iiss', $ma, $sel, $timestamp, $selw);
		$stmt->execute();
		$stmt->close();
        echo '<table class="outer-border" id="main"><tr><td class="textbox"><h2>'.$locate['163'].$dae.' um '.$uh.' Uhr</h2></td></tr></table>';
        echo '<meta http-equiv="refresh" content="3"/>';
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}
