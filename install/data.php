<form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
<table class="outer-border" id="hori">
    <tr>
    <td class="textbox"><? echo $locate['013'] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['014'] ?></td>
    <td class="table-body"><input type="text" name="dbbn"/></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['015'] ?></td>
    <td class="table-body"><input type="password" name="dbpw"/></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['016'] ?></td>
    <td class="table-body"><input type="text" name="dbh"/></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['017'] ?></td>
    <td class="table-body"><input type="text" name="dbdb"/></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate['018'] ?></td>
    <td class="table-body"><input type="checkbox" name="dbpwv"/></td>
    </tr>
    <tr>
    <td class="table-body"><input type="submit" name="submit" value="Speichern und Weiter" class="button"/></td>
    </tr>
</table></form>
<?php
if ($_REQUEST['submit']) {
    $file = "../inc/dbdat.inc.php";
    if (isset ($_POST['dbpwv'])) {
        include_once("../inc/function.inc.php");
        mt_srand(crc32(microtime()));
        $buchstaben = array("","a","b","c","d","e","f","g","h","i","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z",1,2,3,4,5,6,7,8,9);
        $array_max = count($buchstaben)-1;

        for ($i=0; $i < 16; $i++) {
            $rand_num = mt_rand(1, $array_max);
            $key .= $buchstaben[$rand_num];
            $a++;
        }
        $dbpw = $_POST['dbpw'];
        $xtea = new XTEA($key);
        $xtkey = $xtea->Encrypt($dbpw);

        $txt = '$strHostName = "'.$_POST['dbh'].'";'."\n".'$strUserName = "'.$_POST['dbbn'].'";'."\n".'$strPassword = "'.$xtkey.'";'."\n".'$db = "'.$_POST['dbdb'].'";'."\n".'$c = "1";'."\n".'$ve = "'.$key.'";';
        $datei = fopen($file, w);
        fwrite($datei, $txt);

    } else {

        $txt = '$strHostName = "'.$_POST['dbh'].'";'."\n".'$strUserName = "'.$_POST['dbbn'].'";'."\n".'$strPassword = "'.$_POST['dbpw'].'";'."\n".'$db = "'.$_POST['dbdb'].'";'."\n".'';
        $datei = fopen($file, w);
        fwrite($datei, $txt);
    }
    if (file_exists("../inc/dbdat.inc.php")) {
        $db_erg=mysql_query("CREATE TABLE firmen (id int(10) NOT NULL auto_increment, an varchar(255) NOT NULL, fm varchar(255) NOT NULL, ort varchar(255) NOT NULL, plz varchar(255) NOT NULL, street varchar(255) NOT NULL, tel varchar(255) NOT NULL, PRIMARY KEY (id) );");
        if (!$db_erg) {
            echo '<table class="outer-border" id="hori"><tr><td class="failure"> Fehler beim Speichern der Tabelle firmen; Fehler bitte mit senden: '.mysql_error().' bitte wenden Sie sich an <a href="mailto:support@nolimitgerman.de">NoLimitGerman.de</td></table>';
        }
        $db_erg=mysql_query("CREATE TABLE settings (id int(10) NOT NULL auto_increment, heimg varchar(255) NOT NULL, sub varchar(255) NOT NULL, mfsize varchar(255) NOT NULL, image_prop varchar(255) NOT NULL, upmw varchar(255) NOT NULL, upmh varchar(255) NOT NULL, dir varchar(255) NOT NULL, addrr varchar(255) NOT NULL, admm varchar(255) NOT NULL, maa varchar(255) NOT NULL, fma varchar(255) NOT NULL, name varchar(255) NOT NULL, str varchar(255) NOT NULL, plz varchar(255) NOT NULL, ort varchar(255) NOT NULL, reg varchar(255) NOT NULL, son longblob NOT NULL, tel varchar(255) NOT NULL, email varchar(255) NOT NULL, PRIMARY KEY (id) );");
        if (!$db_erg) {
            echo '<table class="outer-border" id="hori"><tr><td class="failure"> Fehler beim Speichern der Tabelle settings; Fehler bitte mit senden: '.mysql_error().' bitte wenden Sie sich an <a href="mailto:support@nolimitgerman.de">NoLimitGerman.de</td></table>';
        }
        $db_erg=mysql_query("CREATE TABLE usr_login (id int(10) NOT NULL auto_increment, ma varchar(255) NOT NULL, pw varchar(255) NOT NULL, lo varchar(255) NOT NULL, logrp varchar(255) NOT NULL, name varchar(255) NOT NULL, surname varchar(255) NOT NULL, geb varchar(255) NOT NULL, ein varchar(255) NOT NULL, aus varchar(255) NOT NULL, street varchar(255) NOT NULL, plz varchar(255) NOT NULL, tel varchar(255) NOT NULL, mob varchar(255) NOT NULL, ort varchar(255) NOT NULL, url varchar(255) NOT NULL, reurl varchar(255) NOT NULL, usrgrp longblob NOT NULL, ber varchar(255) NOT NULL, me varchar(255) NOT NULL, mail varchar(255) NOT NULL, imgs longblob NOT NULL, fid varchar(255) NOT NULL, awo int(1) NOT NULL, uestd varchar(10) NOT NULL, soll varchar(4) NOT NULL, sollmonth varchar(255) NOT NULL, sollstd varchar(255), PRIMARY KEY (id) );");
        if (!$db_erg) {
            echo '<table class="outer-border" id="hori"><tr><td class="failure"> Fehler beim Speichern der Tabelle usr_login; Fehler bitte mit senden: '.mysql_error().' bitte wenden Sie sich an <a href="mailto:support@nolimitgerman.de">NoLimitGerman.de</td></table>';
        }
		$db_erg=mysql_query("CREATE TABLE urlaub (id int(10) NOT NULL auto_increment, ma int(10) NOT NULL, von varchar(255) NOT NULL, bis varchar(255) NOT NULL, ges varchar(255) NOT NULL, gen int(1) NOT NULL, me int(1) NOT NULL, PRIMARY KEY (id) );");
        if (!$db_erg) {
            echo '<table class="outer-border" id="hori"><tr><td class="failure"> Fehler beim Speichern der Tabelle Urlaub; Fehler bitte mit senden: '.mysql_error().' bitte wenden Sie sich an <a href="mailto:support@nolimitgerman.de">NoLimitGerman.de</td></table>';
        }
        ?>
        <form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
        <table class="outer-border" id="hori">
        <tr>
        <td class="textbox"><? echo $locate['019'] ?></td>
        <td class="table-body"><input type="text" name="falog"></td>
        <td class="textbox"><? echo $locate['020'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['021'] ?></td>
        <td class="table-body"><input type="text" name="sub" value="/"></td>
        <td class="textbox"><? echo $locate['022'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['023'] ?></td>
        <td class="table-body"><input type="text" name="mb" value="2"></td>
        <td class="textbox"><? echo $locate['024'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['025'] ?></td>
        <td class="table-body"><input type="text" name="mw" value="100"></td>
        <td class="textbox"><? echo $locate['026'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['027'] ?></td>
        <td class="table-body"><input type="text" name="mh" value="100"></td>
        <td class="textbox"><? echo $locate['028'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['029'] ?></td>
        <td class="table-body"><input type="text" name="adr" value="www.<?echo $_SERVER['HTTP_HOST']?>"></td>
        <td class="textbox"><? echo $locate['030'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['031'] ?></td>
        <td class="table-body"><input type="email" name="admm"></td>
        <td class="textbox"><? echo $locate['032'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['033'] ?></td>
        <td class="table-body"><input type="email" name="maa"></td>
        <td class="textbox"><? echo $locate['034'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['035'] ?></td>
        <td class="table-body"><input type="text" name="fma"></td>
        <td class="textbox"><? echo $locate['036'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['037'] ?></td>
        <td class="table-body"><input type="text" name="nma"></td>
        <td class="textbox"><? echo $locate['038'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['039'] ?></td>
        <td class="table-body"><input type="text" name="str"></td>
        <td class="textbox"><? echo $locate['040'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['041'] ?></td>
        <td class="table-body"><input type="text" name="plz"></td>
        <td class="textbox"><? echo $locate['042'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['043'] ?></td>
        <td class="table-body"><input type="text" name="ort"></td>
        <td class="textbox"><? echo $locate['044'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['045'] ?></td>
        <td class="table-body"><input type="text" name="reg"></td>
        <td class="textbox"><? echo $locate['046'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['047'] ?></td>
        <td class="table-body"><input type="tel" name="tel"></td>
        <td class="textbox"><? echo $locate['048'] ?></td>
        </tr>
        <tr>
        <td class="textbox"><? echo $locate['049'] ?></td>
        <td class="table-body"><input type="email" name="sup"></td>
        <td class="textbox"><? echo $locate['050'] ?></td>
        </tr>
        <tr>
        <td class="table-body"><input type="submit" class="button" name="sa" value="Speichern"></td>
        </tr>
        </table></form>
        <?php
        if ($_REQUEST['sa']) {
            include ("../inc/dbconn.inc.php");
            $nl_sqll="INSERT INTO settings (heimg, sub, mfsize, image_prop, upmw, upmh, dir, addrr, admm, maa, fma, name, str, plz, ort, reg, tel, email) VALUES ('$_POST[falog]', '$_POST[sub]', '$_POST[mb]', 'ja', '$_POST[mw]', '$_POST[mh]', 'avatar/', '$_POST[adr]', '$_POST[admm]', '$_POST[maa]', '$_POST[fma]', '$_POST[nma]', '$_POST[str]', '$_POST[plz]', '$_POST[ort]', '$_POST[reg]', '$_POST[tel]', '$_POST[sup]')";
            $pwww="345jk3tj3bg4j3b4";
            $pwmde=md5($pwww);
            $nlu_sqll="INSERT INTO usr_login (ma, pw, usrgrp, awo) VALUES ('1','$pwmde', '1', '0')";
            $db_ergu = mysql_query($nlu_sqll);
            $db_erg = mysql_query($nl_sqll);
            if (!$db_erg AND !$db_ergu) {
                echo '<table class="outer-border" id="hori"><tr><td class="failure"> Fehler beim Speichern; Fehler bitte mit senden: '.mysql_error().' bitte wenden Sie sich an <a href="mailto:support@nolimitgerman.de">NoLimitGerman.de</td></table>';
            } else {
                echo '<form method="post" action="./index.php?site=finish"><table class="outer-border" id="hori"><tr><td class="textbox"> Daten Gespeichert und Erstpasswort für den Admin wurde gespeichert '.$pwww.' Bitte &auml;ndern Sie dieses und Ihre Mitarbeiternummer unverz&uuml;glich, da dieses ein Standard Passwort ist! Bitte Notieren Sie sich das Erstpasswort sowie Ihre Mitarbeiternummer "1" damit loggen sie sich ein</td></tr><tr><td class="table-body"><input type="submit" value="Beenden" class="button"></td></tr></table></form>';
            }
        }
    } else {
        ?>
        <table class="outer-border" id="hori">
        <tr>
        <td class="failure"><? echo $locate['051'] ?></td>
        </tr>
        </table>
        <?php
    }
}

