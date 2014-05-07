<?php
$timestamp = time();
$da = date("Y.m.d", $timestamp);
$uh = date("H:i", $timestamp);
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
			$dbu = "tt".$_SESSION['mid'];
			$stmt = $mysqli->prepare("SELECT uestd, soll, sollmonth, sollstd FROM ".USR." WHERE ma = ? LIMIT 1");
			$stmt->bind_param('s', $_SESSION['mid']);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($sm = $result->fetch_array()) {
				$smue = $sm['uestd'];
				$smsll = $sm['soll'];
				$smm = $sm['sollmonth'];
				$smss = $sm['sollstd'];
			}
			$stmt->close();
			$stmt = $mysqli->prepare("SELECT start, end FROM ".$dbu." ORDER BY id DESC LIMIT 1");
			$stmt->execute();
			$result = $stmt->get_result();
			while ($st = $result->fetch_array()) {
				$sts = $st['start'];
				$ste = $st['end'];
			}
			$stmt->close();
			$diff = $ste - $sts;
			$diff = diff_time ($diff);
			$stg = $diff['std']. "." .$diff['min'];
			if ($smss == "") {
				$smre = 0 + $stg;
			} else {
				$add = $smss + $stg;
				$smre = $add;
			}
			if($smre >= $smm) {
				$add = 0;
				$addg = 0;
				$addge = 0;
				$add = $smre - $smm;
				$addg = $stg - $add;
				$addge = $smss + $addg;
				$ue = $add + $smue;
				if ($add == '0') {
					$add = $smue;
				}
				$stmt = $mysqli->prepare("UPDATE ".USR." SET uestd = ?, sollstd = ? WHERE ma = ? ");
				$stmt->bind_param('sss', $ue, $addge, $_SESSION['mid']);
				$stmt->execute();
				$stmt->close();
			} else {
				$stmt = $mysqli->prepare("UPDATE ".USR." SET sollstd = ? WHERE ma = ? ");
				$stmt->bind_param('ss', $smre, $_SESSION['mid']);
				$stmt->execute();
				$stmt->close();
			}
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
    ?>
    <form method="post" action="<? $_SERVER['PHP_SELF']; ?>">
    <table class='outer-border' id='main'>
    <tr>
    <td class="tabhead"><? echo $locate['105']; ?></td>
    <td class="table-body"><input type="text" name="ma" value="<? echo $_SESSION['mid'] ?>" readonly="readonly"/></td>
    <td class="textbox"><? echo $locate['100']; ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate['149']; ?></td>
    <td class="table-body"><select name="sel"><? echo $sele ?></select></td>
    <td class="textbox"><? echo $locate['141']; ?></td>
    </tr>
    <tr>
    <td class="table-body"><input type="submit" class="button" name="submit" value="Start"/></td>
    <td></td>
    </tr>
    </table>
    </form>
    <?php
    if (isset($_REQUEST['submit'])) {
		$awo = "1";
		$stmt = $mysqli->prepare("UPDATE ".USR." SET awo = ? WHERE ma = ? LIMIT 1");
		$stmt->bind_param('ii', $awo, $_SESSION['mid']);
		$stmt->execute();
		$stmt->close();
		$ma = $_POST['ma'];
		$sel = $_POST['sel'];
		$stmt = $mysqli->prepare("INSERT INTO tt".$_SESSION['mid']." (ma, fid, start) VALUES (?, ?, ?)");
		$stmt->bind_param('iis', $ma, $sel, $timestamp);
		$stmt->execute();
		$stmt->close();
        echo '<table class="outer-border" id="main"><tr><td class="textbox"><h2>'.$locate['163'].$dae.' um '.$uh.' Uhr</h2></td></tr></table>';
        echo '<meta http-equiv="refresh" content="3"/>';
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}
