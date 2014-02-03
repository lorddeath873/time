<?php
    include ("../inc/dbconn.inc.php");
    $nl_sqll="SELECT * FROM settings";
    $db_erg=mysql_query($nl_sqll);
while ($fa = mysql_fetch_array($db_erg, MYSQL_ASSOC)) {
    $fma = $fa['fma'];
    $maa = $fa['maa'];
}
    $empfaenger = "support@nolimitgerman.de";
    $betreff    = "Time-Skript";
    $mailtext = "Ihr Time-Skript wurde installiert unter folgender Adresse<br><br>";
    $mailtext   .= $_SERVER['HTTP_HOST'];
    $mailtext .= $footer;
    $absender   = $fma." <".$maa.">";
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = "From: {$absender}";
    $headers[] = "Reply-To: {$absender}";
    $headers[] = "Subject: {$betreff}";
    $headers[] = "X-Mailer: PHP/".phpversion();
    mail($empfaenger, $betreff, $mailtext, implode("\r\n", $headers));
?>
<form action="<? $_SERVER['HTTP_HOST']?>" method="post">
<table class="outer-border" id="hori">
<tr>
<td class="textbox">Sie haben die Installation erfolgreich abgeschlossen. Bitte löschen Sie nun den Install-Ordner und rufen Ihre neues Time-Skript auf</td>
</tr>
<tr>
<td class="table-body"><input type="submit" class="button" value="Beenden"></td>
</tr>
</table>
</form>