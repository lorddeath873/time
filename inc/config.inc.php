<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$allowedfiletype = array('png', 'gif', 'jpg', 'jpeg'); // Bild-Upload Dateitypen erlauben
//Ab hier nichts mehr ändern!!!
require_once ('function.inc.php');
$allowed_langs = array ('de', 'en');

$lang = lang_getfrombrowser($allowed_langs, 'de', null, false);
$lng=$lang;
while (!file_exists($folder_level."/inc/config.inc.php")) {
    $folder_level .= "../";
    $i++;
    if ($i == 10) {
        die("config.inc.php file not found");
    }
}
define("BASEDIR", $folder_level);
define("TEMPLATE", "template/");
define("INC", BASEDIR."inc/");
define("CSS", TEMPLATE."css/");
define("IMG", TEMPLATE."img/");
define("JS", TEMPLATE."js/");
define("LNG", TEMPLATE."lang/".$lng.".php");
define("DB_SITE_LINKS", "site_links");
define("USR", "usr_login");
define("UIM", BASEDIR."usr/");
define("FA", "firmen");
define("UL", "urlaub");
define("SE", "settings");
include INC."dbconn.inc.php";
define("DB", $db);
$stmt=$mysqli->prepare("SELECT * FROM ".DB.".".SE."");
$stmt->execute();
$result=$stmt->get_result();
//$nl_sqll="SELECT * FROM ".DB.".".SE."";
while ($se = $result->fetch_array()) {
    $heimg = $se['heimg'];
    $sub = $se['sub'];
    $maxfilesize = $se['mfsize'];
    $image_prop = $se['image_prop'];
    $uploadMaxWidth = $se['upmw'];
    $uploadMaxHeight = $se['upmh'];
    $uploaddirb = $se['dir'];
    $db = $se['db'];
    $addrr = $se['addrr'];
    $admm = $se['admm'];
    $maa = $se['maa'];
    $fma = $se['fma'];
    $nam = $se['name'];
    $st = $se['str'];
    $pl = $se['plz'];
    $or = $se['ort'];
    $register = $se['reg'];
    $son = $se['son'];
    $te = $se['tel'];
    $hmail = $se['email'];

}
    $footer = "Inhaber: $nam <br> Strasse: $st <br> PLZ: $pl <br> Ort: $or <br> Registernummer: $register <br> Tel: $te <br> $son <br> Mail: $hmail <br> Website: $addrr"; // Footer für den E-Mail versandt
