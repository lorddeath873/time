<? 
if (isset($_SESSION['mid'])) {
	$id = $_SESSION['mid'];
	$stmt = $mysqli->prepare("SELECT ma, name, surname, me, url, reurl, uestd, soll FROM ".USR." WHERE id = ? ");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$reurl = $result->fetch_array();
	if ($reurl['reurl'] == "0" && $reurl['uestd'] == "0") {
		echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['176'].'</td></tr></table>';
		$abbutt="disabled";
	}
	if ($reurl['reurl'] == "0") {
		$rbutt = '<input type="radio" disabled >' ;
		$mess = $locate['194'];
	} else {
		$rbutt = '<input type="radio" name="url" value="url">';
		$mess = $locate['225'].''.$reurl['reurl'].''.$locate['226'];
	}
	if ($reurl['uestd'] == "0" or $reurl['uestd'] < $reurl['soll'] ) {
		$rbuett = '<input type="radio" disabled >' ;
		$muess = $locate['227'];
	} else {
		$rbuett = '<input type="radio" name="url" value="uestd">';
		$muess = $locate['225'].''.$reurl['uestd'].''.$locate['228'];
	}
	$geurl = $reurl['url'];
	$reurlg = $reurl['reurl'];
	$uset = $reurl['uestd'];
	$soll = $reurl['soll'];
	$disp = $reurl['me'];
	$name = $reurl['name'];
	$surname = $reurl['surname'];
	$ma = $reurl['ma'];
	$stmt->close();
	?>

	<form action="./index.php?site=ua&user=<? echo $_SESSION['mid'] ?>" method="post">
	<table class="outer-border" id="main"><tr><td class="tabhead"> <? echo $locate['229'] ?> </td></tr>
	<tr>
    <td class="table-body"> <? echo $rbutt ?> </td>
    <td class="textbox"> <? echo $mess ?> </td>
    </tr>
    <tr>
    <td class="table-body"> <? echo $rbuett ?> </td>
    <td class="textbox"> <? echo $muess ?> </td>
    </tr>
    <tr>
    <td class="tabhead"> Von: </td>
    <td class="table-body"> <input type="date" name="dt" required></td>
    </tr>
    <tr>
    <td class="tabhead"> Bis: </td>
    <td class="table-body"> <input type="date" name="dte" required></td>
    </tr>
    <input type="hidden" name="maue" value="<? echo $_SESSION['mid'] ?>">
    <tr>
    <td class="table-body"> <input type="submit" class="button" value="<? echo $locate['230'] ?>" name="aa" <? echo $abbutt ?>></td>
    </tr>
    </table>
    </form>
    
	<?
	$g="1";
	$stmt = $mysqli->prepare("SELECT von, bis, ges, gen FROM ".UL." WHERE ma= ?");
	$stmt->bind_param('i', $ma);
	$stmt->execute();
	$rs = $stmt->get_result();
	echo '<table class="outer-border" id="main"><tr><td class="tabhead"> Von: </td><td class="tabhead">' .$locate['185']. '</td><td class="tabhead">' .$locate['231']. '</td><td class="tabhead">' .$locate['232']. '</td></tr>';
	while ($rst = $rs->fetch_array()) {
		$von = date('d.m.Y', $rst['von']);
		$bis = date('d.m.Y', $rst['bis']);
		if ($rst['gen'] == "0") {
			$gen = '<img src="'.IMG.'/x.jpg" width="20px" height="20px" />&nbsp;'.$locate['233'].'';
		} 
		if ($rst['gen'] == "1") {
			$gen = '<img src="'.IMG.'/haken.jpg" width="20px" height="20px" />&nbsp;'.$locate['234'].'';
		}
		if ($rst['gen'] == "2") {
			$gen = '<img src="'.IMG.'/aus.gif" width="20px" height="20px" />&nbsp;'.$locate['235'].'';
		}
		echo '<tr>';
		echo '<td class="textbox">'.$von.'</td>';
		echo '<td class="textbox">'.$bis.'</td>';
		echo '<td class="textbox">'.$rst['ges'].'</td>';
		echo '<td class="textbox">'.$gen.'</td>';
		echo '</tr>';
	}
	echo "</table>";
	$stmt->close();
	if ($_REQUEST['aa']) {
		if (isset($_POST['url'])) {
			$heute = time();
			$datum = date("Y-m-d",$heute);
			$datum = strtotime($datum) + 259200;
			$dat = strtotime($_POST['dt']);
			$dae = strtotime($_POST['dte']);
			if ( $dat <= $datum ) {
				echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['179'].'</td></tr></table>';
				exit;
			}
			if ($dae < $dat) {
				echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['180'].'</td></tr></table>';
				exit;
			}
			$urlg = ($dae - $dat) /60 /60 /24 +1;
			$uestdg = $urlg * $soll;
			$geuestd = $uset - $uestdg;
			if ($geuestd < "0") {
				echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['181'].'</td></tr></table>';
			exit;
			}
			$stmt = $mysqli->prepare("SELECT surname, mail FROM ".USR." WHERE ma = ? ");
			$stmt->bind_param('i', $disp);
			$stmt->execute();
			$result = $stmt->get_result();
			$result = $result->fetch_array();
			if (!isset($result['mail'])) {
				echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['183'].'</td></tr></table>';
				exit;
			}
		$empfaenger = $result['mail'];
        $betreff    = $locate['236']."".$surname.", ".$name;
        $mailtext = "<img src=http://".$_SERVER['HTTP_HOST']."/".IMG.$heimg."><br><br>";
        $mailtext   .= $locate['237']."".$result['surname'].",<br><br>";
        $mailtext   .= $locate['238']."".$surname."".$locate['239']."".$_POST['dt']."".$locate['240']."".$_POST['dte'].",<br>".$locate['241']."<br><br><br>";
        $absender   = $fma." <".$maa.">";
        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=iso-8859-1";
        $headers[] = "From: {$absender}";
        $headers[] = "Bcc: Administrator <".$admm.">";
        $headers[] = "Reply-To: {$absender}";
        $headers[] = "Subject: {$betreff}";
        $headers[] = "X-Mailer: PHP/".phpversion();
        mail($empfaenger, $betreff, $mailtext, implode("\r\n", $headers));
		$stmt->close();
			$gen="0";
			$stmt = $mysqli->prepare("INSERT INTO ".UL." (ma, von, bis, ges, gen, me) VALUES (?, ?, ?, ?, ?, ?) ");
			$stmt->bind_param('iiiiii', $_SESSION['mid'], $dat, $dae, $urlg, $gen, $disp);
			$stmt->execute();
			$stmt->close();
			if ($_POST['url'] == "uestd") {
				$geurl = $geurl - $urlg;
				$stmt = $mysqli->prepare("UPDATE ".USR." SET uestd= ? WHERE id = ? ");
				$stmt->bind_param('si', $geuestd, $_SESSION['mid']);
				$stmt->execute();
				$stmt->close();
				echo '<meta http-equiv="refresh" content="0;url=./index.php?site=ua&user='.$_SESSION['mid'].'" />';
			}
			if ($_POST['url'] == "url") {
				$geurl = $geurl - $urlg;
				$stmt = $mysqli->prepare("UPDATE ".USR." SET reurl= ? WHERE id = ? ");
				$stmt->bind_param('si', $geurl, $_SESSION['mid']);
				$stmt->execute();
				$stmt->close();
				echo '<meta http-equiv="refresh" content="0;url=./index.php?site=ua&user='.$_SESSION['mid'].'" />';
			}
		} else {
			echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['182'].'</td></tr></table>';
		}
	}
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}