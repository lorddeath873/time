<?php
include(INC."gmap/class.gmapper.php");
$karte = new gmap('AIzaSyBIagxVlDHwQJqyJl83yAHIk4o_w1-GiAI');
?>
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<?php
$karte->headjs();
?>
</head>
<body>
<div style="background-color:#666666;color:#FF0000;" align = "center">
<?php
$karte->mapdiv('200', '600');
?>
</div>
<?php
$karte->bodyjs();
$karte->map(6,'49.980067','10.8731',"normal",5,9);
?>
</body>
</html>