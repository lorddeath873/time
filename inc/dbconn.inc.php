<?php
require "dbdat.inc.php";
if ($c == "1") {
    $xtea = new XTEA($ve);
    $xtkey =$xtea->Decrypt($strPassword);
    $strPassword = $xtkey;
}
$mysqli = new mysqli($strHostName, $strUserName, $strPassword, $db);
$mysqli->set_charset("utf8");

