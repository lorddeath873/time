<?php 
// Locate config.php and set the basedir path
$folder_level = "./";
$i = 0;
while (!file_exists($folder_level."/config.php")) {
    $folder_level .= "../";
    $i++;
    if ($i == 10) {
        die("config.php file not found");
    }
}

define("BASEDIR", "../".$folder_level);
define("BASEDIRI", $folder_level);
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
require "config.php";
include LNG;
include INC."dbconn.inc.php";
?>
<!DOCTYPE html>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><? echo $fma ?></title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="<? echo CSS ?>style.css" rel="stylesheet" type="text/css" />
<script src="<? echo JS ?>tcal.js" type="text/javascript"></script>
<script src="<? echo JS ?>failure.js" type="text/javascript"></script>
<link href="<? echo CSS ?>tcal.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" src="<? echo JS ?>scripts.js"></script>
</head>
<body >
<?php
echo "<table class='outer-border' id='main'><tr><td><table width='100%'><tr><td class='full-header'><table width='100%'><tr><td><img src='".IMG.$heimg."'></td></tr></table></td></tr></table><table width='100%'><tr><td class='sub-header'></td></tr></table>\n";
echo "<table width='100%'><tr>\n";
echo '</td></tr></table><table width="100%" class="border tablebreak"><tr><td class="capmain">'.$locate['001'].'</td></tr><tr><td class="main-body"><div style="text-align:center"><br /><br />';
if ($_SERVER['REQUEST_URI']== $sub."" OR $_SERVER['REQUEST_URI']== $sub."index.php") {
        include BASEDIRI."start.php";
}
if ($_GET['site'] == "chmod") {
    include BASEDIRI."chmod.php";
}
if ($_GET['site'] == "data") {
    include BASEDIRI."data.php";
}
if ($_GET['site'] == "finish") {
    include BASEDIRI."finish.php";
}
echo '</div></td></tr></table></td>';

?>
</body>

</html>
