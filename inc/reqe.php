<?php
$nl_sqls= "UPDATE ".DB."".USR." SET ".USR.".awo='0' WHERE ".USR.".ma=".$_SESSION['mid']." LIMIT 1";
$db_erg = mysql_query($nl_sqls);
if (!$db_erg) {
    die('Ungültige Abfrage: ' . mysql_error());
}
$da = date("d.m.Y", $timestamp);
$uh = date("H:i:s", $timestamp);
$sql = "UPDATE ".DB."".FA." SET ".FA.".end='$uh', ".FA.".edate='$da' ORDER BY id DESC LIMIT 1;";
$res = mysql_query($sql);
if (!$res) {
    die('Ungültige Abfrage: ' . mysql_error());
}
