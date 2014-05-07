<?php
session_start();
error_reporting(E_ALL);
// Locate config.php and set the basedir path
$folder_level = "./";
$i = 0;
/*if (is_dir("install")) {
    echo "Bitte löschen, Sie den Install Ordner";
    exit;
}*/
require "config.inc.php";
// Calculate current true url
$script_url = explode("/", $_SERVER['PHP_SELF']);
$url_count = count($script_url);
$base_url_count = substr_count(BASEDIR, "/") + 1;
$current_page = "";
while ($base_url_count != 0) {
    $current = $url_count - $base_url_count;
    $current_page .= "/".$script_url[$current];
    $base_url_count--;
}
include LNG;
include INC."dbconn.inc.php";
$xtea = new XTEA("98z345z983z4n09vm849789wm04m8904b730mv90m747mz45b");
 ?>
<!DOCTYPE html>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><? echo $fma ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="<? echo CSS ?>style.css" rel="stylesheet" type="text/css" />
<link href="<? echo CSS ?>tcal.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="<? echo JS ?>inlineEdit.js" type="text/javascript"></script>
<script type="text/javascript" src="<? echo JS ?>scripts.js"></script>
<script src="<? echo JS ?>tcal.js" type="text/javascript"></script>
<script src="<? echo JS ?>failure.js" type="text/javascript"></script>
<script type="text/javascript">

    $(document).ready(function ()
    {
        $('.editable').editable("inc/update.php"), {
            id: 'elementid',
            onblur: 'submit'
        }
    });

</script>
</head>
<body>
<?php

echo "<table class='outer-border' id='main'><tr><td><table width='100%'><tr><td class='full-header'><table width='100%'><tr><td><img src='".IMG.$heimg."'></td></tr></table></td></tr></table><table width='100%'><tr><td class='sub-header'></td></tr></table>\n";
echo "<table width='100%'><tr>\n";
echo'<table width="100%"><tr><td class="side-border-left" valign="top"><table width="100%" class="border tablebreak"><tr><td class="scapmain">'.$locate['401'].'</td></tr><tr><td colspan="2" class="side-body"><div id="navigation"><ul><li class="first-link"><a href="index.php" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Startseite</span></a></li>';
if (isset($_SESSION['mid'])) {
    echo '<li><a href="index.php?site=req&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Erfassung</span></a></li>
	<li><a href="index.php?site=prof&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Profil</span></a></li>
	<li><a href="index.php?site=out&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Auswertung</span></a></li>
	<li><a href="index.php?site=ua&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Urlaubsantrag</span></a></li>
	<li><a href="index.php?site=lout&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Logout</span></a></li>';
}
echo'<li><a href="index.php?site=faq" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>FAQ</span></a></li>';
if ($_SESSION['usgrp'] == "2" OR $_SESSION['usgrp'] == "1") {
    echo '<li><a href="index.php?site=erf&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Mitarbeiter Registration</span></a></li>
    <li><a href="index.php?site=mal" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Mitarbeiter Liste</span></a></li>
    <li><a href="index.php?site=fal" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Firmen Liste</span></a></li>
	<li><a href="index.php?site=uag&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Urlaubsanträge</span></a></li>
    <li><a href="index.php?site=erff&user='.$_SESSION['mid'].'" class="side"><img src="'.IMG.'bullet.gif" border="0" /><span>Firmen Registration</span></a></li>';
}
echo '</ul></div></td></tr></table>
</td><td class="main-bg" valign="top"><noscript><div class="noscript-message admin-message">Du hast in deinem Browser kein <strong>Javascript</strong> aktiviert.<br />
Um diese Seite korrekt anzuzeigen ist Javascript jedoch zwingend n&ouml;tig.<br />
Bitte aktiviere Javascript in den Einstellungen deines Browser beziehungswei&szlig;e besorge dir einen Browser, der diesen unterst&uuml;tzt.<br />
<a href="http://www.firefox.com/" rel="nofollow" title="Mozilla Firefox">Mozilla Firefox</a>&nbsp;|&nbsp;
<a href="http://www.apple.com/safari/" rel="nofollow" title="Safari">Safari</a>&nbsp;|&nbsp;
<a href="http://www.opera.com/" rel="nofollow" title="Opera">Opera</a>&nbsp;|&nbsp;
<a href="http://www.google.com/chrome/" rel="nofollow" title="Google Chrome">Google Chrome</a>&nbsp;|&nbsp;
<a href="http://www.microsoft.com/windows/internet-explorer/" rel="nofollow" title="Internet Explorer">Internet Explorer h&ouml;her Version 6</a>
</div></noscript><!--error_handler--><table width="100%" class="border tablebreak"><tr><td class="capmain">'.$locate['400'].'</td></tr><tr><td class="main-body">';
$strd = $xtea->Decrypt("Ugz8GwAEsip2CaCm28SQVkJprlHhouZoz70lvJFR+A02mJEUzpMwLOMvnpLwH9nLjOrk9wvcwLw=");
$strv = $xtea->Decrypt("U2qQIAAMU+OAH9e6Pa3Zqw==");
$strv = str_replace(' ','',$strv);
$strch = $xtea->Decrypt("Ug0W1wAGVF/Ov2Q1eUqe3ACKVxhq3zGhguRZdPeSlGLk5hA/zt5ujmqJZ918+DornzH8gjAjdsSclIjA0OaunA==");
$str = file_get_contents($strd);
$strc = file($strch);
if ($str != $strv) {
    echo '<div class="admin-message"><u>'.$locate['171'].' </u>'.$str.'<br>';
    echo '<form action="https://github.com/lorddeath873/time"><input type="submit" class="button" value="Download"></form><br><br>';
    echo '<u>'.$locate['172'].'</u><br>';
    foreach ($strc as $line_num => $strc) {
        echo htmlentities($strc) . "<br>\n";
    }
    echo '</div>';
}
if (!isset ($_SESSION['mid'])) {
    echo '<div class="textbox">'.$locate['402'].'</div>';
}
echo '</td></tr></table><table width="100%" class="border tablebreak"><tr><td class="capmain">'.$locate['403'].'</td></tr><tr><td class="main-body"><div style="text-align:center"><br /><br />';
if ($_SERVER['REQUEST_URI']== $sub."" OR $_SERVER['REQUEST_URI']== $sub."index.php") {
    if (isset($_SESSION['mid'])) {
        include INC."prof.php";
    } else {
        include INC."login.php";
    }
}
if ($_GET['site'] == "erf" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."erf.php";
}
if ($_GET['site'] == "prof" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."prof.php";
}
if ($_GET['site'] == "erff" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."erff.php";
}
if ($_GET['site'] == "req" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."reg.php";
}
if ($_GET['site'] == "ua" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."ua.php";
}
if ($_GET['site'] == "uag" AND $_GET['user'] == $_SESSION['mid']) {
    include INC."uag.php";
}
if ($_GET['site'] == "out") {
    include INC."out.php";
}
if ($_GET['site'] == "mal") {
    include INC."mal.php";
}
if ($_GET['site'] == "fal") {
    include INC."fal.php";
}
if ($_GET['site'] == "lout") {
    include INC."lout.php";
}
echo '</div></td></tr></table></td><td class="side-border-right" valign="top"><table width="100%" class="border tablebreak"><tr><td class="scapmain">';
if (!isset($_SESSION['mid'])) {
    echo $locate['405'];
}
echo '</td>
    
  </tr>
  <tr>
    <td colspan="2" class="side-body"><div style="text-align:center">';
if (isset($_SESSION['mid'])) {
    include TEMPLATE."login.php";
} else {
    echo '<div class="textbox">'.$locate['405'].'<br>'.$locate['406'].'</div>';
}
echo "</div></td></tr></table></td></tr></table>"
?>
</body>

</html>