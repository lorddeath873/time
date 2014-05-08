<?php
function pwgm()
{
    $bst=array_merge(range('a', 'z'), range('A', 'Z'));
    $zah=range(0, 9);
    $so=array('@','?','!','$');
    $z_p=array_merge($bst, $zah, $so);
    $z_p=array_flip($z_p);
    $lä=rand(8, 12);
    $pass='';
    for ($x=1; $x<$lä; $x++) {
        $pass.=array_rand($z_p);
    }
    return $pass;
}
$stmt = $mysqli->prepare("SELECT id, fm FROM ".FA."");
$stmt->execute();
$result = $stmt->get_result();
if (!check_data($result)){
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['146'].'</td></tr></table>';
    exit;
} else {
    while ($fa = $result->fetch_array()) {
        $sele.='<option value ='.$fa['id'].'>'.$fa['fm'].'</option>';
    }
}
$pwm=pwgm();
if ($_SESSION['usgrp'] == "1" OR $_SESSION['usgrp'] == "2" && isset($_SESSION['mid'])) {
    if ($_SESSION['usgrp'] == "2") {
        $usrgrp='<select name="usrgrp"><option value="3">3</option></select>';
    } else {
        $usrgrp='<select name="usrgrp"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>';
    }
    $geb=''
    ?>
    <form name="erf" method="post" action="<? $_SERVER['PHP_SELF']; ?>" onsubmit="return pruefen()">
    <table class='outer-border' id='main'>	
    <tr>
    <td class="tabhead"><? echo $locate ['105'] ?></td>
    <td class="table-body"><input name="ma" type="text" maxlength="10" /></td>
    <td class="textbox"><? echo $locate ['122'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['106'] ?></td>
    <td class="table-body"><input style="border:1px; color:#FFF; background-color:transparent;" name="pw" type="password" value="<? echo $pwm ?>" readonly="readonly" /></td>
    <td class="textbox"><? echo $locate ['123'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['107'] ?></td>
    <td class="table-body"><input name="lo" type="text" maxlength="5"></td>
    <td class="textbox"><? echo $locate ['125'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['108'] ?></td>
    <td class="table-body"><input name="logrp" type="text" maxlength="1"></td>
    <td class="textbox"><? echo $locate ['126'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['109'] ?></td>
    <td class="table-body"><input name="name" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['127'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['110'] ?></td>
    <td class="table-body"><input name="surname" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['128'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['111'] ?></td>
    <td class="table-body"><input name="geb" type="text" class="tcal"></td>
    <td class="textbox"><? echo $locate ['129'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['112'] ?></td>
    <td class="table-body"><input name="plz" type="text" maxlength="5"></td>
    <td class="textbox"><? echo $locate ['130'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['113'] ?></td>
    <td class="table-body"><input name="ort" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['131'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['114'] ?></td>
    <td class="table-body"><input name="street" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['132'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['115'] ?></td>
    <td class="table-body"><input name="tel" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['133'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['116'] ?></td>
    <td class="table-body"><input name="mob" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['134'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['117'] ?></td>
    <td class="table-body"><? echo $usrgrp ?></td>
    <td class="textbox"><? echo $locate ['135'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['118'] ?></td>
    <td class="table-body"><input name="ein" type="text" class="tcal" /></td>
    <td class="textbox"><? echo $locate ['136'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['119'] ?></td>
    <td class="table-body"><input name="aus" type="text" class="tcal" /></td>
    <td class="textbox"><? echo $locate ['137'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['120'] ?></td>
    <td class="table-body"><input name="ber" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['138'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['147'] ?></td>
    <td class="table-body"><? echo '<select name="sel">'.$sele.'</select>' ?></td>
    <td class="textbox"><? echo $locate ['148'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['121'] ?></td>
    <td class="table-body"><input style="border:1px; color:#FFF; background-color:transparent;" name="me" type="text" value="<? echo $_SESSION['mid'] ?>" maxlength="10" readonly="readonly"></td>
    <td class="textbox"><? echo $locate ['121'] ?></td>
    </tr>
	<tr>
    <td class="tabhead"><? echo $locate ['177'] ?></td>
    <td class="table-body"><input name="ta" type="text" maxlength="4"> </td>
    <td class="textbox"><? echo $locate ['178'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['139'] ?></td>
    <td class="table-body"><input name="url" type="text" maxlength="2"> </td>
    <td class="textbox"><? echo $locate ['139'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['140'] ?></td>
    <td class="table-body"><input name="reurl" type="text" maxlength="2"></td>
    <td class="textbox"><? echo $locate ['140'] ?></td>
    </tr>
    <tr>
    <td class="tabhead"><? echo $locate ['124'] ?></td>
    <td class="table-body"><input name="mail" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['124'] ?></td>
    </tr>
	<tr>
    <td class="tabhead"><? echo $locate ['170'] ?></td>
    <td class="table-body"><input name="gemon" type="text" maxlength="255"></td>
    <td class="textbox"><? echo $locate ['195'] ?></td>
    </tr>
    <tr>
    <td class="table-body"><input class="button" name="ok" type="submit" value="<? echo $locate['243'] ?>" /></td></tr>
    </table>
    </form>

    <?php
    if (isset($_REQUEST['ok'])) {
        $pwm5=md5($_POST['pw']);
        $pwmm=$_POST['pw'];
        $dat="tt".$_POST['ma'];
		$uestd="0";
		$soll=$_POST['ta'];
		if ($mysqli->query("CREATE TABLE IF NOT EXISTS ".$dat." (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, ma  VARCHAR(255), fid VARCHAR(255), start VARCHAR(255), work VARCHAR(255), end VARCHAR(255), date  DATE NOT NULL, edat DATE NOT NULL) ENGINE=MYISAM;") === true) {
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['165'].'</td></tr></table>';
		}
		$stmt = $mysqli->prepare("INSERT INTO usr_login (ma, pw, lo, logrp, name, surname, geb, ein, aus, street, plz, tel, mob, ort, url, reurl, usrgrp, ber, me, mail, fid, awo, uestd, soll, sollmonth) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('ssssssssssissssssssssssss',$_POST['ma'], $pwm5, $_POST['lo'], $_POST['logrp'], $_POST['name'], $_POST['surname'], $_POST['geb'], $_POST['ein'], $_POST['aus'], $_POST['street'], $_POST['plz'], $_POST['tel'], $_POST['mob'], $_POST['ort'], $_POST['url'], $_POST['reurl'], $_POST['usrgrp'], $_POST['ber'], $_POST['me'], $_POST['mail'], $_POST['fid'], $uestd, $uestd, $soll, $_POST['gemon']);
		$stmt->execute();
		$stmt->close();
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['157'].'</td></tr></table>';
		//Bearbeitbar
        $empfaenger = $_POST['mail'];
        $betreff    = $locate['244']."".$fma;
        $mailtext = "<img src=http://".$_SERVER['HTTP_HOST']."/".IMG.$heimg."><br><br>";
        $mailtext   .= $locate['237']."".$_POST['name'].",<br><br>";
        $mailtext   .= $locate['245']."".$addrr.":<br> <table><tr><td><u>".$locate['105'].":</u></td><td>".$_POST['ma']."</td></tr><table><tr><td><u>".$locate['106'].":</u></td><td>".$_POST['pw']."</td></tr></table><br><br>".$locate['246']."<br><br>".$locate['247']."".$fma."".$locate['248']."<br>";
        $mailtext .= $footer;
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
		//Bearbeitbar Ende
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['164'].'</td></tr></table>';
    }
} else {
    echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['104'].'</td></tr></table>';
}



