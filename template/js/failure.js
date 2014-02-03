function pruefen(){
var f = document.forms[0];
var fehler = "";

if (f.ma.value == ""){
fehler += "- die Mitarbeiternummer\n";
f.ma.style.border = "solid red 1px";
}

if (f.lo.value == ""){
fehler += "- der Lohn\n";
f.lo.style.border = "solid red 1px";
}

if (f.logrp.value == ""){
fehler += "- die Lohngruppe\n";
f.logrp.style.border = "solid red 1px";
}

if (f.name.value == ""){
    fehler += "- der Name\n";
f.name.style.border = "solid red 1px";
}

if (f.surname.value == ""){
fehler += "- der Vorname\n";
f.surname.style.border = "solid red 1px";
}

if (f.geb.value == ""){
fehler += "- das Geburtsdatum\n";
f.geb.style.border = "solid red 1px";
}

if (f.plz.value == ""){
fehler += "- die Postleitzahl\n";
f.plz.style.border = "solid red 1px";
}

if (f.ort.value == ""){
fehler += "- der Ort\n";
f.ort.style.border = "solid red 1px";
}

if (f.street.value == ""){
fehler += "- die Strasse\n";
f.street.style.border = "solid red 1px";
}

if (f.ein.value == ""){
fehler += "- das Eintrittsdatum\n";
f.ein.style.border = "solid red 1px";
}

if (f.ber.value == ""){
fehler += "- der Bereich\n";
f.ber.style.border = "solid red 1px";
}

if (f.mail.value == ""){
fehler += "- die E-Mail\n";
f.mail.style.border = "solid red 1px";
}

if (f.url.value == ""){
fehler += "- der Urlaub\n";
f.url.style.border = "solid red 1px";
}

if (f.reurl.value == ""){
fehler += "- der Resturlaub\n";
f.reurl.style.border = "solid red 1px";
}

if (f.mail.value.indexOf("@") == -1){
fehler += "- eine korrekte eMail-Adresse\n";
f.mail.style.border = "solid red 1px";
}

if (f.lo.value.indexOf(".") == -1){
fehler += "- einen korrekten Lohn\n";
f.lo.style.border = "solid red 1px";
}


for (var i = 0; i < f.tel.value.length; i++) {
if ((f.tel.value.charAt(i) > "9" || f.tel.value.charAt(i) < "0") &&
f.tel.value.charAt(i) != "/" &&
f.tel.value.charAt(i) != " " &&
f.tel.value.charAt(i) != "-" &&
f.tel.value.charAt(i) != "+") {
fehler += "\t- eine korrekte Telefonnummer\n";
f.tel.style.border = "solid red 1px";

break;
}
}
 
for (var i = 0; i < f.mob.value.length; i++) {
if ((f.mob.value.charAt(i) > "9" || f.mob.value.charAt(i) < "0") &&
f.mob.value.charAt(i) != "/" &&
f.mob.value.charAt(i) != " " &&
f.mob.value.charAt(i) != "-" &&
f.mob.value.charAt(i) != "+") {
fehler += "\t- eine korrekte Handynummer\n";
f.mob.style.border = "solid red 1px";

break;
}
} 

var chkZ = 1;
  for (i = 0; i < f.plz.value.length; ++i)
    if (f.plz.value.charAt(i) < "0" ||
        f.plz.value.charAt(i) > "9"){
      chkZ = -1;}
  if (chkZ == -1) {
    fehler += "\t- Postleitzahl ist keine Zahl!";
    f.plz.style.border = "solid red 1px";

    }

var chkZ = 1;
  for (i = 0; i < f.ma.value.length; ++i)
    if (f.ma.value.charAt(i) < "0" ||
        f.ma.value.charAt(i) > "9"){
      chkZ = -1;}
  if (chkZ == -1) {
    fehler += "\t- Mitarbeiternummer ist keine Zahl!";
    f.ma.style.border = "solid red 1px";

    }
    
var chkZ = 1;
  for (i = 0; i < f.logrp.value.length; ++i)
    if (f.logrp.value.charAt(i) < "0" ||
        f.logrp.value.charAt(i) > "9"){
      chkZ = -1;}
  if (chkZ == -1) {
    fehler += "\t- Lohngruppe ist keine Zahl!";
    f.logrp.style.border = "solid red 1px";

    }

var chkZ = 1;
  for (i = 0; i < f.url.value.length; ++i)
    if (f.url.value.charAt(i) < "0" ||
        f.url.value.charAt(i) > "9"){
      chkZ = -1;}
  if (chkZ == -1) {
    fehler += "\t- Urlaub ist keine Zahl!";
    f.url.style.border = "solid red 1px";

    }

var chkZ = 1;
  for (i = 0; i < f.reurl.value.length; ++i)
    if (f.reurl.value.charAt(i) < "0" ||
        f.reurl.value.charAt(i) > "9"){
      chkZ = -1;}
  if (chkZ == -1) {
    fehler += "\t- Resturlaub  ist keine Zahl!";
    f.reurl.style.border = "solid red 1px";

    }

    
    



if (fehler != ""){
var fehlertext = "Die folgenden Felder wurden nicht vollständig ausgefüllt:\n\n";
fehlertext += fehler;
alert(fehlertext + "\nBitte füllen Sie die Informationen noch aus.");
return false;
}
return true;
}