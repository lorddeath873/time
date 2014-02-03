<?php
error_reporting(E_ALL);
$heimg="header.gif";
$sub="/install/";
$fma = "NoLimitGerman";

//Ab hier nichts mehr ändern!!!
error_reporting(E_ALL & ~E_NOTICE);
require_once ('../inc/function.inc.php');
$allowed_langs = array ('de', 'en');

$lang = lang_getfrombrowser($allowed_langs, 'de', null, false);
$lng=$lang;

define("TEMPLATE", "../template/");
define("INC", BASEDIR."inc/");
define("CSS", TEMPLATE."css/");
define("IMG", TEMPLATE."img/");
define("JS", TEMPLATE."js/");
define("LNG", $lng.".php");
define("DB_SITE_LINKS", "site_links");
define("USR", "usr_login");
define("Z", "zeit");
define("GRP", "usr_group");
define("UIM", BASEDIR."usr/");
define("DB", $db);
define("FA", "firmen");
define("WO", "work");
$ver= "0.1 Beta";
