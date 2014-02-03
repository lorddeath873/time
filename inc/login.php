<form method="post" action="<? $_SERVER['PHP_SELF']; ?>">
<table class='outer-border' id='main'>
	<tr>
		<td class="textbox"><? echo $locate['100']; ?></td>
		<td class="textbox"><? echo $locate['101']; ?></td>
	</tr>
	<tr>
		<td class="table-body"><input name="kdn" type="text" /></td>
		<td class="table-body"><input name="pw" type="password" /></td>
	</tr>
	<tr>
		<td class="table-body"><input class="button" name="ok" type="submit" value="Login" /></td></tr>
</table>
</form>
<?php
if (isset($_REQUEST['ok'])) {
    $kdn = $_POST['kdn'];
    $pw = md5($_POST['pw']);
	$stmt = $mysqli->prepare("SELECT ma, pw, name, surname, usrgrp FROM usr_login WHERE ma = ? LIMIT 1");
	$stmt->bind_param('s', $kdn);
	$stmt->execute();
	$result = $stmt->get_result();
    if (!check_data($result)){
        echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['102'].'</td></tr></table>';
    } else {
        while ($urs = $result->fetch_array()) {
            if ($kdn == $urs['ma'] && $pw == $urs['pw']) {
                $_SESSION['mid']=$urs['ma'];
                $_SESSION['na']=$urs['name'];
                $_SESSION['nan']=$urs['surname'];
                $_SESSION['usgrp']=$urs['usrgrp'];
                echo '<meta http-equiv="refresh" content="0;url=./index.php?site=req&user='.$_SESSION['mid'].'" />';
            } else {
                echo '<table class="outer-border" id="main"><tr><td class="failure">'.$locate['103'].'</td></tr></table>';
                break;
            }
        }
		$stmt->close();
    }
}
