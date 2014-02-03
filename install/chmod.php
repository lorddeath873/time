<?php
    clearstatcache();
if (chmod(INC."config.inc.php", 0777) == false) {
    $cc = '<tr><td class="textbox">'.$locate['002'].'</td><td class="textbox"><img src="'.IMG.'/x.jpg" alt="ok" width="60" height="60"/></td></tr>';
}
if (chmod(INC."dbdat.inc.php", 0777) == false) {
        $cc .= '<tr><td class="textbox">'.$locate['003'].'</td><td class="textbox"><img src="'.IMG.'/x.jpg" alt="ok" width="60" height="60"/></td></tr>';
}
if (chmod("../usr", 0777) == false) {
        $cc .= '<tr><td class="textbox">'.$locate['004'].'</td><td class="textbox"><img src="'.IMG.'/x.jpg" alt="ok" width="60" height="60"/></td></tr>';
}
if (chmod("../usr/avatar", 0777) == false) {
        $cc .= '<tr><td class="textbox">'.$locate['005'].'</td><td class="textbox"><img src="'.IMG.'/x.jpg" alt="ok" width="60" height="60"/></td></tr>';
}
function file_perms($file, $octal = false)
{
    if (!file_exists($file)) return false;

    $perms = fileperms($file);

    $cut = $octal ? 2 : 3;

    return substr(decoct($perms), $cut);
}
echo '<form method="post" action="index.php?site=data">';
echo '<table class="outer-border" id="hori">';
if (!$cc) {
    echo '<tr><td class="textbox">'.$locate['006'].'</td><td class="textbox">'.file_perms(INC."config.inc.php", "true").'</td><td class="textbox"><img src="'.IMG.'/haken.jpg" alt="ok" width="60" height="60" /></td></tr>';
    echo '<tr><td class="textbox">'.$locate['007'].'</td><td class="textbox">'.file_perms(INC."dbdat.inc.php", "true").' </td><td class="textbox"><img src="'.IMG.'/haken.jpg" alt="ok" width="60" height="60" /></td></tr>';
    echo '<tr><td class="textbox">'.$locate['008'].'</td><td class="textbox">'.file_perms(INC."../usr", "true").'</td><td class="textbox"><img src="'.IMG.'/haken.jpg" alt="ok" width="60" height="60" /></td></tr>';
    echo '<tr><td class="textbox">'.$locate['009'].'</td><td class="textbox">'.file_perms(INC."../usr/avatar", "true").'</td><td class="textbox"><img src="'.IMG.'/haken.jpg" alt="ok" width="60" height="60" /></td></tr>';
    echo '<tr><td class="table-body"><input type="submit" class="button" value="Weiter"/></td></tr>';
} else {
    echo $cc;
}
echo '</table></form>';
